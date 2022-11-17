<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VDaftarPasienAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fV_DAFTAR_PASIENadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fV_DAFTAR_PASIENadd = currentForm = new ew.Form("fV_DAFTAR_PASIENadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "V_DAFTAR_PASIEN")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.V_DAFTAR_PASIEN)
        ew.vars.tables.V_DAFTAR_PASIEN = currentTable;
    fV_DAFTAR_PASIENadd.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["PASIEN_ID", [fields.PASIEN_ID.visible && fields.PASIEN_ID.required ? ew.Validators.required(fields.PASIEN_ID.caption) : null], fields.PASIEN_ID.isInvalid],
        ["KK_NO", [fields.KK_NO.visible && fields.KK_NO.required ? ew.Validators.required(fields.KK_NO.caption) : null], fields.KK_NO.isInvalid],
        ["NAME_OF_PASIEN", [fields.NAME_OF_PASIEN.visible && fields.NAME_OF_PASIEN.required ? ew.Validators.required(fields.NAME_OF_PASIEN.caption) : null], fields.NAME_OF_PASIEN.isInvalid],
        ["PLACE_OF_BIRTH", [fields.PLACE_OF_BIRTH.visible && fields.PLACE_OF_BIRTH.required ? ew.Validators.required(fields.PLACE_OF_BIRTH.caption) : null], fields.PLACE_OF_BIRTH.isInvalid],
        ["DATE_OF_BIRTH", [fields.DATE_OF_BIRTH.visible && fields.DATE_OF_BIRTH.required ? ew.Validators.required(fields.DATE_OF_BIRTH.caption) : null, ew.Validators.datetime(7)], fields.DATE_OF_BIRTH.isInvalid],
        ["GENDER", [fields.GENDER.visible && fields.GENDER.required ? ew.Validators.required(fields.GENDER.caption) : null], fields.GENDER.isInvalid],
        ["EDUCATION_TYPE_CODE", [fields.EDUCATION_TYPE_CODE.visible && fields.EDUCATION_TYPE_CODE.required ? ew.Validators.required(fields.EDUCATION_TYPE_CODE.caption) : null], fields.EDUCATION_TYPE_CODE.isInvalid],
        ["MARITALSTATUSID", [fields.MARITALSTATUSID.visible && fields.MARITALSTATUSID.required ? ew.Validators.required(fields.MARITALSTATUSID.caption) : null], fields.MARITALSTATUSID.isInvalid],
        ["KODE_AGAMA", [fields.KODE_AGAMA.visible && fields.KODE_AGAMA.required ? ew.Validators.required(fields.KODE_AGAMA.caption) : null], fields.KODE_AGAMA.isInvalid],
        ["KAL_ID", [fields.KAL_ID.visible && fields.KAL_ID.required ? ew.Validators.required(fields.KAL_ID.caption) : null], fields.KAL_ID.isInvalid],
        ["JOB_ID", [fields.JOB_ID.visible && fields.JOB_ID.required ? ew.Validators.required(fields.JOB_ID.caption) : null, ew.Validators.integer], fields.JOB_ID.isInvalid],
        ["STATUS_PASIEN_ID", [fields.STATUS_PASIEN_ID.visible && fields.STATUS_PASIEN_ID.required ? ew.Validators.required(fields.STATUS_PASIEN_ID.caption) : null], fields.STATUS_PASIEN_ID.isInvalid],
        ["ANAK_KE", [fields.ANAK_KE.visible && fields.ANAK_KE.required ? ew.Validators.required(fields.ANAK_KE.caption) : null, ew.Validators.integer], fields.ANAK_KE.isInvalid],
        ["CONTACT_ADDRESS", [fields.CONTACT_ADDRESS.visible && fields.CONTACT_ADDRESS.required ? ew.Validators.required(fields.CONTACT_ADDRESS.caption) : null], fields.CONTACT_ADDRESS.isInvalid],
        ["PHONE_NUMBER", [fields.PHONE_NUMBER.visible && fields.PHONE_NUMBER.required ? ew.Validators.required(fields.PHONE_NUMBER.caption) : null], fields.PHONE_NUMBER.isInvalid],
        ["REGISTRATION_DATE", [fields.REGISTRATION_DATE.visible && fields.REGISTRATION_DATE.required ? ew.Validators.required(fields.REGISTRATION_DATE.caption) : null, ew.Validators.datetime(11)], fields.REGISTRATION_DATE.isInvalid],
        ["PAYOR_ID", [fields.PAYOR_ID.visible && fields.PAYOR_ID.required ? ew.Validators.required(fields.PAYOR_ID.caption) : null], fields.PAYOR_ID.isInvalid],
        ["CLASS_ID", [fields.CLASS_ID.visible && fields.CLASS_ID.required ? ew.Validators.required(fields.CLASS_ID.caption) : null], fields.CLASS_ID.isInvalid],
        ["COVERAGE_ID", [fields.COVERAGE_ID.visible && fields.COVERAGE_ID.required ? ew.Validators.required(fields.COVERAGE_ID.caption) : null], fields.COVERAGE_ID.isInvalid],
        ["MOTHER", [fields.MOTHER.visible && fields.MOTHER.required ? ew.Validators.required(fields.MOTHER.caption) : null], fields.MOTHER.isInvalid],
        ["FATHER", [fields.FATHER.visible && fields.FATHER.required ? ew.Validators.required(fields.FATHER.caption) : null], fields.FATHER.isInvalid],
        ["SPOUSE", [fields.SPOUSE.visible && fields.SPOUSE.required ? ew.Validators.required(fields.SPOUSE.caption) : null], fields.SPOUSE.isInvalid],
        ["AKTIF", [fields.AKTIF.visible && fields.AKTIF.required ? ew.Validators.required(fields.AKTIF.caption) : null], fields.AKTIF.isInvalid],
        ["TMT", [fields.TMT.visible && fields.TMT.required ? ew.Validators.required(fields.TMT.caption) : null, ew.Validators.datetime(11)], fields.TMT.isInvalid],
        ["TAT", [fields.TAT.visible && fields.TAT.required ? ew.Validators.required(fields.TAT.caption) : null, ew.Validators.datetime(11)], fields.TAT.isInvalid],
        ["CARD_ID", [fields.CARD_ID.visible && fields.CARD_ID.required ? ew.Validators.required(fields.CARD_ID.caption) : null], fields.CARD_ID.isInvalid],
        ["newapp", [fields.newapp.visible && fields.newapp.required ? ew.Validators.required(fields.newapp.caption) : null], fields.newapp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fV_DAFTAR_PASIENadd,
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
    fV_DAFTAR_PASIENadd.validate = function () {
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
    fV_DAFTAR_PASIENadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fV_DAFTAR_PASIENadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fV_DAFTAR_PASIENadd.lists.GENDER = <?= $Page->GENDER->toClientList($Page) ?>;
    fV_DAFTAR_PASIENadd.lists.EDUCATION_TYPE_CODE = <?= $Page->EDUCATION_TYPE_CODE->toClientList($Page) ?>;
    fV_DAFTAR_PASIENadd.lists.MARITALSTATUSID = <?= $Page->MARITALSTATUSID->toClientList($Page) ?>;
    fV_DAFTAR_PASIENadd.lists.KODE_AGAMA = <?= $Page->KODE_AGAMA->toClientList($Page) ?>;
    fV_DAFTAR_PASIENadd.lists.KAL_ID = <?= $Page->KAL_ID->toClientList($Page) ?>;
    fV_DAFTAR_PASIENadd.lists.STATUS_PASIEN_ID = <?= $Page->STATUS_PASIEN_ID->toClientList($Page) ?>;
    fV_DAFTAR_PASIENadd.lists.PAYOR_ID = <?= $Page->PAYOR_ID->toClientList($Page) ?>;
    fV_DAFTAR_PASIENadd.lists.CLASS_ID = <?= $Page->CLASS_ID->toClientList($Page) ?>;
    fV_DAFTAR_PASIENadd.lists.COVERAGE_ID = <?= $Page->COVERAGE_ID->toClientList($Page) ?>;
    loadjs.done("fV_DAFTAR_PASIENadd");
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
<form name="fV_DAFTAR_PASIENadd" id="fV_DAFTAR_PASIENadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_DAFTAR_PASIEN">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_NO_REGISTRATION" for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION->caption() ?><?= $Page->NO_REGISTRATION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_NO_REGISTRATION">
<input type="<?= $Page->NO_REGISTRATION->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_NO_REGISTRATION" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->NO_REGISTRATION->getPlaceHolder()) ?>" value="<?= $Page->NO_REGISTRATION->EditValue ?>"<?= $Page->NO_REGISTRATION->editAttributes() ?> aria-describedby="x_NO_REGISTRATION_help">
<?= $Page->NO_REGISTRATION->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_REGISTRATION->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
    <div id="r_PASIEN_ID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_PASIEN_ID" for="x_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PASIEN_ID->caption() ?><?= $Page->PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_PASIEN_ID">
<input type="<?= $Page->PASIEN_ID->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_PASIEN_ID" name="x_PASIEN_ID" id="x_PASIEN_ID" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->PASIEN_ID->getPlaceHolder()) ?>" value="<?= $Page->PASIEN_ID->EditValue ?>"<?= $Page->PASIEN_ID->editAttributes() ?> aria-describedby="x_PASIEN_ID_help">
<?= $Page->PASIEN_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PASIEN_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KK_NO->Visible) { // KK_NO ?>
    <div id="r_KK_NO" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_KK_NO" for="x_KK_NO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KK_NO->caption() ?><?= $Page->KK_NO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KK_NO->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_KK_NO">
<input type="<?= $Page->KK_NO->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_KK_NO" name="x_KK_NO" id="x_KK_NO" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->KK_NO->getPlaceHolder()) ?>" value="<?= $Page->KK_NO->EditValue ?>"<?= $Page->KK_NO->editAttributes() ?> aria-describedby="x_KK_NO_help">
<?= $Page->KK_NO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KK_NO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
    <div id="r_NAME_OF_PASIEN" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_NAME_OF_PASIEN" for="x_NAME_OF_PASIEN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAME_OF_PASIEN->caption() ?><?= $Page->NAME_OF_PASIEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_NAME_OF_PASIEN">
<input type="<?= $Page->NAME_OF_PASIEN->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_NAME_OF_PASIEN" name="x_NAME_OF_PASIEN" id="x_NAME_OF_PASIEN" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAME_OF_PASIEN->getPlaceHolder()) ?>" value="<?= $Page->NAME_OF_PASIEN->EditValue ?>"<?= $Page->NAME_OF_PASIEN->editAttributes() ?> aria-describedby="x_NAME_OF_PASIEN_help">
<?= $Page->NAME_OF_PASIEN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAME_OF_PASIEN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
    <div id="r_PLACE_OF_BIRTH" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_PLACE_OF_BIRTH" for="x_PLACE_OF_BIRTH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PLACE_OF_BIRTH->caption() ?><?= $Page->PLACE_OF_BIRTH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_PLACE_OF_BIRTH">
<input type="<?= $Page->PLACE_OF_BIRTH->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_PLACE_OF_BIRTH" name="x_PLACE_OF_BIRTH" id="x_PLACE_OF_BIRTH" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PLACE_OF_BIRTH->getPlaceHolder()) ?>" value="<?= $Page->PLACE_OF_BIRTH->EditValue ?>"<?= $Page->PLACE_OF_BIRTH->editAttributes() ?> aria-describedby="x_PLACE_OF_BIRTH_help">
<?= $Page->PLACE_OF_BIRTH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PLACE_OF_BIRTH->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
    <div id="r_DATE_OF_BIRTH" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_DATE_OF_BIRTH" for="x_DATE_OF_BIRTH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DATE_OF_BIRTH->caption() ?><?= $Page->DATE_OF_BIRTH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_DATE_OF_BIRTH">
<input type="<?= $Page->DATE_OF_BIRTH->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_DATE_OF_BIRTH" data-format="7" name="x_DATE_OF_BIRTH" id="x_DATE_OF_BIRTH" placeholder="<?= HtmlEncode($Page->DATE_OF_BIRTH->getPlaceHolder()) ?>" value="<?= $Page->DATE_OF_BIRTH->EditValue ?>"<?= $Page->DATE_OF_BIRTH->editAttributes() ?> aria-describedby="x_DATE_OF_BIRTH_help">
<?= $Page->DATE_OF_BIRTH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DATE_OF_BIRTH->getErrorMessage() ?></div>
<?php if (!$Page->DATE_OF_BIRTH->ReadOnly && !$Page->DATE_OF_BIRTH->Disabled && !isset($Page->DATE_OF_BIRTH->EditAttrs["readonly"]) && !isset($Page->DATE_OF_BIRTH->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_DAFTAR_PASIENadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_DAFTAR_PASIENadd", "x_DATE_OF_BIRTH", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <div id="r_GENDER" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_GENDER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GENDER->caption() ?><?= $Page->GENDER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_GENDER">
<?php
$onchange = $Page->GENDER->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->GENDER->EditAttrs["onchange"] = "";
?>
<span id="as_x_GENDER" class="ew-auto-suggest">
    <input type="<?= $Page->GENDER->getInputTextType() ?>" class="form-control" name="sv_x_GENDER" id="sv_x_GENDER" value="<?= RemoveHtml($Page->GENDER->EditValue) ?>" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->GENDER->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->GENDER->getPlaceHolder()) ?>"<?= $Page->GENDER->editAttributes() ?> aria-describedby="x_GENDER_help">
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="V_DAFTAR_PASIEN" data-field="x_GENDER" data-input="sv_x_GENDER" data-value-separator="<?= $Page->GENDER->displayValueSeparatorAttribute() ?>" name="x_GENDER" id="x_GENDER" value="<?= HtmlEncode($Page->GENDER->CurrentValue) ?>"<?= $onchange ?>>
<?= $Page->GENDER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->GENDER->getErrorMessage() ?></div>
<script>
loadjs.ready(["fV_DAFTAR_PASIENadd"], function() {
    fV_DAFTAR_PASIENadd.createAutoSuggest(Object.assign({"id":"x_GENDER","forceSelect":false}, ew.vars.tables.V_DAFTAR_PASIEN.fields.GENDER.autoSuggestOptions));
});
</script>
<?= $Page->GENDER->Lookup->getParamTag($Page, "p_x_GENDER") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
    <div id="r_EDUCATION_TYPE_CODE" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_EDUCATION_TYPE_CODE" for="x_EDUCATION_TYPE_CODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EDUCATION_TYPE_CODE->caption() ?><?= $Page->EDUCATION_TYPE_CODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EDUCATION_TYPE_CODE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_EDUCATION_TYPE_CODE">
    <select
        id="x_EDUCATION_TYPE_CODE"
        name="x_EDUCATION_TYPE_CODE"
        class="form-control ew-select<?= $Page->EDUCATION_TYPE_CODE->isInvalidClass() ?>"
        data-select2-id="V_DAFTAR_PASIEN_x_EDUCATION_TYPE_CODE"
        data-table="V_DAFTAR_PASIEN"
        data-field="x_EDUCATION_TYPE_CODE"
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
    var el = document.querySelector("select[data-select2-id='V_DAFTAR_PASIEN_x_EDUCATION_TYPE_CODE']"),
        options = { name: "x_EDUCATION_TYPE_CODE", selectId: "V_DAFTAR_PASIEN_x_EDUCATION_TYPE_CODE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_DAFTAR_PASIEN.fields.EDUCATION_TYPE_CODE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
    <div id="r_MARITALSTATUSID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_MARITALSTATUSID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MARITALSTATUSID->caption() ?><?= $Page->MARITALSTATUSID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MARITALSTATUSID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_MARITALSTATUSID">
<template id="tp_x_MARITALSTATUSID">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="V_DAFTAR_PASIEN" data-field="x_MARITALSTATUSID" name="x_MARITALSTATUSID" id="x_MARITALSTATUSID"<?= $Page->MARITALSTATUSID->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_MARITALSTATUSID" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_MARITALSTATUSID"
    name="x_MARITALSTATUSID"
    value="<?= HtmlEncode($Page->MARITALSTATUSID->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_MARITALSTATUSID"
    data-target="dsl_x_MARITALSTATUSID"
    data-repeatcolumn="5"
    class="form-control<?= $Page->MARITALSTATUSID->isInvalidClass() ?>"
    data-table="V_DAFTAR_PASIEN"
    data-field="x_MARITALSTATUSID"
    data-value-separator="<?= $Page->MARITALSTATUSID->displayValueSeparatorAttribute() ?>"
    <?= $Page->MARITALSTATUSID->editAttributes() ?>>
<?= $Page->MARITALSTATUSID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MARITALSTATUSID->getErrorMessage() ?></div>
<?= $Page->MARITALSTATUSID->Lookup->getParamTag($Page, "p_x_MARITALSTATUSID") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <div id="r_KODE_AGAMA" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_KODE_AGAMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KODE_AGAMA->caption() ?><?= $Page->KODE_AGAMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_KODE_AGAMA">
<template id="tp_x_KODE_AGAMA">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="V_DAFTAR_PASIEN" data-field="x_KODE_AGAMA" name="x_KODE_AGAMA" id="x_KODE_AGAMA"<?= $Page->KODE_AGAMA->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_KODE_AGAMA" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_KODE_AGAMA"
    name="x_KODE_AGAMA"
    value="<?= HtmlEncode($Page->KODE_AGAMA->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_KODE_AGAMA"
    data-target="dsl_x_KODE_AGAMA"
    data-repeatcolumn="5"
    class="form-control<?= $Page->KODE_AGAMA->isInvalidClass() ?>"
    data-table="V_DAFTAR_PASIEN"
    data-field="x_KODE_AGAMA"
    data-value-separator="<?= $Page->KODE_AGAMA->displayValueSeparatorAttribute() ?>"
    <?= $Page->KODE_AGAMA->editAttributes() ?>>
<?= $Page->KODE_AGAMA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KODE_AGAMA->getErrorMessage() ?></div>
<?= $Page->KODE_AGAMA->Lookup->getParamTag($Page, "p_x_KODE_AGAMA") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KAL_ID->Visible) { // KAL_ID ?>
    <div id="r_KAL_ID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_KAL_ID" for="x_KAL_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KAL_ID->caption() ?><?= $Page->KAL_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KAL_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_KAL_ID">
    <select
        id="x_KAL_ID"
        name="x_KAL_ID"
        class="form-control ew-select<?= $Page->KAL_ID->isInvalidClass() ?>"
        data-select2-id="V_DAFTAR_PASIEN_x_KAL_ID"
        data-table="V_DAFTAR_PASIEN"
        data-field="x_KAL_ID"
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
    var el = document.querySelector("select[data-select2-id='V_DAFTAR_PASIEN_x_KAL_ID']"),
        options = { name: "x_KAL_ID", selectId: "V_DAFTAR_PASIEN_x_KAL_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_DAFTAR_PASIEN.fields.KAL_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
    <div id="r_JOB_ID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_JOB_ID" for="x_JOB_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JOB_ID->caption() ?><?= $Page->JOB_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->JOB_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_JOB_ID">
<input type="<?= $Page->JOB_ID->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_JOB_ID" name="x_JOB_ID" id="x_JOB_ID" size="30" placeholder="<?= HtmlEncode($Page->JOB_ID->getPlaceHolder()) ?>" value="<?= $Page->JOB_ID->EditValue ?>"<?= $Page->JOB_ID->editAttributes() ?> aria-describedby="x_JOB_ID_help">
<?= $Page->JOB_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JOB_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <div id="r_STATUS_PASIEN_ID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_STATUS_PASIEN_ID" for="x_STATUS_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_PASIEN_ID->caption() ?><?= $Page->STATUS_PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_STATUS_PASIEN_ID">
    <select
        id="x_STATUS_PASIEN_ID"
        name="x_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Page->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="V_DAFTAR_PASIEN_x_STATUS_PASIEN_ID"
        data-table="V_DAFTAR_PASIEN"
        data-field="x_STATUS_PASIEN_ID"
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
    var el = document.querySelector("select[data-select2-id='V_DAFTAR_PASIEN_x_STATUS_PASIEN_ID']"),
        options = { name: "x_STATUS_PASIEN_ID", selectId: "V_DAFTAR_PASIEN_x_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_DAFTAR_PASIEN.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ANAK_KE->Visible) { // ANAK_KE ?>
    <div id="r_ANAK_KE" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_ANAK_KE" for="x_ANAK_KE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ANAK_KE->caption() ?><?= $Page->ANAK_KE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ANAK_KE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_ANAK_KE">
<input type="<?= $Page->ANAK_KE->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_ANAK_KE" name="x_ANAK_KE" id="x_ANAK_KE" size="30" placeholder="<?= HtmlEncode($Page->ANAK_KE->getPlaceHolder()) ?>" value="<?= $Page->ANAK_KE->EditValue ?>"<?= $Page->ANAK_KE->editAttributes() ?> aria-describedby="x_ANAK_KE_help">
<?= $Page->ANAK_KE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ANAK_KE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
    <div id="r_CONTACT_ADDRESS" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_CONTACT_ADDRESS" for="x_CONTACT_ADDRESS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CONTACT_ADDRESS->caption() ?><?= $Page->CONTACT_ADDRESS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CONTACT_ADDRESS->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_CONTACT_ADDRESS">
<input type="<?= $Page->CONTACT_ADDRESS->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_CONTACT_ADDRESS" name="x_CONTACT_ADDRESS" id="x_CONTACT_ADDRESS" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->CONTACT_ADDRESS->getPlaceHolder()) ?>" value="<?= $Page->CONTACT_ADDRESS->EditValue ?>"<?= $Page->CONTACT_ADDRESS->editAttributes() ?> aria-describedby="x_CONTACT_ADDRESS_help">
<?= $Page->CONTACT_ADDRESS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CONTACT_ADDRESS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PHONE_NUMBER->Visible) { // PHONE_NUMBER ?>
    <div id="r_PHONE_NUMBER" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_PHONE_NUMBER" for="x_PHONE_NUMBER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PHONE_NUMBER->caption() ?><?= $Page->PHONE_NUMBER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PHONE_NUMBER->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_PHONE_NUMBER">
<input type="<?= $Page->PHONE_NUMBER->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_PHONE_NUMBER" name="x_PHONE_NUMBER" id="x_PHONE_NUMBER" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->PHONE_NUMBER->getPlaceHolder()) ?>" value="<?= $Page->PHONE_NUMBER->EditValue ?>"<?= $Page->PHONE_NUMBER->editAttributes() ?> aria-describedby="x_PHONE_NUMBER_help">
<?= $Page->PHONE_NUMBER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PHONE_NUMBER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
    <div id="r_REGISTRATION_DATE" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_REGISTRATION_DATE" for="x_REGISTRATION_DATE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->REGISTRATION_DATE->caption() ?><?= $Page->REGISTRATION_DATE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->REGISTRATION_DATE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_REGISTRATION_DATE">
<input type="<?= $Page->REGISTRATION_DATE->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_REGISTRATION_DATE" data-format="11" name="x_REGISTRATION_DATE" id="x_REGISTRATION_DATE" placeholder="<?= HtmlEncode($Page->REGISTRATION_DATE->getPlaceHolder()) ?>" value="<?= $Page->REGISTRATION_DATE->EditValue ?>"<?= $Page->REGISTRATION_DATE->editAttributes() ?> aria-describedby="x_REGISTRATION_DATE_help">
<?= $Page->REGISTRATION_DATE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->REGISTRATION_DATE->getErrorMessage() ?></div>
<?php if (!$Page->REGISTRATION_DATE->ReadOnly && !$Page->REGISTRATION_DATE->Disabled && !isset($Page->REGISTRATION_DATE->EditAttrs["readonly"]) && !isset($Page->REGISTRATION_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_DAFTAR_PASIENadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_DAFTAR_PASIENadd", "x_REGISTRATION_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <div id="r_PAYOR_ID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_PAYOR_ID" for="x_PAYOR_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYOR_ID->caption() ?><?= $Page->PAYOR_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_PAYOR_ID">
    <select
        id="x_PAYOR_ID"
        name="x_PAYOR_ID"
        class="form-control ew-select<?= $Page->PAYOR_ID->isInvalidClass() ?>"
        data-select2-id="V_DAFTAR_PASIEN_x_PAYOR_ID"
        data-table="V_DAFTAR_PASIEN"
        data-field="x_PAYOR_ID"
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
    var el = document.querySelector("select[data-select2-id='V_DAFTAR_PASIEN_x_PAYOR_ID']"),
        options = { name: "x_PAYOR_ID", selectId: "V_DAFTAR_PASIEN_x_PAYOR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_DAFTAR_PASIEN.fields.PAYOR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <div id="r_CLASS_ID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_CLASS_ID" for="x_CLASS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLASS_ID->caption() ?><?= $Page->CLASS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_CLASS_ID">
    <select
        id="x_CLASS_ID"
        name="x_CLASS_ID"
        class="form-control ew-select<?= $Page->CLASS_ID->isInvalidClass() ?>"
        data-select2-id="V_DAFTAR_PASIEN_x_CLASS_ID"
        data-table="V_DAFTAR_PASIEN"
        data-field="x_CLASS_ID"
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
    var el = document.querySelector("select[data-select2-id='V_DAFTAR_PASIEN_x_CLASS_ID']"),
        options = { name: "x_CLASS_ID", selectId: "V_DAFTAR_PASIEN_x_CLASS_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_DAFTAR_PASIEN.fields.CLASS_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <div id="r_COVERAGE_ID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_COVERAGE_ID" for="x_COVERAGE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->COVERAGE_ID->caption() ?><?= $Page->COVERAGE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COVERAGE_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_COVERAGE_ID">
    <select
        id="x_COVERAGE_ID"
        name="x_COVERAGE_ID"
        class="form-control ew-select<?= $Page->COVERAGE_ID->isInvalidClass() ?>"
        data-select2-id="V_DAFTAR_PASIEN_x_COVERAGE_ID"
        data-table="V_DAFTAR_PASIEN"
        data-field="x_COVERAGE_ID"
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
    var el = document.querySelector("select[data-select2-id='V_DAFTAR_PASIEN_x_COVERAGE_ID']"),
        options = { name: "x_COVERAGE_ID", selectId: "V_DAFTAR_PASIEN_x_COVERAGE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_DAFTAR_PASIEN.fields.COVERAGE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MOTHER->Visible) { // MOTHER ?>
    <div id="r_MOTHER" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_MOTHER" for="x_MOTHER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MOTHER->caption() ?><?= $Page->MOTHER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MOTHER->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_MOTHER">
<input type="<?= $Page->MOTHER->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_MOTHER" name="x_MOTHER" id="x_MOTHER" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->MOTHER->getPlaceHolder()) ?>" value="<?= $Page->MOTHER->EditValue ?>"<?= $Page->MOTHER->editAttributes() ?> aria-describedby="x_MOTHER_help">
<?= $Page->MOTHER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MOTHER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FATHER->Visible) { // FATHER ?>
    <div id="r_FATHER" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_FATHER" for="x_FATHER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FATHER->caption() ?><?= $Page->FATHER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FATHER->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_FATHER">
<input type="<?= $Page->FATHER->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_FATHER" name="x_FATHER" id="x_FATHER" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->FATHER->getPlaceHolder()) ?>" value="<?= $Page->FATHER->EditValue ?>"<?= $Page->FATHER->editAttributes() ?> aria-describedby="x_FATHER_help">
<?= $Page->FATHER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FATHER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SPOUSE->Visible) { // SPOUSE ?>
    <div id="r_SPOUSE" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_SPOUSE" for="x_SPOUSE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SPOUSE->caption() ?><?= $Page->SPOUSE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SPOUSE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_SPOUSE">
<input type="<?= $Page->SPOUSE->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_SPOUSE" name="x_SPOUSE" id="x_SPOUSE" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->SPOUSE->getPlaceHolder()) ?>" value="<?= $Page->SPOUSE->EditValue ?>"<?= $Page->SPOUSE->editAttributes() ?> aria-describedby="x_SPOUSE_help">
<?= $Page->SPOUSE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SPOUSE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->AKTIF->Visible) { // AKTIF ?>
    <div id="r_AKTIF" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_AKTIF" for="x_AKTIF" class="<?= $Page->LeftColumnClass ?>"><?= $Page->AKTIF->caption() ?><?= $Page->AKTIF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->AKTIF->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_AKTIF">
<input type="<?= $Page->AKTIF->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_AKTIF" name="x_AKTIF" id="x_AKTIF" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->AKTIF->getPlaceHolder()) ?>" value="<?= $Page->AKTIF->EditValue ?>"<?= $Page->AKTIF->editAttributes() ?> aria-describedby="x_AKTIF_help">
<?= $Page->AKTIF->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->AKTIF->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TMT->Visible) { // TMT ?>
    <div id="r_TMT" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_TMT" for="x_TMT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TMT->caption() ?><?= $Page->TMT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TMT->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_TMT">
<input type="<?= $Page->TMT->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_TMT" data-format="11" name="x_TMT" id="x_TMT" placeholder="<?= HtmlEncode($Page->TMT->getPlaceHolder()) ?>" value="<?= $Page->TMT->EditValue ?>"<?= $Page->TMT->editAttributes() ?> aria-describedby="x_TMT_help">
<?= $Page->TMT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TMT->getErrorMessage() ?></div>
<?php if (!$Page->TMT->ReadOnly && !$Page->TMT->Disabled && !isset($Page->TMT->EditAttrs["readonly"]) && !isset($Page->TMT->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_DAFTAR_PASIENadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_DAFTAR_PASIENadd", "x_TMT", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TAT->Visible) { // TAT ?>
    <div id="r_TAT" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_TAT" for="x_TAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TAT->caption() ?><?= $Page->TAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TAT->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_TAT">
<input type="<?= $Page->TAT->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_TAT" data-format="11" name="x_TAT" id="x_TAT" placeholder="<?= HtmlEncode($Page->TAT->getPlaceHolder()) ?>" value="<?= $Page->TAT->EditValue ?>"<?= $Page->TAT->editAttributes() ?> aria-describedby="x_TAT_help">
<?= $Page->TAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TAT->getErrorMessage() ?></div>
<?php if (!$Page->TAT->ReadOnly && !$Page->TAT->Disabled && !isset($Page->TAT->EditAttrs["readonly"]) && !isset($Page->TAT->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_DAFTAR_PASIENadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_DAFTAR_PASIENadd", "x_TAT", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CARD_ID->Visible) { // CARD_ID ?>
    <div id="r_CARD_ID" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_CARD_ID" for="x_CARD_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CARD_ID->caption() ?><?= $Page->CARD_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CARD_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_CARD_ID">
<input type="<?= $Page->CARD_ID->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_CARD_ID" name="x_CARD_ID" id="x_CARD_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->CARD_ID->getPlaceHolder()) ?>" value="<?= $Page->CARD_ID->EditValue ?>"<?= $Page->CARD_ID->editAttributes() ?> aria-describedby="x_CARD_ID_help">
<?= $Page->CARD_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CARD_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->newapp->Visible) { // newapp ?>
    <div id="r_newapp" class="form-group row">
        <label id="elh_V_DAFTAR_PASIEN_newapp" for="x_newapp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->newapp->caption() ?><?= $Page->newapp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->newapp->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_newapp">
<input type="<?= $Page->newapp->getInputTextType() ?>" data-table="V_DAFTAR_PASIEN" data-field="x_newapp" name="x_newapp" id="x_newapp" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->newapp->getPlaceHolder()) ?>" value="<?= $Page->newapp->EditValue ?>"<?= $Page->newapp->editAttributes() ?> aria-describedby="x_newapp_help">
<?= $Page->newapp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->newapp->getErrorMessage() ?></div>
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
    ew.addEventHandlers("V_DAFTAR_PASIEN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
