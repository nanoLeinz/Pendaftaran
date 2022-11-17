<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienDiagnosaEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPASIEN_DIAGNOSAedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fPASIEN_DIAGNOSAedit = currentForm = new ew.Form("fPASIEN_DIAGNOSAedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PASIEN_DIAGNOSA")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PASIEN_DIAGNOSA)
        ew.vars.tables.PASIEN_DIAGNOSA = currentTable;
    fPASIEN_DIAGNOSAedit.addFields([
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["THENAME", [fields.THENAME.visible && fields.THENAME.required ? ew.Validators.required(fields.THENAME.caption) : null], fields.THENAME.isInvalid],
        ["CLINIC_ID", [fields.CLINIC_ID.visible && fields.CLINIC_ID.required ? ew.Validators.required(fields.CLINIC_ID.caption) : null], fields.CLINIC_ID.isInvalid],
        ["KELUAR_ID", [fields.KELUAR_ID.visible && fields.KELUAR_ID.required ? ew.Validators.required(fields.KELUAR_ID.caption) : null], fields.KELUAR_ID.isInvalid],
        ["DATE_OF_DIAGNOSA", [fields.DATE_OF_DIAGNOSA.visible && fields.DATE_OF_DIAGNOSA.required ? ew.Validators.required(fields.DATE_OF_DIAGNOSA.caption) : null, ew.Validators.datetime(11)], fields.DATE_OF_DIAGNOSA.isInvalid],
        ["DIAGNOSA_ID", [fields.DIAGNOSA_ID.visible && fields.DIAGNOSA_ID.required ? ew.Validators.required(fields.DIAGNOSA_ID.caption) : null], fields.DIAGNOSA_ID.isInvalid],
        ["ANAMNASE", [fields.ANAMNASE.visible && fields.ANAMNASE.required ? ew.Validators.required(fields.ANAMNASE.caption) : null], fields.ANAMNASE.isInvalid],
        ["PEMERIKSAAN", [fields.PEMERIKSAAN.visible && fields.PEMERIKSAAN.required ? ew.Validators.required(fields.PEMERIKSAAN.caption) : null], fields.PEMERIKSAAN.isInvalid],
        ["TERAPHY_DESC", [fields.TERAPHY_DESC.visible && fields.TERAPHY_DESC.required ? ew.Validators.required(fields.TERAPHY_DESC.caption) : null], fields.TERAPHY_DESC.isInvalid],
        ["INSTRUCTION", [fields.INSTRUCTION.visible && fields.INSTRUCTION.required ? ew.Validators.required(fields.INSTRUCTION.caption) : null], fields.INSTRUCTION.isInvalid],
        ["SUFFER_TYPE", [fields.SUFFER_TYPE.visible && fields.SUFFER_TYPE.required ? ew.Validators.required(fields.SUFFER_TYPE.caption) : null], fields.SUFFER_TYPE.isInvalid],
        ["EMPLOYEE_ID", [fields.EMPLOYEE_ID.visible && fields.EMPLOYEE_ID.required ? ew.Validators.required(fields.EMPLOYEE_ID.caption) : null], fields.EMPLOYEE_ID.isInvalid],
        ["MORFOLOGI_NEOPLASMA", [fields.MORFOLOGI_NEOPLASMA.visible && fields.MORFOLOGI_NEOPLASMA.required ? ew.Validators.required(fields.MORFOLOGI_NEOPLASMA.caption) : null], fields.MORFOLOGI_NEOPLASMA.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid],
        ["KOMPLIKASI", [fields.KOMPLIKASI.visible && fields.KOMPLIKASI.required ? ew.Validators.required(fields.KOMPLIKASI.caption) : null], fields.KOMPLIKASI.isInvalid],
        ["DIAGNOSA_ID_02", [fields.DIAGNOSA_ID_02.visible && fields.DIAGNOSA_ID_02.required ? ew.Validators.required(fields.DIAGNOSA_ID_02.caption) : null], fields.DIAGNOSA_ID_02.isInvalid],
        ["DIAGNOSA_ID_03", [fields.DIAGNOSA_ID_03.visible && fields.DIAGNOSA_ID_03.required ? ew.Validators.required(fields.DIAGNOSA_ID_03.caption) : null], fields.DIAGNOSA_ID_03.isInvalid],
        ["DIAGNOSA_ID_04", [fields.DIAGNOSA_ID_04.visible && fields.DIAGNOSA_ID_04.required ? ew.Validators.required(fields.DIAGNOSA_ID_04.caption) : null], fields.DIAGNOSA_ID_04.isInvalid],
        ["DIAGNOSA_ID_05", [fields.DIAGNOSA_ID_05.visible && fields.DIAGNOSA_ID_05.required ? ew.Validators.required(fields.DIAGNOSA_ID_05.caption) : null], fields.DIAGNOSA_ID_05.isInvalid],
        ["DIAGNOSA_ID_06", [fields.DIAGNOSA_ID_06.visible && fields.DIAGNOSA_ID_06.required ? ew.Validators.required(fields.DIAGNOSA_ID_06.caption) : null], fields.DIAGNOSA_ID_06.isInvalid],
        ["DIAGNOSA_ID_09", [fields.DIAGNOSA_ID_09.visible && fields.DIAGNOSA_ID_09.required ? ew.Validators.required(fields.DIAGNOSA_ID_09.caption) : null], fields.DIAGNOSA_ID_09.isInvalid],
        ["DIAGNOSA_ID_10", [fields.DIAGNOSA_ID_10.visible && fields.DIAGNOSA_ID_10.required ? ew.Validators.required(fields.DIAGNOSA_ID_10.caption) : null], fields.DIAGNOSA_ID_10.isInvalid],
        ["PROCEDURE_03", [fields.PROCEDURE_03.visible && fields.PROCEDURE_03.required ? ew.Validators.required(fields.PROCEDURE_03.caption) : null], fields.PROCEDURE_03.isInvalid],
        ["PROCEDURE_05", [fields.PROCEDURE_05.visible && fields.PROCEDURE_05.required ? ew.Validators.required(fields.PROCEDURE_05.caption) : null], fields.PROCEDURE_05.isInvalid],
        ["PROCEDURE_06", [fields.PROCEDURE_06.visible && fields.PROCEDURE_06.required ? ew.Validators.required(fields.PROCEDURE_06.caption) : null], fields.PROCEDURE_06.isInvalid],
        ["DIAGNOSA_ID2", [fields.DIAGNOSA_ID2.visible && fields.DIAGNOSA_ID2.required ? ew.Validators.required(fields.DIAGNOSA_ID2.caption) : null], fields.DIAGNOSA_ID2.isInvalid],
        ["WEIGHT", [fields.WEIGHT.visible && fields.WEIGHT.required ? ew.Validators.required(fields.WEIGHT.caption) : null, ew.Validators.float], fields.WEIGHT.isInvalid],
        ["TGLKONTROL", [fields.TGLKONTROL.visible && fields.TGLKONTROL.required ? ew.Validators.required(fields.TGLKONTROL.caption) : null, ew.Validators.datetime(0)], fields.TGLKONTROL.isInvalid],
        ["PEMERIKSAAN_02", [fields.PEMERIKSAAN_02.visible && fields.PEMERIKSAAN_02.required ? ew.Validators.required(fields.PEMERIKSAAN_02.caption) : null], fields.PEMERIKSAAN_02.isInvalid],
        ["height", [fields.height.visible && fields.height.required ? ew.Validators.required(fields.height.caption) : null], fields.height.isInvalid],
        ["TEMPERATURE", [fields.TEMPERATURE.visible && fields.TEMPERATURE.required ? ew.Validators.required(fields.TEMPERATURE.caption) : null, ew.Validators.float], fields.TEMPERATURE.isInvalid],
        ["TENSION_UPPER", [fields.TENSION_UPPER.visible && fields.TENSION_UPPER.required ? ew.Validators.required(fields.TENSION_UPPER.caption) : null, ew.Validators.float], fields.TENSION_UPPER.isInvalid],
        ["NADI", [fields.NADI.visible && fields.NADI.required ? ew.Validators.required(fields.NADI.caption) : null, ew.Validators.float], fields.NADI.isInvalid],
        ["NAFAS", [fields.NAFAS.visible && fields.NAFAS.required ? ew.Validators.required(fields.NAFAS.caption) : null, ew.Validators.float], fields.NAFAS.isInvalid],
        ["IDXDAFTAR", [fields.IDXDAFTAR.visible && fields.IDXDAFTAR.required ? ew.Validators.required(fields.IDXDAFTAR.caption) : null, ew.Validators.integer], fields.IDXDAFTAR.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fPASIEN_DIAGNOSAedit,
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
    fPASIEN_DIAGNOSAedit.validate = function () {
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
    fPASIEN_DIAGNOSAedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPASIEN_DIAGNOSAedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Multi-Page
    fPASIEN_DIAGNOSAedit.multiPage = new ew.MultiPage("fPASIEN_DIAGNOSAedit");

    // Dynamic selection lists
    fPASIEN_DIAGNOSAedit.lists.KELUAR_ID = <?= $Page->KELUAR_ID->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.DIAGNOSA_ID = <?= $Page->DIAGNOSA_ID->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.SUFFER_TYPE = <?= $Page->SUFFER_TYPE->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.EMPLOYEE_ID = <?= $Page->EMPLOYEE_ID->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.DESCRIPTION = <?= $Page->DESCRIPTION->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.DIAGNOSA_ID_02 = <?= $Page->DIAGNOSA_ID_02->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.DIAGNOSA_ID_03 = <?= $Page->DIAGNOSA_ID_03->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.DIAGNOSA_ID_04 = <?= $Page->DIAGNOSA_ID_04->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.DIAGNOSA_ID_05 = <?= $Page->DIAGNOSA_ID_05->toClientList($Page) ?>;
    fPASIEN_DIAGNOSAedit.lists.DIAGNOSA_ID_06 = <?= $Page->DIAGNOSA_ID_06->toClientList($Page) ?>;
    loadjs.done("fPASIEN_DIAGNOSAedit");
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
<form name="fPASIEN_DIAGNOSAedit" id="fPASIEN_DIAGNOSAedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN_DIAGNOSA">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "V_RIWAYAT_RM") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_RIWAYAT_RM">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="Page"><!-- multi-page tabs -->
    <ul class="<?= $Page->MultiPages->navStyle() ?>">
        <li class="nav-item"><a class="nav-link<?= $Page->MultiPages->pageStyle(1) ?>" href="#tab_PASIEN_DIAGNOSA1" data-toggle="tab"><?= $Page->pageCaption(1) ?></a></li>
        <li class="nav-item"><a class="nav-link<?= $Page->MultiPages->pageStyle(2) ?>" href="#tab_PASIEN_DIAGNOSA2" data-toggle="tab"><?= $Page->pageCaption(2) ?></a></li>
        <li class="nav-item"><a class="nav-link<?= $Page->MultiPages->pageStyle(3) ?>" href="#tab_PASIEN_DIAGNOSA3" data-toggle="tab"><?= $Page->pageCaption(3) ?></a></li>
        <li class="nav-item"><a class="nav-link<?= $Page->MultiPages->pageStyle(4) ?>" href="#tab_PASIEN_DIAGNOSA4" data-toggle="tab"><?= $Page->pageCaption(4) ?></a></li>
    </ul>
    <div class="tab-content"><!-- multi-page tabs .tab-content -->
        <div class="tab-pane<?= $Page->MultiPages->pageStyle(1) ?>" id="tab_PASIEN_DIAGNOSA1"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_NO_REGISTRATION" for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION->caption() ?><?= $Page->NO_REGISTRATION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NO_REGISTRATION->getDisplayValue($Page->NO_REGISTRATION->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_NO_REGISTRATION" data-hidden="1" data-page="1" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" value="<?= HtmlEncode($Page->NO_REGISTRATION->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->THENAME->Visible) { // THENAME ?>
    <div id="r_THENAME" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_THENAME" for="x_THENAME" class="<?= $Page->LeftColumnClass ?>"><?= $Page->THENAME->caption() ?><?= $Page->THENAME->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->THENAME->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_THENAME">
<input type="<?= $Page->THENAME->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_THENAME" data-page="1" name="x_THENAME" id="x_THENAME" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->THENAME->getPlaceHolder()) ?>" value="<?= $Page->THENAME->EditValue ?>"<?= $Page->THENAME->editAttributes() ?> aria-describedby="x_THENAME_help">
<?= $Page->THENAME->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->THENAME->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <div id="r_CLINIC_ID" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_CLINIC_ID" for="x_CLINIC_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLINIC_ID->caption() ?><?= $Page->CLINIC_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->CLINIC_ID->getDisplayValue($Page->CLINIC_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_CLINIC_ID" data-hidden="1" data-page="1" name="x_CLINIC_ID" id="x_CLINIC_ID" value="<?= HtmlEncode($Page->CLINIC_ID->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { // KELUAR_ID ?>
    <div id="r_KELUAR_ID" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_KELUAR_ID" for="x_KELUAR_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KELUAR_ID->caption() ?><?= $Page->KELUAR_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KELUAR_ID->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_KELUAR_ID">
    <select
        id="x_KELUAR_ID"
        name="x_KELUAR_ID"
        class="form-control ew-select<?= $Page->KELUAR_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_DIAGNOSA_x_KELUAR_ID"
        data-table="PASIEN_DIAGNOSA"
        data-field="x_KELUAR_ID"
        data-page="1"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_DIAGNOSA_x_KELUAR_ID']"),
        options = { name: "x_KELUAR_ID", selectId: "PASIEN_DIAGNOSA_x_KELUAR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_DIAGNOSA.fields.KELUAR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
    <div id="r_DATE_OF_DIAGNOSA" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" for="x_DATE_OF_DIAGNOSA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DATE_OF_DIAGNOSA->caption() ?><?= $Page->DATE_OF_DIAGNOSA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DATE_OF_DIAGNOSA->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA">
<input type="<?= $Page->DATE_OF_DIAGNOSA->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-page="1" data-format="11" name="x_DATE_OF_DIAGNOSA" id="x_DATE_OF_DIAGNOSA" placeholder="<?= HtmlEncode($Page->DATE_OF_DIAGNOSA->getPlaceHolder()) ?>" value="<?= $Page->DATE_OF_DIAGNOSA->EditValue ?>"<?= $Page->DATE_OF_DIAGNOSA->editAttributes() ?> aria-describedby="x_DATE_OF_DIAGNOSA_help">
<?= $Page->DATE_OF_DIAGNOSA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DATE_OF_DIAGNOSA->getErrorMessage() ?></div>
<?php if (!$Page->DATE_OF_DIAGNOSA->ReadOnly && !$Page->DATE_OF_DIAGNOSA->Disabled && !isset($Page->DATE_OF_DIAGNOSA->EditAttrs["readonly"]) && !isset($Page->DATE_OF_DIAGNOSA->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_DIAGNOSAedit", "x_DATE_OF_DIAGNOSA", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <div id="r_DIAGNOSA_ID" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID" for="x_DIAGNOSA_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID->caption() ?><?= $Page->DIAGNOSA_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID">
<div class="input-group ew-lookup-list" aria-describedby="x_DIAGNOSA_ID_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID"><?= EmptyValue(strval($Page->DIAGNOSA_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID->ReadOnly || $Page->DIAGNOSA_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID->getErrorMessage() ?></div>
<?= $Page->DIAGNOSA_ID->getCustomMessage() ?>
<?= $Page->DIAGNOSA_ID->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-page="1" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID" id="x_DIAGNOSA_ID" value="<?= $Page->DIAGNOSA_ID->CurrentValue ?>"<?= $Page->DIAGNOSA_ID->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ANAMNASE->Visible) { // ANAMNASE ?>
    <div id="r_ANAMNASE" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_ANAMNASE" for="x_ANAMNASE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ANAMNASE->caption() ?><?= $Page->ANAMNASE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ANAMNASE->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_ANAMNASE">
<textarea data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" data-page="1" name="x_ANAMNASE" id="x_ANAMNASE" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ANAMNASE->getPlaceHolder()) ?>"<?= $Page->ANAMNASE->editAttributes() ?> aria-describedby="x_ANAMNASE_help"><?= $Page->ANAMNASE->EditValue ?></textarea>
<?= $Page->ANAMNASE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ANAMNASE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
    <div id="r_PEMERIKSAAN" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_PEMERIKSAAN" for="x_PEMERIKSAAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PEMERIKSAAN->caption() ?><?= $Page->PEMERIKSAAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PEMERIKSAAN->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PEMERIKSAAN">
<input type="<?= $Page->PEMERIKSAAN->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" data-page="1" name="x_PEMERIKSAAN" id="x_PEMERIKSAAN" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->PEMERIKSAAN->getPlaceHolder()) ?>" value="<?= $Page->PEMERIKSAAN->EditValue ?>"<?= $Page->PEMERIKSAAN->editAttributes() ?> aria-describedby="x_PEMERIKSAAN_help">
<?= $Page->PEMERIKSAAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PEMERIKSAAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
    <div id="r_TERAPHY_DESC" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_TERAPHY_DESC" for="x_TERAPHY_DESC" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TERAPHY_DESC->caption() ?><?= $Page->TERAPHY_DESC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TERAPHY_DESC->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_TERAPHY_DESC">
<input type="<?= $Page->TERAPHY_DESC->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" data-page="1" name="x_TERAPHY_DESC" id="x_TERAPHY_DESC" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->TERAPHY_DESC->getPlaceHolder()) ?>" value="<?= $Page->TERAPHY_DESC->EditValue ?>"<?= $Page->TERAPHY_DESC->editAttributes() ?> aria-describedby="x_TERAPHY_DESC_help">
<?= $Page->TERAPHY_DESC->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TERAPHY_DESC->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->INSTRUCTION->Visible) { // INSTRUCTION ?>
    <div id="r_INSTRUCTION" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_INSTRUCTION" for="x_INSTRUCTION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->INSTRUCTION->caption() ?><?= $Page->INSTRUCTION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->INSTRUCTION->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_INSTRUCTION">
<input type="<?= $Page->INSTRUCTION->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_INSTRUCTION" data-page="1" name="x_INSTRUCTION" id="x_INSTRUCTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->INSTRUCTION->getPlaceHolder()) ?>" value="<?= $Page->INSTRUCTION->EditValue ?>"<?= $Page->INSTRUCTION->editAttributes() ?> aria-describedby="x_INSTRUCTION_help">
<?= $Page->INSTRUCTION->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->INSTRUCTION->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SUFFER_TYPE->Visible) { // SUFFER_TYPE ?>
    <div id="r_SUFFER_TYPE" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_SUFFER_TYPE" for="x_SUFFER_TYPE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SUFFER_TYPE->caption() ?><?= $Page->SUFFER_TYPE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SUFFER_TYPE->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_SUFFER_TYPE">
    <select
        id="x_SUFFER_TYPE"
        name="x_SUFFER_TYPE"
        class="form-control ew-select<?= $Page->SUFFER_TYPE->isInvalidClass() ?>"
        data-select2-id="PASIEN_DIAGNOSA_x_SUFFER_TYPE"
        data-table="PASIEN_DIAGNOSA"
        data-field="x_SUFFER_TYPE"
        data-page="1"
        data-value-separator="<?= $Page->SUFFER_TYPE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SUFFER_TYPE->getPlaceHolder()) ?>"
        <?= $Page->SUFFER_TYPE->editAttributes() ?>>
        <?= $Page->SUFFER_TYPE->selectOptionListHtml("x_SUFFER_TYPE") ?>
    </select>
    <?= $Page->SUFFER_TYPE->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SUFFER_TYPE->getErrorMessage() ?></div>
<?= $Page->SUFFER_TYPE->Lookup->getParamTag($Page, "p_x_SUFFER_TYPE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_DIAGNOSA_x_SUFFER_TYPE']"),
        options = { name: "x_SUFFER_TYPE", selectId: "PASIEN_DIAGNOSA_x_SUFFER_TYPE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_DIAGNOSA.fields.SUFFER_TYPE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <div id="r_EMPLOYEE_ID" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_EMPLOYEE_ID" for="x_EMPLOYEE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EMPLOYEE_ID->caption() ?><?= $Page->EMPLOYEE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_EMPLOYEE_ID">
    <select
        id="x_EMPLOYEE_ID"
        name="x_EMPLOYEE_ID"
        class="form-control ew-select<?= $Page->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_DIAGNOSA_x_EMPLOYEE_ID"
        data-table="PASIEN_DIAGNOSA"
        data-field="x_EMPLOYEE_ID"
        data-page="1"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_DIAGNOSA_x_EMPLOYEE_ID']"),
        options = { name: "x_EMPLOYEE_ID", selectId: "PASIEN_DIAGNOSA_x_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_DIAGNOSA.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MORFOLOGI_NEOPLASMA->Visible) { // MORFOLOGI_NEOPLASMA ?>
    <div id="r_MORFOLOGI_NEOPLASMA" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_MORFOLOGI_NEOPLASMA" for="x_MORFOLOGI_NEOPLASMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MORFOLOGI_NEOPLASMA->caption() ?><?= $Page->MORFOLOGI_NEOPLASMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MORFOLOGI_NEOPLASMA->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_MORFOLOGI_NEOPLASMA">
<input type="<?= $Page->MORFOLOGI_NEOPLASMA->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_MORFOLOGI_NEOPLASMA" data-page="1" name="x_MORFOLOGI_NEOPLASMA" id="x_MORFOLOGI_NEOPLASMA" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->MORFOLOGI_NEOPLASMA->getPlaceHolder()) ?>" value="<?= $Page->MORFOLOGI_NEOPLASMA->EditValue ?>"<?= $Page->MORFOLOGI_NEOPLASMA->editAttributes() ?> aria-describedby="x_MORFOLOGI_NEOPLASMA_help">
<?= $Page->MORFOLOGI_NEOPLASMA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MORFOLOGI_NEOPLASMA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <div id="r_DESCRIPTION" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DESCRIPTION" for="x_DESCRIPTION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DESCRIPTION->caption() ?><?= $Page->DESCRIPTION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DESCRIPTION">
<div class="input-group ew-lookup-list" aria-describedby="x_DESCRIPTION_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DESCRIPTION"><?= EmptyValue(strval($Page->DESCRIPTION->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DESCRIPTION->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DESCRIPTION->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DESCRIPTION->ReadOnly || $Page->DESCRIPTION->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DESCRIPTION',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DESCRIPTION->getErrorMessage() ?></div>
<?= $Page->DESCRIPTION->getCustomMessage() ?>
<?= $Page->DESCRIPTION->Lookup->getParamTag($Page, "p_x_DESCRIPTION") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DESCRIPTION" data-page="1" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DESCRIPTION->displayValueSeparatorAttribute() ?>" name="x_DESCRIPTION" id="x_DESCRIPTION" value="<?= $Page->DESCRIPTION->CurrentValue ?>"<?= $Page->DESCRIPTION->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KOMPLIKASI->Visible) { // KOMPLIKASI ?>
    <div id="r_KOMPLIKASI" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_KOMPLIKASI" for="x_KOMPLIKASI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KOMPLIKASI->caption() ?><?= $Page->KOMPLIKASI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KOMPLIKASI->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_KOMPLIKASI">
<input type="<?= $Page->KOMPLIKASI->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_KOMPLIKASI" data-page="1" name="x_KOMPLIKASI" id="x_KOMPLIKASI" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->KOMPLIKASI->getPlaceHolder()) ?>" value="<?= $Page->KOMPLIKASI->EditValue ?>"<?= $Page->KOMPLIKASI->editAttributes() ?> aria-describedby="x_KOMPLIKASI_help">
<?= $Page->KOMPLIKASI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KOMPLIKASI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_09->Visible) { // DIAGNOSA_ID_09 ?>
    <div id="r_DIAGNOSA_ID_09" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_09" for="x_DIAGNOSA_ID_09" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID_09->caption() ?><?= $Page->DIAGNOSA_ID_09->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID_09->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_09">
<input type="<?= $Page->DIAGNOSA_ID_09->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID_09" data-page="1" name="x_DIAGNOSA_ID_09" id="x_DIAGNOSA_ID_09" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->DIAGNOSA_ID_09->getPlaceHolder()) ?>" value="<?= $Page->DIAGNOSA_ID_09->EditValue ?>"<?= $Page->DIAGNOSA_ID_09->editAttributes() ?> aria-describedby="x_DIAGNOSA_ID_09_help">
<?= $Page->DIAGNOSA_ID_09->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID_09->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_10->Visible) { // DIAGNOSA_ID_10 ?>
    <div id="r_DIAGNOSA_ID_10" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_10" for="x_DIAGNOSA_ID_10" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID_10->caption() ?><?= $Page->DIAGNOSA_ID_10->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID_10->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_10">
<input type="<?= $Page->DIAGNOSA_ID_10->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID_10" data-page="1" name="x_DIAGNOSA_ID_10" id="x_DIAGNOSA_ID_10" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->DIAGNOSA_ID_10->getPlaceHolder()) ?>" value="<?= $Page->DIAGNOSA_ID_10->EditValue ?>"<?= $Page->DIAGNOSA_ID_10->editAttributes() ?> aria-describedby="x_DIAGNOSA_ID_10_help">
<?= $Page->DIAGNOSA_ID_10->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID_10->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID2->Visible) { // DIAGNOSA_ID2 ?>
    <div id="r_DIAGNOSA_ID2" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID2" for="x_DIAGNOSA_ID2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID2->caption() ?><?= $Page->DIAGNOSA_ID2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID2->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID2">
<input type="<?= $Page->DIAGNOSA_ID2->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID2" data-page="1" name="x_DIAGNOSA_ID2" id="x_DIAGNOSA_ID2" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DIAGNOSA_ID2->getPlaceHolder()) ?>" value="<?= $Page->DIAGNOSA_ID2->EditValue ?>"<?= $Page->DIAGNOSA_ID2->editAttributes() ?> aria-describedby="x_DIAGNOSA_ID2_help">
<?= $Page->DIAGNOSA_ID2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TGLKONTROL->Visible) { // TGLKONTROL ?>
    <div id="r_TGLKONTROL" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_TGLKONTROL" for="x_TGLKONTROL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TGLKONTROL->caption() ?><?= $Page->TGLKONTROL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TGLKONTROL->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_TGLKONTROL">
<input type="<?= $Page->TGLKONTROL->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" data-page="1" name="x_TGLKONTROL" id="x_TGLKONTROL" placeholder="<?= HtmlEncode($Page->TGLKONTROL->getPlaceHolder()) ?>" value="<?= $Page->TGLKONTROL->EditValue ?>"<?= $Page->TGLKONTROL->editAttributes() ?> aria-describedby="x_TGLKONTROL_help">
<?= $Page->TGLKONTROL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TGLKONTROL->getErrorMessage() ?></div>
<?php if (!$Page->TGLKONTROL->ReadOnly && !$Page->TGLKONTROL->Disabled && !isset($Page->TGLKONTROL->EditAttrs["readonly"]) && !isset($Page->TGLKONTROL->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_DIAGNOSAedit", "x_TGLKONTROL", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PEMERIKSAAN_02->Visible) { // PEMERIKSAAN_02 ?>
    <div id="r_PEMERIKSAAN_02" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_PEMERIKSAAN_02" for="x_PEMERIKSAAN_02" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PEMERIKSAAN_02->caption() ?><?= $Page->PEMERIKSAAN_02->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PEMERIKSAAN_02->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PEMERIKSAAN_02">
<input type="<?= $Page->PEMERIKSAAN_02->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN_02" data-page="1" name="x_PEMERIKSAAN_02" id="x_PEMERIKSAAN_02" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->PEMERIKSAAN_02->getPlaceHolder()) ?>" value="<?= $Page->PEMERIKSAAN_02->EditValue ?>"<?= $Page->PEMERIKSAAN_02->editAttributes() ?> aria-describedby="x_PEMERIKSAAN_02_help">
<?= $Page->PEMERIKSAAN_02->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PEMERIKSAAN_02->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
    <div id="r_IDXDAFTAR" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_IDXDAFTAR" for="x_IDXDAFTAR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->IDXDAFTAR->caption() ?><?= $Page->IDXDAFTAR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->IDXDAFTAR->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_IDXDAFTAR">
<input type="<?= $Page->IDXDAFTAR->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" data-page="1" name="x_IDXDAFTAR" id="x_IDXDAFTAR" size="30" placeholder="<?= HtmlEncode($Page->IDXDAFTAR->getPlaceHolder()) ?>" value="<?= $Page->IDXDAFTAR->EditValue ?>"<?= $Page->IDXDAFTAR->editAttributes() ?> aria-describedby="x_IDXDAFTAR_help">
<?= $Page->IDXDAFTAR->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->IDXDAFTAR->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
        </div><!-- /multi-page .tab-pane -->
        <div class="tab-pane<?= $Page->MultiPages->pageStyle(2) ?>" id="tab_PASIEN_DIAGNOSA2"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->WEIGHT->Visible) { // WEIGHT ?>
    <div id="r_WEIGHT" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_WEIGHT" for="x_WEIGHT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->WEIGHT->caption() ?><?= $Page->WEIGHT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->WEIGHT->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_WEIGHT">
<input type="<?= $Page->WEIGHT->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_WEIGHT" data-page="2" name="x_WEIGHT" id="x_WEIGHT" size="30" placeholder="<?= HtmlEncode($Page->WEIGHT->getPlaceHolder()) ?>" value="<?= $Page->WEIGHT->EditValue ?>"<?= $Page->WEIGHT->editAttributes() ?> aria-describedby="x_WEIGHT_help">
<?= $Page->WEIGHT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->WEIGHT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
    <div id="r_height" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_height" for="x_height" class="<?= $Page->LeftColumnClass ?>"><?= $Page->height->caption() ?><?= $Page->height->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->height->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_height">
<input type="<?= $Page->height->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_height" data-page="2" name="x_height" id="x_height" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->height->getPlaceHolder()) ?>" value="<?= $Page->height->EditValue ?>"<?= $Page->height->editAttributes() ?> aria-describedby="x_height_help">
<?= $Page->height->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->height->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TEMPERATURE->Visible) { // TEMPERATURE ?>
    <div id="r_TEMPERATURE" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_TEMPERATURE" for="x_TEMPERATURE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TEMPERATURE->caption() ?><?= $Page->TEMPERATURE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TEMPERATURE->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_TEMPERATURE">
<input type="<?= $Page->TEMPERATURE->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TEMPERATURE" data-page="2" name="x_TEMPERATURE" id="x_TEMPERATURE" size="30" placeholder="<?= HtmlEncode($Page->TEMPERATURE->getPlaceHolder()) ?>" value="<?= $Page->TEMPERATURE->EditValue ?>"<?= $Page->TEMPERATURE->editAttributes() ?> aria-describedby="x_TEMPERATURE_help">
<?= $Page->TEMPERATURE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TEMPERATURE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TENSION_UPPER->Visible) { // TENSION_UPPER ?>
    <div id="r_TENSION_UPPER" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_TENSION_UPPER" for="x_TENSION_UPPER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TENSION_UPPER->caption() ?><?= $Page->TENSION_UPPER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TENSION_UPPER->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_TENSION_UPPER">
<input type="<?= $Page->TENSION_UPPER->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TENSION_UPPER" data-page="2" name="x_TENSION_UPPER" id="x_TENSION_UPPER" size="30" placeholder="<?= HtmlEncode($Page->TENSION_UPPER->getPlaceHolder()) ?>" value="<?= $Page->TENSION_UPPER->EditValue ?>"<?= $Page->TENSION_UPPER->editAttributes() ?> aria-describedby="x_TENSION_UPPER_help">
<?= $Page->TENSION_UPPER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TENSION_UPPER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NADI->Visible) { // NADI ?>
    <div id="r_NADI" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_NADI" for="x_NADI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NADI->caption() ?><?= $Page->NADI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NADI->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_NADI">
<input type="<?= $Page->NADI->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_NADI" data-page="2" name="x_NADI" id="x_NADI" size="30" placeholder="<?= HtmlEncode($Page->NADI->getPlaceHolder()) ?>" value="<?= $Page->NADI->EditValue ?>"<?= $Page->NADI->editAttributes() ?> aria-describedby="x_NADI_help">
<?= $Page->NADI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NADI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAFAS->Visible) { // NAFAS ?>
    <div id="r_NAFAS" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_NAFAS" for="x_NAFAS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAFAS->caption() ?><?= $Page->NAFAS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAFAS->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_NAFAS">
<input type="<?= $Page->NAFAS->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_NAFAS" data-page="2" name="x_NAFAS" id="x_NAFAS" size="30" placeholder="<?= HtmlEncode($Page->NAFAS->getPlaceHolder()) ?>" value="<?= $Page->NAFAS->EditValue ?>"<?= $Page->NAFAS->editAttributes() ?> aria-describedby="x_NAFAS_help">
<?= $Page->NAFAS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAFAS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
        </div><!-- /multi-page .tab-pane -->
        <div class="tab-pane<?= $Page->MultiPages->pageStyle(3) ?>" id="tab_PASIEN_DIAGNOSA3"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->PROCEDURE_03->Visible) { // PROCEDURE_03 ?>
    <div id="r_PROCEDURE_03" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_PROCEDURE_03" for="x_PROCEDURE_03" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROCEDURE_03->caption() ?><?= $Page->PROCEDURE_03->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROCEDURE_03->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PROCEDURE_03">
<input type="<?= $Page->PROCEDURE_03->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_PROCEDURE_03" data-page="3" name="x_PROCEDURE_03" id="x_PROCEDURE_03" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->PROCEDURE_03->getPlaceHolder()) ?>" value="<?= $Page->PROCEDURE_03->EditValue ?>"<?= $Page->PROCEDURE_03->editAttributes() ?> aria-describedby="x_PROCEDURE_03_help">
<?= $Page->PROCEDURE_03->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROCEDURE_03->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROCEDURE_05->Visible) { // PROCEDURE_05 ?>
    <div id="r_PROCEDURE_05" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_PROCEDURE_05" for="x_PROCEDURE_05" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROCEDURE_05->caption() ?><?= $Page->PROCEDURE_05->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROCEDURE_05->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PROCEDURE_05">
<input type="<?= $Page->PROCEDURE_05->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_PROCEDURE_05" data-page="3" name="x_PROCEDURE_05" id="x_PROCEDURE_05" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->PROCEDURE_05->getPlaceHolder()) ?>" value="<?= $Page->PROCEDURE_05->EditValue ?>"<?= $Page->PROCEDURE_05->editAttributes() ?> aria-describedby="x_PROCEDURE_05_help">
<?= $Page->PROCEDURE_05->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROCEDURE_05->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROCEDURE_06->Visible) { // PROCEDURE_06 ?>
    <div id="r_PROCEDURE_06" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_PROCEDURE_06" for="x_PROCEDURE_06" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROCEDURE_06->caption() ?><?= $Page->PROCEDURE_06->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROCEDURE_06->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PROCEDURE_06">
<input type="<?= $Page->PROCEDURE_06->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_PROCEDURE_06" data-page="3" name="x_PROCEDURE_06" id="x_PROCEDURE_06" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->PROCEDURE_06->getPlaceHolder()) ?>" value="<?= $Page->PROCEDURE_06->EditValue ?>"<?= $Page->PROCEDURE_06->editAttributes() ?> aria-describedby="x_PROCEDURE_06_help">
<?= $Page->PROCEDURE_06->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROCEDURE_06->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
        </div><!-- /multi-page .tab-pane -->
        <div class="tab-pane<?= $Page->MultiPages->pageStyle(4) ?>" id="tab_PASIEN_DIAGNOSA4"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->DIAGNOSA_ID_02->Visible) { // DIAGNOSA_ID_02 ?>
    <div id="r_DIAGNOSA_ID_02" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_02" for="x_DIAGNOSA_ID_02" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID_02->caption() ?><?= $Page->DIAGNOSA_ID_02->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID_02->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_02">
<div class="input-group ew-lookup-list" aria-describedby="x_DIAGNOSA_ID_02_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID_02"><?= EmptyValue(strval($Page->DIAGNOSA_ID_02->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID_02->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID_02->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID_02->ReadOnly || $Page->DIAGNOSA_ID_02->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID_02',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID_02->getErrorMessage() ?></div>
<?= $Page->DIAGNOSA_ID_02->getCustomMessage() ?>
<?= $Page->DIAGNOSA_ID_02->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID_02") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID_02" data-page="4" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID_02->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID_02" id="x_DIAGNOSA_ID_02" value="<?= $Page->DIAGNOSA_ID_02->CurrentValue ?>"<?= $Page->DIAGNOSA_ID_02->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_03->Visible) { // DIAGNOSA_ID_03 ?>
    <div id="r_DIAGNOSA_ID_03" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_03" for="x_DIAGNOSA_ID_03" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID_03->caption() ?><?= $Page->DIAGNOSA_ID_03->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID_03->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_03">
<div class="input-group ew-lookup-list" aria-describedby="x_DIAGNOSA_ID_03_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID_03"><?= EmptyValue(strval($Page->DIAGNOSA_ID_03->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID_03->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID_03->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID_03->ReadOnly || $Page->DIAGNOSA_ID_03->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID_03',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID_03->getErrorMessage() ?></div>
<?= $Page->DIAGNOSA_ID_03->getCustomMessage() ?>
<?= $Page->DIAGNOSA_ID_03->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID_03") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID_03" data-page="4" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID_03->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID_03" id="x_DIAGNOSA_ID_03" value="<?= $Page->DIAGNOSA_ID_03->CurrentValue ?>"<?= $Page->DIAGNOSA_ID_03->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_04->Visible) { // DIAGNOSA_ID_04 ?>
    <div id="r_DIAGNOSA_ID_04" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_04" for="x_DIAGNOSA_ID_04" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID_04->caption() ?><?= $Page->DIAGNOSA_ID_04->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID_04->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_04">
<div class="input-group ew-lookup-list" aria-describedby="x_DIAGNOSA_ID_04_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID_04"><?= EmptyValue(strval($Page->DIAGNOSA_ID_04->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID_04->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID_04->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID_04->ReadOnly || $Page->DIAGNOSA_ID_04->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID_04',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID_04->getErrorMessage() ?></div>
<?= $Page->DIAGNOSA_ID_04->getCustomMessage() ?>
<?= $Page->DIAGNOSA_ID_04->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID_04") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID_04" data-page="4" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID_04->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID_04" id="x_DIAGNOSA_ID_04" value="<?= $Page->DIAGNOSA_ID_04->CurrentValue ?>"<?= $Page->DIAGNOSA_ID_04->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_05->Visible) { // DIAGNOSA_ID_05 ?>
    <div id="r_DIAGNOSA_ID_05" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_05" for="x_DIAGNOSA_ID_05" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID_05->caption() ?><?= $Page->DIAGNOSA_ID_05->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID_05->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_05">
<div class="input-group ew-lookup-list" aria-describedby="x_DIAGNOSA_ID_05_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID_05"><?= EmptyValue(strval($Page->DIAGNOSA_ID_05->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID_05->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID_05->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID_05->ReadOnly || $Page->DIAGNOSA_ID_05->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID_05',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID_05->getErrorMessage() ?></div>
<?= $Page->DIAGNOSA_ID_05->getCustomMessage() ?>
<?= $Page->DIAGNOSA_ID_05->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID_05") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID_05" data-page="4" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID_05->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID_05" id="x_DIAGNOSA_ID_05" value="<?= $Page->DIAGNOSA_ID_05->CurrentValue ?>"<?= $Page->DIAGNOSA_ID_05->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_06->Visible) { // DIAGNOSA_ID_06 ?>
    <div id="r_DIAGNOSA_ID_06" class="form-group row">
        <label id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_06" for="x_DIAGNOSA_ID_06" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID_06->caption() ?><?= $Page->DIAGNOSA_ID_06->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID_06->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_06">
<div class="input-group ew-lookup-list" aria-describedby="x_DIAGNOSA_ID_06_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID_06"><?= EmptyValue(strval($Page->DIAGNOSA_ID_06->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID_06->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID_06->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID_06->ReadOnly || $Page->DIAGNOSA_ID_06->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID_06',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID_06->getErrorMessage() ?></div>
<?= $Page->DIAGNOSA_ID_06->getCustomMessage() ?>
<?= $Page->DIAGNOSA_ID_06->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID_06") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID_06" data-page="4" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID_06->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID_06" id="x_DIAGNOSA_ID_06" value="<?= $Page->DIAGNOSA_ID_06->CurrentValue ?>"<?= $Page->DIAGNOSA_ID_06->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
        </div><!-- /multi-page .tab-pane -->
    </div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
    <input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_ID" data-hidden="1" name="x_ID" id="x_ID" value="<?= HtmlEncode($Page->ID->CurrentValue) ?>">
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
    ew.addEventHandlers("PASIEN_DIAGNOSA");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
