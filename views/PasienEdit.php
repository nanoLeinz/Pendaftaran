<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPASIENedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fPASIENedit = currentForm = new ew.Form("fPASIENedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PASIEN")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PASIEN)
        ew.vars.tables.PASIEN = currentTable;
    fPASIENedit.addFields([
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["NAME_OF_PASIEN", [fields.NAME_OF_PASIEN.visible && fields.NAME_OF_PASIEN.required ? ew.Validators.required(fields.NAME_OF_PASIEN.caption) : null], fields.NAME_OF_PASIEN.isInvalid],
        ["PASIEN_ID", [fields.PASIEN_ID.visible && fields.PASIEN_ID.required ? ew.Validators.required(fields.PASIEN_ID.caption) : null], fields.PASIEN_ID.isInvalid],
        ["KK_NO", [fields.KK_NO.visible && fields.KK_NO.required ? ew.Validators.required(fields.KK_NO.caption) : null], fields.KK_NO.isInvalid],
        ["PLACE_OF_BIRTH", [fields.PLACE_OF_BIRTH.visible && fields.PLACE_OF_BIRTH.required ? ew.Validators.required(fields.PLACE_OF_BIRTH.caption) : null], fields.PLACE_OF_BIRTH.isInvalid],
        ["DATE_OF_BIRTH", [fields.DATE_OF_BIRTH.visible && fields.DATE_OF_BIRTH.required ? ew.Validators.required(fields.DATE_OF_BIRTH.caption) : null, ew.Validators.datetime(11)], fields.DATE_OF_BIRTH.isInvalid],
        ["GENDER", [fields.GENDER.visible && fields.GENDER.required ? ew.Validators.required(fields.GENDER.caption) : null], fields.GENDER.isInvalid],
        ["EDUCATION_TYPE_CODE", [fields.EDUCATION_TYPE_CODE.visible && fields.EDUCATION_TYPE_CODE.required ? ew.Validators.required(fields.EDUCATION_TYPE_CODE.caption) : null], fields.EDUCATION_TYPE_CODE.isInvalid],
        ["MARITALSTATUSID", [fields.MARITALSTATUSID.visible && fields.MARITALSTATUSID.required ? ew.Validators.required(fields.MARITALSTATUSID.caption) : null], fields.MARITALSTATUSID.isInvalid],
        ["KODE_AGAMA", [fields.KODE_AGAMA.visible && fields.KODE_AGAMA.required ? ew.Validators.required(fields.KODE_AGAMA.caption) : null], fields.KODE_AGAMA.isInvalid],
        ["KAL_ID", [fields.KAL_ID.visible && fields.KAL_ID.required ? ew.Validators.required(fields.KAL_ID.caption) : null], fields.KAL_ID.isInvalid],
        ["JOB_ID", [fields.JOB_ID.visible && fields.JOB_ID.required ? ew.Validators.required(fields.JOB_ID.caption) : null], fields.JOB_ID.isInvalid],
        ["STATUS_PASIEN_ID", [fields.STATUS_PASIEN_ID.visible && fields.STATUS_PASIEN_ID.required ? ew.Validators.required(fields.STATUS_PASIEN_ID.caption) : null], fields.STATUS_PASIEN_ID.isInvalid],
        ["CONTACT_ADDRESS", [fields.CONTACT_ADDRESS.visible && fields.CONTACT_ADDRESS.required ? ew.Validators.required(fields.CONTACT_ADDRESS.caption) : null], fields.CONTACT_ADDRESS.isInvalid],
        ["PHONE_NUMBER", [fields.PHONE_NUMBER.visible && fields.PHONE_NUMBER.required ? ew.Validators.required(fields.PHONE_NUMBER.caption) : null], fields.PHONE_NUMBER.isInvalid],
        ["MOBILE", [fields.MOBILE.visible && fields.MOBILE.required ? ew.Validators.required(fields.MOBILE.caption) : null], fields.MOBILE.isInvalid],
        ["PAYOR_ID", [fields.PAYOR_ID.visible && fields.PAYOR_ID.required ? ew.Validators.required(fields.PAYOR_ID.caption) : null], fields.PAYOR_ID.isInvalid],
        ["MOTHER", [fields.MOTHER.visible && fields.MOTHER.required ? ew.Validators.required(fields.MOTHER.caption) : null], fields.MOTHER.isInvalid],
        ["FATHER", [fields.FATHER.visible && fields.FATHER.required ? ew.Validators.required(fields.FATHER.caption) : null], fields.FATHER.isInvalid],
        ["SPOUSE", [fields.SPOUSE.visible && fields.SPOUSE.required ? ew.Validators.required(fields.SPOUSE.caption) : null], fields.SPOUSE.isInvalid],
        ["ORG_ID", [fields.ORG_ID.visible && fields.ORG_ID.required ? ew.Validators.required(fields.ORG_ID.caption) : null], fields.ORG_ID.isInvalid],
        ["AKTIF", [fields.AKTIF.visible && fields.AKTIF.required ? ew.Validators.required(fields.AKTIF.caption) : null], fields.AKTIF.isInvalid],
        ["CLASS_ID", [fields.CLASS_ID.visible && fields.CLASS_ID.required ? ew.Validators.required(fields.CLASS_ID.caption) : null], fields.CLASS_ID.isInvalid],
        ["COVERAGE_ID", [fields.COVERAGE_ID.visible && fields.COVERAGE_ID.required ? ew.Validators.required(fields.COVERAGE_ID.caption) : null], fields.COVERAGE_ID.isInvalid],
        ["FAMILY_STATUS_ID", [fields.FAMILY_STATUS_ID.visible && fields.FAMILY_STATUS_ID.required ? ew.Validators.required(fields.FAMILY_STATUS_ID.caption) : null], fields.FAMILY_STATUS_ID.isInvalid],
        ["TMT", [fields.TMT.visible && fields.TMT.required ? ew.Validators.required(fields.TMT.caption) : null], fields.TMT.isInvalid],
        ["TAT", [fields.TAT.visible && fields.TAT.required ? ew.Validators.required(fields.TAT.caption) : null], fields.TAT.isInvalid],
        ["REGISTRATION_DATE", [fields.REGISTRATION_DATE.visible && fields.REGISTRATION_DATE.required ? ew.Validators.required(fields.REGISTRATION_DATE.caption) : null], fields.REGISTRATION_DATE.isInvalid],
        ["MEDICAL_NOTES", [fields.MEDICAL_NOTES.visible && fields.MEDICAL_NOTES.required ? ew.Validators.required(fields.MEDICAL_NOTES.caption) : null], fields.MEDICAL_NOTES.isInvalid],
        ["Cek", [fields.Cek.visible && fields.Cek.required ? ew.Validators.required(fields.Cek.caption) : null], fields.Cek.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fPASIENedit,
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
    fPASIENedit.validate = function () {
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
    fPASIENedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPASIENedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fPASIENedit.lists.GENDER = <?= $Page->GENDER->toClientList($Page) ?>;
    fPASIENedit.lists.EDUCATION_TYPE_CODE = <?= $Page->EDUCATION_TYPE_CODE->toClientList($Page) ?>;
    fPASIENedit.lists.MARITALSTATUSID = <?= $Page->MARITALSTATUSID->toClientList($Page) ?>;
    fPASIENedit.lists.KODE_AGAMA = <?= $Page->KODE_AGAMA->toClientList($Page) ?>;
    fPASIENedit.lists.KAL_ID = <?= $Page->KAL_ID->toClientList($Page) ?>;
    fPASIENedit.lists.JOB_ID = <?= $Page->JOB_ID->toClientList($Page) ?>;
    fPASIENedit.lists.STATUS_PASIEN_ID = <?= $Page->STATUS_PASIEN_ID->toClientList($Page) ?>;
    fPASIENedit.lists.PAYOR_ID = <?= $Page->PAYOR_ID->toClientList($Page) ?>;
    fPASIENedit.lists.CLASS_ID = <?= $Page->CLASS_ID->toClientList($Page) ?>;
    fPASIENedit.lists.COVERAGE_ID = <?= $Page->COVERAGE_ID->toClientList($Page) ?>;
    loadjs.done("fPASIENedit");
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
<form name="fPASIENedit" id="fPASIENedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label id="elh_PASIEN_NO_REGISTRATION" for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION->caption() ?><?= $Page->NO_REGISTRATION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_PASIEN_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NO_REGISTRATION->getDisplayValue($Page->NO_REGISTRATION->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN" data-field="x_NO_REGISTRATION" data-hidden="1" data-page="1" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" value="<?= HtmlEncode($Page->NO_REGISTRATION->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
    <div id="r_NAME_OF_PASIEN" class="form-group row">
        <label id="elh_PASIEN_NAME_OF_PASIEN" for="x_NAME_OF_PASIEN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAME_OF_PASIEN->caption() ?><?= $Page->NAME_OF_PASIEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el_PASIEN_NAME_OF_PASIEN">
<input type="<?= $Page->NAME_OF_PASIEN->getInputTextType() ?>" data-table="PASIEN" data-field="x_NAME_OF_PASIEN" data-page="1" name="x_NAME_OF_PASIEN" id="x_NAME_OF_PASIEN" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAME_OF_PASIEN->getPlaceHolder()) ?>" value="<?= $Page->NAME_OF_PASIEN->EditValue ?>"<?= $Page->NAME_OF_PASIEN->editAttributes() ?> aria-describedby="x_NAME_OF_PASIEN_help">
<?= $Page->NAME_OF_PASIEN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAME_OF_PASIEN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
    <div id="r_PASIEN_ID" class="form-group row">
        <label id="elh_PASIEN_PASIEN_ID" for="x_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PASIEN_ID->caption() ?><?= $Page->PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el_PASIEN_PASIEN_ID">
<input type="<?= $Page->PASIEN_ID->getInputTextType() ?>" data-table="PASIEN" data-field="x_PASIEN_ID" data-page="1" name="x_PASIEN_ID" id="x_PASIEN_ID" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->PASIEN_ID->getPlaceHolder()) ?>" value="<?= $Page->PASIEN_ID->EditValue ?>"<?= $Page->PASIEN_ID->editAttributes() ?> aria-describedby="x_PASIEN_ID_help">
<?= $Page->PASIEN_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PASIEN_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KK_NO->Visible) { // KK_NO ?>
    <div id="r_KK_NO" class="form-group row">
        <label id="elh_PASIEN_KK_NO" for="x_KK_NO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KK_NO->caption() ?><?= $Page->KK_NO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KK_NO->cellAttributes() ?>>
<span id="el_PASIEN_KK_NO">
<input type="<?= $Page->KK_NO->getInputTextType() ?>" data-table="PASIEN" data-field="x_KK_NO" data-page="1" name="x_KK_NO" id="x_KK_NO" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->KK_NO->getPlaceHolder()) ?>" value="<?= $Page->KK_NO->EditValue ?>"<?= $Page->KK_NO->editAttributes() ?> aria-describedby="x_KK_NO_help">
<?= $Page->KK_NO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KK_NO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
    <div id="r_PLACE_OF_BIRTH" class="form-group row">
        <label id="elh_PASIEN_PLACE_OF_BIRTH" for="x_PLACE_OF_BIRTH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PLACE_OF_BIRTH->caption() ?><?= $Page->PLACE_OF_BIRTH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el_PASIEN_PLACE_OF_BIRTH">
<input type="<?= $Page->PLACE_OF_BIRTH->getInputTextType() ?>" data-table="PASIEN" data-field="x_PLACE_OF_BIRTH" data-page="1" name="x_PLACE_OF_BIRTH" id="x_PLACE_OF_BIRTH" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PLACE_OF_BIRTH->getPlaceHolder()) ?>" value="<?= $Page->PLACE_OF_BIRTH->EditValue ?>"<?= $Page->PLACE_OF_BIRTH->editAttributes() ?> aria-describedby="x_PLACE_OF_BIRTH_help">
<?= $Page->PLACE_OF_BIRTH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PLACE_OF_BIRTH->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
    <div id="r_DATE_OF_BIRTH" class="form-group row">
        <label id="elh_PASIEN_DATE_OF_BIRTH" for="x_DATE_OF_BIRTH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DATE_OF_BIRTH->caption() ?><?= $Page->DATE_OF_BIRTH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el_PASIEN_DATE_OF_BIRTH">
<input type="<?= $Page->DATE_OF_BIRTH->getInputTextType() ?>" data-table="PASIEN" data-field="x_DATE_OF_BIRTH" data-page="1" data-format="11" name="x_DATE_OF_BIRTH" id="x_DATE_OF_BIRTH" placeholder="<?= HtmlEncode($Page->DATE_OF_BIRTH->getPlaceHolder()) ?>" value="<?= $Page->DATE_OF_BIRTH->EditValue ?>"<?= $Page->DATE_OF_BIRTH->editAttributes() ?> aria-describedby="x_DATE_OF_BIRTH_help">
<?= $Page->DATE_OF_BIRTH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DATE_OF_BIRTH->getErrorMessage() ?></div>
<?php if (!$Page->DATE_OF_BIRTH->ReadOnly && !$Page->DATE_OF_BIRTH->Disabled && !isset($Page->DATE_OF_BIRTH->EditAttrs["readonly"]) && !isset($Page->DATE_OF_BIRTH->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIENedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIENedit", "x_DATE_OF_BIRTH", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <div id="r_GENDER" class="form-group row">
        <label id="elh_PASIEN_GENDER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GENDER->caption() ?><?= $Page->GENDER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_PASIEN_GENDER">
<template id="tp_x_GENDER">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="PASIEN" data-field="x_GENDER" name="x_GENDER" id="x_GENDER"<?= $Page->GENDER->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_GENDER" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_GENDER"
    name="x_GENDER"
    value="<?= HtmlEncode($Page->GENDER->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_GENDER"
    data-target="dsl_x_GENDER"
    data-repeatcolumn="5"
    class="form-control<?= $Page->GENDER->isInvalidClass() ?>"
    data-table="PASIEN"
    data-field="x_GENDER"
    data-page="1"
    data-value-separator="<?= $Page->GENDER->displayValueSeparatorAttribute() ?>"
    <?= $Page->GENDER->editAttributes() ?>>
<?= $Page->GENDER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->GENDER->getErrorMessage() ?></div>
<?= $Page->GENDER->Lookup->getParamTag($Page, "p_x_GENDER") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
    <div id="r_EDUCATION_TYPE_CODE" class="form-group row">
        <label id="elh_PASIEN_EDUCATION_TYPE_CODE" for="x_EDUCATION_TYPE_CODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EDUCATION_TYPE_CODE->caption() ?><?= $Page->EDUCATION_TYPE_CODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EDUCATION_TYPE_CODE->cellAttributes() ?>>
<span id="el_PASIEN_EDUCATION_TYPE_CODE">
    <select
        id="x_EDUCATION_TYPE_CODE"
        name="x_EDUCATION_TYPE_CODE"
        class="form-control ew-select<?= $Page->EDUCATION_TYPE_CODE->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_EDUCATION_TYPE_CODE"
        data-table="PASIEN"
        data-field="x_EDUCATION_TYPE_CODE"
        data-page="1"
        data-value-separator="<?= $Page->EDUCATION_TYPE_CODE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->EDUCATION_TYPE_CODE->getPlaceHolder()) ?>"
        <?= $Page->EDUCATION_TYPE_CODE->editAttributes() ?>>
        <?= $Page->EDUCATION_TYPE_CODE->selectOptionListHtml("x_EDUCATION_TYPE_CODE") ?>
    </select>
    <?= $Page->EDUCATION_TYPE_CODE->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->EDUCATION_TYPE_CODE->getErrorMessage() ?></div>
<?= $Page->EDUCATION_TYPE_CODE->Lookup->getParamTag($Page, "p_x_EDUCATION_TYPE_CODE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_EDUCATION_TYPE_CODE']"),
        options = { name: "x_EDUCATION_TYPE_CODE", selectId: "PASIEN_x_EDUCATION_TYPE_CODE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.EDUCATION_TYPE_CODE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
    <div id="r_MARITALSTATUSID" class="form-group row">
        <label id="elh_PASIEN_MARITALSTATUSID" for="x_MARITALSTATUSID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MARITALSTATUSID->caption() ?><?= $Page->MARITALSTATUSID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MARITALSTATUSID->cellAttributes() ?>>
<span id="el_PASIEN_MARITALSTATUSID">
    <select
        id="x_MARITALSTATUSID"
        name="x_MARITALSTATUSID"
        class="form-control ew-select<?= $Page->MARITALSTATUSID->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_MARITALSTATUSID"
        data-table="PASIEN"
        data-field="x_MARITALSTATUSID"
        data-page="1"
        data-value-separator="<?= $Page->MARITALSTATUSID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MARITALSTATUSID->getPlaceHolder()) ?>"
        <?= $Page->MARITALSTATUSID->editAttributes() ?>>
        <?= $Page->MARITALSTATUSID->selectOptionListHtml("x_MARITALSTATUSID") ?>
    </select>
    <?= $Page->MARITALSTATUSID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MARITALSTATUSID->getErrorMessage() ?></div>
<?= $Page->MARITALSTATUSID->Lookup->getParamTag($Page, "p_x_MARITALSTATUSID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_MARITALSTATUSID']"),
        options = { name: "x_MARITALSTATUSID", selectId: "PASIEN_x_MARITALSTATUSID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.MARITALSTATUSID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <div id="r_KODE_AGAMA" class="form-group row">
        <label id="elh_PASIEN_KODE_AGAMA" for="x_KODE_AGAMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KODE_AGAMA->caption() ?><?= $Page->KODE_AGAMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el_PASIEN_KODE_AGAMA">
    <select
        id="x_KODE_AGAMA"
        name="x_KODE_AGAMA"
        class="form-control ew-select<?= $Page->KODE_AGAMA->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_KODE_AGAMA"
        data-table="PASIEN"
        data-field="x_KODE_AGAMA"
        data-page="1"
        data-value-separator="<?= $Page->KODE_AGAMA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KODE_AGAMA->getPlaceHolder()) ?>"
        <?= $Page->KODE_AGAMA->editAttributes() ?>>
        <?= $Page->KODE_AGAMA->selectOptionListHtml("x_KODE_AGAMA") ?>
    </select>
    <?= $Page->KODE_AGAMA->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KODE_AGAMA->getErrorMessage() ?></div>
<?= $Page->KODE_AGAMA->Lookup->getParamTag($Page, "p_x_KODE_AGAMA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_KODE_AGAMA']"),
        options = { name: "x_KODE_AGAMA", selectId: "PASIEN_x_KODE_AGAMA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.KODE_AGAMA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KAL_ID->Visible) { // KAL_ID ?>
    <div id="r_KAL_ID" class="form-group row">
        <label id="elh_PASIEN_KAL_ID" for="x_KAL_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KAL_ID->caption() ?><?= $Page->KAL_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KAL_ID->cellAttributes() ?>>
<span id="el_PASIEN_KAL_ID">
    <select
        id="x_KAL_ID"
        name="x_KAL_ID"
        class="form-control ew-select<?= $Page->KAL_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_KAL_ID"
        data-table="PASIEN"
        data-field="x_KAL_ID"
        data-page="1"
        data-value-separator="<?= $Page->KAL_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KAL_ID->getPlaceHolder()) ?>"
        <?= $Page->KAL_ID->editAttributes() ?>>
        <?= $Page->KAL_ID->selectOptionListHtml("x_KAL_ID") ?>
    </select>
    <?= $Page->KAL_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KAL_ID->getErrorMessage() ?></div>
<?= $Page->KAL_ID->Lookup->getParamTag($Page, "p_x_KAL_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_KAL_ID']"),
        options = { name: "x_KAL_ID", selectId: "PASIEN_x_KAL_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.KAL_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
    <div id="r_JOB_ID" class="form-group row">
        <label id="elh_PASIEN_JOB_ID" for="x_JOB_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JOB_ID->caption() ?><?= $Page->JOB_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->JOB_ID->cellAttributes() ?>>
<span id="el_PASIEN_JOB_ID">
    <select
        id="x_JOB_ID"
        name="x_JOB_ID"
        class="form-control ew-select<?= $Page->JOB_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_JOB_ID"
        data-table="PASIEN"
        data-field="x_JOB_ID"
        data-page="1"
        data-value-separator="<?= $Page->JOB_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->JOB_ID->getPlaceHolder()) ?>"
        <?= $Page->JOB_ID->editAttributes() ?>>
        <?= $Page->JOB_ID->selectOptionListHtml("x_JOB_ID") ?>
    </select>
    <?= $Page->JOB_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->JOB_ID->getErrorMessage() ?></div>
<?= $Page->JOB_ID->Lookup->getParamTag($Page, "p_x_JOB_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_JOB_ID']"),
        options = { name: "x_JOB_ID", selectId: "PASIEN_x_JOB_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.JOB_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <div id="r_STATUS_PASIEN_ID" class="form-group row">
        <label id="elh_PASIEN_STATUS_PASIEN_ID" for="x_STATUS_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_PASIEN_ID->caption() ?><?= $Page->STATUS_PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_PASIEN_STATUS_PASIEN_ID">
    <select
        id="x_STATUS_PASIEN_ID"
        name="x_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Page->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_STATUS_PASIEN_ID"
        data-table="PASIEN"
        data-field="x_STATUS_PASIEN_ID"
        data-page="1"
        data-value-separator="<?= $Page->STATUS_PASIEN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->STATUS_PASIEN_ID->getPlaceHolder()) ?>"
        <?= $Page->STATUS_PASIEN_ID->editAttributes() ?>>
        <?= $Page->STATUS_PASIEN_ID->selectOptionListHtml("x_STATUS_PASIEN_ID") ?>
    </select>
    <?= $Page->STATUS_PASIEN_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->STATUS_PASIEN_ID->getErrorMessage() ?></div>
<?= $Page->STATUS_PASIEN_ID->Lookup->getParamTag($Page, "p_x_STATUS_PASIEN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_STATUS_PASIEN_ID']"),
        options = { name: "x_STATUS_PASIEN_ID", selectId: "PASIEN_x_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
    <div id="r_CONTACT_ADDRESS" class="form-group row">
        <label id="elh_PASIEN_CONTACT_ADDRESS" for="x_CONTACT_ADDRESS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CONTACT_ADDRESS->caption() ?><?= $Page->CONTACT_ADDRESS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CONTACT_ADDRESS->cellAttributes() ?>>
<span id="el_PASIEN_CONTACT_ADDRESS">
<textarea data-table="PASIEN" data-field="x_CONTACT_ADDRESS" data-page="1" name="x_CONTACT_ADDRESS" id="x_CONTACT_ADDRESS" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->CONTACT_ADDRESS->getPlaceHolder()) ?>"<?= $Page->CONTACT_ADDRESS->editAttributes() ?> aria-describedby="x_CONTACT_ADDRESS_help"><?= $Page->CONTACT_ADDRESS->EditValue ?></textarea>
<?= $Page->CONTACT_ADDRESS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CONTACT_ADDRESS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PHONE_NUMBER->Visible) { // PHONE_NUMBER ?>
    <div id="r_PHONE_NUMBER" class="form-group row">
        <label id="elh_PASIEN_PHONE_NUMBER" for="x_PHONE_NUMBER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PHONE_NUMBER->caption() ?><?= $Page->PHONE_NUMBER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PHONE_NUMBER->cellAttributes() ?>>
<span id="el_PASIEN_PHONE_NUMBER">
<input type="<?= $Page->PHONE_NUMBER->getInputTextType() ?>" data-table="PASIEN" data-field="x_PHONE_NUMBER" data-page="1" name="x_PHONE_NUMBER" id="x_PHONE_NUMBER" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->PHONE_NUMBER->getPlaceHolder()) ?>" value="<?= $Page->PHONE_NUMBER->EditValue ?>"<?= $Page->PHONE_NUMBER->editAttributes() ?> aria-describedby="x_PHONE_NUMBER_help">
<?= $Page->PHONE_NUMBER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PHONE_NUMBER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { // MOBILE ?>
    <div id="r_MOBILE" class="form-group row">
        <label id="elh_PASIEN_MOBILE" for="x_MOBILE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MOBILE->caption() ?><?= $Page->MOBILE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MOBILE->cellAttributes() ?>>
<span id="el_PASIEN_MOBILE">
<input type="<?= $Page->MOBILE->getInputTextType() ?>" data-table="PASIEN" data-field="x_MOBILE" data-page="1" name="x_MOBILE" id="x_MOBILE" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->MOBILE->getPlaceHolder()) ?>" value="<?= $Page->MOBILE->EditValue ?>"<?= $Page->MOBILE->editAttributes() ?> aria-describedby="x_MOBILE_help">
<?= $Page->MOBILE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MOBILE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <div id="r_PAYOR_ID" class="form-group row">
        <label id="elh_PASIEN_PAYOR_ID" for="x_PAYOR_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYOR_ID->caption() ?><?= $Page->PAYOR_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el_PASIEN_PAYOR_ID">
    <select
        id="x_PAYOR_ID"
        name="x_PAYOR_ID"
        class="form-control ew-select<?= $Page->PAYOR_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_PAYOR_ID"
        data-table="PASIEN"
        data-field="x_PAYOR_ID"
        data-page="1"
        data-value-separator="<?= $Page->PAYOR_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PAYOR_ID->getPlaceHolder()) ?>"
        <?= $Page->PAYOR_ID->editAttributes() ?>>
        <?= $Page->PAYOR_ID->selectOptionListHtml("x_PAYOR_ID") ?>
    </select>
    <?= $Page->PAYOR_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PAYOR_ID->getErrorMessage() ?></div>
<?= $Page->PAYOR_ID->Lookup->getParamTag($Page, "p_x_PAYOR_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_PAYOR_ID']"),
        options = { name: "x_PAYOR_ID", selectId: "PASIEN_x_PAYOR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.PAYOR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MOTHER->Visible) { // MOTHER ?>
    <div id="r_MOTHER" class="form-group row">
        <label id="elh_PASIEN_MOTHER" for="x_MOTHER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MOTHER->caption() ?><?= $Page->MOTHER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MOTHER->cellAttributes() ?>>
<span id="el_PASIEN_MOTHER">
<input type="<?= $Page->MOTHER->getInputTextType() ?>" data-table="PASIEN" data-field="x_MOTHER" data-page="1" name="x_MOTHER" id="x_MOTHER" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->MOTHER->getPlaceHolder()) ?>" value="<?= $Page->MOTHER->EditValue ?>"<?= $Page->MOTHER->editAttributes() ?> aria-describedby="x_MOTHER_help">
<?= $Page->MOTHER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MOTHER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FATHER->Visible) { // FATHER ?>
    <div id="r_FATHER" class="form-group row">
        <label id="elh_PASIEN_FATHER" for="x_FATHER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FATHER->caption() ?><?= $Page->FATHER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FATHER->cellAttributes() ?>>
<span id="el_PASIEN_FATHER">
<input type="<?= $Page->FATHER->getInputTextType() ?>" data-table="PASIEN" data-field="x_FATHER" data-page="1" name="x_FATHER" id="x_FATHER" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->FATHER->getPlaceHolder()) ?>" value="<?= $Page->FATHER->EditValue ?>"<?= $Page->FATHER->editAttributes() ?> aria-describedby="x_FATHER_help">
<?= $Page->FATHER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FATHER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SPOUSE->Visible) { // SPOUSE ?>
    <div id="r_SPOUSE" class="form-group row">
        <label id="elh_PASIEN_SPOUSE" for="x_SPOUSE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SPOUSE->caption() ?><?= $Page->SPOUSE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SPOUSE->cellAttributes() ?>>
<span id="el_PASIEN_SPOUSE">
<input type="<?= $Page->SPOUSE->getInputTextType() ?>" data-table="PASIEN" data-field="x_SPOUSE" data-page="1" name="x_SPOUSE" id="x_SPOUSE" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->SPOUSE->getPlaceHolder()) ?>" value="<?= $Page->SPOUSE->EditValue ?>"<?= $Page->SPOUSE->editAttributes() ?> aria-describedby="x_SPOUSE_help">
<?= $Page->SPOUSE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SPOUSE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
    <div id="r_ORG_ID" class="form-group row">
        <label id="elh_PASIEN_ORG_ID" for="x_ORG_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ORG_ID->caption() ?><?= $Page->ORG_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ORG_ID->cellAttributes() ?>>
<span id="el_PASIEN_ORG_ID">
<span<?= $Page->ORG_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ORG_ID->getDisplayValue($Page->ORG_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN" data-field="x_ORG_ID" data-hidden="1" data-page="1" name="x_ORG_ID" id="x_ORG_ID" value="<?= HtmlEncode($Page->ORG_ID->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->AKTIF->Visible) { // AKTIF ?>
    <div id="r_AKTIF" class="form-group row">
        <label id="elh_PASIEN_AKTIF" class="<?= $Page->LeftColumnClass ?>"><?= $Page->AKTIF->caption() ?><?= $Page->AKTIF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->AKTIF->cellAttributes() ?>>
<span id="el_PASIEN_AKTIF">
<span<?= $Page->AKTIF->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->AKTIF->getDisplayValue($Page->AKTIF->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN" data-field="x_AKTIF" data-hidden="1" data-page="1" name="x_AKTIF" id="x_AKTIF" value="<?= HtmlEncode($Page->AKTIF->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <div id="r_CLASS_ID" class="form-group row">
        <label id="elh_PASIEN_CLASS_ID" for="x_CLASS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLASS_ID->caption() ?><?= $Page->CLASS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_PASIEN_CLASS_ID">
    <select
        id="x_CLASS_ID"
        name="x_CLASS_ID"
        class="form-control ew-select<?= $Page->CLASS_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_CLASS_ID"
        data-table="PASIEN"
        data-field="x_CLASS_ID"
        data-page="1"
        data-value-separator="<?= $Page->CLASS_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLASS_ID->getPlaceHolder()) ?>"
        <?= $Page->CLASS_ID->editAttributes() ?>>
        <?= $Page->CLASS_ID->selectOptionListHtml("x_CLASS_ID") ?>
    </select>
    <?= $Page->CLASS_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->CLASS_ID->getErrorMessage() ?></div>
<?= $Page->CLASS_ID->Lookup->getParamTag($Page, "p_x_CLASS_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_CLASS_ID']"),
        options = { name: "x_CLASS_ID", selectId: "PASIEN_x_CLASS_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.CLASS_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <div id="r_COVERAGE_ID" class="form-group row">
        <label id="elh_PASIEN_COVERAGE_ID" for="x_COVERAGE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->COVERAGE_ID->caption() ?><?= $Page->COVERAGE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COVERAGE_ID->cellAttributes() ?>>
<span id="el_PASIEN_COVERAGE_ID">
    <select
        id="x_COVERAGE_ID"
        name="x_COVERAGE_ID"
        class="form-control ew-select<?= $Page->COVERAGE_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_COVERAGE_ID"
        data-table="PASIEN"
        data-field="x_COVERAGE_ID"
        data-page="1"
        data-value-separator="<?= $Page->COVERAGE_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->COVERAGE_ID->getPlaceHolder()) ?>"
        <?= $Page->COVERAGE_ID->editAttributes() ?>>
        <?= $Page->COVERAGE_ID->selectOptionListHtml("x_COVERAGE_ID") ?>
    </select>
    <?= $Page->COVERAGE_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->COVERAGE_ID->getErrorMessage() ?></div>
<?= $Page->COVERAGE_ID->Lookup->getParamTag($Page, "p_x_COVERAGE_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_COVERAGE_ID']"),
        options = { name: "x_COVERAGE_ID", selectId: "PASIEN_x_COVERAGE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.COVERAGE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
    <div id="r_FAMILY_STATUS_ID" class="form-group row">
        <label id="elh_PASIEN_FAMILY_STATUS_ID" for="x_FAMILY_STATUS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FAMILY_STATUS_ID->caption() ?><?= $Page->FAMILY_STATUS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el_PASIEN_FAMILY_STATUS_ID">
<span<?= $Page->FAMILY_STATUS_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->FAMILY_STATUS_ID->getDisplayValue($Page->FAMILY_STATUS_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN" data-field="x_FAMILY_STATUS_ID" data-hidden="1" data-page="1" name="x_FAMILY_STATUS_ID" id="x_FAMILY_STATUS_ID" value="<?= HtmlEncode($Page->FAMILY_STATUS_ID->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TMT->Visible) { // TMT ?>
    <div id="r_TMT" class="form-group row">
        <label id="elh_PASIEN_TMT" for="x_TMT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TMT->caption() ?><?= $Page->TMT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TMT->cellAttributes() ?>>
<span id="el_PASIEN_TMT">
<span<?= $Page->TMT->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->TMT->getDisplayValue($Page->TMT->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN" data-field="x_TMT" data-hidden="1" data-page="1" name="x_TMT" id="x_TMT" value="<?= HtmlEncode($Page->TMT->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TAT->Visible) { // TAT ?>
    <div id="r_TAT" class="form-group row">
        <label id="elh_PASIEN_TAT" for="x_TAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TAT->caption() ?><?= $Page->TAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TAT->cellAttributes() ?>>
<span id="el_PASIEN_TAT">
<span<?= $Page->TAT->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->TAT->getDisplayValue($Page->TAT->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN" data-field="x_TAT" data-hidden="1" data-page="1" name="x_TAT" id="x_TAT" value="<?= HtmlEncode($Page->TAT->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
    <div id="r_REGISTRATION_DATE" class="form-group row">
        <label id="elh_PASIEN_REGISTRATION_DATE" for="x_REGISTRATION_DATE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->REGISTRATION_DATE->caption() ?><?= $Page->REGISTRATION_DATE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->REGISTRATION_DATE->cellAttributes() ?>>
<span id="el_PASIEN_REGISTRATION_DATE">
<span<?= $Page->REGISTRATION_DATE->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->REGISTRATION_DATE->getDisplayValue($Page->REGISTRATION_DATE->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN" data-field="x_REGISTRATION_DATE" data-hidden="1" data-page="1" name="x_REGISTRATION_DATE" id="x_REGISTRATION_DATE" value="<?= HtmlEncode($Page->REGISTRATION_DATE->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MEDICAL_NOTES->Visible) { // MEDICAL_NOTES ?>
    <div id="r_MEDICAL_NOTES" class="form-group row">
        <label id="elh_PASIEN_MEDICAL_NOTES" for="x_MEDICAL_NOTES" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MEDICAL_NOTES->caption() ?><?= $Page->MEDICAL_NOTES->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MEDICAL_NOTES->cellAttributes() ?>>
<span id="el_PASIEN_MEDICAL_NOTES">
<textarea data-table="PASIEN" data-field="x_MEDICAL_NOTES" data-page="1" name="x_MEDICAL_NOTES" id="x_MEDICAL_NOTES" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->MEDICAL_NOTES->getPlaceHolder()) ?>"<?= $Page->MEDICAL_NOTES->editAttributes() ?> aria-describedby="x_MEDICAL_NOTES_help"><?= $Page->MEDICAL_NOTES->EditValue ?></textarea>
<?= $Page->MEDICAL_NOTES->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MEDICAL_NOTES->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Cek->Visible) { // Cek ?>
    <div id="r_Cek" class="form-group row">
        <label id="elh_PASIEN_Cek" for="x_Cek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Cek->caption() ?><?= $Page->Cek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Cek->cellAttributes() ?>>
<span id="el_PASIEN_Cek">
<a href="../bridging/getpeserta.php?key=<?php echo urlencode(CurrentPage()->KK_NO->CurrentValue).'&id='.urlencode(CurrentPage()->ID->CurrentValue)?>" class="btn btn-info btn-sm" role="button">Ambil Data</a>
<a href="../bridging/getpeserta.php?key=<?php echo urlencode(CurrentPage()->PASIEN_ID->CurrentValue).'&id='.urlencode(CurrentPage()->ID->CurrentValue)?>" class="btn btn-info btn-sm" role="button">Ambil Data dari NIK</a>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="PASIEN" data-field="x_ID" data-hidden="1" name="x_ID" id="x_ID" value="<?= HtmlEncode($Page->ID->CurrentValue) ?>">
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
    ew.addEventHandlers("PASIEN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
