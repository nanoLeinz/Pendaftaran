<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienVisitationEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPASIEN_VISITATIONedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fPASIEN_VISITATIONedit = currentForm = new ew.Form("fPASIEN_VISITATIONedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PASIEN_VISITATION")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PASIEN_VISITATION)
        ew.vars.tables.PASIEN_VISITATION = currentTable;
    fPASIEN_VISITATIONedit.addFields([
        ["VISIT_ID", [fields.VISIT_ID.visible && fields.VISIT_ID.required ? ew.Validators.required(fields.VISIT_ID.caption) : null], fields.VISIT_ID.isInvalid],
        ["TICKET_NO", [fields.TICKET_NO.visible && fields.TICKET_NO.required ? ew.Validators.required(fields.TICKET_NO.caption) : null], fields.TICKET_NO.isInvalid],
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["STATUS_PASIEN_ID", [fields.STATUS_PASIEN_ID.visible && fields.STATUS_PASIEN_ID.required ? ew.Validators.required(fields.STATUS_PASIEN_ID.caption) : null], fields.STATUS_PASIEN_ID.isInvalid],
        ["PASIEN_ID", [fields.PASIEN_ID.visible && fields.PASIEN_ID.required ? ew.Validators.required(fields.PASIEN_ID.caption) : null], fields.PASIEN_ID.isInvalid],
        ["RUJUKAN_ID", [fields.RUJUKAN_ID.visible && fields.RUJUKAN_ID.required ? ew.Validators.required(fields.RUJUKAN_ID.caption) : null], fields.RUJUKAN_ID.isInvalid],
        ["REASON_ID", [fields.REASON_ID.visible && fields.REASON_ID.required ? ew.Validators.required(fields.REASON_ID.caption) : null], fields.REASON_ID.isInvalid],
        ["WAY_ID", [fields.WAY_ID.visible && fields.WAY_ID.required ? ew.Validators.required(fields.WAY_ID.caption) : null], fields.WAY_ID.isInvalid],
        ["KDPOLI_EKS", [fields.KDPOLI_EKS.visible && fields.KDPOLI_EKS.required ? ew.Validators.required(fields.KDPOLI_EKS.caption) : null], fields.KDPOLI_EKS.isInvalid],
        ["CLINIC_ID", [fields.CLINIC_ID.visible && fields.CLINIC_ID.required ? ew.Validators.required(fields.CLINIC_ID.caption) : null], fields.CLINIC_ID.isInvalid],
        ["RESPONTGLPLG_DESC", [fields.RESPONTGLPLG_DESC.visible && fields.RESPONTGLPLG_DESC.required ? ew.Validators.required(fields.RESPONTGLPLG_DESC.caption) : null], fields.RESPONTGLPLG_DESC.isInvalid],
        ["GENDER", [fields.GENDER.visible && fields.GENDER.required ? ew.Validators.required(fields.GENDER.caption) : null], fields.GENDER.isInvalid],
        ["EMPLOYEE_ID", [fields.EMPLOYEE_ID.visible && fields.EMPLOYEE_ID.required ? ew.Validators.required(fields.EMPLOYEE_ID.caption) : null], fields.EMPLOYEE_ID.isInvalid],
        ["ISATTENDED", [fields.ISATTENDED.visible && fields.ISATTENDED.required ? ew.Validators.required(fields.ISATTENDED.caption) : null], fields.ISATTENDED.isInvalid],
        ["CLASS_ID", [fields.CLASS_ID.visible && fields.CLASS_ID.required ? ew.Validators.required(fields.CLASS_ID.caption) : null, ew.Validators.integer], fields.CLASS_ID.isInvalid],
        ["COVERAGE_ID", [fields.COVERAGE_ID.visible && fields.COVERAGE_ID.required ? ew.Validators.required(fields.COVERAGE_ID.caption) : null, ew.Validators.integer], fields.COVERAGE_ID.isInvalid],
        ["NO_SKP", [fields.NO_SKP.visible && fields.NO_SKP.required ? ew.Validators.required(fields.NO_SKP.caption) : null], fields.NO_SKP.isInvalid],
        ["ASALRUJUKAN", [fields.ASALRUJUKAN.visible && fields.ASALRUJUKAN.required ? ew.Validators.required(fields.ASALRUJUKAN.caption) : null], fields.ASALRUJUKAN.isInvalid],
        ["NORUJUKAN", [fields.NORUJUKAN.visible && fields.NORUJUKAN.required ? ew.Validators.required(fields.NORUJUKAN.caption) : null], fields.NORUJUKAN.isInvalid],
        ["DIAG_AWAL", [fields.DIAG_AWAL.visible && fields.DIAG_AWAL.required ? ew.Validators.required(fields.DIAG_AWAL.caption) : null], fields.DIAG_AWAL.isInvalid],
        ["DIAGNOSA_ID", [fields.DIAGNOSA_ID.visible && fields.DIAGNOSA_ID.required ? ew.Validators.required(fields.DIAGNOSA_ID.caption) : null], fields.DIAGNOSA_ID.isInvalid],
        ["PPKRUJUKAN", [fields.PPKRUJUKAN.visible && fields.PPKRUJUKAN.required ? ew.Validators.required(fields.PPKRUJUKAN.caption) : null], fields.PPKRUJUKAN.isInvalid],
        ["EDIT_SEP", [fields.EDIT_SEP.visible && fields.EDIT_SEP.required ? ew.Validators.required(fields.EDIT_SEP.caption) : null], fields.EDIT_SEP.isInvalid],
        ["COB", [fields.COB.visible && fields.COB.required ? ew.Validators.required(fields.COB.caption) : null], fields.COB.isInvalid],
        ["KDDPJP", [fields.KDDPJP.visible && fields.KDDPJP.required ? ew.Validators.required(fields.KDDPJP.caption) : null], fields.KDDPJP.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid],
        ["tgl_kontrol", [fields.tgl_kontrol.visible && fields.tgl_kontrol.required ? ew.Validators.required(fields.tgl_kontrol.caption) : null, ew.Validators.datetime(0)], fields.tgl_kontrol.isInvalid],
        ["SEP", [fields.SEP.visible && fields.SEP.required ? ew.Validators.required(fields.SEP.caption) : null], fields.SEP.isInvalid],
        ["idbooking", [fields.idbooking.visible && fields.idbooking.required ? ew.Validators.required(fields.idbooking.caption) : null], fields.idbooking.isInvalid],
        ["id_tujuan", [fields.id_tujuan.visible && fields.id_tujuan.required ? ew.Validators.required(fields.id_tujuan.caption) : null, ew.Validators.integer], fields.id_tujuan.isInvalid],
        ["id_penunjang", [fields.id_penunjang.visible && fields.id_penunjang.required ? ew.Validators.required(fields.id_penunjang.caption) : null, ew.Validators.integer], fields.id_penunjang.isInvalid],
        ["id_pembiayaan", [fields.id_pembiayaan.visible && fields.id_pembiayaan.required ? ew.Validators.required(fields.id_pembiayaan.caption) : null, ew.Validators.integer], fields.id_pembiayaan.isInvalid],
        ["id_procedure", [fields.id_procedure.visible && fields.id_procedure.required ? ew.Validators.required(fields.id_procedure.caption) : null, ew.Validators.integer], fields.id_procedure.isInvalid],
        ["id_aspel", [fields.id_aspel.visible && fields.id_aspel.required ? ew.Validators.required(fields.id_aspel.caption) : null, ew.Validators.integer], fields.id_aspel.isInvalid],
        ["id_kelas", [fields.id_kelas.visible && fields.id_kelas.required ? ew.Validators.required(fields.id_kelas.caption) : null, ew.Validators.integer], fields.id_kelas.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fPASIEN_VISITATIONedit,
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
    fPASIEN_VISITATIONedit.validate = function () {
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
    fPASIEN_VISITATIONedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPASIEN_VISITATIONedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fPASIEN_VISITATIONedit.lists.NO_REGISTRATION = <?= $Page->NO_REGISTRATION->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.STATUS_PASIEN_ID = <?= $Page->STATUS_PASIEN_ID->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.REASON_ID = <?= $Page->REASON_ID->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.WAY_ID = <?= $Page->WAY_ID->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.KDPOLI_EKS = <?= $Page->KDPOLI_EKS->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.CLINIC_ID = <?= $Page->CLINIC_ID->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.RESPONTGLPLG_DESC = <?= $Page->RESPONTGLPLG_DESC->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.GENDER = <?= $Page->GENDER->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.EMPLOYEE_ID = <?= $Page->EMPLOYEE_ID->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.ISATTENDED = <?= $Page->ISATTENDED->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.CLASS_ID = <?= $Page->CLASS_ID->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.COVERAGE_ID = <?= $Page->COVERAGE_ID->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.ASALRUJUKAN = <?= $Page->ASALRUJUKAN->toClientList($Page) ?>;
    fPASIEN_VISITATIONedit.lists.COB = <?= $Page->COB->toClientList($Page) ?>;
    loadjs.done("fPASIEN_VISITATIONedit");
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
<form name="fPASIEN_VISITATIONedit" id="fPASIEN_VISITATIONedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN_VISITATION">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "cv_pasien") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="cv_pasien">
<input type="hidden" name="fk_NO_REGISTRATION" value="<?= HtmlEncode($Page->NO_REGISTRATION->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->TICKET_NO->Visible) { // TICKET_NO ?>
    <div id="r_TICKET_NO" class="form-group row">
        <label id="elh_PASIEN_VISITATION_TICKET_NO" for="x_TICKET_NO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TICKET_NO->caption() ?><?= $Page->TICKET_NO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TICKET_NO->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_TICKET_NO">
<span<?= $Page->TICKET_NO->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->TICKET_NO->getDisplayValue($Page->TICKET_NO->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" data-hidden="1" name="x_TICKET_NO" id="x_TICKET_NO" value="<?= HtmlEncode($Page->TICKET_NO->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label id="elh_PASIEN_VISITATION_NO_REGISTRATION" for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION->caption() ?><?= $Page->NO_REGISTRATION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<?php if ($Page->NO_REGISTRATION->getSessionValue() != "") { ?>
<span id="el_PASIEN_VISITATION_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NO_REGISTRATION->getDisplayValue($Page->NO_REGISTRATION->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_NO_REGISTRATION" name="x_NO_REGISTRATION" value="<?= HtmlEncode($Page->NO_REGISTRATION->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_PASIEN_VISITATION_NO_REGISTRATION">
<?php $Page->NO_REGISTRATION->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list" aria-describedby="x_NO_REGISTRATION_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_NO_REGISTRATION"><?= EmptyValue(strval($Page->NO_REGISTRATION->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->NO_REGISTRATION->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->NO_REGISTRATION->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->NO_REGISTRATION->ReadOnly || $Page->NO_REGISTRATION->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_NO_REGISTRATION',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->NO_REGISTRATION->getErrorMessage() ?></div>
<?= $Page->NO_REGISTRATION->getCustomMessage() ?>
<?= $Page->NO_REGISTRATION->Lookup->getParamTag($Page, "p_x_NO_REGISTRATION") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->NO_REGISTRATION->displayValueSeparatorAttribute() ?>" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" value="<?= $Page->NO_REGISTRATION->CurrentValue ?>"<?= $Page->NO_REGISTRATION->editAttributes() ?>>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <div id="r_STATUS_PASIEN_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_STATUS_PASIEN_ID" for="x_STATUS_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_PASIEN_ID->caption() ?><?= $Page->STATUS_PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_STATUS_PASIEN_ID">
    <select
        id="x_STATUS_PASIEN_ID"
        name="x_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Page->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x_STATUS_PASIEN_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x_STATUS_PASIEN_ID']"),
        options = { name: "x_STATUS_PASIEN_ID", selectId: "PASIEN_VISITATION_x_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
    <div id="r_PASIEN_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_PASIEN_ID" for="x_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PASIEN_ID->caption() ?><?= $Page->PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_PASIEN_ID">
<span<?= $Page->PASIEN_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->PASIEN_ID->getDisplayValue($Page->PASIEN_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" data-hidden="1" name="x_PASIEN_ID" id="x_PASIEN_ID" value="<?= HtmlEncode($Page->PASIEN_ID->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->REASON_ID->Visible) { // REASON_ID ?>
    <div id="r_REASON_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_REASON_ID" for="x_REASON_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->REASON_ID->caption() ?><?= $Page->REASON_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->REASON_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_REASON_ID">
    <select
        id="x_REASON_ID"
        name="x_REASON_ID"
        class="form-control ew-select<?= $Page->REASON_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x_REASON_ID"
        data-table="PASIEN_VISITATION"
        data-field="x_REASON_ID"
        data-value-separator="<?= $Page->REASON_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->REASON_ID->getPlaceHolder()) ?>"
        <?= $Page->REASON_ID->editAttributes() ?>>
        <?= $Page->REASON_ID->selectOptionListHtml("x_REASON_ID") ?>
    </select>
    <?= $Page->REASON_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->REASON_ID->getErrorMessage() ?></div>
<?= $Page->REASON_ID->Lookup->getParamTag($Page, "p_x_REASON_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x_REASON_ID']"),
        options = { name: "x_REASON_ID", selectId: "PASIEN_VISITATION_x_REASON_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.REASON_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->WAY_ID->Visible) { // WAY_ID ?>
    <div id="r_WAY_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_WAY_ID" for="x_WAY_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->WAY_ID->caption() ?><?= $Page->WAY_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->WAY_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_WAY_ID">
    <select
        id="x_WAY_ID"
        name="x_WAY_ID"
        class="form-control ew-select<?= $Page->WAY_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x_WAY_ID"
        data-table="PASIEN_VISITATION"
        data-field="x_WAY_ID"
        data-value-separator="<?= $Page->WAY_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->WAY_ID->getPlaceHolder()) ?>"
        <?= $Page->WAY_ID->editAttributes() ?>>
        <?= $Page->WAY_ID->selectOptionListHtml("x_WAY_ID") ?>
    </select>
    <?= $Page->WAY_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->WAY_ID->getErrorMessage() ?></div>
<?= $Page->WAY_ID->Lookup->getParamTag($Page, "p_x_WAY_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x_WAY_ID']"),
        options = { name: "x_WAY_ID", selectId: "PASIEN_VISITATION_x_WAY_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.WAY_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KDPOLI_EKS->Visible) { // KDPOLI_EKS ?>
    <div id="r_KDPOLI_EKS" class="form-group row">
        <label id="elh_PASIEN_VISITATION_KDPOLI_EKS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KDPOLI_EKS->caption() ?><?= $Page->KDPOLI_EKS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDPOLI_EKS->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_KDPOLI_EKS">
<template id="tp_x_KDPOLI_EKS">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="PASIEN_VISITATION" data-field="x_KDPOLI_EKS" name="x_KDPOLI_EKS" id="x_KDPOLI_EKS"<?= $Page->KDPOLI_EKS->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_KDPOLI_EKS" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_KDPOLI_EKS"
    name="x_KDPOLI_EKS"
    value="<?= HtmlEncode($Page->KDPOLI_EKS->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_KDPOLI_EKS"
    data-target="dsl_x_KDPOLI_EKS"
    data-repeatcolumn="5"
    class="form-control<?= $Page->KDPOLI_EKS->isInvalidClass() ?>"
    data-table="PASIEN_VISITATION"
    data-field="x_KDPOLI_EKS"
    data-value-separator="<?= $Page->KDPOLI_EKS->displayValueSeparatorAttribute() ?>"
    <?= $Page->KDPOLI_EKS->editAttributes() ?>>
<?= $Page->KDPOLI_EKS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KDPOLI_EKS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <div id="r_CLINIC_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_CLINIC_ID" for="x_CLINIC_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLINIC_ID->caption() ?><?= $Page->CLINIC_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_CLINIC_ID">
<?php $Page->CLINIC_ID->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_CLINIC_ID"
        name="x_CLINIC_ID"
        class="form-control ew-select<?= $Page->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x_CLINIC_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x_CLINIC_ID']"),
        options = { name: "x_CLINIC_ID", selectId: "PASIEN_VISITATION_x_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->RESPONTGLPLG_DESC->Visible) { // RESPONTGLPLG_DESC ?>
    <div id="r_RESPONTGLPLG_DESC" class="form-group row">
        <label id="elh_PASIEN_VISITATION_RESPONTGLPLG_DESC" for="x_RESPONTGLPLG_DESC" class="<?= $Page->LeftColumnClass ?>"><?= $Page->RESPONTGLPLG_DESC->caption() ?><?= $Page->RESPONTGLPLG_DESC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESPONTGLPLG_DESC->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_RESPONTGLPLG_DESC">
    <select
        id="x_RESPONTGLPLG_DESC"
        name="x_RESPONTGLPLG_DESC"
        class="form-control ew-select<?= $Page->RESPONTGLPLG_DESC->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x_RESPONTGLPLG_DESC"
        data-table="PASIEN_VISITATION"
        data-field="x_RESPONTGLPLG_DESC"
        data-value-separator="<?= $Page->RESPONTGLPLG_DESC->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->RESPONTGLPLG_DESC->getPlaceHolder()) ?>"
        <?= $Page->RESPONTGLPLG_DESC->editAttributes() ?>>
        <?= $Page->RESPONTGLPLG_DESC->selectOptionListHtml("x_RESPONTGLPLG_DESC") ?>
    </select>
    <?= $Page->RESPONTGLPLG_DESC->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->RESPONTGLPLG_DESC->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x_RESPONTGLPLG_DESC']"),
        options = { name: "x_RESPONTGLPLG_DESC", selectId: "PASIEN_VISITATION_x_RESPONTGLPLG_DESC", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.PASIEN_VISITATION.fields.RESPONTGLPLG_DESC.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.RESPONTGLPLG_DESC.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <div id="r_GENDER" class="form-group row">
        <label id="elh_PASIEN_VISITATION_GENDER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GENDER->caption() ?><?= $Page->GENDER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_GENDER">
<template id="tp_x_GENDER">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="PASIEN_VISITATION" data-field="x_GENDER" name="x_GENDER" id="x_GENDER"<?= $Page->GENDER->editAttributes() ?>>
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
    data-table="PASIEN_VISITATION"
    data-field="x_GENDER"
    data-value-separator="<?= $Page->GENDER->displayValueSeparatorAttribute() ?>"
    <?= $Page->GENDER->editAttributes() ?>>
<?= $Page->GENDER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->GENDER->getErrorMessage() ?></div>
<?= $Page->GENDER->Lookup->getParamTag($Page, "p_x_GENDER") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <div id="r_EMPLOYEE_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_EMPLOYEE_ID" for="x_EMPLOYEE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EMPLOYEE_ID->caption() ?><?= $Page->EMPLOYEE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_EMPLOYEE_ID">
<?php $Page->EMPLOYEE_ID->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x_EMPLOYEE_ID"
        name="x_EMPLOYEE_ID"
        class="form-control ew-select<?= $Page->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x_EMPLOYEE_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x_EMPLOYEE_ID']"),
        options = { name: "x_EMPLOYEE_ID", selectId: "PASIEN_VISITATION_x_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ISATTENDED->Visible) { // ISATTENDED ?>
    <div id="r_ISATTENDED" class="form-group row">
        <label id="elh_PASIEN_VISITATION_ISATTENDED" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ISATTENDED->caption() ?><?= $Page->ISATTENDED->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ISATTENDED->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_ISATTENDED">
<template id="tp_x_ISATTENDED">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="PASIEN_VISITATION" data-field="x_ISATTENDED" name="x_ISATTENDED" id="x_ISATTENDED"<?= $Page->ISATTENDED->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_ISATTENDED" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_ISATTENDED"
    name="x_ISATTENDED"
    value="<?= HtmlEncode($Page->ISATTENDED->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_ISATTENDED"
    data-target="dsl_x_ISATTENDED"
    data-repeatcolumn="5"
    class="form-control<?= $Page->ISATTENDED->isInvalidClass() ?>"
    data-table="PASIEN_VISITATION"
    data-field="x_ISATTENDED"
    data-value-separator="<?= $Page->ISATTENDED->displayValueSeparatorAttribute() ?>"
    <?= $Page->ISATTENDED->editAttributes() ?>>
<?= $Page->ISATTENDED->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ISATTENDED->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <div id="r_CLASS_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_CLASS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLASS_ID->caption() ?><?= $Page->CLASS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_CLASS_ID">
<?php
$onchange = $Page->CLASS_ID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->CLASS_ID->EditAttrs["onchange"] = "";
?>
<span id="as_x_CLASS_ID" class="ew-auto-suggest">
    <input type="<?= $Page->CLASS_ID->getInputTextType() ?>" class="form-control" name="sv_x_CLASS_ID" id="sv_x_CLASS_ID" value="<?= RemoveHtml($Page->CLASS_ID->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->CLASS_ID->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->CLASS_ID->getPlaceHolder()) ?>"<?= $Page->CLASS_ID->editAttributes() ?> aria-describedby="x_CLASS_ID_help">
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-input="sv_x_CLASS_ID" data-value-separator="<?= $Page->CLASS_ID->displayValueSeparatorAttribute() ?>" name="x_CLASS_ID" id="x_CLASS_ID" value="<?= HtmlEncode($Page->CLASS_ID->CurrentValue) ?>"<?= $onchange ?>>
<?= $Page->CLASS_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CLASS_ID->getErrorMessage() ?></div>
<script>
loadjs.ready(["fPASIEN_VISITATIONedit"], function() {
    fPASIEN_VISITATIONedit.createAutoSuggest(Object.assign({"id":"x_CLASS_ID","forceSelect":false}, ew.vars.tables.PASIEN_VISITATION.fields.CLASS_ID.autoSuggestOptions));
});
</script>
<?= $Page->CLASS_ID->Lookup->getParamTag($Page, "p_x_CLASS_ID") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <div id="r_COVERAGE_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_COVERAGE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->COVERAGE_ID->caption() ?><?= $Page->COVERAGE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COVERAGE_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_COVERAGE_ID">
<?php
$onchange = $Page->COVERAGE_ID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->COVERAGE_ID->EditAttrs["onchange"] = "";
?>
<span id="as_x_COVERAGE_ID" class="ew-auto-suggest">
    <input type="<?= $Page->COVERAGE_ID->getInputTextType() ?>" class="form-control" name="sv_x_COVERAGE_ID" id="sv_x_COVERAGE_ID" value="<?= RemoveHtml($Page->COVERAGE_ID->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->COVERAGE_ID->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->COVERAGE_ID->getPlaceHolder()) ?>"<?= $Page->COVERAGE_ID->editAttributes() ?> aria-describedby="x_COVERAGE_ID_help">
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="PASIEN_VISITATION" data-field="x_COVERAGE_ID" data-input="sv_x_COVERAGE_ID" data-value-separator="<?= $Page->COVERAGE_ID->displayValueSeparatorAttribute() ?>" name="x_COVERAGE_ID" id="x_COVERAGE_ID" value="<?= HtmlEncode($Page->COVERAGE_ID->CurrentValue) ?>"<?= $onchange ?>>
<?= $Page->COVERAGE_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->COVERAGE_ID->getErrorMessage() ?></div>
<script>
loadjs.ready(["fPASIEN_VISITATIONedit"], function() {
    fPASIEN_VISITATIONedit.createAutoSuggest(Object.assign({"id":"x_COVERAGE_ID","forceSelect":false}, ew.vars.tables.PASIEN_VISITATION.fields.COVERAGE_ID.autoSuggestOptions));
});
</script>
<?= $Page->COVERAGE_ID->Lookup->getParamTag($Page, "p_x_COVERAGE_ID") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_SKP->Visible) { // NO_SKP ?>
    <div id="r_NO_SKP" class="form-group row">
        <label id="elh_PASIEN_VISITATION_NO_SKP" for="x_NO_SKP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_SKP->caption() ?><?= $Page->NO_SKP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_SKP->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_NO_SKP">
<span<?= $Page->NO_SKP->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NO_SKP->getDisplayValue($Page->NO_SKP->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_NO_SKP" data-hidden="1" name="x_NO_SKP" id="x_NO_SKP" value="<?= HtmlEncode($Page->NO_SKP->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ASALRUJUKAN->Visible) { // ASALRUJUKAN ?>
    <div id="r_ASALRUJUKAN" class="form-group row">
        <label id="elh_PASIEN_VISITATION_ASALRUJUKAN" for="x_ASALRUJUKAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ASALRUJUKAN->caption() ?><?= $Page->ASALRUJUKAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ASALRUJUKAN->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_ASALRUJUKAN">
    <select
        id="x_ASALRUJUKAN"
        name="x_ASALRUJUKAN"
        class="form-control ew-select<?= $Page->ASALRUJUKAN->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x_ASALRUJUKAN"
        data-table="PASIEN_VISITATION"
        data-field="x_ASALRUJUKAN"
        data-value-separator="<?= $Page->ASALRUJUKAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ASALRUJUKAN->getPlaceHolder()) ?>"
        <?= $Page->ASALRUJUKAN->editAttributes() ?>>
        <?= $Page->ASALRUJUKAN->selectOptionListHtml("x_ASALRUJUKAN") ?>
    </select>
    <?= $Page->ASALRUJUKAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ASALRUJUKAN->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x_ASALRUJUKAN']"),
        options = { name: "x_ASALRUJUKAN", selectId: "PASIEN_VISITATION_x_ASALRUJUKAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.PASIEN_VISITATION.fields.ASALRUJUKAN.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.ASALRUJUKAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NORUJUKAN->Visible) { // NORUJUKAN ?>
    <div id="r_NORUJUKAN" class="form-group row">
        <label id="elh_PASIEN_VISITATION_NORUJUKAN" for="x_NORUJUKAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NORUJUKAN->caption() ?><?= $Page->NORUJUKAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NORUJUKAN->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_NORUJUKAN">
<input type="<?= $Page->NORUJUKAN->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_NORUJUKAN" name="x_NORUJUKAN" id="x_NORUJUKAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->NORUJUKAN->getPlaceHolder()) ?>" value="<?= $Page->NORUJUKAN->EditValue ?>"<?= $Page->NORUJUKAN->editAttributes() ?> aria-describedby="x_NORUJUKAN_help">
<?= $Page->NORUJUKAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NORUJUKAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAG_AWAL->Visible) { // DIAG_AWAL ?>
    <div id="r_DIAG_AWAL" class="form-group row">
        <label id="elh_PASIEN_VISITATION_DIAG_AWAL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAG_AWAL->caption() ?><?= $Page->DIAG_AWAL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAG_AWAL->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_DIAG_AWAL">
<span<?= $Page->DIAG_AWAL->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->DIAG_AWAL->getDisplayValue($Page->DIAG_AWAL->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_DIAG_AWAL" data-hidden="1" name="x_DIAG_AWAL" id="x_DIAG_AWAL" value="<?= HtmlEncode($Page->DIAG_AWAL->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <div id="r_DIAGNOSA_ID" class="form-group row">
        <label id="elh_PASIEN_VISITATION_DIAGNOSA_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID->caption() ?><?= $Page->DIAGNOSA_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_DIAGNOSA_ID">
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->DIAGNOSA_ID->getDisplayValue($Page->DIAGNOSA_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_DIAGNOSA_ID" data-hidden="1" name="x_DIAGNOSA_ID" id="x_DIAGNOSA_ID" value="<?= HtmlEncode($Page->DIAGNOSA_ID->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PPKRUJUKAN->Visible) { // PPKRUJUKAN ?>
    <div id="r_PPKRUJUKAN" class="form-group row">
        <label id="elh_PASIEN_VISITATION_PPKRUJUKAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PPKRUJUKAN->caption() ?><?= $Page->PPKRUJUKAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PPKRUJUKAN->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_PPKRUJUKAN">
<span<?= $Page->PPKRUJUKAN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->PPKRUJUKAN->getDisplayValue($Page->PPKRUJUKAN->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PPKRUJUKAN" data-hidden="1" name="x_PPKRUJUKAN" id="x_PPKRUJUKAN" value="<?= HtmlEncode($Page->PPKRUJUKAN->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->EDIT_SEP->Visible) { // EDIT_SEP ?>
    <div id="r_EDIT_SEP" class="form-group row">
        <label id="elh_PASIEN_VISITATION_EDIT_SEP" for="x_EDIT_SEP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EDIT_SEP->caption() ?><?= $Page->EDIT_SEP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EDIT_SEP->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_EDIT_SEP">
<input type="<?= $Page->EDIT_SEP->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_EDIT_SEP" name="x_EDIT_SEP" id="x_EDIT_SEP" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->EDIT_SEP->getPlaceHolder()) ?>" value="<?= $Page->EDIT_SEP->EditValue ?>"<?= $Page->EDIT_SEP->editAttributes() ?> aria-describedby="x_EDIT_SEP_help">
<?= $Page->EDIT_SEP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->EDIT_SEP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->COB->Visible) { // COB ?>
    <div id="r_COB" class="form-group row">
        <label id="elh_PASIEN_VISITATION_COB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->COB->caption() ?><?= $Page->COB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COB->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_COB">
<template id="tp_x_COB">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="PASIEN_VISITATION" data-field="x_COB" name="x_COB" id="x_COB"<?= $Page->COB->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_COB" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_COB"
    name="x_COB"
    value="<?= HtmlEncode($Page->COB->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_COB"
    data-target="dsl_x_COB"
    data-repeatcolumn="5"
    class="form-control<?= $Page->COB->isInvalidClass() ?>"
    data-table="PASIEN_VISITATION"
    data-field="x_COB"
    data-value-separator="<?= $Page->COB->displayValueSeparatorAttribute() ?>"
    <?= $Page->COB->editAttributes() ?>>
<?= $Page->COB->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->COB->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KDDPJP->Visible) { // KDDPJP ?>
    <div id="r_KDDPJP" class="form-group row">
        <label id="elh_PASIEN_VISITATION_KDDPJP" for="x_KDDPJP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KDDPJP->caption() ?><?= $Page->KDDPJP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDDPJP->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_KDDPJP">
<input type="<?= $Page->KDDPJP->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_KDDPJP" name="x_KDDPJP" id="x_KDDPJP" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->KDDPJP->getPlaceHolder()) ?>" value="<?= $Page->KDDPJP->EditValue ?>"<?= $Page->KDDPJP->editAttributes() ?> aria-describedby="x_KDDPJP_help">
<?= $Page->KDDPJP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KDDPJP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <div id="r_DESCRIPTION" class="form-group row">
        <label id="elh_PASIEN_VISITATION_DESCRIPTION" for="x_DESCRIPTION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DESCRIPTION->caption() ?><?= $Page->DESCRIPTION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_DESCRIPTION">
<textarea data-table="PASIEN_VISITATION" data-field="x_DESCRIPTION" name="x_DESCRIPTION" id="x_DESCRIPTION" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->DESCRIPTION->getPlaceHolder()) ?>"<?= $Page->DESCRIPTION->editAttributes() ?> aria-describedby="x_DESCRIPTION_help"><?= $Page->DESCRIPTION->EditValue ?></textarea>
<?= $Page->DESCRIPTION->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DESCRIPTION->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
    <div id="r_tgl_kontrol" class="form-group row">
        <label id="elh_PASIEN_VISITATION_tgl_kontrol" for="x_tgl_kontrol" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_kontrol->caption() ?><?= $Page->tgl_kontrol->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl_kontrol->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_tgl_kontrol">
<input type="<?= $Page->tgl_kontrol->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_tgl_kontrol" name="x_tgl_kontrol" id="x_tgl_kontrol" placeholder="<?= HtmlEncode($Page->tgl_kontrol->getPlaceHolder()) ?>" value="<?= $Page->tgl_kontrol->EditValue ?>"<?= $Page->tgl_kontrol->editAttributes() ?> aria-describedby="x_tgl_kontrol_help">
<?= $Page->tgl_kontrol->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_kontrol->getErrorMessage() ?></div>
<?php if (!$Page->tgl_kontrol->ReadOnly && !$Page->tgl_kontrol->Disabled && !isset($Page->tgl_kontrol->EditAttrs["readonly"]) && !isset($Page->tgl_kontrol->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_VISITATIONedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_VISITATIONedit", "x_tgl_kontrol", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SEP->Visible) { // SEP ?>
    <div id="r_SEP" class="form-group row">
        <label id="elh_PASIEN_VISITATION_SEP" for="x_SEP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEP->caption() ?><?= $Page->SEP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEP->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_SEP">
<script>

	function Buka(link = "") {
		window.open(link, 'newwindow', 'width=800,height=400');
		return false;
	};
</script>
<?php
if (empty(CurrentPage()->NO_SKP->CurrentValue)) {
?>
<a href="../bridging/get_rujukan.php?key=<?php echo urlencode(CurrentPage()->PASIEN_ID->CurrentValue).'&id='.urlencode(CurrentPage()->IDXDAFTAR->CurrentValue).'&no='.urlencode(CurrentPage()->NO_REGISTRATION->CurrentValue)?>" class="btn btn-info btn-sm" id="rujukan" role="button">Ambil Rujukan</a>
<a href="../bridging/insert_sep.php?key=<?php echo urlencode(CurrentPage()->PASIEN_ID->CurrentValue) . '&pelayanan=' . urlencode(CurrentPage()->RESPONTGLPLG_DESC->CurrentValue) . '&id=' . urlencode(CurrentPage()->IDXDAFTAR->CurrentValue). '&catatan=' . urlencode(CurrentPage()->DESCRIPTION->CurrentValue). '&nosurat=' . urlencode(CurrentPage()->EDIT_SEP->CurrentValue). '&eksekutif=' . urlencode(CurrentPage()->KDPOLI_EKS->CurrentValue). '&dpjp=' . urlencode(CurrentPage()->KDDPJP->CurrentValue) . '&no=' . urlencode(CurrentPage()->NO_REGISTRATION->CurrentValue).'&poli=' . urlencode(CurrentPage()->KDPOLI->CurrentValue) ?>" class="btn btn-info btn-sm" role="button">Buat SEP</a>
<a href="../bridging/insert_skdp.php?id=<?php echo urlencode(CurrentPage()->IDXDAFTAR->CurrentValue).'&poli='.urlencode(CurrentPage()->KDPOLI->CurrentValue).'&sep='.urlencode(CurrentPage()->NO_SKP->CurrentValue).'&tgl='.urlencode(CurrentPage()->tgl_kontrol->CurrentValue).'&dpjp='.urlencode(CurrentPage()->KDDPJP->CurrentValue)?>" class="btn btn-info btn-sm" role="button">Buat Kontrol</a>
<?php } else { ?>
<a href="#" onclick="Buka('../bridging/jasper.php?id=<?php echo urlencode(CurrentPage()->IDXDAFTAR->CurrentValue).'&tipe=SEP_BPJS'?>'); return false" class="btn btn-info btn-sm" role="button">Cetak SEP </a>
<a href="#" onclick="Buka('../bridging/jasper.php?id=<?php echo urlencode(CurrentPage()->IDXDAFTAR->CurrentValue).'&tipe=SEP_BPJS_ASLI'?>'); return false" class="btn btn-info btn-sm" role="button">Cetak SEP Asli</a>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idbooking->Visible) { // idbooking ?>
    <div id="r_idbooking" class="form-group row">
        <label id="elh_PASIEN_VISITATION_idbooking" for="x_idbooking" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idbooking->caption() ?><?= $Page->idbooking->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idbooking->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_idbooking">
<input type="<?= $Page->idbooking->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_idbooking" name="x_idbooking" id="x_idbooking" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->idbooking->getPlaceHolder()) ?>" value="<?= $Page->idbooking->EditValue ?>"<?= $Page->idbooking->editAttributes() ?> aria-describedby="x_idbooking_help">
<?= $Page->idbooking->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idbooking->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
    <div id="r_id_tujuan" class="form-group row">
        <label id="elh_PASIEN_VISITATION_id_tujuan" for="x_id_tujuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_tujuan->caption() ?><?= $Page->id_tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_tujuan->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_id_tujuan">
<input type="<?= $Page->id_tujuan->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" name="x_id_tujuan" id="x_id_tujuan" size="30" placeholder="<?= HtmlEncode($Page->id_tujuan->getPlaceHolder()) ?>" value="<?= $Page->id_tujuan->EditValue ?>"<?= $Page->id_tujuan->editAttributes() ?> aria-describedby="x_id_tujuan_help">
<?= $Page->id_tujuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_tujuan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
    <div id="r_id_penunjang" class="form-group row">
        <label id="elh_PASIEN_VISITATION_id_penunjang" for="x_id_penunjang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_penunjang->caption() ?><?= $Page->id_penunjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_penunjang->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_id_penunjang">
<input type="<?= $Page->id_penunjang->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" name="x_id_penunjang" id="x_id_penunjang" size="30" placeholder="<?= HtmlEncode($Page->id_penunjang->getPlaceHolder()) ?>" value="<?= $Page->id_penunjang->EditValue ?>"<?= $Page->id_penunjang->editAttributes() ?> aria-describedby="x_id_penunjang_help">
<?= $Page->id_penunjang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_penunjang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
    <div id="r_id_pembiayaan" class="form-group row">
        <label id="elh_PASIEN_VISITATION_id_pembiayaan" for="x_id_pembiayaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_pembiayaan->caption() ?><?= $Page->id_pembiayaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pembiayaan->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_id_pembiayaan">
<input type="<?= $Page->id_pembiayaan->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" name="x_id_pembiayaan" id="x_id_pembiayaan" size="30" placeholder="<?= HtmlEncode($Page->id_pembiayaan->getPlaceHolder()) ?>" value="<?= $Page->id_pembiayaan->EditValue ?>"<?= $Page->id_pembiayaan->editAttributes() ?> aria-describedby="x_id_pembiayaan_help">
<?= $Page->id_pembiayaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_pembiayaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
    <div id="r_id_procedure" class="form-group row">
        <label id="elh_PASIEN_VISITATION_id_procedure" for="x_id_procedure" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_procedure->caption() ?><?= $Page->id_procedure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_procedure->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_id_procedure">
<input type="<?= $Page->id_procedure->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_procedure" name="x_id_procedure" id="x_id_procedure" size="30" placeholder="<?= HtmlEncode($Page->id_procedure->getPlaceHolder()) ?>" value="<?= $Page->id_procedure->EditValue ?>"<?= $Page->id_procedure->editAttributes() ?> aria-describedby="x_id_procedure_help">
<?= $Page->id_procedure->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_procedure->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
    <div id="r_id_aspel" class="form-group row">
        <label id="elh_PASIEN_VISITATION_id_aspel" for="x_id_aspel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_aspel->caption() ?><?= $Page->id_aspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_aspel->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_id_aspel">
<input type="<?= $Page->id_aspel->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_aspel" name="x_id_aspel" id="x_id_aspel" size="30" placeholder="<?= HtmlEncode($Page->id_aspel->getPlaceHolder()) ?>" value="<?= $Page->id_aspel->EditValue ?>"<?= $Page->id_aspel->editAttributes() ?> aria-describedby="x_id_aspel_help">
<?= $Page->id_aspel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_aspel->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
    <div id="r_id_kelas" class="form-group row">
        <label id="elh_PASIEN_VISITATION_id_kelas" for="x_id_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_kelas->caption() ?><?= $Page->id_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_kelas->cellAttributes() ?>>
<span id="el_PASIEN_VISITATION_id_kelas">
<input type="<?= $Page->id_kelas->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_kelas" name="x_id_kelas" id="x_id_kelas" size="30" placeholder="<?= HtmlEncode($Page->id_kelas->getPlaceHolder()) ?>" value="<?= $Page->id_kelas->EditValue ?>"<?= $Page->id_kelas->editAttributes() ?> aria-describedby="x_id_kelas_help">
<?= $Page->id_kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_kelas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<span id="el_PASIEN_VISITATION_VISIT_ID">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_VISIT_ID" data-hidden="1" name="x_VISIT_ID" id="x_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->CurrentValue) ?>">
</span>
<span id="el_PASIEN_VISITATION_RUJUKAN_ID">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_RUJUKAN_ID" data-hidden="1" name="x_RUJUKAN_ID" id="x_RUJUKAN_ID" value="<?= HtmlEncode($Page->RUJUKAN_ID->CurrentValue) ?>">
</span>
    <input type="hidden" data-table="PASIEN_VISITATION" data-field="x_IDXDAFTAR" data-hidden="1" name="x_IDXDAFTAR" id="x_IDXDAFTAR" value="<?= HtmlEncode($Page->IDXDAFTAR->CurrentValue) ?>">
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
    ew.addEventHandlers("PASIEN_VISITATION");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    	function Buka(link = "") {
    		window.open(link, 'newwindow', 'width=800,height=400');
    		return false;
    	};
    	var visit = "../bridging/jasper.php?tipe=ANTRIAN_POLI&id=" + document.getElementById("x_VISIT_ID").value;
    	console.log(visit);

    //var url = "<a href='#' onclick="Buka('visit')" class='btn btn-info btn-sm' role='button'>Cetak</a>";
     $("#el_PASIEN_VISITATION_TICKET_NO").append('<a href="#" id="url" class="btn btn-info btn-sm" role="button">Cetak</a>')document.getElementById("url").onclick = function() {Buka(visit)};
});
</script>
