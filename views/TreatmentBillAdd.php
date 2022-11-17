<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatmentBillAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fTREATMENT_BILLadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fTREATMENT_BILLadd = currentForm = new ew.Form("fTREATMENT_BILLadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "TREATMENT_BILL")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.TREATMENT_BILL)
        ew.vars.tables.TREATMENT_BILL = currentTable;
    fTREATMENT_BILLadd.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["BILL_ID", [fields.BILL_ID.visible && fields.BILL_ID.required ? ew.Validators.required(fields.BILL_ID.caption) : null], fields.BILL_ID.isInvalid],
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["VISIT_ID", [fields.VISIT_ID.visible && fields.VISIT_ID.required ? ew.Validators.required(fields.VISIT_ID.caption) : null], fields.VISIT_ID.isInvalid],
        ["TARIF_ID", [fields.TARIF_ID.visible && fields.TARIF_ID.required ? ew.Validators.required(fields.TARIF_ID.caption) : null], fields.TARIF_ID.isInvalid],
        ["TREATMENT", [fields.TREATMENT.visible && fields.TREATMENT.required ? ew.Validators.required(fields.TREATMENT.caption) : null], fields.TREATMENT.isInvalid],
        ["QUANTITY", [fields.QUANTITY.visible && fields.QUANTITY.required ? ew.Validators.required(fields.QUANTITY.caption) : null, ew.Validators.float], fields.QUANTITY.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fTREATMENT_BILLadd,
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
    fTREATMENT_BILLadd.validate = function () {
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
    fTREATMENT_BILLadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fTREATMENT_BILLadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fTREATMENT_BILLadd.lists.NO_REGISTRATION = <?= $Page->NO_REGISTRATION->toClientList($Page) ?>;
    fTREATMENT_BILLadd.lists.TARIF_ID = <?= $Page->TARIF_ID->toClientList($Page) ?>;
    loadjs.done("fTREATMENT_BILLadd");
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
<form name="fTREATMENT_BILLadd" id="fTREATMENT_BILLadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREATMENT_BILL">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "V_LABORATORIUM") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_LABORATORIUM">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "V_RADIOLOGI") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_RADIOLOGI">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "V_FARMASI") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_FARMASI">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "V_KASIR") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_KASIR">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label id="elh_TREATMENT_BILL_NO_REGISTRATION" for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION->caption() ?><?= $Page->NO_REGISTRATION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_NO_REGISTRATION">
<div class="input-group ew-lookup-list" aria-describedby="x_NO_REGISTRATION_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_NO_REGISTRATION"><?= EmptyValue(strval($Page->NO_REGISTRATION->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->NO_REGISTRATION->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->NO_REGISTRATION->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->NO_REGISTRATION->ReadOnly || $Page->NO_REGISTRATION->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_NO_REGISTRATION',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->NO_REGISTRATION->getErrorMessage() ?></div>
<?= $Page->NO_REGISTRATION->getCustomMessage() ?>
<?= $Page->NO_REGISTRATION->Lookup->getParamTag($Page, "p_x_NO_REGISTRATION") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_BILL" data-field="x_NO_REGISTRATION" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->NO_REGISTRATION->displayValueSeparatorAttribute() ?>" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" value="<?= $Page->NO_REGISTRATION->CurrentValue ?>"<?= $Page->NO_REGISTRATION->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
    <?php if ($Page->VISIT_ID->getSessionValue() != "") { ?>
    <input type="hidden" id="x_VISIT_ID" name="x_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->CurrentValue) ?>" data-hidden="1">
    <?php } else { ?>
    <span id="el_TREATMENT_BILL_VISIT_ID">
    <input type="hidden" data-table="TREATMENT_BILL" data-field="x_VISIT_ID" data-hidden="1" name="x_VISIT_ID" id="x_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->CurrentValue) ?>">
    </span>
    <?php } ?>
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
    <div id="r_TARIF_ID" class="form-group row">
        <label id="elh_TREATMENT_BILL_TARIF_ID" for="x_TARIF_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TARIF_ID->caption() ?><?= $Page->TARIF_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TARIF_ID->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_TARIF_ID">
<?php $Page->TARIF_ID->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list" aria-describedby="x_TARIF_ID_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_TARIF_ID"><?= EmptyValue(strval($Page->TARIF_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->TARIF_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->TARIF_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->TARIF_ID->ReadOnly || $Page->TARIF_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_TARIF_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->TARIF_ID->getErrorMessage() ?></div>
<?= $Page->TARIF_ID->getCustomMessage() ?>
<?= $Page->TARIF_ID->Lookup->getParamTag($Page, "p_x_TARIF_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_BILL" data-field="x_TARIF_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->TARIF_ID->displayValueSeparatorAttribute() ?>" name="x_TARIF_ID" id="x_TARIF_ID" value="<?= $Page->TARIF_ID->CurrentValue ?>"<?= $Page->TARIF_ID->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { // TREATMENT ?>
    <div id="r_TREATMENT" class="form-group row">
        <label id="elh_TREATMENT_BILL_TREATMENT" for="x_TREATMENT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TREATMENT->caption() ?><?= $Page->TREATMENT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TREATMENT->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_TREATMENT">
<input type="<?= $Page->TREATMENT->getInputTextType() ?>" data-table="TREATMENT_BILL" data-field="x_TREATMENT" name="x_TREATMENT" id="x_TREATMENT" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->TREATMENT->getPlaceHolder()) ?>" value="<?= $Page->TREATMENT->EditValue ?>"<?= $Page->TREATMENT->editAttributes() ?> aria-describedby="x_TREATMENT_help">
<?= $Page->TREATMENT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TREATMENT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->QUANTITY->Visible) { // QUANTITY ?>
    <div id="r_QUANTITY" class="form-group row">
        <label id="elh_TREATMENT_BILL_QUANTITY" for="x_QUANTITY" class="<?= $Page->LeftColumnClass ?>"><?= $Page->QUANTITY->caption() ?><?= $Page->QUANTITY->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->QUANTITY->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_QUANTITY">
<input type="<?= $Page->QUANTITY->getInputTextType() ?>" data-table="TREATMENT_BILL" data-field="x_QUANTITY" name="x_QUANTITY" id="x_QUANTITY" size="30" placeholder="<?= HtmlEncode($Page->QUANTITY->getPlaceHolder()) ?>" value="<?= $Page->QUANTITY->EditValue ?>"<?= $Page->QUANTITY->editAttributes() ?> aria-describedby="x_QUANTITY_help">
<?= $Page->QUANTITY->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->QUANTITY->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("TREATMENT_AKOMODASI", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_AKOMODASI->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("TREATMENT_AKOMODASI", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "TreatmentAkomodasiGrid.php" ?>
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
    ew.addEventHandlers("TREATMENT_BILL");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
