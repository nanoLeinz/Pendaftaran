<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VRadiologiSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fV_RADIOLOGIsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fV_RADIOLOGIsearch = currentAdvancedSearchForm = new ew.Form("fV_RADIOLOGIsearch", "search");
    <?php } else { ?>
    fV_RADIOLOGIsearch = currentForm = new ew.Form("fV_RADIOLOGIsearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "V_RADIOLOGI")) ?>,
        fields = currentTable.fields;
    fV_RADIOLOGIsearch.addFields([
        ["ORG_UNIT_CODE", [], fields.ORG_UNIT_CODE.isInvalid],
        ["NO_REGISTRATION", [], fields.NO_REGISTRATION.isInvalid],
        ["VISIT_ID", [], fields.VISIT_ID.isInvalid],
        ["STATUS_PASIEN_ID", [], fields.STATUS_PASIEN_ID.isInvalid],
        ["RUJUKAN_ID", [], fields.RUJUKAN_ID.isInvalid],
        ["ADDRESS_OF_RUJUKAN", [], fields.ADDRESS_OF_RUJUKAN.isInvalid],
        ["REASON_ID", [], fields.REASON_ID.isInvalid],
        ["WAY_ID", [], fields.WAY_ID.isInvalid],
        ["PATIENT_CATEGORY_ID", [], fields.PATIENT_CATEGORY_ID.isInvalid],
        ["BOOKED_DATE", [ew.Validators.datetime(0)], fields.BOOKED_DATE.isInvalid],
        ["VISIT_DATE", [ew.Validators.datetime(0)], fields.VISIT_DATE.isInvalid],
        ["ISNEW", [], fields.ISNEW.isInvalid],
        ["FOLLOW_UP", [ew.Validators.integer], fields.FOLLOW_UP.isInvalid],
        ["PLACE_TYPE", [ew.Validators.integer], fields.PLACE_TYPE.isInvalid],
        ["CLINIC_ID", [], fields.CLINIC_ID.isInvalid],
        ["CLINIC_ID_FROM", [], fields.CLINIC_ID_FROM.isInvalid],
        ["CLASS_ROOM_ID", [], fields.CLASS_ROOM_ID.isInvalid],
        ["BED_ID", [ew.Validators.integer], fields.BED_ID.isInvalid],
        ["KELUAR_ID", [], fields.KELUAR_ID.isInvalid],
        ["IN_DATE", [ew.Validators.datetime(0)], fields.IN_DATE.isInvalid],
        ["EXIT_DATE", [ew.Validators.datetime(0)], fields.EXIT_DATE.isInvalid],
        ["DIANTAR_OLEH", [], fields.DIANTAR_OLEH.isInvalid],
        ["GENDER", [], fields.GENDER.isInvalid],
        ["DESCRIPTION", [], fields.DESCRIPTION.isInvalid],
        ["VISITOR_ADDRESS", [], fields.VISITOR_ADDRESS.isInvalid],
        ["MODIFIED_BY", [], fields.MODIFIED_BY.isInvalid],
        ["MODIFIED_DATE", [ew.Validators.datetime(0)], fields.MODIFIED_DATE.isInvalid],
        ["MODIFIED_FROM", [], fields.MODIFIED_FROM.isInvalid],
        ["EMPLOYEE_ID", [], fields.EMPLOYEE_ID.isInvalid],
        ["EMPLOYEE_ID_FROM", [], fields.EMPLOYEE_ID_FROM.isInvalid],
        ["RESPONSIBLE_ID", [ew.Validators.integer], fields.RESPONSIBLE_ID.isInvalid],
        ["RESPONSIBLE", [], fields.RESPONSIBLE.isInvalid],
        ["FAMILY_STATUS_ID", [ew.Validators.integer], fields.FAMILY_STATUS_ID.isInvalid],
        ["TICKET_NO", [ew.Validators.integer], fields.TICKET_NO.isInvalid],
        ["ISATTENDED", [], fields.ISATTENDED.isInvalid],
        ["PAYOR_ID", [], fields.PAYOR_ID.isInvalid],
        ["CLASS_ID", [], fields.CLASS_ID.isInvalid],
        ["ISPERTARIF", [], fields.ISPERTARIF.isInvalid],
        ["KAL_ID", [], fields.KAL_ID.isInvalid],
        ["EMPLOYEE_INAP", [], fields.EMPLOYEE_INAP.isInvalid],
        ["PASIEN_ID", [], fields.PASIEN_ID.isInvalid],
        ["KARYAWAN", [], fields.KARYAWAN.isInvalid],
        ["ACCOUNT_ID", [], fields.ACCOUNT_ID.isInvalid],
        ["CLASS_ID_PLAFOND", [ew.Validators.integer], fields.CLASS_ID_PLAFOND.isInvalid],
        ["BACKCHARGE", [], fields.BACKCHARGE.isInvalid],
        ["COVERAGE_ID", [], fields.COVERAGE_ID.isInvalid],
        ["AGEYEAR", [ew.Validators.integer], fields.AGEYEAR.isInvalid],
        ["AGEMONTH", [ew.Validators.integer], fields.AGEMONTH.isInvalid],
        ["AGEDAY", [ew.Validators.integer], fields.AGEDAY.isInvalid],
        ["RECOMENDATION", [], fields.RECOMENDATION.isInvalid],
        ["CONCLUSION", [], fields.CONCLUSION.isInvalid],
        ["SPECIMENNO", [], fields.SPECIMENNO.isInvalid],
        ["LOCKED", [], fields.LOCKED.isInvalid],
        ["RM_OUT_DATE", [ew.Validators.datetime(0)], fields.RM_OUT_DATE.isInvalid],
        ["RM_IN_DATE", [ew.Validators.datetime(0)], fields.RM_IN_DATE.isInvalid],
        ["LAMA_PINJAM", [ew.Validators.datetime(0)], fields.LAMA_PINJAM.isInvalid],
        ["STANDAR_RJ", [], fields.STANDAR_RJ.isInvalid],
        ["LENGKAP_RJ", [], fields.LENGKAP_RJ.isInvalid],
        ["LENGKAP_RI", [], fields.LENGKAP_RI.isInvalid],
        ["RESEND_RM_DATE", [ew.Validators.datetime(0)], fields.RESEND_RM_DATE.isInvalid],
        ["LENGKAP_RM1", [], fields.LENGKAP_RM1.isInvalid],
        ["LENGKAP_RESUME", [], fields.LENGKAP_RESUME.isInvalid],
        ["LENGKAP_ANAMNESIS", [], fields.LENGKAP_ANAMNESIS.isInvalid],
        ["LENGKAP_CONSENT", [], fields.LENGKAP_CONSENT.isInvalid],
        ["LENGKAP_ANESTESI", [], fields.LENGKAP_ANESTESI.isInvalid],
        ["LENGKAP_OP", [], fields.LENGKAP_OP.isInvalid],
        ["BACK_RM_DATE", [ew.Validators.datetime(0)], fields.BACK_RM_DATE.isInvalid],
        ["VALID_RM_DATE", [ew.Validators.datetime(0)], fields.VALID_RM_DATE.isInvalid],
        ["NO_SKP", [], fields.NO_SKP.isInvalid],
        ["NO_SKPINAP", [], fields.NO_SKPINAP.isInvalid],
        ["DIAGNOSA_ID", [], fields.DIAGNOSA_ID.isInvalid],
        ["ticket_all", [ew.Validators.integer], fields.ticket_all.isInvalid],
        ["tanggal_rujukan", [ew.Validators.datetime(0)], fields.tanggal_rujukan.isInvalid],
        ["ISRJ", [], fields.ISRJ.isInvalid],
        ["NORUJUKAN", [], fields.NORUJUKAN.isInvalid],
        ["PPKRUJUKAN", [], fields.PPKRUJUKAN.isInvalid],
        ["LOKASILAKA", [], fields.LOKASILAKA.isInvalid],
        ["KDPOLI", [], fields.KDPOLI.isInvalid],
        ["EDIT_SEP", [], fields.EDIT_SEP.isInvalid],
        ["DELETE_SEP", [], fields.DELETE_SEP.isInvalid],
        ["KODE_AGAMA", [], fields.KODE_AGAMA.isInvalid],
        ["DIAG_AWAL", [], fields.DIAG_AWAL.isInvalid],
        ["AKTIF", [], fields.AKTIF.isInvalid],
        ["BILL_INAP", [], fields.BILL_INAP.isInvalid],
        ["SEP_PRINTDATE", [ew.Validators.datetime(0)], fields.SEP_PRINTDATE.isInvalid],
        ["MAPPING_SEP", [], fields.MAPPING_SEP.isInvalid],
        ["TRANS_ID", [], fields.TRANS_ID.isInvalid],
        ["KDPOLI_EKS", [], fields.KDPOLI_EKS.isInvalid],
        ["COB", [], fields.COB.isInvalid],
        ["PENJAMIN", [], fields.PENJAMIN.isInvalid],
        ["ASALRUJUKAN", [], fields.ASALRUJUKAN.isInvalid],
        ["RESPONSEP", [], fields.RESPONSEP.isInvalid],
        ["APPROVAL_DESC", [], fields.APPROVAL_DESC.isInvalid],
        ["APPROVAL_RESPONAJUKAN", [], fields.APPROVAL_RESPONAJUKAN.isInvalid],
        ["APPROVAL_RESPONAPPROV", [], fields.APPROVAL_RESPONAPPROV.isInvalid],
        ["RESPONTGLPLG_DESC", [], fields.RESPONTGLPLG_DESC.isInvalid],
        ["RESPONPOST_VKLAIM", [], fields.RESPONPOST_VKLAIM.isInvalid],
        ["RESPONPUT_VKLAIM", [], fields.RESPONPUT_VKLAIM.isInvalid],
        ["RESPONDEL_VKLAIM", [], fields.RESPONDEL_VKLAIM.isInvalid],
        ["CALL_TIMES", [ew.Validators.integer], fields.CALL_TIMES.isInvalid],
        ["CALL_DATE", [ew.Validators.datetime(0)], fields.CALL_DATE.isInvalid],
        ["CALL_DATES", [ew.Validators.datetime(0)], fields.CALL_DATES.isInvalid],
        ["SERVED_DATE", [ew.Validators.datetime(0)], fields.SERVED_DATE.isInvalid],
        ["SERVED_INAP", [ew.Validators.datetime(0)], fields.SERVED_INAP.isInvalid],
        ["KDDPJP1", [], fields.KDDPJP1.isInvalid],
        ["KDDPJP", [], fields.KDDPJP.isInvalid],
        ["IDXDAFTAR", [], fields.IDXDAFTAR.isInvalid],
        ["tgl_kontrol", [ew.Validators.datetime(0)], fields.tgl_kontrol.isInvalid],
        ["idbooking", [], fields.idbooking.isInvalid],
        ["id_tujuan", [ew.Validators.integer], fields.id_tujuan.isInvalid],
        ["id_penunjang", [ew.Validators.integer], fields.id_penunjang.isInvalid],
        ["id_pembiayaan", [ew.Validators.integer], fields.id_pembiayaan.isInvalid],
        ["id_procedure", [ew.Validators.integer], fields.id_procedure.isInvalid],
        ["id_aspel", [ew.Validators.integer], fields.id_aspel.isInvalid],
        ["id_kelas", [ew.Validators.integer], fields.id_kelas.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fV_RADIOLOGIsearch.setInvalid();
    });

    // Validate form
    fV_RADIOLOGIsearch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fV_RADIOLOGIsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fV_RADIOLOGIsearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fV_RADIOLOGIsearch.lists.NO_REGISTRATION = <?= $Page->NO_REGISTRATION->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.STATUS_PASIEN_ID = <?= $Page->STATUS_PASIEN_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.RUJUKAN_ID = <?= $Page->RUJUKAN_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.REASON_ID = <?= $Page->REASON_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.WAY_ID = <?= $Page->WAY_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.PATIENT_CATEGORY_ID = <?= $Page->PATIENT_CATEGORY_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.ISNEW = <?= $Page->ISNEW->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.CLINIC_ID = <?= $Page->CLINIC_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.CLINIC_ID_FROM = <?= $Page->CLINIC_ID_FROM->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.KELUAR_ID = <?= $Page->KELUAR_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.GENDER = <?= $Page->GENDER->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.EMPLOYEE_ID = <?= $Page->EMPLOYEE_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.PAYOR_ID = <?= $Page->PAYOR_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.CLASS_ID = <?= $Page->CLASS_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.KAL_ID = <?= $Page->KAL_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.COVERAGE_ID = <?= $Page->COVERAGE_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.DIAGNOSA_ID = <?= $Page->DIAGNOSA_ID->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.ISRJ = <?= $Page->ISRJ->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.PPKRUJUKAN = <?= $Page->PPKRUJUKAN->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.KODE_AGAMA = <?= $Page->KODE_AGAMA->toClientList($Page) ?>;
    fV_RADIOLOGIsearch.lists.COB = <?= $Page->COB->toClientList($Page) ?>;
    loadjs.done("fV_RADIOLOGIsearch");
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
<form name="fV_RADIOLOGIsearch" id="fV_RADIOLOGIsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_RADIOLOGI">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <div id="r_ORG_UNIT_CODE" class="form-group row">
        <label for="x_ORG_UNIT_CODE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ORG_UNIT_CODE" id="z_ORG_UNIT_CODE" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ORG_UNIT_CODE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->ORG_UNIT_CODE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_ORG_UNIT_CODE" name="x_ORG_UNIT_CODE" id="x_ORG_UNIT_CODE" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ORG_UNIT_CODE->getPlaceHolder()) ?>" value="<?= $Page->ORG_UNIT_CODE->EditValue ?>"<?= $Page->ORG_UNIT_CODE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ORG_UNIT_CODE->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NO_REGISTRATION" id="z_NO_REGISTRATION" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_NO_REGISTRATION" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_NO_REGISTRATION"><?= EmptyValue(strval($Page->NO_REGISTRATION->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->NO_REGISTRATION->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->NO_REGISTRATION->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->NO_REGISTRATION->ReadOnly || $Page->NO_REGISTRATION->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_NO_REGISTRATION',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->NO_REGISTRATION->getErrorMessage(false) ?></div>
<?= $Page->NO_REGISTRATION->Lookup->getParamTag($Page, "p_x_NO_REGISTRATION") ?>
<input type="hidden" is="selection-list" data-table="V_RADIOLOGI" data-field="x_NO_REGISTRATION" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->NO_REGISTRATION->displayValueSeparatorAttribute() ?>" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" value="<?= $Page->NO_REGISTRATION->AdvancedSearch->SearchValue ?>"<?= $Page->NO_REGISTRATION->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->VISIT_ID->Visible) { // VISIT_ID ?>
    <div id="r_VISIT_ID" class="form-group row">
        <label for="x_VISIT_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_VISIT_ID"><?= $Page->VISIT_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_VISIT_ID" id="z_VISIT_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->VISIT_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_VISIT_ID" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->VISIT_ID->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_VISIT_ID" name="x_VISIT_ID" id="x_VISIT_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->VISIT_ID->getPlaceHolder()) ?>" value="<?= $Page->VISIT_ID->EditValue ?>"<?= $Page->VISIT_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->VISIT_ID->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <div id="r_STATUS_PASIEN_ID" class="form-group row">
        <label for="x_STATUS_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_STATUS_PASIEN_ID"><?= $Page->STATUS_PASIEN_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_STATUS_PASIEN_ID" id="z_STATUS_PASIEN_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_STATUS_PASIEN_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_STATUS_PASIEN_ID"
        name="x_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Page->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_STATUS_PASIEN_ID"
        data-table="V_RADIOLOGI"
        data-field="x_STATUS_PASIEN_ID"
        data-value-separator="<?= $Page->STATUS_PASIEN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->STATUS_PASIEN_ID->getPlaceHolder()) ?>"
        <?= $Page->STATUS_PASIEN_ID->editAttributes() ?>>
        <?= $Page->STATUS_PASIEN_ID->selectOptionListHtml("x_STATUS_PASIEN_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->STATUS_PASIEN_ID->getErrorMessage(false) ?></div>
<?= $Page->STATUS_PASIEN_ID->Lookup->getParamTag($Page, "p_x_STATUS_PASIEN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_STATUS_PASIEN_ID']"),
        options = { name: "x_STATUS_PASIEN_ID", selectId: "V_RADIOLOGI_x_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RUJUKAN_ID->Visible) { // RUJUKAN_ID ?>
    <div id="r_RUJUKAN_ID" class="form-group row">
        <label for="x_RUJUKAN_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RUJUKAN_ID"><?= $Page->RUJUKAN_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_RUJUKAN_ID" id="z_RUJUKAN_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RUJUKAN_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RUJUKAN_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_RUJUKAN_ID"
        name="x_RUJUKAN_ID"
        class="form-control ew-select<?= $Page->RUJUKAN_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_RUJUKAN_ID"
        data-table="V_RADIOLOGI"
        data-field="x_RUJUKAN_ID"
        data-value-separator="<?= $Page->RUJUKAN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->RUJUKAN_ID->getPlaceHolder()) ?>"
        <?= $Page->RUJUKAN_ID->editAttributes() ?>>
        <?= $Page->RUJUKAN_ID->selectOptionListHtml("x_RUJUKAN_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->RUJUKAN_ID->getErrorMessage(false) ?></div>
<?= $Page->RUJUKAN_ID->Lookup->getParamTag($Page, "p_x_RUJUKAN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_RUJUKAN_ID']"),
        options = { name: "x_RUJUKAN_ID", selectId: "V_RADIOLOGI_x_RUJUKAN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.RUJUKAN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->ADDRESS_OF_RUJUKAN->Visible) { // ADDRESS_OF_RUJUKAN ?>
    <div id="r_ADDRESS_OF_RUJUKAN" class="form-group row">
        <label for="x_ADDRESS_OF_RUJUKAN" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ADDRESS_OF_RUJUKAN"><?= $Page->ADDRESS_OF_RUJUKAN->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ADDRESS_OF_RUJUKAN" id="z_ADDRESS_OF_RUJUKAN" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ADDRESS_OF_RUJUKAN->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ADDRESS_OF_RUJUKAN" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->ADDRESS_OF_RUJUKAN->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_ADDRESS_OF_RUJUKAN" name="x_ADDRESS_OF_RUJUKAN" id="x_ADDRESS_OF_RUJUKAN" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ADDRESS_OF_RUJUKAN->getPlaceHolder()) ?>" value="<?= $Page->ADDRESS_OF_RUJUKAN->EditValue ?>"<?= $Page->ADDRESS_OF_RUJUKAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ADDRESS_OF_RUJUKAN->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->REASON_ID->Visible) { // REASON_ID ?>
    <div id="r_REASON_ID" class="form-group row">
        <label for="x_REASON_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_REASON_ID"><?= $Page->REASON_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_REASON_ID" id="z_REASON_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->REASON_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_REASON_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_REASON_ID"
        name="x_REASON_ID"
        class="form-control ew-select<?= $Page->REASON_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_REASON_ID"
        data-table="V_RADIOLOGI"
        data-field="x_REASON_ID"
        data-value-separator="<?= $Page->REASON_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->REASON_ID->getPlaceHolder()) ?>"
        <?= $Page->REASON_ID->editAttributes() ?>>
        <?= $Page->REASON_ID->selectOptionListHtml("x_REASON_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->REASON_ID->getErrorMessage(false) ?></div>
<?= $Page->REASON_ID->Lookup->getParamTag($Page, "p_x_REASON_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_REASON_ID']"),
        options = { name: "x_REASON_ID", selectId: "V_RADIOLOGI_x_REASON_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.REASON_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->WAY_ID->Visible) { // WAY_ID ?>
    <div id="r_WAY_ID" class="form-group row">
        <label for="x_WAY_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_WAY_ID"><?= $Page->WAY_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_WAY_ID" id="z_WAY_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->WAY_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_WAY_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_WAY_ID"
        name="x_WAY_ID"
        class="form-control ew-select<?= $Page->WAY_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_WAY_ID"
        data-table="V_RADIOLOGI"
        data-field="x_WAY_ID"
        data-value-separator="<?= $Page->WAY_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->WAY_ID->getPlaceHolder()) ?>"
        <?= $Page->WAY_ID->editAttributes() ?>>
        <?= $Page->WAY_ID->selectOptionListHtml("x_WAY_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->WAY_ID->getErrorMessage(false) ?></div>
<?= $Page->WAY_ID->Lookup->getParamTag($Page, "p_x_WAY_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_WAY_ID']"),
        options = { name: "x_WAY_ID", selectId: "V_RADIOLOGI_x_WAY_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.WAY_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->PATIENT_CATEGORY_ID->Visible) { // PATIENT_CATEGORY_ID ?>
    <div id="r_PATIENT_CATEGORY_ID" class="form-group row">
        <label for="x_PATIENT_CATEGORY_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_PATIENT_CATEGORY_ID"><?= $Page->PATIENT_CATEGORY_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_PATIENT_CATEGORY_ID" id="z_PATIENT_CATEGORY_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PATIENT_CATEGORY_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_PATIENT_CATEGORY_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_PATIENT_CATEGORY_ID"
        name="x_PATIENT_CATEGORY_ID"
        class="form-control ew-select<?= $Page->PATIENT_CATEGORY_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_PATIENT_CATEGORY_ID"
        data-table="V_RADIOLOGI"
        data-field="x_PATIENT_CATEGORY_ID"
        data-value-separator="<?= $Page->PATIENT_CATEGORY_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PATIENT_CATEGORY_ID->getPlaceHolder()) ?>"
        <?= $Page->PATIENT_CATEGORY_ID->editAttributes() ?>>
        <?= $Page->PATIENT_CATEGORY_ID->selectOptionListHtml("x_PATIENT_CATEGORY_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PATIENT_CATEGORY_ID->getErrorMessage(false) ?></div>
<?= $Page->PATIENT_CATEGORY_ID->Lookup->getParamTag($Page, "p_x_PATIENT_CATEGORY_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_PATIENT_CATEGORY_ID']"),
        options = { name: "x_PATIENT_CATEGORY_ID", selectId: "V_RADIOLOGI_x_PATIENT_CATEGORY_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.PATIENT_CATEGORY_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->BOOKED_DATE->Visible) { // BOOKED_DATE ?>
    <div id="r_BOOKED_DATE" class="form-group row">
        <label for="x_BOOKED_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_BOOKED_DATE"><?= $Page->BOOKED_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_BOOKED_DATE" id="z_BOOKED_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->BOOKED_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_BOOKED_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->BOOKED_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_BOOKED_DATE" name="x_BOOKED_DATE" id="x_BOOKED_DATE" placeholder="<?= HtmlEncode($Page->BOOKED_DATE->getPlaceHolder()) ?>" value="<?= $Page->BOOKED_DATE->EditValue ?>"<?= $Page->BOOKED_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->BOOKED_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->BOOKED_DATE->ReadOnly && !$Page->BOOKED_DATE->Disabled && !isset($Page->BOOKED_DATE->EditAttrs["readonly"]) && !isset($Page->BOOKED_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_BOOKED_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
    <div id="r_VISIT_DATE" class="form-group row">
        <label for="x_VISIT_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_VISIT_DATE"><?= $Page->VISIT_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_VISIT_DATE" id="z_VISIT_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->VISIT_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_VISIT_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->VISIT_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_VISIT_DATE" name="x_VISIT_DATE" id="x_VISIT_DATE" placeholder="<?= HtmlEncode($Page->VISIT_DATE->getPlaceHolder()) ?>" value="<?= $Page->VISIT_DATE->EditValue ?>"<?= $Page->VISIT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->VISIT_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->VISIT_DATE->ReadOnly && !$Page->VISIT_DATE->Disabled && !isset($Page->VISIT_DATE->EditAttrs["readonly"]) && !isset($Page->VISIT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_VISIT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->ISNEW->Visible) { // ISNEW ?>
    <div id="r_ISNEW" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ISNEW"><?= $Page->ISNEW->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ISNEW" id="z_ISNEW" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ISNEW->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ISNEW" class="ew-search-field ew-search-field-single">
<template id="tp_x_ISNEW">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="V_RADIOLOGI" data-field="x_ISNEW" name="x_ISNEW" id="x_ISNEW"<?= $Page->ISNEW->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_ISNEW" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_ISNEW"
    name="x_ISNEW"
    value="<?= HtmlEncode($Page->ISNEW->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_ISNEW"
    data-target="dsl_x_ISNEW"
    data-repeatcolumn="5"
    class="form-control<?= $Page->ISNEW->isInvalidClass() ?>"
    data-table="V_RADIOLOGI"
    data-field="x_ISNEW"
    data-value-separator="<?= $Page->ISNEW->displayValueSeparatorAttribute() ?>"
    <?= $Page->ISNEW->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ISNEW->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->FOLLOW_UP->Visible) { // FOLLOW_UP ?>
    <div id="r_FOLLOW_UP" class="form-group row">
        <label for="x_FOLLOW_UP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_FOLLOW_UP"><?= $Page->FOLLOW_UP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_FOLLOW_UP" id="z_FOLLOW_UP" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FOLLOW_UP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_FOLLOW_UP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->FOLLOW_UP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_FOLLOW_UP" name="x_FOLLOW_UP" id="x_FOLLOW_UP" size="30" placeholder="<?= HtmlEncode($Page->FOLLOW_UP->getPlaceHolder()) ?>" value="<?= $Page->FOLLOW_UP->EditValue ?>"<?= $Page->FOLLOW_UP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->FOLLOW_UP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->PLACE_TYPE->Visible) { // PLACE_TYPE ?>
    <div id="r_PLACE_TYPE" class="form-group row">
        <label for="x_PLACE_TYPE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_PLACE_TYPE"><?= $Page->PLACE_TYPE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_PLACE_TYPE" id="z_PLACE_TYPE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PLACE_TYPE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_PLACE_TYPE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->PLACE_TYPE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_PLACE_TYPE" name="x_PLACE_TYPE" id="x_PLACE_TYPE" size="30" placeholder="<?= HtmlEncode($Page->PLACE_TYPE->getPlaceHolder()) ?>" value="<?= $Page->PLACE_TYPE->EditValue ?>"<?= $Page->PLACE_TYPE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->PLACE_TYPE->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <div id="r_CLINIC_ID" class="form-group row">
        <label for="x_CLINIC_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CLINIC_ID" id="z_CLINIC_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CLINIC_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_CLINIC_ID"
        name="x_CLINIC_ID"
        class="form-control ew-select<?= $Page->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_CLINIC_ID"
        data-table="V_RADIOLOGI"
        data-field="x_CLINIC_ID"
        data-value-separator="<?= $Page->CLINIC_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLINIC_ID->getPlaceHolder()) ?>"
        <?= $Page->CLINIC_ID->editAttributes() ?>>
        <?= $Page->CLINIC_ID->selectOptionListHtml("x_CLINIC_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->CLINIC_ID->getErrorMessage(false) ?></div>
<?= $Page->CLINIC_ID->Lookup->getParamTag($Page, "p_x_CLINIC_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_CLINIC_ID']"),
        options = { name: "x_CLINIC_ID", selectId: "V_RADIOLOGI_x_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_ID_FROM->Visible) { // CLINIC_ID_FROM ?>
    <div id="r_CLINIC_ID_FROM" class="form-group row">
        <label for="x_CLINIC_ID_FROM" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CLINIC_ID_FROM"><?= $Page->CLINIC_ID_FROM->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CLINIC_ID_FROM" id="z_CLINIC_ID_FROM" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID_FROM->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CLINIC_ID_FROM" class="ew-search-field ew-search-field-single">
    <select
        id="x_CLINIC_ID_FROM"
        name="x_CLINIC_ID_FROM"
        class="form-control ew-select<?= $Page->CLINIC_ID_FROM->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_CLINIC_ID_FROM"
        data-table="V_RADIOLOGI"
        data-field="x_CLINIC_ID_FROM"
        data-value-separator="<?= $Page->CLINIC_ID_FROM->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLINIC_ID_FROM->getPlaceHolder()) ?>"
        <?= $Page->CLINIC_ID_FROM->editAttributes() ?>>
        <?= $Page->CLINIC_ID_FROM->selectOptionListHtml("x_CLINIC_ID_FROM") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->CLINIC_ID_FROM->getErrorMessage(false) ?></div>
<?= $Page->CLINIC_ID_FROM->Lookup->getParamTag($Page, "p_x_CLINIC_ID_FROM") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_CLINIC_ID_FROM']"),
        options = { name: "x_CLINIC_ID_FROM", selectId: "V_RADIOLOGI_x_CLINIC_ID_FROM", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.CLINIC_ID_FROM.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
    <div id="r_CLASS_ROOM_ID" class="form-group row">
        <label for="x_CLASS_ROOM_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CLASS_ROOM_ID"><?= $Page->CLASS_ROOM_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CLASS_ROOM_ID" id="z_CLASS_ROOM_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ROOM_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CLASS_ROOM_ID" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->CLASS_ROOM_ID->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_CLASS_ROOM_ID" name="x_CLASS_ROOM_ID" id="x_CLASS_ROOM_ID" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->CLASS_ROOM_ID->getPlaceHolder()) ?>" value="<?= $Page->CLASS_ROOM_ID->EditValue ?>"<?= $Page->CLASS_ROOM_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->CLASS_ROOM_ID->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->BED_ID->Visible) { // BED_ID ?>
    <div id="r_BED_ID" class="form-group row">
        <label for="x_BED_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_BED_ID"><?= $Page->BED_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_BED_ID" id="z_BED_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->BED_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_BED_ID" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->BED_ID->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_BED_ID" name="x_BED_ID" id="x_BED_ID" size="30" placeholder="<?= HtmlEncode($Page->BED_ID->getPlaceHolder()) ?>" value="<?= $Page->BED_ID->EditValue ?>"<?= $Page->BED_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->BED_ID->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { // KELUAR_ID ?>
    <div id="r_KELUAR_ID" class="form-group row">
        <label for="x_KELUAR_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_KELUAR_ID"><?= $Page->KELUAR_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_KELUAR_ID" id="z_KELUAR_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KELUAR_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_KELUAR_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_KELUAR_ID"
        name="x_KELUAR_ID"
        class="form-control ew-select<?= $Page->KELUAR_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_KELUAR_ID"
        data-table="V_RADIOLOGI"
        data-field="x_KELUAR_ID"
        data-value-separator="<?= $Page->KELUAR_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KELUAR_ID->getPlaceHolder()) ?>"
        <?= $Page->KELUAR_ID->editAttributes() ?>>
        <?= $Page->KELUAR_ID->selectOptionListHtml("x_KELUAR_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KELUAR_ID->getErrorMessage(false) ?></div>
<?= $Page->KELUAR_ID->Lookup->getParamTag($Page, "p_x_KELUAR_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_KELUAR_ID']"),
        options = { name: "x_KELUAR_ID", selectId: "V_RADIOLOGI_x_KELUAR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.KELUAR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->IN_DATE->Visible) { // IN_DATE ?>
    <div id="r_IN_DATE" class="form-group row">
        <label for="x_IN_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_IN_DATE"><?= $Page->IN_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_IN_DATE" id="z_IN_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->IN_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_IN_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->IN_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_IN_DATE" name="x_IN_DATE" id="x_IN_DATE" placeholder="<?= HtmlEncode($Page->IN_DATE->getPlaceHolder()) ?>" value="<?= $Page->IN_DATE->EditValue ?>"<?= $Page->IN_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->IN_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->IN_DATE->ReadOnly && !$Page->IN_DATE->Disabled && !isset($Page->IN_DATE->EditAttrs["readonly"]) && !isset($Page->IN_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_IN_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->EXIT_DATE->Visible) { // EXIT_DATE ?>
    <div id="r_EXIT_DATE" class="form-group row">
        <label for="x_EXIT_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_EXIT_DATE"><?= $Page->EXIT_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_EXIT_DATE" id="z_EXIT_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EXIT_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_EXIT_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->EXIT_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_EXIT_DATE" name="x_EXIT_DATE" id="x_EXIT_DATE" placeholder="<?= HtmlEncode($Page->EXIT_DATE->getPlaceHolder()) ?>" value="<?= $Page->EXIT_DATE->EditValue ?>"<?= $Page->EXIT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->EXIT_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->EXIT_DATE->ReadOnly && !$Page->EXIT_DATE->Disabled && !isset($Page->EXIT_DATE->EditAttrs["readonly"]) && !isset($Page->EXIT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_EXIT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->DIANTAR_OLEH->Visible) { // DIANTAR_OLEH ?>
    <div id="r_DIANTAR_OLEH" class="form-group row">
        <label for="x_DIANTAR_OLEH" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_DIANTAR_OLEH"><?= $Page->DIANTAR_OLEH->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DIANTAR_OLEH" id="z_DIANTAR_OLEH" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIANTAR_OLEH->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_DIANTAR_OLEH" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->DIANTAR_OLEH->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_DIANTAR_OLEH" name="x_DIANTAR_OLEH" id="x_DIANTAR_OLEH" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->DIANTAR_OLEH->getPlaceHolder()) ?>" value="<?= $Page->DIANTAR_OLEH->EditValue ?>"<?= $Page->DIANTAR_OLEH->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DIANTAR_OLEH->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <div id="r_GENDER" class="form-group row">
        <label for="x_GENDER" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_GENDER"><?= $Page->GENDER->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_GENDER" id="z_GENDER" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->GENDER->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_GENDER" class="ew-search-field ew-search-field-single">
    <select
        id="x_GENDER"
        name="x_GENDER"
        class="form-control ew-select<?= $Page->GENDER->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_GENDER"
        data-table="V_RADIOLOGI"
        data-field="x_GENDER"
        data-value-separator="<?= $Page->GENDER->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->GENDER->getPlaceHolder()) ?>"
        <?= $Page->GENDER->editAttributes() ?>>
        <?= $Page->GENDER->selectOptionListHtml("x_GENDER") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->GENDER->getErrorMessage(false) ?></div>
<?= $Page->GENDER->Lookup->getParamTag($Page, "p_x_GENDER") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_GENDER']"),
        options = { name: "x_GENDER", selectId: "V_RADIOLOGI_x_GENDER", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.GENDER.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <div id="r_DESCRIPTION" class="form-group row">
        <label for="x_DESCRIPTION" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_DESCRIPTION"><?= $Page->DESCRIPTION->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DESCRIPTION" id="z_DESCRIPTION" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DESCRIPTION->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_DESCRIPTION" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->DESCRIPTION->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_DESCRIPTION" name="x_DESCRIPTION" id="x_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Page->DESCRIPTION->EditValue ?>"<?= $Page->DESCRIPTION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DESCRIPTION->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->VISITOR_ADDRESS->Visible) { // VISITOR_ADDRESS ?>
    <div id="r_VISITOR_ADDRESS" class="form-group row">
        <label for="x_VISITOR_ADDRESS" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_VISITOR_ADDRESS"><?= $Page->VISITOR_ADDRESS->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_VISITOR_ADDRESS" id="z_VISITOR_ADDRESS" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->VISITOR_ADDRESS->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_VISITOR_ADDRESS" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->VISITOR_ADDRESS->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_VISITOR_ADDRESS" name="x_VISITOR_ADDRESS" id="x_VISITOR_ADDRESS" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->VISITOR_ADDRESS->getPlaceHolder()) ?>" value="<?= $Page->VISITOR_ADDRESS->EditValue ?>"<?= $Page->VISITOR_ADDRESS->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->VISITOR_ADDRESS->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
    <div id="r_MODIFIED_BY" class="form-group row">
        <label for="x_MODIFIED_BY" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_MODIFIED_BY"><?= $Page->MODIFIED_BY->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MODIFIED_BY" id="z_MODIFIED_BY" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_BY->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_MODIFIED_BY" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->MODIFIED_BY->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_MODIFIED_BY" name="x_MODIFIED_BY" id="x_MODIFIED_BY" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->MODIFIED_BY->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_BY->EditValue ?>"<?= $Page->MODIFIED_BY->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->MODIFIED_BY->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
    <div id="r_MODIFIED_DATE" class="form-group row">
        <label for="x_MODIFIED_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_MODIFIED_DATE"><?= $Page->MODIFIED_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_MODIFIED_DATE" id="z_MODIFIED_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_MODIFIED_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->MODIFIED_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_MODIFIED_DATE" name="x_MODIFIED_DATE" id="x_MODIFIED_DATE" placeholder="<?= HtmlEncode($Page->MODIFIED_DATE->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_DATE->EditValue ?>"<?= $Page->MODIFIED_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->MODIFIED_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->MODIFIED_DATE->ReadOnly && !$Page->MODIFIED_DATE->Disabled && !isset($Page->MODIFIED_DATE->EditAttrs["readonly"]) && !isset($Page->MODIFIED_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_MODIFIED_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
    <div id="r_MODIFIED_FROM" class="form-group row">
        <label for="x_MODIFIED_FROM" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_MODIFIED_FROM"><?= $Page->MODIFIED_FROM->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MODIFIED_FROM" id="z_MODIFIED_FROM" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_FROM->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_MODIFIED_FROM" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->MODIFIED_FROM->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_MODIFIED_FROM" name="x_MODIFIED_FROM" id="x_MODIFIED_FROM" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MODIFIED_FROM->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_FROM->EditValue ?>"<?= $Page->MODIFIED_FROM->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->MODIFIED_FROM->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <div id="r_EMPLOYEE_ID" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_EMPLOYEE_ID"><?= $Page->EMPLOYEE_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_EMPLOYEE_ID" id="z_EMPLOYEE_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_EMPLOYEE_ID" class="ew-search-field ew-search-field-single">
<?php
$onchange = $Page->EMPLOYEE_ID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->EMPLOYEE_ID->EditAttrs["onchange"] = "";
?>
<span id="as_x_EMPLOYEE_ID" class="ew-auto-suggest">
    <input type="<?= $Page->EMPLOYEE_ID->getInputTextType() ?>" class="form-control" name="sv_x_EMPLOYEE_ID" id="sv_x_EMPLOYEE_ID" value="<?= RemoveHtml($Page->EMPLOYEE_ID->EditValue) ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->EMPLOYEE_ID->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->EMPLOYEE_ID->getPlaceHolder()) ?>"<?= $Page->EMPLOYEE_ID->editAttributes() ?>>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="V_RADIOLOGI" data-field="x_EMPLOYEE_ID" data-input="sv_x_EMPLOYEE_ID" data-value-separator="<?= $Page->EMPLOYEE_ID->displayValueSeparatorAttribute() ?>" name="x_EMPLOYEE_ID" id="x_EMPLOYEE_ID" value="<?= HtmlEncode($Page->EMPLOYEE_ID->AdvancedSearch->SearchValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Page->EMPLOYEE_ID->getErrorMessage(false) ?></div>
<script>
loadjs.ready(["fV_RADIOLOGIsearch"], function() {
    fV_RADIOLOGIsearch.createAutoSuggest(Object.assign({"id":"x_EMPLOYEE_ID","forceSelect":false}, ew.vars.tables.V_RADIOLOGI.fields.EMPLOYEE_ID.autoSuggestOptions));
});
</script>
<?= $Page->EMPLOYEE_ID->Lookup->getParamTag($Page, "p_x_EMPLOYEE_ID") ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID_FROM->Visible) { // EMPLOYEE_ID_FROM ?>
    <div id="r_EMPLOYEE_ID_FROM" class="form-group row">
        <label for="x_EMPLOYEE_ID_FROM" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_EMPLOYEE_ID_FROM"><?= $Page->EMPLOYEE_ID_FROM->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_EMPLOYEE_ID_FROM" id="z_EMPLOYEE_ID_FROM" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EMPLOYEE_ID_FROM->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_EMPLOYEE_ID_FROM" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->EMPLOYEE_ID_FROM->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_EMPLOYEE_ID_FROM" name="x_EMPLOYEE_ID_FROM" id="x_EMPLOYEE_ID_FROM" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->EMPLOYEE_ID_FROM->getPlaceHolder()) ?>" value="<?= $Page->EMPLOYEE_ID_FROM->EditValue ?>"<?= $Page->EMPLOYEE_ID_FROM->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->EMPLOYEE_ID_FROM->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RESPONSIBLE_ID->Visible) { // RESPONSIBLE_ID ?>
    <div id="r_RESPONSIBLE_ID" class="form-group row">
        <label for="x_RESPONSIBLE_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RESPONSIBLE_ID"><?= $Page->RESPONSIBLE_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_RESPONSIBLE_ID" id="z_RESPONSIBLE_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESPONSIBLE_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RESPONSIBLE_ID" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RESPONSIBLE_ID->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RESPONSIBLE_ID" name="x_RESPONSIBLE_ID" id="x_RESPONSIBLE_ID" size="30" placeholder="<?= HtmlEncode($Page->RESPONSIBLE_ID->getPlaceHolder()) ?>" value="<?= $Page->RESPONSIBLE_ID->EditValue ?>"<?= $Page->RESPONSIBLE_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RESPONSIBLE_ID->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RESPONSIBLE->Visible) { // RESPONSIBLE ?>
    <div id="r_RESPONSIBLE" class="form-group row">
        <label for="x_RESPONSIBLE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RESPONSIBLE"><?= $Page->RESPONSIBLE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RESPONSIBLE" id="z_RESPONSIBLE" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESPONSIBLE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RESPONSIBLE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RESPONSIBLE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RESPONSIBLE" name="x_RESPONSIBLE" id="x_RESPONSIBLE" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->RESPONSIBLE->getPlaceHolder()) ?>" value="<?= $Page->RESPONSIBLE->EditValue ?>"<?= $Page->RESPONSIBLE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RESPONSIBLE->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
    <div id="r_FAMILY_STATUS_ID" class="form-group row">
        <label for="x_FAMILY_STATUS_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_FAMILY_STATUS_ID"><?= $Page->FAMILY_STATUS_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_FAMILY_STATUS_ID" id="z_FAMILY_STATUS_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_FAMILY_STATUS_ID" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->FAMILY_STATUS_ID->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_FAMILY_STATUS_ID" name="x_FAMILY_STATUS_ID" id="x_FAMILY_STATUS_ID" size="30" placeholder="<?= HtmlEncode($Page->FAMILY_STATUS_ID->getPlaceHolder()) ?>" value="<?= $Page->FAMILY_STATUS_ID->EditValue ?>"<?= $Page->FAMILY_STATUS_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->FAMILY_STATUS_ID->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->TICKET_NO->Visible) { // TICKET_NO ?>
    <div id="r_TICKET_NO" class="form-group row">
        <label for="x_TICKET_NO" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_TICKET_NO"><?= $Page->TICKET_NO->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_TICKET_NO" id="z_TICKET_NO" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TICKET_NO->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_TICKET_NO" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->TICKET_NO->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_TICKET_NO" name="x_TICKET_NO" id="x_TICKET_NO" size="30" placeholder="<?= HtmlEncode($Page->TICKET_NO->getPlaceHolder()) ?>" value="<?= $Page->TICKET_NO->EditValue ?>"<?= $Page->TICKET_NO->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TICKET_NO->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->ISATTENDED->Visible) { // ISATTENDED ?>
    <div id="r_ISATTENDED" class="form-group row">
        <label for="x_ISATTENDED" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ISATTENDED"><?= $Page->ISATTENDED->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ISATTENDED" id="z_ISATTENDED" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ISATTENDED->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ISATTENDED" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->ISATTENDED->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_ISATTENDED" name="x_ISATTENDED" id="x_ISATTENDED" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->ISATTENDED->getPlaceHolder()) ?>" value="<?= $Page->ISATTENDED->EditValue ?>"<?= $Page->ISATTENDED->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ISATTENDED->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <div id="r_PAYOR_ID" class="form-group row">
        <label for="x_PAYOR_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_PAYOR_ID"><?= $Page->PAYOR_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PAYOR_ID" id="z_PAYOR_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYOR_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_PAYOR_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_PAYOR_ID"
        name="x_PAYOR_ID"
        class="form-control ew-select<?= $Page->PAYOR_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_PAYOR_ID"
        data-table="V_RADIOLOGI"
        data-field="x_PAYOR_ID"
        data-value-separator="<?= $Page->PAYOR_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PAYOR_ID->getPlaceHolder()) ?>"
        <?= $Page->PAYOR_ID->editAttributes() ?>>
        <?= $Page->PAYOR_ID->selectOptionListHtml("x_PAYOR_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PAYOR_ID->getErrorMessage(false) ?></div>
<?= $Page->PAYOR_ID->Lookup->getParamTag($Page, "p_x_PAYOR_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_PAYOR_ID']"),
        options = { name: "x_PAYOR_ID", selectId: "V_RADIOLOGI_x_PAYOR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.PAYOR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <div id="r_CLASS_ID" class="form-group row">
        <label for="x_CLASS_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CLASS_ID"><?= $Page->CLASS_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_CLASS_ID" id="z_CLASS_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CLASS_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_CLASS_ID"
        name="x_CLASS_ID"
        class="form-control ew-select<?= $Page->CLASS_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_CLASS_ID"
        data-table="V_RADIOLOGI"
        data-field="x_CLASS_ID"
        data-value-separator="<?= $Page->CLASS_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLASS_ID->getPlaceHolder()) ?>"
        <?= $Page->CLASS_ID->editAttributes() ?>>
        <?= $Page->CLASS_ID->selectOptionListHtml("x_CLASS_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->CLASS_ID->getErrorMessage(false) ?></div>
<?= $Page->CLASS_ID->Lookup->getParamTag($Page, "p_x_CLASS_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_CLASS_ID']"),
        options = { name: "x_CLASS_ID", selectId: "V_RADIOLOGI_x_CLASS_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.CLASS_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->ISPERTARIF->Visible) { // ISPERTARIF ?>
    <div id="r_ISPERTARIF" class="form-group row">
        <label for="x_ISPERTARIF" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ISPERTARIF"><?= $Page->ISPERTARIF->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ISPERTARIF" id="z_ISPERTARIF" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ISPERTARIF->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ISPERTARIF" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->ISPERTARIF->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_ISPERTARIF" name="x_ISPERTARIF" id="x_ISPERTARIF" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->ISPERTARIF->getPlaceHolder()) ?>" value="<?= $Page->ISPERTARIF->EditValue ?>"<?= $Page->ISPERTARIF->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ISPERTARIF->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->KAL_ID->Visible) { // KAL_ID ?>
    <div id="r_KAL_ID" class="form-group row">
        <label for="x_KAL_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_KAL_ID"><?= $Page->KAL_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_KAL_ID" id="z_KAL_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KAL_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_KAL_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_KAL_ID"
        name="x_KAL_ID"
        class="form-control ew-select<?= $Page->KAL_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_KAL_ID"
        data-table="V_RADIOLOGI"
        data-field="x_KAL_ID"
        data-value-separator="<?= $Page->KAL_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KAL_ID->getPlaceHolder()) ?>"
        <?= $Page->KAL_ID->editAttributes() ?>>
        <?= $Page->KAL_ID->selectOptionListHtml("x_KAL_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KAL_ID->getErrorMessage(false) ?></div>
<?= $Page->KAL_ID->Lookup->getParamTag($Page, "p_x_KAL_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_KAL_ID']"),
        options = { name: "x_KAL_ID", selectId: "V_RADIOLOGI_x_KAL_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.KAL_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->EMPLOYEE_INAP->Visible) { // EMPLOYEE_INAP ?>
    <div id="r_EMPLOYEE_INAP" class="form-group row">
        <label for="x_EMPLOYEE_INAP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_EMPLOYEE_INAP"><?= $Page->EMPLOYEE_INAP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_EMPLOYEE_INAP" id="z_EMPLOYEE_INAP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EMPLOYEE_INAP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_EMPLOYEE_INAP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->EMPLOYEE_INAP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_EMPLOYEE_INAP" name="x_EMPLOYEE_INAP" id="x_EMPLOYEE_INAP" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->EMPLOYEE_INAP->getPlaceHolder()) ?>" value="<?= $Page->EMPLOYEE_INAP->EditValue ?>"<?= $Page->EMPLOYEE_INAP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->EMPLOYEE_INAP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
    <div id="r_PASIEN_ID" class="form-group row">
        <label for="x_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_PASIEN_ID"><?= $Page->PASIEN_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PASIEN_ID" id="z_PASIEN_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PASIEN_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_PASIEN_ID" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->PASIEN_ID->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_PASIEN_ID" name="x_PASIEN_ID" id="x_PASIEN_ID" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->PASIEN_ID->getPlaceHolder()) ?>" value="<?= $Page->PASIEN_ID->EditValue ?>"<?= $Page->PASIEN_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->PASIEN_ID->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->KARYAWAN->Visible) { // KARYAWAN ?>
    <div id="r_KARYAWAN" class="form-group row">
        <label for="x_KARYAWAN" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_KARYAWAN"><?= $Page->KARYAWAN->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_KARYAWAN" id="z_KARYAWAN" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KARYAWAN->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_KARYAWAN" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->KARYAWAN->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_KARYAWAN" name="x_KARYAWAN" id="x_KARYAWAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KARYAWAN->getPlaceHolder()) ?>" value="<?= $Page->KARYAWAN->EditValue ?>"<?= $Page->KARYAWAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->KARYAWAN->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->ACCOUNT_ID->Visible) { // ACCOUNT_ID ?>
    <div id="r_ACCOUNT_ID" class="form-group row">
        <label for="x_ACCOUNT_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ACCOUNT_ID"><?= $Page->ACCOUNT_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ACCOUNT_ID" id="z_ACCOUNT_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ACCOUNT_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ACCOUNT_ID" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->ACCOUNT_ID->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_ACCOUNT_ID" name="x_ACCOUNT_ID" id="x_ACCOUNT_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ACCOUNT_ID->getPlaceHolder()) ?>" value="<?= $Page->ACCOUNT_ID->EditValue ?>"<?= $Page->ACCOUNT_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ACCOUNT_ID->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ID_PLAFOND->Visible) { // CLASS_ID_PLAFOND ?>
    <div id="r_CLASS_ID_PLAFOND" class="form-group row">
        <label for="x_CLASS_ID_PLAFOND" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CLASS_ID_PLAFOND"><?= $Page->CLASS_ID_PLAFOND->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_CLASS_ID_PLAFOND" id="z_CLASS_ID_PLAFOND" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ID_PLAFOND->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CLASS_ID_PLAFOND" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->CLASS_ID_PLAFOND->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_CLASS_ID_PLAFOND" name="x_CLASS_ID_PLAFOND" id="x_CLASS_ID_PLAFOND" size="30" placeholder="<?= HtmlEncode($Page->CLASS_ID_PLAFOND->getPlaceHolder()) ?>" value="<?= $Page->CLASS_ID_PLAFOND->EditValue ?>"<?= $Page->CLASS_ID_PLAFOND->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->CLASS_ID_PLAFOND->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->BACKCHARGE->Visible) { // BACKCHARGE ?>
    <div id="r_BACKCHARGE" class="form-group row">
        <label for="x_BACKCHARGE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_BACKCHARGE"><?= $Page->BACKCHARGE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BACKCHARGE" id="z_BACKCHARGE" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->BACKCHARGE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_BACKCHARGE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->BACKCHARGE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_BACKCHARGE" name="x_BACKCHARGE" id="x_BACKCHARGE" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->BACKCHARGE->getPlaceHolder()) ?>" value="<?= $Page->BACKCHARGE->EditValue ?>"<?= $Page->BACKCHARGE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->BACKCHARGE->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <div id="r_COVERAGE_ID" class="form-group row">
        <label for="x_COVERAGE_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_COVERAGE_ID"><?= $Page->COVERAGE_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_COVERAGE_ID" id="z_COVERAGE_ID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COVERAGE_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_COVERAGE_ID" class="ew-search-field ew-search-field-single">
    <select
        id="x_COVERAGE_ID"
        name="x_COVERAGE_ID"
        class="form-control ew-select<?= $Page->COVERAGE_ID->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_COVERAGE_ID"
        data-table="V_RADIOLOGI"
        data-field="x_COVERAGE_ID"
        data-value-separator="<?= $Page->COVERAGE_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->COVERAGE_ID->getPlaceHolder()) ?>"
        <?= $Page->COVERAGE_ID->editAttributes() ?>>
        <?= $Page->COVERAGE_ID->selectOptionListHtml("x_COVERAGE_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->COVERAGE_ID->getErrorMessage(false) ?></div>
<?= $Page->COVERAGE_ID->Lookup->getParamTag($Page, "p_x_COVERAGE_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_COVERAGE_ID']"),
        options = { name: "x_COVERAGE_ID", selectId: "V_RADIOLOGI_x_COVERAGE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.COVERAGE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->AGEYEAR->Visible) { // AGEYEAR ?>
    <div id="r_AGEYEAR" class="form-group row">
        <label for="x_AGEYEAR" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_AGEYEAR"><?= $Page->AGEYEAR->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_AGEYEAR" id="z_AGEYEAR" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->AGEYEAR->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_AGEYEAR" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->AGEYEAR->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_AGEYEAR" name="x_AGEYEAR" id="x_AGEYEAR" size="30" placeholder="<?= HtmlEncode($Page->AGEYEAR->getPlaceHolder()) ?>" value="<?= $Page->AGEYEAR->EditValue ?>"<?= $Page->AGEYEAR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->AGEYEAR->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->AGEMONTH->Visible) { // AGEMONTH ?>
    <div id="r_AGEMONTH" class="form-group row">
        <label for="x_AGEMONTH" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_AGEMONTH"><?= $Page->AGEMONTH->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_AGEMONTH" id="z_AGEMONTH" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->AGEMONTH->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_AGEMONTH" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->AGEMONTH->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_AGEMONTH" name="x_AGEMONTH" id="x_AGEMONTH" size="30" placeholder="<?= HtmlEncode($Page->AGEMONTH->getPlaceHolder()) ?>" value="<?= $Page->AGEMONTH->EditValue ?>"<?= $Page->AGEMONTH->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->AGEMONTH->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->AGEDAY->Visible) { // AGEDAY ?>
    <div id="r_AGEDAY" class="form-group row">
        <label for="x_AGEDAY" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_AGEDAY"><?= $Page->AGEDAY->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_AGEDAY" id="z_AGEDAY" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->AGEDAY->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_AGEDAY" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->AGEDAY->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_AGEDAY" name="x_AGEDAY" id="x_AGEDAY" size="30" placeholder="<?= HtmlEncode($Page->AGEDAY->getPlaceHolder()) ?>" value="<?= $Page->AGEDAY->EditValue ?>"<?= $Page->AGEDAY->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->AGEDAY->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RECOMENDATION->Visible) { // RECOMENDATION ?>
    <div id="r_RECOMENDATION" class="form-group row">
        <label for="x_RECOMENDATION" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RECOMENDATION"><?= $Page->RECOMENDATION->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RECOMENDATION" id="z_RECOMENDATION" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RECOMENDATION->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RECOMENDATION" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RECOMENDATION->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RECOMENDATION" name="x_RECOMENDATION" id="x_RECOMENDATION" size="30" maxlength="8000" placeholder="<?= HtmlEncode($Page->RECOMENDATION->getPlaceHolder()) ?>" value="<?= $Page->RECOMENDATION->EditValue ?>"<?= $Page->RECOMENDATION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RECOMENDATION->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CONCLUSION->Visible) { // CONCLUSION ?>
    <div id="r_CONCLUSION" class="form-group row">
        <label for="x_CONCLUSION" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CONCLUSION"><?= $Page->CONCLUSION->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CONCLUSION" id="z_CONCLUSION" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CONCLUSION->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CONCLUSION" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->CONCLUSION->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_CONCLUSION" name="x_CONCLUSION" id="x_CONCLUSION" size="30" maxlength="8000" placeholder="<?= HtmlEncode($Page->CONCLUSION->getPlaceHolder()) ?>" value="<?= $Page->CONCLUSION->EditValue ?>"<?= $Page->CONCLUSION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->CONCLUSION->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->SPECIMENNO->Visible) { // SPECIMENNO ?>
    <div id="r_SPECIMENNO" class="form-group row">
        <label for="x_SPECIMENNO" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_SPECIMENNO"><?= $Page->SPECIMENNO->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SPECIMENNO" id="z_SPECIMENNO" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SPECIMENNO->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_SPECIMENNO" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->SPECIMENNO->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_SPECIMENNO" name="x_SPECIMENNO" id="x_SPECIMENNO" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SPECIMENNO->getPlaceHolder()) ?>" value="<?= $Page->SPECIMENNO->EditValue ?>"<?= $Page->SPECIMENNO->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->SPECIMENNO->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LOCKED->Visible) { // LOCKED ?>
    <div id="r_LOCKED" class="form-group row">
        <label for="x_LOCKED" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LOCKED"><?= $Page->LOCKED->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LOCKED" id="z_LOCKED" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LOCKED->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LOCKED" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LOCKED->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LOCKED" name="x_LOCKED" id="x_LOCKED" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LOCKED->getPlaceHolder()) ?>" value="<?= $Page->LOCKED->EditValue ?>"<?= $Page->LOCKED->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LOCKED->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RM_OUT_DATE->Visible) { // RM_OUT_DATE ?>
    <div id="r_RM_OUT_DATE" class="form-group row">
        <label for="x_RM_OUT_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RM_OUT_DATE"><?= $Page->RM_OUT_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_RM_OUT_DATE" id="z_RM_OUT_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RM_OUT_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RM_OUT_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RM_OUT_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RM_OUT_DATE" name="x_RM_OUT_DATE" id="x_RM_OUT_DATE" placeholder="<?= HtmlEncode($Page->RM_OUT_DATE->getPlaceHolder()) ?>" value="<?= $Page->RM_OUT_DATE->EditValue ?>"<?= $Page->RM_OUT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RM_OUT_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->RM_OUT_DATE->ReadOnly && !$Page->RM_OUT_DATE->Disabled && !isset($Page->RM_OUT_DATE->EditAttrs["readonly"]) && !isset($Page->RM_OUT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_RM_OUT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RM_IN_DATE->Visible) { // RM_IN_DATE ?>
    <div id="r_RM_IN_DATE" class="form-group row">
        <label for="x_RM_IN_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RM_IN_DATE"><?= $Page->RM_IN_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_RM_IN_DATE" id="z_RM_IN_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RM_IN_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RM_IN_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RM_IN_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RM_IN_DATE" name="x_RM_IN_DATE" id="x_RM_IN_DATE" placeholder="<?= HtmlEncode($Page->RM_IN_DATE->getPlaceHolder()) ?>" value="<?= $Page->RM_IN_DATE->EditValue ?>"<?= $Page->RM_IN_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RM_IN_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->RM_IN_DATE->ReadOnly && !$Page->RM_IN_DATE->Disabled && !isset($Page->RM_IN_DATE->EditAttrs["readonly"]) && !isset($Page->RM_IN_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_RM_IN_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LAMA_PINJAM->Visible) { // LAMA_PINJAM ?>
    <div id="r_LAMA_PINJAM" class="form-group row">
        <label for="x_LAMA_PINJAM" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LAMA_PINJAM"><?= $Page->LAMA_PINJAM->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_LAMA_PINJAM" id="z_LAMA_PINJAM" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LAMA_PINJAM->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LAMA_PINJAM" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LAMA_PINJAM->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LAMA_PINJAM" name="x_LAMA_PINJAM" id="x_LAMA_PINJAM" placeholder="<?= HtmlEncode($Page->LAMA_PINJAM->getPlaceHolder()) ?>" value="<?= $Page->LAMA_PINJAM->EditValue ?>"<?= $Page->LAMA_PINJAM->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LAMA_PINJAM->getErrorMessage(false) ?></div>
<?php if (!$Page->LAMA_PINJAM->ReadOnly && !$Page->LAMA_PINJAM->Disabled && !isset($Page->LAMA_PINJAM->EditAttrs["readonly"]) && !isset($Page->LAMA_PINJAM->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_LAMA_PINJAM", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->STANDAR_RJ->Visible) { // STANDAR_RJ ?>
    <div id="r_STANDAR_RJ" class="form-group row">
        <label for="x_STANDAR_RJ" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_STANDAR_RJ"><?= $Page->STANDAR_RJ->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_STANDAR_RJ" id="z_STANDAR_RJ" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STANDAR_RJ->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_STANDAR_RJ" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->STANDAR_RJ->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_STANDAR_RJ" name="x_STANDAR_RJ" id="x_STANDAR_RJ" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->STANDAR_RJ->getPlaceHolder()) ?>" value="<?= $Page->STANDAR_RJ->EditValue ?>"<?= $Page->STANDAR_RJ->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->STANDAR_RJ->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LENGKAP_RJ->Visible) { // LENGKAP_RJ ?>
    <div id="r_LENGKAP_RJ" class="form-group row">
        <label for="x_LENGKAP_RJ" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LENGKAP_RJ"><?= $Page->LENGKAP_RJ->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LENGKAP_RJ" id="z_LENGKAP_RJ" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LENGKAP_RJ->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LENGKAP_RJ" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LENGKAP_RJ->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LENGKAP_RJ" name="x_LENGKAP_RJ" id="x_LENGKAP_RJ" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LENGKAP_RJ->getPlaceHolder()) ?>" value="<?= $Page->LENGKAP_RJ->EditValue ?>"<?= $Page->LENGKAP_RJ->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LENGKAP_RJ->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LENGKAP_RI->Visible) { // LENGKAP_RI ?>
    <div id="r_LENGKAP_RI" class="form-group row">
        <label for="x_LENGKAP_RI" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LENGKAP_RI"><?= $Page->LENGKAP_RI->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LENGKAP_RI" id="z_LENGKAP_RI" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LENGKAP_RI->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LENGKAP_RI" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LENGKAP_RI->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LENGKAP_RI" name="x_LENGKAP_RI" id="x_LENGKAP_RI" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LENGKAP_RI->getPlaceHolder()) ?>" value="<?= $Page->LENGKAP_RI->EditValue ?>"<?= $Page->LENGKAP_RI->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LENGKAP_RI->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RESEND_RM_DATE->Visible) { // RESEND_RM_DATE ?>
    <div id="r_RESEND_RM_DATE" class="form-group row">
        <label for="x_RESEND_RM_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RESEND_RM_DATE"><?= $Page->RESEND_RM_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_RESEND_RM_DATE" id="z_RESEND_RM_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESEND_RM_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RESEND_RM_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RESEND_RM_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RESEND_RM_DATE" name="x_RESEND_RM_DATE" id="x_RESEND_RM_DATE" placeholder="<?= HtmlEncode($Page->RESEND_RM_DATE->getPlaceHolder()) ?>" value="<?= $Page->RESEND_RM_DATE->EditValue ?>"<?= $Page->RESEND_RM_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RESEND_RM_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->RESEND_RM_DATE->ReadOnly && !$Page->RESEND_RM_DATE->Disabled && !isset($Page->RESEND_RM_DATE->EditAttrs["readonly"]) && !isset($Page->RESEND_RM_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_RESEND_RM_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LENGKAP_RM1->Visible) { // LENGKAP_RM1 ?>
    <div id="r_LENGKAP_RM1" class="form-group row">
        <label for="x_LENGKAP_RM1" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LENGKAP_RM1"><?= $Page->LENGKAP_RM1->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LENGKAP_RM1" id="z_LENGKAP_RM1" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LENGKAP_RM1->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LENGKAP_RM1" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LENGKAP_RM1->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LENGKAP_RM1" name="x_LENGKAP_RM1" id="x_LENGKAP_RM1" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LENGKAP_RM1->getPlaceHolder()) ?>" value="<?= $Page->LENGKAP_RM1->EditValue ?>"<?= $Page->LENGKAP_RM1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LENGKAP_RM1->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LENGKAP_RESUME->Visible) { // LENGKAP_RESUME ?>
    <div id="r_LENGKAP_RESUME" class="form-group row">
        <label for="x_LENGKAP_RESUME" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LENGKAP_RESUME"><?= $Page->LENGKAP_RESUME->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LENGKAP_RESUME" id="z_LENGKAP_RESUME" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LENGKAP_RESUME->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LENGKAP_RESUME" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LENGKAP_RESUME->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LENGKAP_RESUME" name="x_LENGKAP_RESUME" id="x_LENGKAP_RESUME" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LENGKAP_RESUME->getPlaceHolder()) ?>" value="<?= $Page->LENGKAP_RESUME->EditValue ?>"<?= $Page->LENGKAP_RESUME->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LENGKAP_RESUME->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LENGKAP_ANAMNESIS->Visible) { // LENGKAP_ANAMNESIS ?>
    <div id="r_LENGKAP_ANAMNESIS" class="form-group row">
        <label for="x_LENGKAP_ANAMNESIS" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LENGKAP_ANAMNESIS"><?= $Page->LENGKAP_ANAMNESIS->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LENGKAP_ANAMNESIS" id="z_LENGKAP_ANAMNESIS" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LENGKAP_ANAMNESIS->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LENGKAP_ANAMNESIS" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LENGKAP_ANAMNESIS->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LENGKAP_ANAMNESIS" name="x_LENGKAP_ANAMNESIS" id="x_LENGKAP_ANAMNESIS" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LENGKAP_ANAMNESIS->getPlaceHolder()) ?>" value="<?= $Page->LENGKAP_ANAMNESIS->EditValue ?>"<?= $Page->LENGKAP_ANAMNESIS->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LENGKAP_ANAMNESIS->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LENGKAP_CONSENT->Visible) { // LENGKAP_CONSENT ?>
    <div id="r_LENGKAP_CONSENT" class="form-group row">
        <label for="x_LENGKAP_CONSENT" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LENGKAP_CONSENT"><?= $Page->LENGKAP_CONSENT->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LENGKAP_CONSENT" id="z_LENGKAP_CONSENT" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LENGKAP_CONSENT->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LENGKAP_CONSENT" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LENGKAP_CONSENT->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LENGKAP_CONSENT" name="x_LENGKAP_CONSENT" id="x_LENGKAP_CONSENT" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LENGKAP_CONSENT->getPlaceHolder()) ?>" value="<?= $Page->LENGKAP_CONSENT->EditValue ?>"<?= $Page->LENGKAP_CONSENT->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LENGKAP_CONSENT->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LENGKAP_ANESTESI->Visible) { // LENGKAP_ANESTESI ?>
    <div id="r_LENGKAP_ANESTESI" class="form-group row">
        <label for="x_LENGKAP_ANESTESI" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LENGKAP_ANESTESI"><?= $Page->LENGKAP_ANESTESI->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LENGKAP_ANESTESI" id="z_LENGKAP_ANESTESI" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LENGKAP_ANESTESI->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LENGKAP_ANESTESI" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LENGKAP_ANESTESI->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LENGKAP_ANESTESI" name="x_LENGKAP_ANESTESI" id="x_LENGKAP_ANESTESI" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LENGKAP_ANESTESI->getPlaceHolder()) ?>" value="<?= $Page->LENGKAP_ANESTESI->EditValue ?>"<?= $Page->LENGKAP_ANESTESI->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LENGKAP_ANESTESI->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LENGKAP_OP->Visible) { // LENGKAP_OP ?>
    <div id="r_LENGKAP_OP" class="form-group row">
        <label for="x_LENGKAP_OP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LENGKAP_OP"><?= $Page->LENGKAP_OP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LENGKAP_OP" id="z_LENGKAP_OP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LENGKAP_OP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LENGKAP_OP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LENGKAP_OP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LENGKAP_OP" name="x_LENGKAP_OP" id="x_LENGKAP_OP" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->LENGKAP_OP->getPlaceHolder()) ?>" value="<?= $Page->LENGKAP_OP->EditValue ?>"<?= $Page->LENGKAP_OP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LENGKAP_OP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->BACK_RM_DATE->Visible) { // BACK_RM_DATE ?>
    <div id="r_BACK_RM_DATE" class="form-group row">
        <label for="x_BACK_RM_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_BACK_RM_DATE"><?= $Page->BACK_RM_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_BACK_RM_DATE" id="z_BACK_RM_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->BACK_RM_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_BACK_RM_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->BACK_RM_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_BACK_RM_DATE" name="x_BACK_RM_DATE" id="x_BACK_RM_DATE" placeholder="<?= HtmlEncode($Page->BACK_RM_DATE->getPlaceHolder()) ?>" value="<?= $Page->BACK_RM_DATE->EditValue ?>"<?= $Page->BACK_RM_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->BACK_RM_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->BACK_RM_DATE->ReadOnly && !$Page->BACK_RM_DATE->Disabled && !isset($Page->BACK_RM_DATE->EditAttrs["readonly"]) && !isset($Page->BACK_RM_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_BACK_RM_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->VALID_RM_DATE->Visible) { // VALID_RM_DATE ?>
    <div id="r_VALID_RM_DATE" class="form-group row">
        <label for="x_VALID_RM_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_VALID_RM_DATE"><?= $Page->VALID_RM_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_VALID_RM_DATE" id="z_VALID_RM_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->VALID_RM_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_VALID_RM_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->VALID_RM_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_VALID_RM_DATE" name="x_VALID_RM_DATE" id="x_VALID_RM_DATE" placeholder="<?= HtmlEncode($Page->VALID_RM_DATE->getPlaceHolder()) ?>" value="<?= $Page->VALID_RM_DATE->EditValue ?>"<?= $Page->VALID_RM_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->VALID_RM_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->VALID_RM_DATE->ReadOnly && !$Page->VALID_RM_DATE->Disabled && !isset($Page->VALID_RM_DATE->EditAttrs["readonly"]) && !isset($Page->VALID_RM_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_VALID_RM_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_SKP->Visible) { // NO_SKP ?>
    <div id="r_NO_SKP" class="form-group row">
        <label for="x_NO_SKP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_NO_SKP"><?= $Page->NO_SKP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NO_SKP" id="z_NO_SKP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_SKP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_NO_SKP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->NO_SKP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_NO_SKP" name="x_NO_SKP" id="x_NO_SKP" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->NO_SKP->getPlaceHolder()) ?>" value="<?= $Page->NO_SKP->EditValue ?>"<?= $Page->NO_SKP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->NO_SKP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_SKPINAP->Visible) { // NO_SKPINAP ?>
    <div id="r_NO_SKPINAP" class="form-group row">
        <label for="x_NO_SKPINAP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_NO_SKPINAP"><?= $Page->NO_SKPINAP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NO_SKPINAP" id="z_NO_SKPINAP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_SKPINAP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_NO_SKPINAP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->NO_SKPINAP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_NO_SKPINAP" name="x_NO_SKPINAP" id="x_NO_SKPINAP" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->NO_SKPINAP->getPlaceHolder()) ?>" value="<?= $Page->NO_SKPINAP->EditValue ?>"<?= $Page->NO_SKPINAP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->NO_SKPINAP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <div id="r_DIAGNOSA_ID" class="form-group row">
        <label for="x_DIAGNOSA_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_DIAGNOSA_ID"><?= $Page->DIAGNOSA_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DIAGNOSA_ID" id="z_DIAGNOSA_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_DIAGNOSA_ID" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID"><?= EmptyValue(strval($Page->DIAGNOSA_ID->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID->ReadOnly || $Page->DIAGNOSA_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID->getErrorMessage(false) ?></div>
<?= $Page->DIAGNOSA_ID->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID") ?>
<input type="hidden" is="selection-list" data-table="V_RADIOLOGI" data-field="x_DIAGNOSA_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID" id="x_DIAGNOSA_ID" value="<?= $Page->DIAGNOSA_ID->AdvancedSearch->SearchValue ?>"<?= $Page->DIAGNOSA_ID->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->ticket_all->Visible) { // ticket_all ?>
    <div id="r_ticket_all" class="form-group row">
        <label for="x_ticket_all" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ticket_all"><?= $Page->ticket_all->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_ticket_all" id="z_ticket_all" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ticket_all->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ticket_all" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->ticket_all->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_ticket_all" name="x_ticket_all" id="x_ticket_all" size="30" placeholder="<?= HtmlEncode($Page->ticket_all->getPlaceHolder()) ?>" value="<?= $Page->ticket_all->EditValue ?>"<?= $Page->ticket_all->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ticket_all->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_rujukan->Visible) { // tanggal_rujukan ?>
    <div id="r_tanggal_rujukan" class="form-group row">
        <label for="x_tanggal_rujukan" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_tanggal_rujukan"><?= $Page->tanggal_rujukan->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal_rujukan" id="z_tanggal_rujukan" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal_rujukan->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_tanggal_rujukan" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->tanggal_rujukan->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_tanggal_rujukan" name="x_tanggal_rujukan" id="x_tanggal_rujukan" placeholder="<?= HtmlEncode($Page->tanggal_rujukan->getPlaceHolder()) ?>" value="<?= $Page->tanggal_rujukan->EditValue ?>"<?= $Page->tanggal_rujukan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->tanggal_rujukan->getErrorMessage(false) ?></div>
<?php if (!$Page->tanggal_rujukan->ReadOnly && !$Page->tanggal_rujukan->Disabled && !isset($Page->tanggal_rujukan->EditAttrs["readonly"]) && !isset($Page->tanggal_rujukan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_tanggal_rujukan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->ISRJ->Visible) { // ISRJ ?>
    <div id="r_ISRJ" class="form-group row">
        <label for="x_ISRJ" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ISRJ"><?= $Page->ISRJ->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ISRJ" id="z_ISRJ" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ISRJ->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ISRJ" class="ew-search-field ew-search-field-single">
    <select
        id="x_ISRJ"
        name="x_ISRJ"
        class="form-control ew-select<?= $Page->ISRJ->isInvalidClass() ?>"
        data-select2-id="V_RADIOLOGI_x_ISRJ"
        data-table="V_RADIOLOGI"
        data-field="x_ISRJ"
        data-value-separator="<?= $Page->ISRJ->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ISRJ->getPlaceHolder()) ?>"
        <?= $Page->ISRJ->editAttributes() ?>>
        <?= $Page->ISRJ->selectOptionListHtml("x_ISRJ") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->ISRJ->getErrorMessage(false) ?></div>
<?= $Page->ISRJ->Lookup->getParamTag($Page, "p_x_ISRJ") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_RADIOLOGI_x_ISRJ']"),
        options = { name: "x_ISRJ", selectId: "V_RADIOLOGI_x_ISRJ", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_RADIOLOGI.fields.ISRJ.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->NORUJUKAN->Visible) { // NORUJUKAN ?>
    <div id="r_NORUJUKAN" class="form-group row">
        <label for="x_NORUJUKAN" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_NORUJUKAN"><?= $Page->NORUJUKAN->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NORUJUKAN" id="z_NORUJUKAN" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NORUJUKAN->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_NORUJUKAN" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->NORUJUKAN->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_NORUJUKAN" name="x_NORUJUKAN" id="x_NORUJUKAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->NORUJUKAN->getPlaceHolder()) ?>" value="<?= $Page->NORUJUKAN->EditValue ?>"<?= $Page->NORUJUKAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->NORUJUKAN->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->PPKRUJUKAN->Visible) { // PPKRUJUKAN ?>
    <div id="r_PPKRUJUKAN" class="form-group row">
        <label for="x_PPKRUJUKAN" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_PPKRUJUKAN"><?= $Page->PPKRUJUKAN->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PPKRUJUKAN" id="z_PPKRUJUKAN" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PPKRUJUKAN->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_PPKRUJUKAN" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PPKRUJUKAN"><?= EmptyValue(strval($Page->PPKRUJUKAN->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->PPKRUJUKAN->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->PPKRUJUKAN->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->PPKRUJUKAN->ReadOnly || $Page->PPKRUJUKAN->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PPKRUJUKAN',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->PPKRUJUKAN->getErrorMessage(false) ?></div>
<?= $Page->PPKRUJUKAN->Lookup->getParamTag($Page, "p_x_PPKRUJUKAN") ?>
<input type="hidden" is="selection-list" data-table="V_RADIOLOGI" data-field="x_PPKRUJUKAN" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->PPKRUJUKAN->displayValueSeparatorAttribute() ?>" name="x_PPKRUJUKAN" id="x_PPKRUJUKAN" value="<?= $Page->PPKRUJUKAN->AdvancedSearch->SearchValue ?>"<?= $Page->PPKRUJUKAN->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->LOKASILAKA->Visible) { // LOKASILAKA ?>
    <div id="r_LOKASILAKA" class="form-group row">
        <label for="x_LOKASILAKA" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_LOKASILAKA"><?= $Page->LOKASILAKA->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LOKASILAKA" id="z_LOKASILAKA" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LOKASILAKA->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_LOKASILAKA" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->LOKASILAKA->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_LOKASILAKA" name="x_LOKASILAKA" id="x_LOKASILAKA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->LOKASILAKA->getPlaceHolder()) ?>" value="<?= $Page->LOKASILAKA->EditValue ?>"<?= $Page->LOKASILAKA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->LOKASILAKA->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->KDPOLI->Visible) { // KDPOLI ?>
    <div id="r_KDPOLI" class="form-group row">
        <label for="x_KDPOLI" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_KDPOLI"><?= $Page->KDPOLI->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_KDPOLI" id="z_KDPOLI" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDPOLI->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_KDPOLI" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->KDPOLI->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_KDPOLI" name="x_KDPOLI" id="x_KDPOLI" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->KDPOLI->getPlaceHolder()) ?>" value="<?= $Page->KDPOLI->EditValue ?>"<?= $Page->KDPOLI->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->KDPOLI->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->EDIT_SEP->Visible) { // EDIT_SEP ?>
    <div id="r_EDIT_SEP" class="form-group row">
        <label for="x_EDIT_SEP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_EDIT_SEP"><?= $Page->EDIT_SEP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_EDIT_SEP" id="z_EDIT_SEP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EDIT_SEP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_EDIT_SEP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->EDIT_SEP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_EDIT_SEP" name="x_EDIT_SEP" id="x_EDIT_SEP" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->EDIT_SEP->getPlaceHolder()) ?>" value="<?= $Page->EDIT_SEP->EditValue ?>"<?= $Page->EDIT_SEP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->EDIT_SEP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->DELETE_SEP->Visible) { // DELETE_SEP ?>
    <div id="r_DELETE_SEP" class="form-group row">
        <label for="x_DELETE_SEP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_DELETE_SEP"><?= $Page->DELETE_SEP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DELETE_SEP" id="z_DELETE_SEP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DELETE_SEP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_DELETE_SEP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->DELETE_SEP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_DELETE_SEP" name="x_DELETE_SEP" id="x_DELETE_SEP" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->DELETE_SEP->getPlaceHolder()) ?>" value="<?= $Page->DELETE_SEP->EditValue ?>"<?= $Page->DELETE_SEP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DELETE_SEP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <div id="r_KODE_AGAMA" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_KODE_AGAMA"><?= $Page->KODE_AGAMA->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_KODE_AGAMA" id="z_KODE_AGAMA" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KODE_AGAMA->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_KODE_AGAMA" class="ew-search-field ew-search-field-single">
<template id="tp_x_KODE_AGAMA">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="V_RADIOLOGI" data-field="x_KODE_AGAMA" name="x_KODE_AGAMA" id="x_KODE_AGAMA"<?= $Page->KODE_AGAMA->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_KODE_AGAMA" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_KODE_AGAMA"
    name="x_KODE_AGAMA"
    value="<?= HtmlEncode($Page->KODE_AGAMA->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_KODE_AGAMA"
    data-target="dsl_x_KODE_AGAMA"
    data-repeatcolumn="5"
    class="form-control<?= $Page->KODE_AGAMA->isInvalidClass() ?>"
    data-table="V_RADIOLOGI"
    data-field="x_KODE_AGAMA"
    data-value-separator="<?= $Page->KODE_AGAMA->displayValueSeparatorAttribute() ?>"
    <?= $Page->KODE_AGAMA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->KODE_AGAMA->getErrorMessage(false) ?></div>
<?= $Page->KODE_AGAMA->Lookup->getParamTag($Page, "p_x_KODE_AGAMA") ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAG_AWAL->Visible) { // DIAG_AWAL ?>
    <div id="r_DIAG_AWAL" class="form-group row">
        <label for="x_DIAG_AWAL" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_DIAG_AWAL"><?= $Page->DIAG_AWAL->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DIAG_AWAL" id="z_DIAG_AWAL" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAG_AWAL->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_DIAG_AWAL" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->DIAG_AWAL->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_DIAG_AWAL" name="x_DIAG_AWAL" id="x_DIAG_AWAL" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->DIAG_AWAL->getPlaceHolder()) ?>" value="<?= $Page->DIAG_AWAL->EditValue ?>"<?= $Page->DIAG_AWAL->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DIAG_AWAL->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->AKTIF->Visible) { // AKTIF ?>
    <div id="r_AKTIF" class="form-group row">
        <label for="x_AKTIF" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_AKTIF"><?= $Page->AKTIF->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AKTIF" id="z_AKTIF" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->AKTIF->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_AKTIF" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->AKTIF->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_AKTIF" name="x_AKTIF" id="x_AKTIF" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->AKTIF->getPlaceHolder()) ?>" value="<?= $Page->AKTIF->EditValue ?>"<?= $Page->AKTIF->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->AKTIF->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->BILL_INAP->Visible) { // BILL_INAP ?>
    <div id="r_BILL_INAP" class="form-group row">
        <label for="x_BILL_INAP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_BILL_INAP"><?= $Page->BILL_INAP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BILL_INAP" id="z_BILL_INAP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->BILL_INAP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_BILL_INAP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->BILL_INAP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_BILL_INAP" name="x_BILL_INAP" id="x_BILL_INAP" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->BILL_INAP->getPlaceHolder()) ?>" value="<?= $Page->BILL_INAP->EditValue ?>"<?= $Page->BILL_INAP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->BILL_INAP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->SEP_PRINTDATE->Visible) { // SEP_PRINTDATE ?>
    <div id="r_SEP_PRINTDATE" class="form-group row">
        <label for="x_SEP_PRINTDATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_SEP_PRINTDATE"><?= $Page->SEP_PRINTDATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_SEP_PRINTDATE" id="z_SEP_PRINTDATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEP_PRINTDATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_SEP_PRINTDATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->SEP_PRINTDATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_SEP_PRINTDATE" name="x_SEP_PRINTDATE" id="x_SEP_PRINTDATE" placeholder="<?= HtmlEncode($Page->SEP_PRINTDATE->getPlaceHolder()) ?>" value="<?= $Page->SEP_PRINTDATE->EditValue ?>"<?= $Page->SEP_PRINTDATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->SEP_PRINTDATE->getErrorMessage(false) ?></div>
<?php if (!$Page->SEP_PRINTDATE->ReadOnly && !$Page->SEP_PRINTDATE->Disabled && !isset($Page->SEP_PRINTDATE->EditAttrs["readonly"]) && !isset($Page->SEP_PRINTDATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_SEP_PRINTDATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->MAPPING_SEP->Visible) { // MAPPING_SEP ?>
    <div id="r_MAPPING_SEP" class="form-group row">
        <label for="x_MAPPING_SEP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_MAPPING_SEP"><?= $Page->MAPPING_SEP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MAPPING_SEP" id="z_MAPPING_SEP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MAPPING_SEP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_MAPPING_SEP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->MAPPING_SEP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_MAPPING_SEP" name="x_MAPPING_SEP" id="x_MAPPING_SEP" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->MAPPING_SEP->getPlaceHolder()) ?>" value="<?= $Page->MAPPING_SEP->EditValue ?>"<?= $Page->MAPPING_SEP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->MAPPING_SEP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->TRANS_ID->Visible) { // TRANS_ID ?>
    <div id="r_TRANS_ID" class="form-group row">
        <label for="x_TRANS_ID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_TRANS_ID"><?= $Page->TRANS_ID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TRANS_ID" id="z_TRANS_ID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TRANS_ID->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_TRANS_ID" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->TRANS_ID->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_TRANS_ID" name="x_TRANS_ID" id="x_TRANS_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->TRANS_ID->getPlaceHolder()) ?>" value="<?= $Page->TRANS_ID->EditValue ?>"<?= $Page->TRANS_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TRANS_ID->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->KDPOLI_EKS->Visible) { // KDPOLI_EKS ?>
    <div id="r_KDPOLI_EKS" class="form-group row">
        <label for="x_KDPOLI_EKS" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_KDPOLI_EKS"><?= $Page->KDPOLI_EKS->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_KDPOLI_EKS" id="z_KDPOLI_EKS" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDPOLI_EKS->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_KDPOLI_EKS" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->KDPOLI_EKS->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_KDPOLI_EKS" name="x_KDPOLI_EKS" id="x_KDPOLI_EKS" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->KDPOLI_EKS->getPlaceHolder()) ?>" value="<?= $Page->KDPOLI_EKS->EditValue ?>"<?= $Page->KDPOLI_EKS->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->KDPOLI_EKS->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->COB->Visible) { // COB ?>
    <div id="r_COB" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_COB"><?= $Page->COB->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_COB" id="z_COB" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COB->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_COB" class="ew-search-field ew-search-field-single">
<template id="tp_x_COB">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" data-table="V_RADIOLOGI" data-field="x_COB" name="x_COB" id="x_COB"<?= $Page->COB->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_COB" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_COB[]"
    name="x_COB[]"
    value="<?= HtmlEncode($Page->COB->AdvancedSearch->SearchValue) ?>"
    data-type="select-multiple"
    data-template="tp_x_COB"
    data-target="dsl_x_COB"
    data-repeatcolumn="5"
    class="form-control<?= $Page->COB->isInvalidClass() ?>"
    data-table="V_RADIOLOGI"
    data-field="x_COB"
    data-value-separator="<?= $Page->COB->displayValueSeparatorAttribute() ?>"
    <?= $Page->COB->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->COB->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->PENJAMIN->Visible) { // PENJAMIN ?>
    <div id="r_PENJAMIN" class="form-group row">
        <label for="x_PENJAMIN" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_PENJAMIN"><?= $Page->PENJAMIN->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PENJAMIN" id="z_PENJAMIN" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PENJAMIN->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_PENJAMIN" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->PENJAMIN->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_PENJAMIN" name="x_PENJAMIN" id="x_PENJAMIN" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->PENJAMIN->getPlaceHolder()) ?>" value="<?= $Page->PENJAMIN->EditValue ?>"<?= $Page->PENJAMIN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->PENJAMIN->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->ASALRUJUKAN->Visible) { // ASALRUJUKAN ?>
    <div id="r_ASALRUJUKAN" class="form-group row">
        <label for="x_ASALRUJUKAN" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_ASALRUJUKAN"><?= $Page->ASALRUJUKAN->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ASALRUJUKAN" id="z_ASALRUJUKAN" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ASALRUJUKAN->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_ASALRUJUKAN" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->ASALRUJUKAN->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_ASALRUJUKAN" name="x_ASALRUJUKAN" id="x_ASALRUJUKAN" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->ASALRUJUKAN->getPlaceHolder()) ?>" value="<?= $Page->ASALRUJUKAN->EditValue ?>"<?= $Page->ASALRUJUKAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ASALRUJUKAN->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RESPONSEP->Visible) { // RESPONSEP ?>
    <div id="r_RESPONSEP" class="form-group row">
        <label for="x_RESPONSEP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RESPONSEP"><?= $Page->RESPONSEP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RESPONSEP" id="z_RESPONSEP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESPONSEP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RESPONSEP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RESPONSEP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RESPONSEP" name="x_RESPONSEP" id="x_RESPONSEP" size="35" placeholder="<?= HtmlEncode($Page->RESPONSEP->getPlaceHolder()) ?>" value="<?= $Page->RESPONSEP->EditValue ?>"<?= $Page->RESPONSEP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RESPONSEP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->APPROVAL_DESC->Visible) { // APPROVAL_DESC ?>
    <div id="r_APPROVAL_DESC" class="form-group row">
        <label for="x_APPROVAL_DESC" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_APPROVAL_DESC"><?= $Page->APPROVAL_DESC->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_APPROVAL_DESC" id="z_APPROVAL_DESC" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->APPROVAL_DESC->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_APPROVAL_DESC" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->APPROVAL_DESC->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_APPROVAL_DESC" name="x_APPROVAL_DESC" id="x_APPROVAL_DESC" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->APPROVAL_DESC->getPlaceHolder()) ?>" value="<?= $Page->APPROVAL_DESC->EditValue ?>"<?= $Page->APPROVAL_DESC->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->APPROVAL_DESC->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->APPROVAL_RESPONAJUKAN->Visible) { // APPROVAL_RESPONAJUKAN ?>
    <div id="r_APPROVAL_RESPONAJUKAN" class="form-group row">
        <label for="x_APPROVAL_RESPONAJUKAN" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_APPROVAL_RESPONAJUKAN"><?= $Page->APPROVAL_RESPONAJUKAN->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_APPROVAL_RESPONAJUKAN" id="z_APPROVAL_RESPONAJUKAN" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->APPROVAL_RESPONAJUKAN->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_APPROVAL_RESPONAJUKAN" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->APPROVAL_RESPONAJUKAN->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_APPROVAL_RESPONAJUKAN" name="x_APPROVAL_RESPONAJUKAN" id="x_APPROVAL_RESPONAJUKAN" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->APPROVAL_RESPONAJUKAN->getPlaceHolder()) ?>" value="<?= $Page->APPROVAL_RESPONAJUKAN->EditValue ?>"<?= $Page->APPROVAL_RESPONAJUKAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->APPROVAL_RESPONAJUKAN->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->APPROVAL_RESPONAPPROV->Visible) { // APPROVAL_RESPONAPPROV ?>
    <div id="r_APPROVAL_RESPONAPPROV" class="form-group row">
        <label for="x_APPROVAL_RESPONAPPROV" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_APPROVAL_RESPONAPPROV"><?= $Page->APPROVAL_RESPONAPPROV->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_APPROVAL_RESPONAPPROV" id="z_APPROVAL_RESPONAPPROV" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->APPROVAL_RESPONAPPROV->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_APPROVAL_RESPONAPPROV" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->APPROVAL_RESPONAPPROV->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_APPROVAL_RESPONAPPROV" name="x_APPROVAL_RESPONAPPROV" id="x_APPROVAL_RESPONAPPROV" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->APPROVAL_RESPONAPPROV->getPlaceHolder()) ?>" value="<?= $Page->APPROVAL_RESPONAPPROV->EditValue ?>"<?= $Page->APPROVAL_RESPONAPPROV->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->APPROVAL_RESPONAPPROV->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RESPONTGLPLG_DESC->Visible) { // RESPONTGLPLG_DESC ?>
    <div id="r_RESPONTGLPLG_DESC" class="form-group row">
        <label for="x_RESPONTGLPLG_DESC" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RESPONTGLPLG_DESC"><?= $Page->RESPONTGLPLG_DESC->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RESPONTGLPLG_DESC" id="z_RESPONTGLPLG_DESC" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESPONTGLPLG_DESC->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RESPONTGLPLG_DESC" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RESPONTGLPLG_DESC->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RESPONTGLPLG_DESC" name="x_RESPONTGLPLG_DESC" id="x_RESPONTGLPLG_DESC" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->RESPONTGLPLG_DESC->getPlaceHolder()) ?>" value="<?= $Page->RESPONTGLPLG_DESC->EditValue ?>"<?= $Page->RESPONTGLPLG_DESC->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RESPONTGLPLG_DESC->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RESPONPOST_VKLAIM->Visible) { // RESPONPOST_VKLAIM ?>
    <div id="r_RESPONPOST_VKLAIM" class="form-group row">
        <label for="x_RESPONPOST_VKLAIM" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RESPONPOST_VKLAIM"><?= $Page->RESPONPOST_VKLAIM->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RESPONPOST_VKLAIM" id="z_RESPONPOST_VKLAIM" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESPONPOST_VKLAIM->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RESPONPOST_VKLAIM" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RESPONPOST_VKLAIM->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RESPONPOST_VKLAIM" name="x_RESPONPOST_VKLAIM" id="x_RESPONPOST_VKLAIM" size="35" placeholder="<?= HtmlEncode($Page->RESPONPOST_VKLAIM->getPlaceHolder()) ?>" value="<?= $Page->RESPONPOST_VKLAIM->EditValue ?>"<?= $Page->RESPONPOST_VKLAIM->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RESPONPOST_VKLAIM->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RESPONPUT_VKLAIM->Visible) { // RESPONPUT_VKLAIM ?>
    <div id="r_RESPONPUT_VKLAIM" class="form-group row">
        <label for="x_RESPONPUT_VKLAIM" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RESPONPUT_VKLAIM"><?= $Page->RESPONPUT_VKLAIM->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RESPONPUT_VKLAIM" id="z_RESPONPUT_VKLAIM" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESPONPUT_VKLAIM->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RESPONPUT_VKLAIM" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RESPONPUT_VKLAIM->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RESPONPUT_VKLAIM" name="x_RESPONPUT_VKLAIM" id="x_RESPONPUT_VKLAIM" size="35" placeholder="<?= HtmlEncode($Page->RESPONPUT_VKLAIM->getPlaceHolder()) ?>" value="<?= $Page->RESPONPUT_VKLAIM->EditValue ?>"<?= $Page->RESPONPUT_VKLAIM->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RESPONPUT_VKLAIM->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->RESPONDEL_VKLAIM->Visible) { // RESPONDEL_VKLAIM ?>
    <div id="r_RESPONDEL_VKLAIM" class="form-group row">
        <label for="x_RESPONDEL_VKLAIM" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_RESPONDEL_VKLAIM"><?= $Page->RESPONDEL_VKLAIM->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RESPONDEL_VKLAIM" id="z_RESPONDEL_VKLAIM" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESPONDEL_VKLAIM->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_RESPONDEL_VKLAIM" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->RESPONDEL_VKLAIM->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_RESPONDEL_VKLAIM" name="x_RESPONDEL_VKLAIM" id="x_RESPONDEL_VKLAIM" size="35" placeholder="<?= HtmlEncode($Page->RESPONDEL_VKLAIM->getPlaceHolder()) ?>" value="<?= $Page->RESPONDEL_VKLAIM->EditValue ?>"<?= $Page->RESPONDEL_VKLAIM->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->RESPONDEL_VKLAIM->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CALL_TIMES->Visible) { // CALL_TIMES ?>
    <div id="r_CALL_TIMES" class="form-group row">
        <label for="x_CALL_TIMES" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CALL_TIMES"><?= $Page->CALL_TIMES->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_CALL_TIMES" id="z_CALL_TIMES" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CALL_TIMES->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CALL_TIMES" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->CALL_TIMES->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_CALL_TIMES" name="x_CALL_TIMES" id="x_CALL_TIMES" size="30" placeholder="<?= HtmlEncode($Page->CALL_TIMES->getPlaceHolder()) ?>" value="<?= $Page->CALL_TIMES->EditValue ?>"<?= $Page->CALL_TIMES->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->CALL_TIMES->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CALL_DATE->Visible) { // CALL_DATE ?>
    <div id="r_CALL_DATE" class="form-group row">
        <label for="x_CALL_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CALL_DATE"><?= $Page->CALL_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_CALL_DATE" id="z_CALL_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CALL_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CALL_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->CALL_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_CALL_DATE" name="x_CALL_DATE" id="x_CALL_DATE" placeholder="<?= HtmlEncode($Page->CALL_DATE->getPlaceHolder()) ?>" value="<?= $Page->CALL_DATE->EditValue ?>"<?= $Page->CALL_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->CALL_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->CALL_DATE->ReadOnly && !$Page->CALL_DATE->Disabled && !isset($Page->CALL_DATE->EditAttrs["readonly"]) && !isset($Page->CALL_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_CALL_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->CALL_DATES->Visible) { // CALL_DATES ?>
    <div id="r_CALL_DATES" class="form-group row">
        <label for="x_CALL_DATES" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_CALL_DATES"><?= $Page->CALL_DATES->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_CALL_DATES" id="z_CALL_DATES" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CALL_DATES->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_CALL_DATES" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->CALL_DATES->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_CALL_DATES" name="x_CALL_DATES" id="x_CALL_DATES" placeholder="<?= HtmlEncode($Page->CALL_DATES->getPlaceHolder()) ?>" value="<?= $Page->CALL_DATES->EditValue ?>"<?= $Page->CALL_DATES->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->CALL_DATES->getErrorMessage(false) ?></div>
<?php if (!$Page->CALL_DATES->ReadOnly && !$Page->CALL_DATES->Disabled && !isset($Page->CALL_DATES->EditAttrs["readonly"]) && !isset($Page->CALL_DATES->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_CALL_DATES", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->SERVED_DATE->Visible) { // SERVED_DATE ?>
    <div id="r_SERVED_DATE" class="form-group row">
        <label for="x_SERVED_DATE" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_SERVED_DATE"><?= $Page->SERVED_DATE->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_SERVED_DATE" id="z_SERVED_DATE" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SERVED_DATE->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_SERVED_DATE" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->SERVED_DATE->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_SERVED_DATE" name="x_SERVED_DATE" id="x_SERVED_DATE" placeholder="<?= HtmlEncode($Page->SERVED_DATE->getPlaceHolder()) ?>" value="<?= $Page->SERVED_DATE->EditValue ?>"<?= $Page->SERVED_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->SERVED_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->SERVED_DATE->ReadOnly && !$Page->SERVED_DATE->Disabled && !isset($Page->SERVED_DATE->EditAttrs["readonly"]) && !isset($Page->SERVED_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_SERVED_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->SERVED_INAP->Visible) { // SERVED_INAP ?>
    <div id="r_SERVED_INAP" class="form-group row">
        <label for="x_SERVED_INAP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_SERVED_INAP"><?= $Page->SERVED_INAP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_SERVED_INAP" id="z_SERVED_INAP" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SERVED_INAP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_SERVED_INAP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->SERVED_INAP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_SERVED_INAP" name="x_SERVED_INAP" id="x_SERVED_INAP" placeholder="<?= HtmlEncode($Page->SERVED_INAP->getPlaceHolder()) ?>" value="<?= $Page->SERVED_INAP->EditValue ?>"<?= $Page->SERVED_INAP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->SERVED_INAP->getErrorMessage(false) ?></div>
<?php if (!$Page->SERVED_INAP->ReadOnly && !$Page->SERVED_INAP->Disabled && !isset($Page->SERVED_INAP->EditAttrs["readonly"]) && !isset($Page->SERVED_INAP->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_SERVED_INAP", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->KDDPJP1->Visible) { // KDDPJP1 ?>
    <div id="r_KDDPJP1" class="form-group row">
        <label for="x_KDDPJP1" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_KDDPJP1"><?= $Page->KDDPJP1->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_KDDPJP1" id="z_KDDPJP1" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDDPJP1->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_KDDPJP1" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->KDDPJP1->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_KDDPJP1" name="x_KDDPJP1" id="x_KDDPJP1" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->KDDPJP1->getPlaceHolder()) ?>" value="<?= $Page->KDDPJP1->EditValue ?>"<?= $Page->KDDPJP1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->KDDPJP1->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->KDDPJP->Visible) { // KDDPJP ?>
    <div id="r_KDDPJP" class="form-group row">
        <label for="x_KDDPJP" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_KDDPJP"><?= $Page->KDDPJP->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_KDDPJP" id="z_KDDPJP" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDDPJP->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_KDDPJP" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->KDDPJP->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_KDDPJP" name="x_KDDPJP" id="x_KDDPJP" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->KDDPJP->getPlaceHolder()) ?>" value="<?= $Page->KDDPJP->EditValue ?>"<?= $Page->KDDPJP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->KDDPJP->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
    <div id="r_IDXDAFTAR" class="form-group row">
        <label for="x_IDXDAFTAR" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_IDXDAFTAR"><?= $Page->IDXDAFTAR->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_IDXDAFTAR" id="z_IDXDAFTAR" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->IDXDAFTAR->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_IDXDAFTAR" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->IDXDAFTAR->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_IDXDAFTAR" name="x_IDXDAFTAR" id="x_IDXDAFTAR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->IDXDAFTAR->getPlaceHolder()) ?>" value="<?= $Page->IDXDAFTAR->EditValue ?>"<?= $Page->IDXDAFTAR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->IDXDAFTAR->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
    <div id="r_tgl_kontrol" class="form-group row">
        <label for="x_tgl_kontrol" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_tgl_kontrol"><?= $Page->tgl_kontrol->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_kontrol" id="z_tgl_kontrol" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl_kontrol->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_tgl_kontrol" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->tgl_kontrol->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_tgl_kontrol" name="x_tgl_kontrol" id="x_tgl_kontrol" placeholder="<?= HtmlEncode($Page->tgl_kontrol->getPlaceHolder()) ?>" value="<?= $Page->tgl_kontrol->EditValue ?>"<?= $Page->tgl_kontrol->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->tgl_kontrol->getErrorMessage(false) ?></div>
<?php if (!$Page->tgl_kontrol->ReadOnly && !$Page->tgl_kontrol->Disabled && !isset($Page->tgl_kontrol->EditAttrs["readonly"]) && !isset($Page->tgl_kontrol->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_RADIOLOGIsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_RADIOLOGIsearch", "x_tgl_kontrol", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->idbooking->Visible) { // idbooking ?>
    <div id="r_idbooking" class="form-group row">
        <label for="x_idbooking" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_idbooking"><?= $Page->idbooking->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_idbooking" id="z_idbooking" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idbooking->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_idbooking" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->idbooking->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_idbooking" name="x_idbooking" id="x_idbooking" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->idbooking->getPlaceHolder()) ?>" value="<?= $Page->idbooking->EditValue ?>"<?= $Page->idbooking->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->idbooking->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
    <div id="r_id_tujuan" class="form-group row">
        <label for="x_id_tujuan" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_id_tujuan"><?= $Page->id_tujuan->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_tujuan" id="z_id_tujuan" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_tujuan->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_id_tujuan" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_tujuan->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_id_tujuan" name="x_id_tujuan" id="x_id_tujuan" size="30" placeholder="<?= HtmlEncode($Page->id_tujuan->getPlaceHolder()) ?>" value="<?= $Page->id_tujuan->EditValue ?>"<?= $Page->id_tujuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_tujuan->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
    <div id="r_id_penunjang" class="form-group row">
        <label for="x_id_penunjang" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_id_penunjang"><?= $Page->id_penunjang->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_penunjang" id="z_id_penunjang" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_penunjang->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_id_penunjang" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_penunjang->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_id_penunjang" name="x_id_penunjang" id="x_id_penunjang" size="30" placeholder="<?= HtmlEncode($Page->id_penunjang->getPlaceHolder()) ?>" value="<?= $Page->id_penunjang->EditValue ?>"<?= $Page->id_penunjang->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_penunjang->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
    <div id="r_id_pembiayaan" class="form-group row">
        <label for="x_id_pembiayaan" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_id_pembiayaan"><?= $Page->id_pembiayaan->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_pembiayaan" id="z_id_pembiayaan" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pembiayaan->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_id_pembiayaan" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_pembiayaan->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_id_pembiayaan" name="x_id_pembiayaan" id="x_id_pembiayaan" size="30" placeholder="<?= HtmlEncode($Page->id_pembiayaan->getPlaceHolder()) ?>" value="<?= $Page->id_pembiayaan->EditValue ?>"<?= $Page->id_pembiayaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_pembiayaan->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
    <div id="r_id_procedure" class="form-group row">
        <label for="x_id_procedure" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_id_procedure"><?= $Page->id_procedure->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_procedure" id="z_id_procedure" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_procedure->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_id_procedure" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_procedure->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_id_procedure" name="x_id_procedure" id="x_id_procedure" size="30" placeholder="<?= HtmlEncode($Page->id_procedure->getPlaceHolder()) ?>" value="<?= $Page->id_procedure->EditValue ?>"<?= $Page->id_procedure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_procedure->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
    <div id="r_id_aspel" class="form-group row">
        <label for="x_id_aspel" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_id_aspel"><?= $Page->id_aspel->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_aspel" id="z_id_aspel" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_aspel->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_id_aspel" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_aspel->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_id_aspel" name="x_id_aspel" id="x_id_aspel" size="30" placeholder="<?= HtmlEncode($Page->id_aspel->getPlaceHolder()) ?>" value="<?= $Page->id_aspel->EditValue ?>"<?= $Page->id_aspel->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_aspel->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
    <div id="r_id_kelas" class="form-group row">
        <label for="x_id_kelas" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_RADIOLOGI_id_kelas"><?= $Page->id_kelas->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_kelas" id="z_id_kelas" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_kelas->cellAttributes() ?>>
            <span id="el_V_RADIOLOGI_id_kelas" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_kelas->getInputTextType() ?>" data-table="V_RADIOLOGI" data-field="x_id_kelas" name="x_id_kelas" id="x_id_kelas" size="30" placeholder="<?= HtmlEncode($Page->id_kelas->getPlaceHolder()) ?>" value="<?= $Page->id_kelas->EditValue ?>"<?= $Page->id_kelas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_kelas->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("Search") ?></button>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="location.reload();"><?= $Language->phrase("Reset") ?></button>
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
    ew.addEventHandlers("V_RADIOLOGI");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
