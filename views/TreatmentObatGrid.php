<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Set up and run Grid object
$Grid = Container("TreatmentObatGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fTREATMENT_OBATgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fTREATMENT_OBATgrid = new ew.Form("fTREATMENT_OBATgrid", "grid");
    fTREATMENT_OBATgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "TREATMENT_OBAT")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.TREATMENT_OBAT)
        ew.vars.tables.TREATMENT_OBAT = currentTable;
    fTREATMENT_OBATgrid.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["RESEP_NO", [fields.RESEP_NO.visible && fields.RESEP_NO.required ? ew.Validators.required(fields.RESEP_NO.caption) : null], fields.RESEP_NO.isInvalid],
        ["TARIF_ID", [fields.TARIF_ID.visible && fields.TARIF_ID.required ? ew.Validators.required(fields.TARIF_ID.caption) : null], fields.TARIF_ID.isInvalid],
        ["TREAT_DATE", [fields.TREAT_DATE.visible && fields.TREAT_DATE.required ? ew.Validators.required(fields.TREAT_DATE.caption) : null], fields.TREAT_DATE.isInvalid],
        ["MEASURE_ID", [fields.MEASURE_ID.visible && fields.MEASURE_ID.required ? ew.Validators.required(fields.MEASURE_ID.caption) : null, ew.Validators.integer], fields.MEASURE_ID.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid],
        ["DOSE_PRESC", [fields.DOSE_PRESC.visible && fields.DOSE_PRESC.required ? ew.Validators.required(fields.DOSE_PRESC.caption) : null, ew.Validators.float], fields.DOSE_PRESC.isInvalid],
        ["BRAND_ID", [fields.BRAND_ID.visible && fields.BRAND_ID.required ? ew.Validators.required(fields.BRAND_ID.caption) : null], fields.BRAND_ID.isInvalid],
        ["ID", [fields.ID.visible && fields.ID.required ? ew.Validators.required(fields.ID.caption) : null], fields.ID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fTREATMENT_OBATgrid,
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
    fTREATMENT_OBATgrid.validate = function () {
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
            var checkrow = (gridinsert) ? !this.emptyRow(rowIndex) : true;
            if (checkrow) {
                addcnt++;

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
            } // End Grid Add checking
        }
        return true;
    }

    // Check empty row
    fTREATMENT_OBATgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "ORG_UNIT_CODE", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "RESEP_NO", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "TARIF_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "MEASURE_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "DESCRIPTION", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "DOSE_PRESC", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "BRAND_ID", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fTREATMENT_OBATgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fTREATMENT_OBATgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fTREATMENT_OBATgrid.lists.TARIF_ID = <?= $Grid->TARIF_ID->toClientList($Grid) ?>;
    fTREATMENT_OBATgrid.lists.BRAND_ID = <?= $Grid->BRAND_ID->toClientList($Grid) ?>;
    loadjs.done("fTREATMENT_OBATgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TREATMENT_OBAT">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fTREATMENT_OBATgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_TREATMENT_OBAT" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_TREATMENT_OBATgrid" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <th data-name="ORG_UNIT_CODE" class="<?= $Grid->ORG_UNIT_CODE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_OBAT_ORG_UNIT_CODE" class="TREATMENT_OBAT_ORG_UNIT_CODE"><?= $Grid->renderSort($Grid->ORG_UNIT_CODE) ?></div></th>
<?php } ?>
<?php if ($Grid->RESEP_NO->Visible) { // RESEP_NO ?>
        <th data-name="RESEP_NO" class="<?= $Grid->RESEP_NO->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_OBAT_RESEP_NO" class="TREATMENT_OBAT_RESEP_NO"><?= $Grid->renderSort($Grid->RESEP_NO) ?></div></th>
<?php } ?>
<?php if ($Grid->TARIF_ID->Visible) { // TARIF_ID ?>
        <th data-name="TARIF_ID" class="<?= $Grid->TARIF_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_OBAT_TARIF_ID" class="TREATMENT_OBAT_TARIF_ID"><?= $Grid->renderSort($Grid->TARIF_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <th data-name="TREAT_DATE" class="<?= $Grid->TREAT_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_OBAT_TREAT_DATE" class="TREATMENT_OBAT_TREAT_DATE"><?= $Grid->renderSort($Grid->TREAT_DATE) ?></div></th>
<?php } ?>
<?php if ($Grid->MEASURE_ID->Visible) { // MEASURE_ID ?>
        <th data-name="MEASURE_ID" class="<?= $Grid->MEASURE_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_OBAT_MEASURE_ID" class="TREATMENT_OBAT_MEASURE_ID"><?= $Grid->renderSort($Grid->MEASURE_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <th data-name="DESCRIPTION" class="<?= $Grid->DESCRIPTION->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_OBAT_DESCRIPTION" class="TREATMENT_OBAT_DESCRIPTION"><?= $Grid->renderSort($Grid->DESCRIPTION) ?></div></th>
<?php } ?>
<?php if ($Grid->DOSE_PRESC->Visible) { // DOSE_PRESC ?>
        <th data-name="DOSE_PRESC" class="<?= $Grid->DOSE_PRESC->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_OBAT_DOSE_PRESC" class="TREATMENT_OBAT_DOSE_PRESC"><?= $Grid->renderSort($Grid->DOSE_PRESC) ?></div></th>
<?php } ?>
<?php if ($Grid->BRAND_ID->Visible) { // BRAND_ID ?>
        <th data-name="BRAND_ID" class="<?= $Grid->BRAND_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_OBAT_BRAND_ID" class="TREATMENT_OBAT_BRAND_ID"><?= $Grid->renderSort($Grid->BRAND_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->ID->Visible) { // ID ?>
        <th data-name="ID" class="<?= $Grid->ID->headerCellClass() ?>"><div id="elh_TREATMENT_OBAT_ID" class="TREATMENT_OBAT_ID"><?= $Grid->renderSort($Grid->ID) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif (!$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
if ($Grid->isGridAdd())
    $Grid->RowIndex = 0;
if ($Grid->isGridEdit())
    $Grid->RowIndex = 0;
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row id / data-rowindex
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_TREATMENT_OBAT", "data-rowtype" => $Grid->RowType]);

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Grid->RowAction != "delete" && $Grid->RowAction != "insertdelete" && !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow())) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <td data-name="ORG_UNIT_CODE" <?= $Grid->ORG_UNIT_CODE->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_ORG_UNIT_CODE" class="form-group">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ORG_UNIT_CODE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" id="x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" value="<?= HtmlEncode($Grid->ORG_UNIT_CODE->CurrentValue) ?>">
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ORG_UNIT_CODE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" id="o<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" value="<?= HtmlEncode($Grid->ORG_UNIT_CODE->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_ORG_UNIT_CODE" class="form-group">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ORG_UNIT_CODE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" id="x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" value="<?= HtmlEncode($Grid->ORG_UNIT_CODE->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_ORG_UNIT_CODE">
<span<?= $Grid->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Grid->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ORG_UNIT_CODE" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" value="<?= HtmlEncode($Grid->ORG_UNIT_CODE->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ORG_UNIT_CODE" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" value="<?= HtmlEncode($Grid->ORG_UNIT_CODE->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->RESEP_NO->Visible) { // RESEP_NO ?>
        <td data-name="RESEP_NO" <?= $Grid->RESEP_NO->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_RESEP_NO" class="form-group">
<input type="<?= $Grid->RESEP_NO->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" name="x<?= $Grid->RowIndex ?>_RESEP_NO" id="x<?= $Grid->RowIndex ?>_RESEP_NO" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->RESEP_NO->getPlaceHolder()) ?>" value="<?= $Grid->RESEP_NO->EditValue ?>"<?= $Grid->RESEP_NO->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->RESEP_NO->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" data-hidden="1" name="o<?= $Grid->RowIndex ?>_RESEP_NO" id="o<?= $Grid->RowIndex ?>_RESEP_NO" value="<?= HtmlEncode($Grid->RESEP_NO->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_RESEP_NO" class="form-group">
<input type="<?= $Grid->RESEP_NO->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" name="x<?= $Grid->RowIndex ?>_RESEP_NO" id="x<?= $Grid->RowIndex ?>_RESEP_NO" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->RESEP_NO->getPlaceHolder()) ?>" value="<?= $Grid->RESEP_NO->EditValue ?>"<?= $Grid->RESEP_NO->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->RESEP_NO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_RESEP_NO">
<span<?= $Grid->RESEP_NO->viewAttributes() ?>>
<?= $Grid->RESEP_NO->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_RESEP_NO" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_RESEP_NO" value="<?= HtmlEncode($Grid->RESEP_NO->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_RESEP_NO" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_RESEP_NO" value="<?= HtmlEncode($Grid->RESEP_NO->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TARIF_ID->Visible) { // TARIF_ID ?>
        <td data-name="TARIF_ID" <?= $Grid->TARIF_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_TARIF_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_TARIF_ID"
        name="x<?= $Grid->RowIndex ?>_TARIF_ID"
        class="form-control ew-select<?= $Grid->TARIF_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_OBAT_x<?= $Grid->RowIndex ?>_TARIF_ID"
        data-table="TREATMENT_OBAT"
        data-field="x_TARIF_ID"
        data-value-separator="<?= $Grid->TARIF_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->TARIF_ID->getPlaceHolder()) ?>"
        <?= $Grid->TARIF_ID->editAttributes() ?>>
        <?= $Grid->TARIF_ID->selectOptionListHtml("x{$Grid->RowIndex}_TARIF_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->TARIF_ID->getErrorMessage() ?></div>
<?= $Grid->TARIF_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_TARIF_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_OBAT_x<?= $Grid->RowIndex ?>_TARIF_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_TARIF_ID", selectId: "TREATMENT_OBAT_x<?= $Grid->RowIndex ?>_TARIF_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_OBAT.fields.TARIF_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TARIF_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TARIF_ID" id="o<?= $Grid->RowIndex ?>_TARIF_ID" value="<?= HtmlEncode($Grid->TARIF_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_TARIF_ID" class="form-group">
<span<?= $Grid->TARIF_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TARIF_ID->getDisplayValue($Grid->TARIF_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TARIF_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TARIF_ID" id="x<?= $Grid->RowIndex ?>_TARIF_ID" value="<?= HtmlEncode($Grid->TARIF_ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_TARIF_ID">
<span<?= $Grid->TARIF_ID->viewAttributes() ?>>
<?= $Grid->TARIF_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TARIF_ID" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_TARIF_ID" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_TARIF_ID" value="<?= HtmlEncode($Grid->TARIF_ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TARIF_ID" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_TARIF_ID" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_TARIF_ID" value="<?= HtmlEncode($Grid->TARIF_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <td data-name="TREAT_DATE" <?= $Grid->TREAT_DATE->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TREAT_DATE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TREAT_DATE" id="o<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_TREAT_DATE">
<span<?= $Grid->TREAT_DATE->viewAttributes() ?>>
<?= $Grid->TREAT_DATE->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TREAT_DATE" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_TREAT_DATE" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TREAT_DATE" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_TREAT_DATE" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->MEASURE_ID->Visible) { // MEASURE_ID ?>
        <td data-name="MEASURE_ID" <?= $Grid->MEASURE_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_MEASURE_ID" class="form-group">
<input type="<?= $Grid->MEASURE_ID->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" name="x<?= $Grid->RowIndex ?>_MEASURE_ID" id="x<?= $Grid->RowIndex ?>_MEASURE_ID" size="30" placeholder="<?= HtmlEncode($Grid->MEASURE_ID->getPlaceHolder()) ?>" value="<?= $Grid->MEASURE_ID->EditValue ?>"<?= $Grid->MEASURE_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->MEASURE_ID->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_MEASURE_ID" id="o<?= $Grid->RowIndex ?>_MEASURE_ID" value="<?= HtmlEncode($Grid->MEASURE_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_MEASURE_ID" class="form-group">
<input type="<?= $Grid->MEASURE_ID->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" name="x<?= $Grid->RowIndex ?>_MEASURE_ID" id="x<?= $Grid->RowIndex ?>_MEASURE_ID" size="30" placeholder="<?= HtmlEncode($Grid->MEASURE_ID->getPlaceHolder()) ?>" value="<?= $Grid->MEASURE_ID->EditValue ?>"<?= $Grid->MEASURE_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->MEASURE_ID->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_MEASURE_ID">
<span<?= $Grid->MEASURE_ID->viewAttributes() ?>>
<?= $Grid->MEASURE_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_MEASURE_ID" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_MEASURE_ID" value="<?= HtmlEncode($Grid->MEASURE_ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_MEASURE_ID" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_MEASURE_ID" value="<?= HtmlEncode($Grid->MEASURE_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <td data-name="DESCRIPTION" <?= $Grid->DESCRIPTION->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_DESCRIPTION" class="form-group">
<input type="<?= $Grid->DESCRIPTION->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" name="x<?= $Grid->RowIndex ?>_DESCRIPTION" id="x<?= $Grid->RowIndex ?>_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Grid->DESCRIPTION->EditValue ?>"<?= $Grid->DESCRIPTION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DESCRIPTION->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DESCRIPTION" id="o<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_DESCRIPTION" class="form-group">
<input type="<?= $Grid->DESCRIPTION->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" name="x<?= $Grid->RowIndex ?>_DESCRIPTION" id="x<?= $Grid->RowIndex ?>_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Grid->DESCRIPTION->EditValue ?>"<?= $Grid->DESCRIPTION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DESCRIPTION->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_DESCRIPTION">
<span<?= $Grid->DESCRIPTION->viewAttributes() ?>>
<?= $Grid->DESCRIPTION->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_DESCRIPTION" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_DESCRIPTION" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->DOSE_PRESC->Visible) { // DOSE_PRESC ?>
        <td data-name="DOSE_PRESC" <?= $Grid->DOSE_PRESC->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_DOSE_PRESC" class="form-group">
<input type="<?= $Grid->DOSE_PRESC->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" name="x<?= $Grid->RowIndex ?>_DOSE_PRESC" id="x<?= $Grid->RowIndex ?>_DOSE_PRESC" size="30" placeholder="<?= HtmlEncode($Grid->DOSE_PRESC->getPlaceHolder()) ?>" value="<?= $Grid->DOSE_PRESC->EditValue ?>"<?= $Grid->DOSE_PRESC->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DOSE_PRESC->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DOSE_PRESC" id="o<?= $Grid->RowIndex ?>_DOSE_PRESC" value="<?= HtmlEncode($Grid->DOSE_PRESC->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_DOSE_PRESC" class="form-group">
<input type="<?= $Grid->DOSE_PRESC->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" name="x<?= $Grid->RowIndex ?>_DOSE_PRESC" id="x<?= $Grid->RowIndex ?>_DOSE_PRESC" size="30" placeholder="<?= HtmlEncode($Grid->DOSE_PRESC->getPlaceHolder()) ?>" value="<?= $Grid->DOSE_PRESC->EditValue ?>"<?= $Grid->DOSE_PRESC->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DOSE_PRESC->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_DOSE_PRESC">
<span<?= $Grid->DOSE_PRESC->viewAttributes() ?>>
<?= $Grid->DOSE_PRESC->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_DOSE_PRESC" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_DOSE_PRESC" value="<?= HtmlEncode($Grid->DOSE_PRESC->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_DOSE_PRESC" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_DOSE_PRESC" value="<?= HtmlEncode($Grid->DOSE_PRESC->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->BRAND_ID->Visible) { // BRAND_ID ?>
        <td data-name="BRAND_ID" <?= $Grid->BRAND_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_BRAND_ID" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_BRAND_ID"><?= EmptyValue(strval($Grid->BRAND_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->BRAND_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->BRAND_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->BRAND_ID->ReadOnly || $Grid->BRAND_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_BRAND_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->BRAND_ID->getErrorMessage() ?></div>
<?= $Grid->BRAND_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_BRAND_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->BRAND_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_BRAND_ID" id="x<?= $Grid->RowIndex ?>_BRAND_ID" value="<?= $Grid->BRAND_ID->CurrentValue ?>"<?= $Grid->BRAND_ID->editAttributes() ?>>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_BRAND_ID" id="o<?= $Grid->RowIndex ?>_BRAND_ID" value="<?= HtmlEncode($Grid->BRAND_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_BRAND_ID" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_BRAND_ID"><?= EmptyValue(strval($Grid->BRAND_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->BRAND_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->BRAND_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->BRAND_ID->ReadOnly || $Grid->BRAND_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_BRAND_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->BRAND_ID->getErrorMessage() ?></div>
<?= $Grid->BRAND_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_BRAND_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->BRAND_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_BRAND_ID" id="x<?= $Grid->RowIndex ?>_BRAND_ID" value="<?= $Grid->BRAND_ID->CurrentValue ?>"<?= $Grid->BRAND_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_BRAND_ID">
<span<?= $Grid->BRAND_ID->viewAttributes() ?>>
<?= $Grid->BRAND_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_BRAND_ID" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_BRAND_ID" value="<?= HtmlEncode($Grid->BRAND_ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_BRAND_ID" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_BRAND_ID" value="<?= HtmlEncode($Grid->BRAND_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ID->Visible) { // ID ?>
        <td data-name="ID" <?= $Grid->ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_ID" class="form-group"></span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ID" id="o<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_ID" class="form-group">
<span<?= $Grid->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ID->getDisplayValue($Grid->ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ID" id="x<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_OBAT_ID">
<span<?= $Grid->ID->viewAttributes() ?>>
<?= $Grid->ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ID" data-hidden="1" name="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_ID" id="fTREATMENT_OBATgrid$x<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ID" data-hidden="1" name="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_ID" id="fTREATMENT_OBATgrid$o<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ID" id="x<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->CurrentValue) ?>">
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fTREATMENT_OBATgrid","load"], function () {
    fTREATMENT_OBATgrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
    if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
        $Grid->RowIndex = '$rowindex$';
        $Grid->loadRowValues();

        // Set row properties
        $Grid->resetAttributes();
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_TREATMENT_OBAT", "data-rowtype" => ROWTYPE_ADD]);
        $Grid->RowAttrs->appendClass("ew-template");
        $Grid->RowType = ROWTYPE_ADD;

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();
        $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <td data-name="ORG_UNIT_CODE">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_OBAT_ORG_UNIT_CODE" class="form-group TREATMENT_OBAT_ORG_UNIT_CODE">
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ORG_UNIT_CODE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" id="x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" value="<?= HtmlEncode($Grid->ORG_UNIT_CODE->CurrentValue) ?>">
</span>
<?php } else { ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ORG_UNIT_CODE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" id="x<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" value="<?= HtmlEncode($Grid->ORG_UNIT_CODE->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ORG_UNIT_CODE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" id="o<?= $Grid->RowIndex ?>_ORG_UNIT_CODE" value="<?= HtmlEncode($Grid->ORG_UNIT_CODE->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->RESEP_NO->Visible) { // RESEP_NO ?>
        <td data-name="RESEP_NO">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_OBAT_RESEP_NO" class="form-group TREATMENT_OBAT_RESEP_NO">
<input type="<?= $Grid->RESEP_NO->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" name="x<?= $Grid->RowIndex ?>_RESEP_NO" id="x<?= $Grid->RowIndex ?>_RESEP_NO" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->RESEP_NO->getPlaceHolder()) ?>" value="<?= $Grid->RESEP_NO->EditValue ?>"<?= $Grid->RESEP_NO->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->RESEP_NO->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_OBAT_RESEP_NO" class="form-group TREATMENT_OBAT_RESEP_NO">
<span<?= $Grid->RESEP_NO->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->RESEP_NO->getDisplayValue($Grid->RESEP_NO->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" data-hidden="1" name="x<?= $Grid->RowIndex ?>_RESEP_NO" id="x<?= $Grid->RowIndex ?>_RESEP_NO" value="<?= HtmlEncode($Grid->RESEP_NO->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" data-hidden="1" name="o<?= $Grid->RowIndex ?>_RESEP_NO" id="o<?= $Grid->RowIndex ?>_RESEP_NO" value="<?= HtmlEncode($Grid->RESEP_NO->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TARIF_ID->Visible) { // TARIF_ID ?>
        <td data-name="TARIF_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_OBAT_TARIF_ID" class="form-group TREATMENT_OBAT_TARIF_ID">
    <select
        id="x<?= $Grid->RowIndex ?>_TARIF_ID"
        name="x<?= $Grid->RowIndex ?>_TARIF_ID"
        class="form-control ew-select<?= $Grid->TARIF_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_OBAT_x<?= $Grid->RowIndex ?>_TARIF_ID"
        data-table="TREATMENT_OBAT"
        data-field="x_TARIF_ID"
        data-value-separator="<?= $Grid->TARIF_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->TARIF_ID->getPlaceHolder()) ?>"
        <?= $Grid->TARIF_ID->editAttributes() ?>>
        <?= $Grid->TARIF_ID->selectOptionListHtml("x{$Grid->RowIndex}_TARIF_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->TARIF_ID->getErrorMessage() ?></div>
<?= $Grid->TARIF_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_TARIF_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_OBAT_x<?= $Grid->RowIndex ?>_TARIF_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_TARIF_ID", selectId: "TREATMENT_OBAT_x<?= $Grid->RowIndex ?>_TARIF_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_OBAT.fields.TARIF_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_OBAT_TARIF_ID" class="form-group TREATMENT_OBAT_TARIF_ID">
<span<?= $Grid->TARIF_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TARIF_ID->getDisplayValue($Grid->TARIF_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TARIF_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TARIF_ID" id="x<?= $Grid->RowIndex ?>_TARIF_ID" value="<?= HtmlEncode($Grid->TARIF_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TARIF_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TARIF_ID" id="o<?= $Grid->RowIndex ?>_TARIF_ID" value="<?= HtmlEncode($Grid->TARIF_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <td data-name="TREAT_DATE">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_OBAT_TREAT_DATE" class="form-group TREATMENT_OBAT_TREAT_DATE">
<span<?= $Grid->TREAT_DATE->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TREAT_DATE->getDisplayValue($Grid->TREAT_DATE->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TREAT_DATE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TREAT_DATE" id="x<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TREAT_DATE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TREAT_DATE" id="o<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->MEASURE_ID->Visible) { // MEASURE_ID ?>
        <td data-name="MEASURE_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_OBAT_MEASURE_ID" class="form-group TREATMENT_OBAT_MEASURE_ID">
<input type="<?= $Grid->MEASURE_ID->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" name="x<?= $Grid->RowIndex ?>_MEASURE_ID" id="x<?= $Grid->RowIndex ?>_MEASURE_ID" size="30" placeholder="<?= HtmlEncode($Grid->MEASURE_ID->getPlaceHolder()) ?>" value="<?= $Grid->MEASURE_ID->EditValue ?>"<?= $Grid->MEASURE_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->MEASURE_ID->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_OBAT_MEASURE_ID" class="form-group TREATMENT_OBAT_MEASURE_ID">
<span<?= $Grid->MEASURE_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->MEASURE_ID->getDisplayValue($Grid->MEASURE_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_MEASURE_ID" id="x<?= $Grid->RowIndex ?>_MEASURE_ID" value="<?= HtmlEncode($Grid->MEASURE_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_MEASURE_ID" id="o<?= $Grid->RowIndex ?>_MEASURE_ID" value="<?= HtmlEncode($Grid->MEASURE_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <td data-name="DESCRIPTION">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_OBAT_DESCRIPTION" class="form-group TREATMENT_OBAT_DESCRIPTION">
<input type="<?= $Grid->DESCRIPTION->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" name="x<?= $Grid->RowIndex ?>_DESCRIPTION" id="x<?= $Grid->RowIndex ?>_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Grid->DESCRIPTION->EditValue ?>"<?= $Grid->DESCRIPTION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DESCRIPTION->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_OBAT_DESCRIPTION" class="form-group TREATMENT_OBAT_DESCRIPTION">
<span<?= $Grid->DESCRIPTION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->DESCRIPTION->getDisplayValue($Grid->DESCRIPTION->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" data-hidden="1" name="x<?= $Grid->RowIndex ?>_DESCRIPTION" id="x<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DESCRIPTION" id="o<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->DOSE_PRESC->Visible) { // DOSE_PRESC ?>
        <td data-name="DOSE_PRESC">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_OBAT_DOSE_PRESC" class="form-group TREATMENT_OBAT_DOSE_PRESC">
<input type="<?= $Grid->DOSE_PRESC->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" name="x<?= $Grid->RowIndex ?>_DOSE_PRESC" id="x<?= $Grid->RowIndex ?>_DOSE_PRESC" size="30" placeholder="<?= HtmlEncode($Grid->DOSE_PRESC->getPlaceHolder()) ?>" value="<?= $Grid->DOSE_PRESC->EditValue ?>"<?= $Grid->DOSE_PRESC->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DOSE_PRESC->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_OBAT_DOSE_PRESC" class="form-group TREATMENT_OBAT_DOSE_PRESC">
<span<?= $Grid->DOSE_PRESC->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->DOSE_PRESC->getDisplayValue($Grid->DOSE_PRESC->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" data-hidden="1" name="x<?= $Grid->RowIndex ?>_DOSE_PRESC" id="x<?= $Grid->RowIndex ?>_DOSE_PRESC" value="<?= HtmlEncode($Grid->DOSE_PRESC->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DOSE_PRESC" id="o<?= $Grid->RowIndex ?>_DOSE_PRESC" value="<?= HtmlEncode($Grid->DOSE_PRESC->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->BRAND_ID->Visible) { // BRAND_ID ?>
        <td data-name="BRAND_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_OBAT_BRAND_ID" class="form-group TREATMENT_OBAT_BRAND_ID">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_BRAND_ID"><?= EmptyValue(strval($Grid->BRAND_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->BRAND_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->BRAND_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->BRAND_ID->ReadOnly || $Grid->BRAND_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_BRAND_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->BRAND_ID->getErrorMessage() ?></div>
<?= $Grid->BRAND_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_BRAND_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->BRAND_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_BRAND_ID" id="x<?= $Grid->RowIndex ?>_BRAND_ID" value="<?= $Grid->BRAND_ID->CurrentValue ?>"<?= $Grid->BRAND_ID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_OBAT_BRAND_ID" class="form-group TREATMENT_OBAT_BRAND_ID">
<span<?= $Grid->BRAND_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->BRAND_ID->getDisplayValue($Grid->BRAND_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_BRAND_ID" id="x<?= $Grid->RowIndex ?>_BRAND_ID" value="<?= HtmlEncode($Grid->BRAND_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_BRAND_ID" id="o<?= $Grid->RowIndex ?>_BRAND_ID" value="<?= HtmlEncode($Grid->BRAND_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ID->Visible) { // ID ?>
        <td data-name="ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_OBAT_ID" class="form-group TREATMENT_OBAT_ID"></span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_OBAT_ID" class="form-group TREATMENT_OBAT_ID">
<span<?= $Grid->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ID->getDisplayValue($Grid->ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ID" id="x<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ID" id="o<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fTREATMENT_OBATgrid","load"], function() {
    fTREATMENT_OBATgrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fTREATMENT_OBATgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Grid->TotalRecords == 0 && !$Grid->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("TREATMENT_OBAT");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
