<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$FamilyAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fFAMILYadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fFAMILYadd = currentForm = new ew.Form("fFAMILYadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "FAMILY")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.FAMILY)
        ew.vars.tables.FAMILY = currentTable;
    fFAMILYadd.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["FAMILY_ID", [fields.FAMILY_ID.visible && fields.FAMILY_ID.required ? ew.Validators.required(fields.FAMILY_ID.caption) : null, ew.Validators.integer], fields.FAMILY_ID.isInvalid],
        ["FAMILY_STATUS_ID", [fields.FAMILY_STATUS_ID.visible && fields.FAMILY_STATUS_ID.required ? ew.Validators.required(fields.FAMILY_STATUS_ID.caption) : null, ew.Validators.integer], fields.FAMILY_STATUS_ID.isInvalid],
        ["NO_REGISTRATION2", [fields.NO_REGISTRATION2.visible && fields.NO_REGISTRATION2.required ? ew.Validators.required(fields.NO_REGISTRATION2.caption) : null], fields.NO_REGISTRATION2.isInvalid],
        ["FULLNAME", [fields.FULLNAME.visible && fields.FULLNAME.required ? ew.Validators.required(fields.FULLNAME.caption) : null], fields.FULLNAME.isInvalid],
        ["ISRESPONSIBLE", [fields.ISRESPONSIBLE.visible && fields.ISRESPONSIBLE.required ? ew.Validators.required(fields.ISRESPONSIBLE.caption) : null], fields.ISRESPONSIBLE.isInvalid],
        ["GENDER", [fields.GENDER.visible && fields.GENDER.required ? ew.Validators.required(fields.GENDER.caption) : null], fields.GENDER.isInvalid],
        ["DATE_OF_BIRTH", [fields.DATE_OF_BIRTH.visible && fields.DATE_OF_BIRTH.required ? ew.Validators.required(fields.DATE_OF_BIRTH.caption) : null, ew.Validators.datetime(0)], fields.DATE_OF_BIRTH.isInvalid],
        ["PLACE_OF_BIRTH", [fields.PLACE_OF_BIRTH.visible && fields.PLACE_OF_BIRTH.required ? ew.Validators.required(fields.PLACE_OF_BIRTH.caption) : null], fields.PLACE_OF_BIRTH.isInvalid],
        ["KODE_AGAMA", [fields.KODE_AGAMA.visible && fields.KODE_AGAMA.required ? ew.Validators.required(fields.KODE_AGAMA.caption) : null, ew.Validators.integer], fields.KODE_AGAMA.isInvalid],
        ["EDUCATION_TYPE_CODE", [fields.EDUCATION_TYPE_CODE.visible && fields.EDUCATION_TYPE_CODE.required ? ew.Validators.required(fields.EDUCATION_TYPE_CODE.caption) : null, ew.Validators.integer], fields.EDUCATION_TYPE_CODE.isInvalid],
        ["JOB_ID", [fields.JOB_ID.visible && fields.JOB_ID.required ? ew.Validators.required(fields.JOB_ID.caption) : null, ew.Validators.integer], fields.JOB_ID.isInvalid],
        ["BLOOD_ID", [fields.BLOOD_ID.visible && fields.BLOOD_ID.required ? ew.Validators.required(fields.BLOOD_ID.caption) : null, ew.Validators.integer], fields.BLOOD_ID.isInvalid],
        ["MARITALSTATUSID", [fields.MARITALSTATUSID.visible && fields.MARITALSTATUSID.required ? ew.Validators.required(fields.MARITALSTATUSID.caption) : null, ew.Validators.integer], fields.MARITALSTATUSID.isInvalid],
        ["ADDRESS", [fields.ADDRESS.visible && fields.ADDRESS.required ? ew.Validators.required(fields.ADDRESS.caption) : null], fields.ADDRESS.isInvalid],
        ["KOTA", [fields.KOTA.visible && fields.KOTA.required ? ew.Validators.required(fields.KOTA.caption) : null], fields.KOTA.isInvalid],
        ["RT", [fields.RT.visible && fields.RT.required ? ew.Validators.required(fields.RT.caption) : null], fields.RT.isInvalid],
        ["RW", [fields.RW.visible && fields.RW.required ? ew.Validators.required(fields.RW.caption) : null], fields.RW.isInvalid],
        ["PHONE", [fields.PHONE.visible && fields.PHONE.required ? ew.Validators.required(fields.PHONE.caption) : null], fields.PHONE.isInvalid],
        ["MOBILE", [fields.MOBILE.visible && fields.MOBILE.required ? ew.Validators.required(fields.MOBILE.caption) : null], fields.MOBILE.isInvalid],
        ["FAX", [fields.FAX.visible && fields.FAX.required ? ew.Validators.required(fields.FAX.caption) : null], fields.FAX.isInvalid],
        ["_EMAIL", [fields._EMAIL.visible && fields._EMAIL.required ? ew.Validators.required(fields._EMAIL.caption) : null], fields._EMAIL.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid],
        ["MODIFIED_DATE", [fields.MODIFIED_DATE.visible && fields.MODIFIED_DATE.required ? ew.Validators.required(fields.MODIFIED_DATE.caption) : null, ew.Validators.datetime(0)], fields.MODIFIED_DATE.isInvalid],
        ["MODIFIED_BY", [fields.MODIFIED_BY.visible && fields.MODIFIED_BY.required ? ew.Validators.required(fields.MODIFIED_BY.caption) : null], fields.MODIFIED_BY.isInvalid],
        ["MODIFIED_FROM", [fields.MODIFIED_FROM.visible && fields.MODIFIED_FROM.required ? ew.Validators.required(fields.MODIFIED_FROM.caption) : null], fields.MODIFIED_FROM.isInvalid],
        ["COUNTRY_CODE", [fields.COUNTRY_CODE.visible && fields.COUNTRY_CODE.required ? ew.Validators.required(fields.COUNTRY_CODE.caption) : null], fields.COUNTRY_CODE.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fFAMILYadd,
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
    fFAMILYadd.validate = function () {
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
    fFAMILYadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fFAMILYadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fFAMILYadd");
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
<form name="fFAMILYadd" id="fFAMILYadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="FAMILY">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <div id="r_ORG_UNIT_CODE" class="form-group row">
        <label id="elh_FAMILY_ORG_UNIT_CODE" for="x_ORG_UNIT_CODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ORG_UNIT_CODE->caption() ?><?= $Page->ORG_UNIT_CODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_FAMILY_ORG_UNIT_CODE">
<input type="<?= $Page->ORG_UNIT_CODE->getInputTextType() ?>" data-table="FAMILY" data-field="x_ORG_UNIT_CODE" name="x_ORG_UNIT_CODE" id="x_ORG_UNIT_CODE" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ORG_UNIT_CODE->getPlaceHolder()) ?>" value="<?= $Page->ORG_UNIT_CODE->EditValue ?>"<?= $Page->ORG_UNIT_CODE->editAttributes() ?> aria-describedby="x_ORG_UNIT_CODE_help">
<?= $Page->ORG_UNIT_CODE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ORG_UNIT_CODE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label id="elh_FAMILY_NO_REGISTRATION" for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION->caption() ?><?= $Page->NO_REGISTRATION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_FAMILY_NO_REGISTRATION">
<input type="<?= $Page->NO_REGISTRATION->getInputTextType() ?>" data-table="FAMILY" data-field="x_NO_REGISTRATION" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->NO_REGISTRATION->getPlaceHolder()) ?>" value="<?= $Page->NO_REGISTRATION->EditValue ?>"<?= $Page->NO_REGISTRATION->editAttributes() ?> aria-describedby="x_NO_REGISTRATION_help">
<?= $Page->NO_REGISTRATION->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_REGISTRATION->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FAMILY_ID->Visible) { // FAMILY_ID ?>
    <div id="r_FAMILY_ID" class="form-group row">
        <label id="elh_FAMILY_FAMILY_ID" for="x_FAMILY_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FAMILY_ID->caption() ?><?= $Page->FAMILY_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FAMILY_ID->cellAttributes() ?>>
<span id="el_FAMILY_FAMILY_ID">
<input type="<?= $Page->FAMILY_ID->getInputTextType() ?>" data-table="FAMILY" data-field="x_FAMILY_ID" name="x_FAMILY_ID" id="x_FAMILY_ID" size="30" placeholder="<?= HtmlEncode($Page->FAMILY_ID->getPlaceHolder()) ?>" value="<?= $Page->FAMILY_ID->EditValue ?>"<?= $Page->FAMILY_ID->editAttributes() ?> aria-describedby="x_FAMILY_ID_help">
<?= $Page->FAMILY_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FAMILY_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
    <div id="r_FAMILY_STATUS_ID" class="form-group row">
        <label id="elh_FAMILY_FAMILY_STATUS_ID" for="x_FAMILY_STATUS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FAMILY_STATUS_ID->caption() ?><?= $Page->FAMILY_STATUS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el_FAMILY_FAMILY_STATUS_ID">
<input type="<?= $Page->FAMILY_STATUS_ID->getInputTextType() ?>" data-table="FAMILY" data-field="x_FAMILY_STATUS_ID" name="x_FAMILY_STATUS_ID" id="x_FAMILY_STATUS_ID" size="30" placeholder="<?= HtmlEncode($Page->FAMILY_STATUS_ID->getPlaceHolder()) ?>" value="<?= $Page->FAMILY_STATUS_ID->EditValue ?>"<?= $Page->FAMILY_STATUS_ID->editAttributes() ?> aria-describedby="x_FAMILY_STATUS_ID_help">
<?= $Page->FAMILY_STATUS_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FAMILY_STATUS_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_REGISTRATION2->Visible) { // NO_REGISTRATION2 ?>
    <div id="r_NO_REGISTRATION2" class="form-group row">
        <label id="elh_FAMILY_NO_REGISTRATION2" for="x_NO_REGISTRATION2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION2->caption() ?><?= $Page->NO_REGISTRATION2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION2->cellAttributes() ?>>
<span id="el_FAMILY_NO_REGISTRATION2">
<input type="<?= $Page->NO_REGISTRATION2->getInputTextType() ?>" data-table="FAMILY" data-field="x_NO_REGISTRATION2" name="x_NO_REGISTRATION2" id="x_NO_REGISTRATION2" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->NO_REGISTRATION2->getPlaceHolder()) ?>" value="<?= $Page->NO_REGISTRATION2->EditValue ?>"<?= $Page->NO_REGISTRATION2->editAttributes() ?> aria-describedby="x_NO_REGISTRATION2_help">
<?= $Page->NO_REGISTRATION2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_REGISTRATION2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
    <div id="r_FULLNAME" class="form-group row">
        <label id="elh_FAMILY_FULLNAME" for="x_FULLNAME" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FULLNAME->caption() ?><?= $Page->FULLNAME->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FULLNAME->cellAttributes() ?>>
<span id="el_FAMILY_FULLNAME">
<input type="<?= $Page->FULLNAME->getInputTextType() ?>" data-table="FAMILY" data-field="x_FULLNAME" name="x_FULLNAME" id="x_FULLNAME" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->FULLNAME->getPlaceHolder()) ?>" value="<?= $Page->FULLNAME->EditValue ?>"<?= $Page->FULLNAME->editAttributes() ?> aria-describedby="x_FULLNAME_help">
<?= $Page->FULLNAME->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FULLNAME->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ISRESPONSIBLE->Visible) { // ISRESPONSIBLE ?>
    <div id="r_ISRESPONSIBLE" class="form-group row">
        <label id="elh_FAMILY_ISRESPONSIBLE" for="x_ISRESPONSIBLE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ISRESPONSIBLE->caption() ?><?= $Page->ISRESPONSIBLE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ISRESPONSIBLE->cellAttributes() ?>>
<span id="el_FAMILY_ISRESPONSIBLE">
<input type="<?= $Page->ISRESPONSIBLE->getInputTextType() ?>" data-table="FAMILY" data-field="x_ISRESPONSIBLE" name="x_ISRESPONSIBLE" id="x_ISRESPONSIBLE" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->ISRESPONSIBLE->getPlaceHolder()) ?>" value="<?= $Page->ISRESPONSIBLE->EditValue ?>"<?= $Page->ISRESPONSIBLE->editAttributes() ?> aria-describedby="x_ISRESPONSIBLE_help">
<?= $Page->ISRESPONSIBLE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ISRESPONSIBLE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <div id="r_GENDER" class="form-group row">
        <label id="elh_FAMILY_GENDER" for="x_GENDER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GENDER->caption() ?><?= $Page->GENDER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_FAMILY_GENDER">
<input type="<?= $Page->GENDER->getInputTextType() ?>" data-table="FAMILY" data-field="x_GENDER" name="x_GENDER" id="x_GENDER" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->GENDER->getPlaceHolder()) ?>" value="<?= $Page->GENDER->EditValue ?>"<?= $Page->GENDER->editAttributes() ?> aria-describedby="x_GENDER_help">
<?= $Page->GENDER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->GENDER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
    <div id="r_DATE_OF_BIRTH" class="form-group row">
        <label id="elh_FAMILY_DATE_OF_BIRTH" for="x_DATE_OF_BIRTH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DATE_OF_BIRTH->caption() ?><?= $Page->DATE_OF_BIRTH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el_FAMILY_DATE_OF_BIRTH">
<input type="<?= $Page->DATE_OF_BIRTH->getInputTextType() ?>" data-table="FAMILY" data-field="x_DATE_OF_BIRTH" name="x_DATE_OF_BIRTH" id="x_DATE_OF_BIRTH" placeholder="<?= HtmlEncode($Page->DATE_OF_BIRTH->getPlaceHolder()) ?>" value="<?= $Page->DATE_OF_BIRTH->EditValue ?>"<?= $Page->DATE_OF_BIRTH->editAttributes() ?> aria-describedby="x_DATE_OF_BIRTH_help">
<?= $Page->DATE_OF_BIRTH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DATE_OF_BIRTH->getErrorMessage() ?></div>
<?php if (!$Page->DATE_OF_BIRTH->ReadOnly && !$Page->DATE_OF_BIRTH->Disabled && !isset($Page->DATE_OF_BIRTH->EditAttrs["readonly"]) && !isset($Page->DATE_OF_BIRTH->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fFAMILYadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fFAMILYadd", "x_DATE_OF_BIRTH", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
    <div id="r_PLACE_OF_BIRTH" class="form-group row">
        <label id="elh_FAMILY_PLACE_OF_BIRTH" for="x_PLACE_OF_BIRTH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PLACE_OF_BIRTH->caption() ?><?= $Page->PLACE_OF_BIRTH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el_FAMILY_PLACE_OF_BIRTH">
<input type="<?= $Page->PLACE_OF_BIRTH->getInputTextType() ?>" data-table="FAMILY" data-field="x_PLACE_OF_BIRTH" name="x_PLACE_OF_BIRTH" id="x_PLACE_OF_BIRTH" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PLACE_OF_BIRTH->getPlaceHolder()) ?>" value="<?= $Page->PLACE_OF_BIRTH->EditValue ?>"<?= $Page->PLACE_OF_BIRTH->editAttributes() ?> aria-describedby="x_PLACE_OF_BIRTH_help">
<?= $Page->PLACE_OF_BIRTH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PLACE_OF_BIRTH->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <div id="r_KODE_AGAMA" class="form-group row">
        <label id="elh_FAMILY_KODE_AGAMA" for="x_KODE_AGAMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KODE_AGAMA->caption() ?><?= $Page->KODE_AGAMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el_FAMILY_KODE_AGAMA">
<input type="<?= $Page->KODE_AGAMA->getInputTextType() ?>" data-table="FAMILY" data-field="x_KODE_AGAMA" name="x_KODE_AGAMA" id="x_KODE_AGAMA" size="30" placeholder="<?= HtmlEncode($Page->KODE_AGAMA->getPlaceHolder()) ?>" value="<?= $Page->KODE_AGAMA->EditValue ?>"<?= $Page->KODE_AGAMA->editAttributes() ?> aria-describedby="x_KODE_AGAMA_help">
<?= $Page->KODE_AGAMA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KODE_AGAMA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
    <div id="r_EDUCATION_TYPE_CODE" class="form-group row">
        <label id="elh_FAMILY_EDUCATION_TYPE_CODE" for="x_EDUCATION_TYPE_CODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EDUCATION_TYPE_CODE->caption() ?><?= $Page->EDUCATION_TYPE_CODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EDUCATION_TYPE_CODE->cellAttributes() ?>>
<span id="el_FAMILY_EDUCATION_TYPE_CODE">
<input type="<?= $Page->EDUCATION_TYPE_CODE->getInputTextType() ?>" data-table="FAMILY" data-field="x_EDUCATION_TYPE_CODE" name="x_EDUCATION_TYPE_CODE" id="x_EDUCATION_TYPE_CODE" size="30" placeholder="<?= HtmlEncode($Page->EDUCATION_TYPE_CODE->getPlaceHolder()) ?>" value="<?= $Page->EDUCATION_TYPE_CODE->EditValue ?>"<?= $Page->EDUCATION_TYPE_CODE->editAttributes() ?> aria-describedby="x_EDUCATION_TYPE_CODE_help">
<?= $Page->EDUCATION_TYPE_CODE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->EDUCATION_TYPE_CODE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
    <div id="r_JOB_ID" class="form-group row">
        <label id="elh_FAMILY_JOB_ID" for="x_JOB_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JOB_ID->caption() ?><?= $Page->JOB_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->JOB_ID->cellAttributes() ?>>
<span id="el_FAMILY_JOB_ID">
<input type="<?= $Page->JOB_ID->getInputTextType() ?>" data-table="FAMILY" data-field="x_JOB_ID" name="x_JOB_ID" id="x_JOB_ID" size="30" placeholder="<?= HtmlEncode($Page->JOB_ID->getPlaceHolder()) ?>" value="<?= $Page->JOB_ID->EditValue ?>"<?= $Page->JOB_ID->editAttributes() ?> aria-describedby="x_JOB_ID_help">
<?= $Page->JOB_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JOB_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->BLOOD_ID->Visible) { // BLOOD_ID ?>
    <div id="r_BLOOD_ID" class="form-group row">
        <label id="elh_FAMILY_BLOOD_ID" for="x_BLOOD_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->BLOOD_ID->caption() ?><?= $Page->BLOOD_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->BLOOD_ID->cellAttributes() ?>>
<span id="el_FAMILY_BLOOD_ID">
<input type="<?= $Page->BLOOD_ID->getInputTextType() ?>" data-table="FAMILY" data-field="x_BLOOD_ID" name="x_BLOOD_ID" id="x_BLOOD_ID" size="30" placeholder="<?= HtmlEncode($Page->BLOOD_ID->getPlaceHolder()) ?>" value="<?= $Page->BLOOD_ID->EditValue ?>"<?= $Page->BLOOD_ID->editAttributes() ?> aria-describedby="x_BLOOD_ID_help">
<?= $Page->BLOOD_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->BLOOD_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
    <div id="r_MARITALSTATUSID" class="form-group row">
        <label id="elh_FAMILY_MARITALSTATUSID" for="x_MARITALSTATUSID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MARITALSTATUSID->caption() ?><?= $Page->MARITALSTATUSID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MARITALSTATUSID->cellAttributes() ?>>
<span id="el_FAMILY_MARITALSTATUSID">
<input type="<?= $Page->MARITALSTATUSID->getInputTextType() ?>" data-table="FAMILY" data-field="x_MARITALSTATUSID" name="x_MARITALSTATUSID" id="x_MARITALSTATUSID" size="30" placeholder="<?= HtmlEncode($Page->MARITALSTATUSID->getPlaceHolder()) ?>" value="<?= $Page->MARITALSTATUSID->EditValue ?>"<?= $Page->MARITALSTATUSID->editAttributes() ?> aria-describedby="x_MARITALSTATUSID_help">
<?= $Page->MARITALSTATUSID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MARITALSTATUSID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
    <div id="r_ADDRESS" class="form-group row">
        <label id="elh_FAMILY_ADDRESS" for="x_ADDRESS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ADDRESS->caption() ?><?= $Page->ADDRESS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ADDRESS->cellAttributes() ?>>
<span id="el_FAMILY_ADDRESS">
<input type="<?= $Page->ADDRESS->getInputTextType() ?>" data-table="FAMILY" data-field="x_ADDRESS" name="x_ADDRESS" id="x_ADDRESS" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->ADDRESS->getPlaceHolder()) ?>" value="<?= $Page->ADDRESS->EditValue ?>"<?= $Page->ADDRESS->editAttributes() ?> aria-describedby="x_ADDRESS_help">
<?= $Page->ADDRESS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ADDRESS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KOTA->Visible) { // KOTA ?>
    <div id="r_KOTA" class="form-group row">
        <label id="elh_FAMILY_KOTA" for="x_KOTA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KOTA->caption() ?><?= $Page->KOTA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KOTA->cellAttributes() ?>>
<span id="el_FAMILY_KOTA">
<input type="<?= $Page->KOTA->getInputTextType() ?>" data-table="FAMILY" data-field="x_KOTA" name="x_KOTA" id="x_KOTA" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->KOTA->getPlaceHolder()) ?>" value="<?= $Page->KOTA->EditValue ?>"<?= $Page->KOTA->editAttributes() ?> aria-describedby="x_KOTA_help">
<?= $Page->KOTA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KOTA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->RT->Visible) { // RT ?>
    <div id="r_RT" class="form-group row">
        <label id="elh_FAMILY_RT" for="x_RT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->RT->caption() ?><?= $Page->RT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RT->cellAttributes() ?>>
<span id="el_FAMILY_RT">
<input type="<?= $Page->RT->getInputTextType() ?>" data-table="FAMILY" data-field="x_RT" name="x_RT" id="x_RT" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->RT->getPlaceHolder()) ?>" value="<?= $Page->RT->EditValue ?>"<?= $Page->RT->editAttributes() ?> aria-describedby="x_RT_help">
<?= $Page->RT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->RT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->RW->Visible) { // RW ?>
    <div id="r_RW" class="form-group row">
        <label id="elh_FAMILY_RW" for="x_RW" class="<?= $Page->LeftColumnClass ?>"><?= $Page->RW->caption() ?><?= $Page->RW->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RW->cellAttributes() ?>>
<span id="el_FAMILY_RW">
<input type="<?= $Page->RW->getInputTextType() ?>" data-table="FAMILY" data-field="x_RW" name="x_RW" id="x_RW" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->RW->getPlaceHolder()) ?>" value="<?= $Page->RW->EditValue ?>"<?= $Page->RW->editAttributes() ?> aria-describedby="x_RW_help">
<?= $Page->RW->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->RW->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
    <div id="r_PHONE" class="form-group row">
        <label id="elh_FAMILY_PHONE" for="x_PHONE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PHONE->caption() ?><?= $Page->PHONE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PHONE->cellAttributes() ?>>
<span id="el_FAMILY_PHONE">
<input type="<?= $Page->PHONE->getInputTextType() ?>" data-table="FAMILY" data-field="x_PHONE" name="x_PHONE" id="x_PHONE" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PHONE->getPlaceHolder()) ?>" value="<?= $Page->PHONE->EditValue ?>"<?= $Page->PHONE->editAttributes() ?> aria-describedby="x_PHONE_help">
<?= $Page->PHONE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PHONE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { // MOBILE ?>
    <div id="r_MOBILE" class="form-group row">
        <label id="elh_FAMILY_MOBILE" for="x_MOBILE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MOBILE->caption() ?><?= $Page->MOBILE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MOBILE->cellAttributes() ?>>
<span id="el_FAMILY_MOBILE">
<input type="<?= $Page->MOBILE->getInputTextType() ?>" data-table="FAMILY" data-field="x_MOBILE" name="x_MOBILE" id="x_MOBILE" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MOBILE->getPlaceHolder()) ?>" value="<?= $Page->MOBILE->EditValue ?>"<?= $Page->MOBILE->editAttributes() ?> aria-describedby="x_MOBILE_help">
<?= $Page->MOBILE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MOBILE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
    <div id="r_FAX" class="form-group row">
        <label id="elh_FAMILY_FAX" for="x_FAX" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FAX->caption() ?><?= $Page->FAX->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FAX->cellAttributes() ?>>
<span id="el_FAMILY_FAX">
<input type="<?= $Page->FAX->getInputTextType() ?>" data-table="FAMILY" data-field="x_FAX" name="x_FAX" id="x_FAX" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->FAX->getPlaceHolder()) ?>" value="<?= $Page->FAX->EditValue ?>"<?= $Page->FAX->editAttributes() ?> aria-describedby="x_FAX_help">
<?= $Page->FAX->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FAX->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
    <div id="r__EMAIL" class="form-group row">
        <label id="elh_FAMILY__EMAIL" for="x__EMAIL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_EMAIL->caption() ?><?= $Page->_EMAIL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el_FAMILY__EMAIL">
<input type="<?= $Page->_EMAIL->getInputTextType() ?>" data-table="FAMILY" data-field="x__EMAIL" name="x__EMAIL" id="x__EMAIL" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_EMAIL->getPlaceHolder()) ?>" value="<?= $Page->_EMAIL->EditValue ?>"<?= $Page->_EMAIL->editAttributes() ?> aria-describedby="x__EMAIL_help">
<?= $Page->_EMAIL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_EMAIL->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <div id="r_DESCRIPTION" class="form-group row">
        <label id="elh_FAMILY_DESCRIPTION" for="x_DESCRIPTION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DESCRIPTION->caption() ?><?= $Page->DESCRIPTION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_FAMILY_DESCRIPTION">
<input type="<?= $Page->DESCRIPTION->getInputTextType() ?>" data-table="FAMILY" data-field="x_DESCRIPTION" name="x_DESCRIPTION" id="x_DESCRIPTION" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Page->DESCRIPTION->EditValue ?>"<?= $Page->DESCRIPTION->editAttributes() ?> aria-describedby="x_DESCRIPTION_help">
<?= $Page->DESCRIPTION->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DESCRIPTION->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
    <div id="r_MODIFIED_DATE" class="form-group row">
        <label id="elh_FAMILY_MODIFIED_DATE" for="x_MODIFIED_DATE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODIFIED_DATE->caption() ?><?= $Page->MODIFIED_DATE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_DATE->cellAttributes() ?>>
<span id="el_FAMILY_MODIFIED_DATE">
<input type="<?= $Page->MODIFIED_DATE->getInputTextType() ?>" data-table="FAMILY" data-field="x_MODIFIED_DATE" name="x_MODIFIED_DATE" id="x_MODIFIED_DATE" placeholder="<?= HtmlEncode($Page->MODIFIED_DATE->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_DATE->EditValue ?>"<?= $Page->MODIFIED_DATE->editAttributes() ?> aria-describedby="x_MODIFIED_DATE_help">
<?= $Page->MODIFIED_DATE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MODIFIED_DATE->getErrorMessage() ?></div>
<?php if (!$Page->MODIFIED_DATE->ReadOnly && !$Page->MODIFIED_DATE->Disabled && !isset($Page->MODIFIED_DATE->EditAttrs["readonly"]) && !isset($Page->MODIFIED_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fFAMILYadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fFAMILYadd", "x_MODIFIED_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
    <div id="r_MODIFIED_BY" class="form-group row">
        <label id="elh_FAMILY_MODIFIED_BY" for="x_MODIFIED_BY" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODIFIED_BY->caption() ?><?= $Page->MODIFIED_BY->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_BY->cellAttributes() ?>>
<span id="el_FAMILY_MODIFIED_BY">
<input type="<?= $Page->MODIFIED_BY->getInputTextType() ?>" data-table="FAMILY" data-field="x_MODIFIED_BY" name="x_MODIFIED_BY" id="x_MODIFIED_BY" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->MODIFIED_BY->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_BY->EditValue ?>"<?= $Page->MODIFIED_BY->editAttributes() ?> aria-describedby="x_MODIFIED_BY_help">
<?= $Page->MODIFIED_BY->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MODIFIED_BY->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
    <div id="r_MODIFIED_FROM" class="form-group row">
        <label id="elh_FAMILY_MODIFIED_FROM" for="x_MODIFIED_FROM" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODIFIED_FROM->caption() ?><?= $Page->MODIFIED_FROM->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_FROM->cellAttributes() ?>>
<span id="el_FAMILY_MODIFIED_FROM">
<input type="<?= $Page->MODIFIED_FROM->getInputTextType() ?>" data-table="FAMILY" data-field="x_MODIFIED_FROM" name="x_MODIFIED_FROM" id="x_MODIFIED_FROM" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MODIFIED_FROM->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_FROM->EditValue ?>"<?= $Page->MODIFIED_FROM->editAttributes() ?> aria-describedby="x_MODIFIED_FROM_help">
<?= $Page->MODIFIED_FROM->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MODIFIED_FROM->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->COUNTRY_CODE->Visible) { // COUNTRY_CODE ?>
    <div id="r_COUNTRY_CODE" class="form-group row">
        <label id="elh_FAMILY_COUNTRY_CODE" for="x_COUNTRY_CODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->COUNTRY_CODE->caption() ?><?= $Page->COUNTRY_CODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COUNTRY_CODE->cellAttributes() ?>>
<span id="el_FAMILY_COUNTRY_CODE">
<input type="<?= $Page->COUNTRY_CODE->getInputTextType() ?>" data-table="FAMILY" data-field="x_COUNTRY_CODE" name="x_COUNTRY_CODE" id="x_COUNTRY_CODE" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->COUNTRY_CODE->getPlaceHolder()) ?>" value="<?= $Page->COUNTRY_CODE->EditValue ?>"<?= $Page->COUNTRY_CODE->editAttributes() ?> aria-describedby="x_COUNTRY_CODE_help">
<?= $Page->COUNTRY_CODE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->COUNTRY_CODE->getErrorMessage() ?></div>
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
    ew.addEventHandlers("FAMILY");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
