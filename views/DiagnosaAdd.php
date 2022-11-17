<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$DiagnosaAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fDIAGNOSAadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fDIAGNOSAadd = currentForm = new ew.Form("fDIAGNOSAadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "DIAGNOSA")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.DIAGNOSA)
        ew.vars.tables.DIAGNOSA = currentTable;
    fDIAGNOSAadd.addFields([
        ["DTYPE", [fields.DTYPE.visible && fields.DTYPE.required ? ew.Validators.required(fields.DTYPE.caption) : null], fields.DTYPE.isInvalid],
        ["DIAGNOSA_ID", [fields.DIAGNOSA_ID.visible && fields.DIAGNOSA_ID.required ? ew.Validators.required(fields.DIAGNOSA_ID.caption) : null], fields.DIAGNOSA_ID.isInvalid],
        ["NAME_OF_DIAGNOSA", [fields.NAME_OF_DIAGNOSA.visible && fields.NAME_OF_DIAGNOSA.required ? ew.Validators.required(fields.NAME_OF_DIAGNOSA.caption) : null], fields.NAME_OF_DIAGNOSA.isInvalid],
        ["OTHER_ID", [fields.OTHER_ID.visible && fields.OTHER_ID.required ? ew.Validators.required(fields.OTHER_ID.caption) : null], fields.OTHER_ID.isInvalid],
        ["OTHER_ID2", [fields.OTHER_ID2.visible && fields.OTHER_ID2.required ? ew.Validators.required(fields.OTHER_ID2.caption) : null], fields.OTHER_ID2.isInvalid],
        ["ISMENULAR", [fields.ISMENULAR.visible && fields.ISMENULAR.required ? ew.Validators.required(fields.ISMENULAR.caption) : null], fields.ISMENULAR.isInvalid],
        ["ENGLISH_DIAGNOSA", [fields.ENGLISH_DIAGNOSA.visible && fields.ENGLISH_DIAGNOSA.required ? ew.Validators.required(fields.ENGLISH_DIAGNOSA.caption) : null], fields.ENGLISH_DIAGNOSA.isInvalid],
        ["issurveylans", [fields.issurveylans.visible && fields.issurveylans.required ? ew.Validators.required(fields.issurveylans.caption) : null], fields.issurveylans.isInvalid],
        ["dtd", [fields.dtd.visible && fields.dtd.required ? ew.Validators.required(fields.dtd.caption) : null], fields.dtd.isInvalid],
        ["kode_bpjs", [fields.kode_bpjs.visible && fields.kode_bpjs.required ? ew.Validators.required(fields.kode_bpjs.caption) : null], fields.kode_bpjs.isInvalid],
        ["diagnosa_bpjs", [fields.diagnosa_bpjs.visible && fields.diagnosa_bpjs.required ? ew.Validators.required(fields.diagnosa_bpjs.caption) : null], fields.diagnosa_bpjs.isInvalid],
        ["DIAGNOSA_KLINIS", [fields.DIAGNOSA_KLINIS.visible && fields.DIAGNOSA_KLINIS.required ? ew.Validators.required(fields.DIAGNOSA_KLINIS.caption) : null], fields.DIAGNOSA_KLINIS.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fDIAGNOSAadd,
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
    fDIAGNOSAadd.validate = function () {
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
    fDIAGNOSAadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fDIAGNOSAadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fDIAGNOSAadd");
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
<form name="fDIAGNOSAadd" id="fDIAGNOSAadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="DIAGNOSA">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->DTYPE->Visible) { // DTYPE ?>
    <div id="r_DTYPE" class="form-group row">
        <label id="elh_DIAGNOSA_DTYPE" for="x_DTYPE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DTYPE->caption() ?><?= $Page->DTYPE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DTYPE->cellAttributes() ?>>
<span id="el_DIAGNOSA_DTYPE">
<input type="<?= $Page->DTYPE->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_DTYPE" name="x_DTYPE" id="x_DTYPE" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->DTYPE->getPlaceHolder()) ?>" value="<?= $Page->DTYPE->EditValue ?>"<?= $Page->DTYPE->editAttributes() ?> aria-describedby="x_DTYPE_help">
<?= $Page->DTYPE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DTYPE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <div id="r_DIAGNOSA_ID" class="form-group row">
        <label id="elh_DIAGNOSA_DIAGNOSA_ID" for="x_DIAGNOSA_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID->caption() ?><?= $Page->DIAGNOSA_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el_DIAGNOSA_DIAGNOSA_ID">
<input type="<?= $Page->DIAGNOSA_ID->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_DIAGNOSA_ID" name="x_DIAGNOSA_ID" id="x_DIAGNOSA_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DIAGNOSA_ID->getPlaceHolder()) ?>" value="<?= $Page->DIAGNOSA_ID->EditValue ?>"<?= $Page->DIAGNOSA_ID->editAttributes() ?> aria-describedby="x_DIAGNOSA_ID_help">
<?= $Page->DIAGNOSA_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAME_OF_DIAGNOSA->Visible) { // NAME_OF_DIAGNOSA ?>
    <div id="r_NAME_OF_DIAGNOSA" class="form-group row">
        <label id="elh_DIAGNOSA_NAME_OF_DIAGNOSA" for="x_NAME_OF_DIAGNOSA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAME_OF_DIAGNOSA->caption() ?><?= $Page->NAME_OF_DIAGNOSA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAME_OF_DIAGNOSA->cellAttributes() ?>>
<span id="el_DIAGNOSA_NAME_OF_DIAGNOSA">
<input type="<?= $Page->NAME_OF_DIAGNOSA->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_NAME_OF_DIAGNOSA" name="x_NAME_OF_DIAGNOSA" id="x_NAME_OF_DIAGNOSA" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->NAME_OF_DIAGNOSA->getPlaceHolder()) ?>" value="<?= $Page->NAME_OF_DIAGNOSA->EditValue ?>"<?= $Page->NAME_OF_DIAGNOSA->editAttributes() ?> aria-describedby="x_NAME_OF_DIAGNOSA_help">
<?= $Page->NAME_OF_DIAGNOSA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAME_OF_DIAGNOSA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
    <div id="r_OTHER_ID" class="form-group row">
        <label id="elh_DIAGNOSA_OTHER_ID" for="x_OTHER_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->OTHER_ID->caption() ?><?= $Page->OTHER_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el_DIAGNOSA_OTHER_ID">
<input type="<?= $Page->OTHER_ID->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_OTHER_ID" name="x_OTHER_ID" id="x_OTHER_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->OTHER_ID->getPlaceHolder()) ?>" value="<?= $Page->OTHER_ID->EditValue ?>"<?= $Page->OTHER_ID->editAttributes() ?> aria-describedby="x_OTHER_ID_help">
<?= $Page->OTHER_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->OTHER_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->OTHER_ID2->Visible) { // OTHER_ID2 ?>
    <div id="r_OTHER_ID2" class="form-group row">
        <label id="elh_DIAGNOSA_OTHER_ID2" for="x_OTHER_ID2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->OTHER_ID2->caption() ?><?= $Page->OTHER_ID2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->OTHER_ID2->cellAttributes() ?>>
<span id="el_DIAGNOSA_OTHER_ID2">
<input type="<?= $Page->OTHER_ID2->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_OTHER_ID2" name="x_OTHER_ID2" id="x_OTHER_ID2" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->OTHER_ID2->getPlaceHolder()) ?>" value="<?= $Page->OTHER_ID2->EditValue ?>"<?= $Page->OTHER_ID2->editAttributes() ?> aria-describedby="x_OTHER_ID2_help">
<?= $Page->OTHER_ID2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->OTHER_ID2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ISMENULAR->Visible) { // ISMENULAR ?>
    <div id="r_ISMENULAR" class="form-group row">
        <label id="elh_DIAGNOSA_ISMENULAR" for="x_ISMENULAR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ISMENULAR->caption() ?><?= $Page->ISMENULAR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ISMENULAR->cellAttributes() ?>>
<span id="el_DIAGNOSA_ISMENULAR">
<input type="<?= $Page->ISMENULAR->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_ISMENULAR" name="x_ISMENULAR" id="x_ISMENULAR" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->ISMENULAR->getPlaceHolder()) ?>" value="<?= $Page->ISMENULAR->EditValue ?>"<?= $Page->ISMENULAR->editAttributes() ?> aria-describedby="x_ISMENULAR_help">
<?= $Page->ISMENULAR->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ISMENULAR->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ENGLISH_DIAGNOSA->Visible) { // ENGLISH_DIAGNOSA ?>
    <div id="r_ENGLISH_DIAGNOSA" class="form-group row">
        <label id="elh_DIAGNOSA_ENGLISH_DIAGNOSA" for="x_ENGLISH_DIAGNOSA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ENGLISH_DIAGNOSA->caption() ?><?= $Page->ENGLISH_DIAGNOSA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ENGLISH_DIAGNOSA->cellAttributes() ?>>
<span id="el_DIAGNOSA_ENGLISH_DIAGNOSA">
<input type="<?= $Page->ENGLISH_DIAGNOSA->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_ENGLISH_DIAGNOSA" name="x_ENGLISH_DIAGNOSA" id="x_ENGLISH_DIAGNOSA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ENGLISH_DIAGNOSA->getPlaceHolder()) ?>" value="<?= $Page->ENGLISH_DIAGNOSA->EditValue ?>"<?= $Page->ENGLISH_DIAGNOSA->editAttributes() ?> aria-describedby="x_ENGLISH_DIAGNOSA_help">
<?= $Page->ENGLISH_DIAGNOSA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ENGLISH_DIAGNOSA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->issurveylans->Visible) { // issurveylans ?>
    <div id="r_issurveylans" class="form-group row">
        <label id="elh_DIAGNOSA_issurveylans" for="x_issurveylans" class="<?= $Page->LeftColumnClass ?>"><?= $Page->issurveylans->caption() ?><?= $Page->issurveylans->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->issurveylans->cellAttributes() ?>>
<span id="el_DIAGNOSA_issurveylans">
<input type="<?= $Page->issurveylans->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_issurveylans" name="x_issurveylans" id="x_issurveylans" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->issurveylans->getPlaceHolder()) ?>" value="<?= $Page->issurveylans->EditValue ?>"<?= $Page->issurveylans->editAttributes() ?> aria-describedby="x_issurveylans_help">
<?= $Page->issurveylans->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->issurveylans->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dtd->Visible) { // dtd ?>
    <div id="r_dtd" class="form-group row">
        <label id="elh_DIAGNOSA_dtd" for="x_dtd" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dtd->caption() ?><?= $Page->dtd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dtd->cellAttributes() ?>>
<span id="el_DIAGNOSA_dtd">
<textarea data-table="DIAGNOSA" data-field="x_dtd" name="x_dtd" id="x_dtd" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->dtd->getPlaceHolder()) ?>"<?= $Page->dtd->editAttributes() ?> aria-describedby="x_dtd_help"><?= $Page->dtd->EditValue ?></textarea>
<?= $Page->dtd->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dtd->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_bpjs->Visible) { // kode_bpjs ?>
    <div id="r_kode_bpjs" class="form-group row">
        <label id="elh_DIAGNOSA_kode_bpjs" for="x_kode_bpjs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_bpjs->caption() ?><?= $Page->kode_bpjs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_bpjs->cellAttributes() ?>>
<span id="el_DIAGNOSA_kode_bpjs">
<input type="<?= $Page->kode_bpjs->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_kode_bpjs" name="x_kode_bpjs" id="x_kode_bpjs" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->kode_bpjs->getPlaceHolder()) ?>" value="<?= $Page->kode_bpjs->EditValue ?>"<?= $Page->kode_bpjs->editAttributes() ?> aria-describedby="x_kode_bpjs_help">
<?= $Page->kode_bpjs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_bpjs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->diagnosa_bpjs->Visible) { // diagnosa_bpjs ?>
    <div id="r_diagnosa_bpjs" class="form-group row">
        <label id="elh_DIAGNOSA_diagnosa_bpjs" for="x_diagnosa_bpjs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->diagnosa_bpjs->caption() ?><?= $Page->diagnosa_bpjs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->diagnosa_bpjs->cellAttributes() ?>>
<span id="el_DIAGNOSA_diagnosa_bpjs">
<input type="<?= $Page->diagnosa_bpjs->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_diagnosa_bpjs" name="x_diagnosa_bpjs" id="x_diagnosa_bpjs" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->diagnosa_bpjs->getPlaceHolder()) ?>" value="<?= $Page->diagnosa_bpjs->EditValue ?>"<?= $Page->diagnosa_bpjs->editAttributes() ?> aria-describedby="x_diagnosa_bpjs_help">
<?= $Page->diagnosa_bpjs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->diagnosa_bpjs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_KLINIS->Visible) { // DIAGNOSA_KLINIS ?>
    <div id="r_DIAGNOSA_KLINIS" class="form-group row">
        <label id="elh_DIAGNOSA_DIAGNOSA_KLINIS" for="x_DIAGNOSA_KLINIS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_KLINIS->caption() ?><?= $Page->DIAGNOSA_KLINIS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_KLINIS->cellAttributes() ?>>
<span id="el_DIAGNOSA_DIAGNOSA_KLINIS">
<input type="<?= $Page->DIAGNOSA_KLINIS->getInputTextType() ?>" data-table="DIAGNOSA" data-field="x_DIAGNOSA_KLINIS" name="x_DIAGNOSA_KLINIS" id="x_DIAGNOSA_KLINIS" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->DIAGNOSA_KLINIS->getPlaceHolder()) ?>" value="<?= $Page->DIAGNOSA_KLINIS->EditValue ?>"<?= $Page->DIAGNOSA_KLINIS->editAttributes() ?> aria-describedby="x_DIAGNOSA_KLINIS_help">
<?= $Page->DIAGNOSA_KLINIS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_KLINIS->getErrorMessage() ?></div>
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
    ew.addEventHandlers("DIAGNOSA");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
