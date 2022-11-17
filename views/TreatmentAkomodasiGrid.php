<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Set up and run Grid object
$Grid = Container("TreatmentAkomodasiGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fTREATMENT_AKOMODASIgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fTREATMENT_AKOMODASIgrid = new ew.Form("fTREATMENT_AKOMODASIgrid", "grid");
    fTREATMENT_AKOMODASIgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "TREATMENT_AKOMODASI")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.TREATMENT_AKOMODASI)
        ew.vars.tables.TREATMENT_AKOMODASI = currentTable;
    fTREATMENT_AKOMODASIgrid.addFields([
        ["CLINIC_ID", [fields.CLINIC_ID.visible && fields.CLINIC_ID.required ? ew.Validators.required(fields.CLINIC_ID.caption) : null], fields.CLINIC_ID.isInvalid],
        ["TREATMENT", [fields.TREATMENT.visible && fields.TREATMENT.required ? ew.Validators.required(fields.TREATMENT.caption) : null], fields.TREATMENT.isInvalid],
        ["TREAT_DATE", [fields.TREAT_DATE.visible && fields.TREAT_DATE.required ? ew.Validators.required(fields.TREAT_DATE.caption) : null], fields.TREAT_DATE.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid],
        ["CLASS_ROOM_ID", [fields.CLASS_ROOM_ID.visible && fields.CLASS_ROOM_ID.required ? ew.Validators.required(fields.CLASS_ROOM_ID.caption) : null], fields.CLASS_ROOM_ID.isInvalid],
        ["KELUAR_ID", [fields.KELUAR_ID.visible && fields.KELUAR_ID.required ? ew.Validators.required(fields.KELUAR_ID.caption) : null], fields.KELUAR_ID.isInvalid],
        ["BED_ID", [fields.BED_ID.visible && fields.BED_ID.required ? ew.Validators.required(fields.BED_ID.caption) : null], fields.BED_ID.isInvalid],
        ["EMPLOYEE_ID", [fields.EMPLOYEE_ID.visible && fields.EMPLOYEE_ID.required ? ew.Validators.required(fields.EMPLOYEE_ID.caption) : null], fields.EMPLOYEE_ID.isInvalid],
        ["NO_SURAT_KET", [fields.NO_SURAT_KET.visible && fields.NO_SURAT_KET.required ? ew.Validators.required(fields.NO_SURAT_KET.caption) : null], fields.NO_SURAT_KET.isInvalid],
        ["ID", [fields.ID.visible && fields.ID.required ? ew.Validators.required(fields.ID.caption) : null], fields.ID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fTREATMENT_AKOMODASIgrid,
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
    fTREATMENT_AKOMODASIgrid.validate = function () {
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
    fTREATMENT_AKOMODASIgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "CLINIC_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "TREATMENT", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "TREAT_DATE", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "DESCRIPTION", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "CLASS_ROOM_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KELUAR_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "BED_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "EMPLOYEE_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "NO_SURAT_KET", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fTREATMENT_AKOMODASIgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fTREATMENT_AKOMODASIgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fTREATMENT_AKOMODASIgrid.lists.CLINIC_ID = <?= $Grid->CLINIC_ID->toClientList($Grid) ?>;
    fTREATMENT_AKOMODASIgrid.lists.CLASS_ROOM_ID = <?= $Grid->CLASS_ROOM_ID->toClientList($Grid) ?>;
    fTREATMENT_AKOMODASIgrid.lists.KELUAR_ID = <?= $Grid->KELUAR_ID->toClientList($Grid) ?>;
    fTREATMENT_AKOMODASIgrid.lists.BED_ID = <?= $Grid->BED_ID->toClientList($Grid) ?>;
    fTREATMENT_AKOMODASIgrid.lists.EMPLOYEE_ID = <?= $Grid->EMPLOYEE_ID->toClientList($Grid) ?>;
    loadjs.done("fTREATMENT_AKOMODASIgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TREATMENT_AKOMODASI">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fTREATMENT_AKOMODASIgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_TREATMENT_AKOMODASI" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_TREATMENT_AKOMODASIgrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th data-name="CLINIC_ID" class="<?= $Grid->CLINIC_ID->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_CLINIC_ID" class="TREATMENT_AKOMODASI_CLINIC_ID"><?= $Grid->renderSort($Grid->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->TREATMENT->Visible) { // TREATMENT ?>
        <th data-name="TREATMENT" class="<?= $Grid->TREATMENT->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_TREATMENT" class="TREATMENT_AKOMODASI_TREATMENT"><?= $Grid->renderSort($Grid->TREATMENT) ?></div></th>
<?php } ?>
<?php if ($Grid->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <th data-name="TREAT_DATE" class="<?= $Grid->TREAT_DATE->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_TREAT_DATE" class="TREATMENT_AKOMODASI_TREAT_DATE"><?= $Grid->renderSort($Grid->TREAT_DATE) ?></div></th>
<?php } ?>
<?php if ($Grid->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <th data-name="DESCRIPTION" class="<?= $Grid->DESCRIPTION->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_DESCRIPTION" class="TREATMENT_AKOMODASI_DESCRIPTION"><?= $Grid->renderSort($Grid->DESCRIPTION) ?></div></th>
<?php } ?>
<?php if ($Grid->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
        <th data-name="CLASS_ROOM_ID" class="<?= $Grid->CLASS_ROOM_ID->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_CLASS_ROOM_ID" class="TREATMENT_AKOMODASI_CLASS_ROOM_ID"><?= $Grid->renderSort($Grid->CLASS_ROOM_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->KELUAR_ID->Visible) { // KELUAR_ID ?>
        <th data-name="KELUAR_ID" class="<?= $Grid->KELUAR_ID->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_KELUAR_ID" class="TREATMENT_AKOMODASI_KELUAR_ID"><?= $Grid->renderSort($Grid->KELUAR_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->BED_ID->Visible) { // BED_ID ?>
        <th data-name="BED_ID" class="<?= $Grid->BED_ID->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_BED_ID" class="TREATMENT_AKOMODASI_BED_ID"><?= $Grid->renderSort($Grid->BED_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <th data-name="EMPLOYEE_ID" class="<?= $Grid->EMPLOYEE_ID->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_EMPLOYEE_ID" class="TREATMENT_AKOMODASI_EMPLOYEE_ID"><?= $Grid->renderSort($Grid->EMPLOYEE_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->NO_SURAT_KET->Visible) { // NO_SURAT_KET ?>
        <th data-name="NO_SURAT_KET" class="<?= $Grid->NO_SURAT_KET->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_NO_SURAT_KET" class="TREATMENT_AKOMODASI_NO_SURAT_KET"><?= $Grid->renderSort($Grid->NO_SURAT_KET) ?></div></th>
<?php } ?>
<?php if ($Grid->ID->Visible) { // ID ?>
        <th data-name="ID" class="<?= $Grid->ID->headerCellClass() ?>"><div id="elh_TREATMENT_AKOMODASI_ID" class="TREATMENT_AKOMODASI_ID"><?= $Grid->renderSort($Grid->ID) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_TREATMENT_AKOMODASI", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID" <?= $Grid->CLINIC_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_CLINIC_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        name="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        class="form-control ew-select<?= $Grid->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_CLINIC_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_CLINIC_ID"
        data-value-separator="<?= $Grid->CLINIC_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->CLINIC_ID->getPlaceHolder()) ?>"
        <?= $Grid->CLINIC_ID->editAttributes() ?>>
        <?= $Grid->CLINIC_ID->selectOptionListHtml("x{$Grid->RowIndex}_CLINIC_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->CLINIC_ID->getErrorMessage() ?></div>
<?= $Grid->CLINIC_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_CLINIC_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_CLINIC_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_CLINIC_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLINIC_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_CLINIC_ID" id="o<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_CLINIC_ID" class="form-group">
<span<?= $Grid->CLINIC_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->CLINIC_ID->getDisplayValue($Grid->CLINIC_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLINIC_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_CLINIC_ID" id="x<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_CLINIC_ID">
<span<?= $Grid->CLINIC_ID->viewAttributes() ?>>
<?= $Grid->CLINIC_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLINIC_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_CLINIC_ID" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLINIC_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_CLINIC_ID" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TREATMENT->Visible) { // TREATMENT ?>
        <td data-name="TREATMENT" <?= $Grid->TREATMENT->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_TREATMENT" class="form-group">
<input type="<?= $Grid->TREATMENT->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" name="x<?= $Grid->RowIndex ?>_TREATMENT" id="x<?= $Grid->RowIndex ?>_TREATMENT" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->TREATMENT->getPlaceHolder()) ?>" value="<?= $Grid->TREATMENT->EditValue ?>"<?= $Grid->TREATMENT->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TREATMENT->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TREATMENT" id="o<?= $Grid->RowIndex ?>_TREATMENT" value="<?= HtmlEncode($Grid->TREATMENT->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_TREATMENT" class="form-group">
<span<?= $Grid->TREATMENT->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TREATMENT->getDisplayValue($Grid->TREATMENT->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TREATMENT" id="x<?= $Grid->RowIndex ?>_TREATMENT" value="<?= HtmlEncode($Grid->TREATMENT->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_TREATMENT">
<span<?= $Grid->TREATMENT->viewAttributes() ?>>
<?= $Grid->TREATMENT->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_TREATMENT" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_TREATMENT" value="<?= HtmlEncode($Grid->TREATMENT->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_TREATMENT" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_TREATMENT" value="<?= HtmlEncode($Grid->TREATMENT->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <td data-name="TREAT_DATE" <?= $Grid->TREAT_DATE->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_TREAT_DATE" class="form-group">
<input type="<?= $Grid->TREAT_DATE->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" name="x<?= $Grid->RowIndex ?>_TREAT_DATE" id="x<?= $Grid->RowIndex ?>_TREAT_DATE" placeholder="<?= HtmlEncode($Grid->TREAT_DATE->getPlaceHolder()) ?>" value="<?= $Grid->TREAT_DATE->EditValue ?>"<?= $Grid->TREAT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TREAT_DATE->getErrorMessage() ?></div>
<?php if (!$Grid->TREAT_DATE->ReadOnly && !$Grid->TREAT_DATE->Disabled && !isset($Grid->TREAT_DATE->EditAttrs["readonly"]) && !isset($Grid->TREAT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fTREATMENT_AKOMODASIgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fTREATMENT_AKOMODASIgrid", "x<?= $Grid->RowIndex ?>_TREAT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TREAT_DATE" id="o<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_TREAT_DATE" class="form-group">
<span<?= $Grid->TREAT_DATE->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TREAT_DATE->getDisplayValue($Grid->TREAT_DATE->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TREAT_DATE" id="x<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_TREAT_DATE">
<span<?= $Grid->TREAT_DATE->viewAttributes() ?>>
<?= $Grid->TREAT_DATE->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_TREAT_DATE" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_TREAT_DATE" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <td data-name="DESCRIPTION" <?= $Grid->DESCRIPTION->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_DESCRIPTION" class="form-group">
<input type="<?= $Grid->DESCRIPTION->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" name="x<?= $Grid->RowIndex ?>_DESCRIPTION" id="x<?= $Grid->RowIndex ?>_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Grid->DESCRIPTION->EditValue ?>"<?= $Grid->DESCRIPTION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DESCRIPTION->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DESCRIPTION" id="o<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_DESCRIPTION" class="form-group">
<input type="<?= $Grid->DESCRIPTION->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" name="x<?= $Grid->RowIndex ?>_DESCRIPTION" id="x<?= $Grid->RowIndex ?>_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Grid->DESCRIPTION->EditValue ?>"<?= $Grid->DESCRIPTION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DESCRIPTION->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_DESCRIPTION">
<span<?= $Grid->DESCRIPTION->viewAttributes() ?>>
<?= $Grid->DESCRIPTION->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_DESCRIPTION" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_DESCRIPTION" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
        <td data-name="CLASS_ROOM_ID" <?= $Grid->CLASS_ROOM_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_CLASS_ROOM_ID" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID"><?= EmptyValue(strval($Grid->CLASS_ROOM_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->CLASS_ROOM_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->CLASS_ROOM_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->CLASS_ROOM_ID->ReadOnly || $Grid->CLASS_ROOM_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->CLASS_ROOM_ID->getErrorMessage() ?></div>
<?= $Grid->CLASS_ROOM_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_CLASS_ROOM_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->CLASS_ROOM_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" id="x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" value="<?= $Grid->CLASS_ROOM_ID->CurrentValue ?>"<?= $Grid->CLASS_ROOM_ID->editAttributes() ?>>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" id="o<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" value="<?= HtmlEncode($Grid->CLASS_ROOM_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_CLASS_ROOM_ID" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID"><?= EmptyValue(strval($Grid->CLASS_ROOM_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->CLASS_ROOM_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->CLASS_ROOM_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->CLASS_ROOM_ID->ReadOnly || $Grid->CLASS_ROOM_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->CLASS_ROOM_ID->getErrorMessage() ?></div>
<?= $Grid->CLASS_ROOM_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_CLASS_ROOM_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->CLASS_ROOM_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" id="x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" value="<?= $Grid->CLASS_ROOM_ID->CurrentValue ?>"<?= $Grid->CLASS_ROOM_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_CLASS_ROOM_ID">
<span<?= $Grid->CLASS_ROOM_ID->viewAttributes() ?>>
<?= $Grid->CLASS_ROOM_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" value="<?= HtmlEncode($Grid->CLASS_ROOM_ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" value="<?= HtmlEncode($Grid->CLASS_ROOM_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KELUAR_ID->Visible) { // KELUAR_ID ?>
        <td data-name="KELUAR_ID" <?= $Grid->KELUAR_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_KELUAR_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_KELUAR_ID"
        name="x<?= $Grid->RowIndex ?>_KELUAR_ID"
        class="form-control ew-select<?= $Grid->KELUAR_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_KELUAR_ID"
        data-value-separator="<?= $Grid->KELUAR_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KELUAR_ID->getPlaceHolder()) ?>"
        <?= $Grid->KELUAR_ID->editAttributes() ?>>
        <?= $Grid->KELUAR_ID->selectOptionListHtml("x{$Grid->RowIndex}_KELUAR_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KELUAR_ID->getErrorMessage() ?></div>
<?= $Grid->KELUAR_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KELUAR_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KELUAR_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.KELUAR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_KELUAR_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KELUAR_ID" id="o<?= $Grid->RowIndex ?>_KELUAR_ID" value="<?= HtmlEncode($Grid->KELUAR_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_KELUAR_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_KELUAR_ID"
        name="x<?= $Grid->RowIndex ?>_KELUAR_ID"
        class="form-control ew-select<?= $Grid->KELUAR_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_KELUAR_ID"
        data-value-separator="<?= $Grid->KELUAR_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KELUAR_ID->getPlaceHolder()) ?>"
        <?= $Grid->KELUAR_ID->editAttributes() ?>>
        <?= $Grid->KELUAR_ID->selectOptionListHtml("x{$Grid->RowIndex}_KELUAR_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KELUAR_ID->getErrorMessage() ?></div>
<?= $Grid->KELUAR_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KELUAR_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KELUAR_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.KELUAR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_KELUAR_ID">
<span<?= $Grid->KELUAR_ID->viewAttributes() ?>>
<?= $Grid->KELUAR_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_KELUAR_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_KELUAR_ID" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_KELUAR_ID" value="<?= HtmlEncode($Grid->KELUAR_ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_KELUAR_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_KELUAR_ID" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_KELUAR_ID" value="<?= HtmlEncode($Grid->KELUAR_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->BED_ID->Visible) { // BED_ID ?>
        <td data-name="BED_ID" <?= $Grid->BED_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_BED_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_BED_ID"
        name="x<?= $Grid->RowIndex ?>_BED_ID"
        class="form-control ew-select<?= $Grid->BED_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_BED_ID"
        data-value-separator="<?= $Grid->BED_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->BED_ID->getPlaceHolder()) ?>"
        <?= $Grid->BED_ID->editAttributes() ?>>
        <?= $Grid->BED_ID->selectOptionListHtml("x{$Grid->RowIndex}_BED_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->BED_ID->getErrorMessage() ?></div>
<?= $Grid->BED_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_BED_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_BED_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.BED_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_BED_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_BED_ID" id="o<?= $Grid->RowIndex ?>_BED_ID" value="<?= HtmlEncode($Grid->BED_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_BED_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_BED_ID"
        name="x<?= $Grid->RowIndex ?>_BED_ID"
        class="form-control ew-select<?= $Grid->BED_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_BED_ID"
        data-value-separator="<?= $Grid->BED_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->BED_ID->getPlaceHolder()) ?>"
        <?= $Grid->BED_ID->editAttributes() ?>>
        <?= $Grid->BED_ID->selectOptionListHtml("x{$Grid->RowIndex}_BED_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->BED_ID->getErrorMessage() ?></div>
<?= $Grid->BED_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_BED_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_BED_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.BED_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_BED_ID">
<span<?= $Grid->BED_ID->viewAttributes() ?>>
<?= $Grid->BED_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_BED_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_BED_ID" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_BED_ID" value="<?= HtmlEncode($Grid->BED_ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_BED_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_BED_ID" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_BED_ID" value="<?= HtmlEncode($Grid->BED_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <td data-name="EMPLOYEE_ID" <?= $Grid->EMPLOYEE_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_EMPLOYEE_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        name="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        class="form-control ew-select<?= $Grid->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_EMPLOYEE_ID"
        data-value-separator="<?= $Grid->EMPLOYEE_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->EMPLOYEE_ID->getPlaceHolder()) ?>"
        <?= $Grid->EMPLOYEE_ID->editAttributes() ?>>
        <?= $Grid->EMPLOYEE_ID->selectOptionListHtml("x{$Grid->RowIndex}_EMPLOYEE_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->EMPLOYEE_ID->getErrorMessage() ?></div>
<?= $Grid->EMPLOYEE_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_EMPLOYEE_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_EMPLOYEE_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_EMPLOYEE_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        name="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        class="form-control ew-select<?= $Grid->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_EMPLOYEE_ID"
        data-value-separator="<?= $Grid->EMPLOYEE_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->EMPLOYEE_ID->getPlaceHolder()) ?>"
        <?= $Grid->EMPLOYEE_ID->editAttributes() ?>>
        <?= $Grid->EMPLOYEE_ID->selectOptionListHtml("x{$Grid->RowIndex}_EMPLOYEE_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->EMPLOYEE_ID->getErrorMessage() ?></div>
<?= $Grid->EMPLOYEE_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_EMPLOYEE_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_EMPLOYEE_ID">
<span<?= $Grid->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Grid->EMPLOYEE_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_EMPLOYEE_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_EMPLOYEE_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->NO_SURAT_KET->Visible) { // NO_SURAT_KET ?>
        <td data-name="NO_SURAT_KET" <?= $Grid->NO_SURAT_KET->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_NO_SURAT_KET" class="form-group">
<input type="<?= $Grid->NO_SURAT_KET->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" name="x<?= $Grid->RowIndex ?>_NO_SURAT_KET" id="x<?= $Grid->RowIndex ?>_NO_SURAT_KET" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->NO_SURAT_KET->getPlaceHolder()) ?>" value="<?= $Grid->NO_SURAT_KET->EditValue ?>"<?= $Grid->NO_SURAT_KET->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NO_SURAT_KET->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NO_SURAT_KET" id="o<?= $Grid->RowIndex ?>_NO_SURAT_KET" value="<?= HtmlEncode($Grid->NO_SURAT_KET->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_NO_SURAT_KET" class="form-group">
<input type="<?= $Grid->NO_SURAT_KET->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" name="x<?= $Grid->RowIndex ?>_NO_SURAT_KET" id="x<?= $Grid->RowIndex ?>_NO_SURAT_KET" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->NO_SURAT_KET->getPlaceHolder()) ?>" value="<?= $Grid->NO_SURAT_KET->EditValue ?>"<?= $Grid->NO_SURAT_KET->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NO_SURAT_KET->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_NO_SURAT_KET">
<span<?= $Grid->NO_SURAT_KET->viewAttributes() ?>>
<?= $Grid->NO_SURAT_KET->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_NO_SURAT_KET" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_NO_SURAT_KET" value="<?= HtmlEncode($Grid->NO_SURAT_KET->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_NO_SURAT_KET" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_NO_SURAT_KET" value="<?= HtmlEncode($Grid->NO_SURAT_KET->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ID->Visible) { // ID ?>
        <td data-name="ID" <?= $Grid->ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_ID" class="form-group"></span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ID" id="o<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_ID" class="form-group">
<span<?= $Grid->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ID->getDisplayValue($Grid->ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ID" id="x<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_TREATMENT_AKOMODASI_ID">
<span<?= $Grid->ID->viewAttributes() ?>>
<?= $Grid->ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_ID" id="fTREATMENT_AKOMODASIgrid$x<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->FormValue) ?>">
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_ID" data-hidden="1" name="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_ID" id="fTREATMENT_AKOMODASIgrid$o<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ID" id="x<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->CurrentValue) ?>">
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fTREATMENT_AKOMODASIgrid","load"], function () {
    fTREATMENT_AKOMODASIgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_TREATMENT_AKOMODASI", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_CLINIC_ID" class="form-group TREATMENT_AKOMODASI_CLINIC_ID">
    <select
        id="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        name="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        class="form-control ew-select<?= $Grid->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_CLINIC_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_CLINIC_ID"
        data-value-separator="<?= $Grid->CLINIC_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->CLINIC_ID->getPlaceHolder()) ?>"
        <?= $Grid->CLINIC_ID->editAttributes() ?>>
        <?= $Grid->CLINIC_ID->selectOptionListHtml("x{$Grid->RowIndex}_CLINIC_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->CLINIC_ID->getErrorMessage() ?></div>
<?= $Grid->CLINIC_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_CLINIC_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_CLINIC_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_CLINIC_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_CLINIC_ID" class="form-group TREATMENT_AKOMODASI_CLINIC_ID">
<span<?= $Grid->CLINIC_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->CLINIC_ID->getDisplayValue($Grid->CLINIC_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLINIC_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_CLINIC_ID" id="x<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLINIC_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_CLINIC_ID" id="o<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TREATMENT->Visible) { // TREATMENT ?>
        <td data-name="TREATMENT">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_TREATMENT" class="form-group TREATMENT_AKOMODASI_TREATMENT">
<input type="<?= $Grid->TREATMENT->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" name="x<?= $Grid->RowIndex ?>_TREATMENT" id="x<?= $Grid->RowIndex ?>_TREATMENT" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->TREATMENT->getPlaceHolder()) ?>" value="<?= $Grid->TREATMENT->EditValue ?>"<?= $Grid->TREATMENT->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TREATMENT->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_TREATMENT" class="form-group TREATMENT_AKOMODASI_TREATMENT">
<span<?= $Grid->TREATMENT->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TREATMENT->getDisplayValue($Grid->TREATMENT->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TREATMENT" id="x<?= $Grid->RowIndex ?>_TREATMENT" value="<?= HtmlEncode($Grid->TREATMENT->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TREATMENT" id="o<?= $Grid->RowIndex ?>_TREATMENT" value="<?= HtmlEncode($Grid->TREATMENT->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <td data-name="TREAT_DATE">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_TREAT_DATE" class="form-group TREATMENT_AKOMODASI_TREAT_DATE">
<input type="<?= $Grid->TREAT_DATE->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" name="x<?= $Grid->RowIndex ?>_TREAT_DATE" id="x<?= $Grid->RowIndex ?>_TREAT_DATE" placeholder="<?= HtmlEncode($Grid->TREAT_DATE->getPlaceHolder()) ?>" value="<?= $Grid->TREAT_DATE->EditValue ?>"<?= $Grid->TREAT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TREAT_DATE->getErrorMessage() ?></div>
<?php if (!$Grid->TREAT_DATE->ReadOnly && !$Grid->TREAT_DATE->Disabled && !isset($Grid->TREAT_DATE->EditAttrs["readonly"]) && !isset($Grid->TREAT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fTREATMENT_AKOMODASIgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fTREATMENT_AKOMODASIgrid", "x<?= $Grid->RowIndex ?>_TREAT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_TREAT_DATE" class="form-group TREATMENT_AKOMODASI_TREAT_DATE">
<span<?= $Grid->TREAT_DATE->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TREAT_DATE->getDisplayValue($Grid->TREAT_DATE->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TREAT_DATE" id="x<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TREAT_DATE" id="o<?= $Grid->RowIndex ?>_TREAT_DATE" value="<?= HtmlEncode($Grid->TREAT_DATE->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <td data-name="DESCRIPTION">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_DESCRIPTION" class="form-group TREATMENT_AKOMODASI_DESCRIPTION">
<input type="<?= $Grid->DESCRIPTION->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" name="x<?= $Grid->RowIndex ?>_DESCRIPTION" id="x<?= $Grid->RowIndex ?>_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Grid->DESCRIPTION->EditValue ?>"<?= $Grid->DESCRIPTION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DESCRIPTION->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_DESCRIPTION" class="form-group TREATMENT_AKOMODASI_DESCRIPTION">
<span<?= $Grid->DESCRIPTION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->DESCRIPTION->getDisplayValue($Grid->DESCRIPTION->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" data-hidden="1" name="x<?= $Grid->RowIndex ?>_DESCRIPTION" id="x<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DESCRIPTION" id="o<?= $Grid->RowIndex ?>_DESCRIPTION" value="<?= HtmlEncode($Grid->DESCRIPTION->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
        <td data-name="CLASS_ROOM_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_CLASS_ROOM_ID" class="form-group TREATMENT_AKOMODASI_CLASS_ROOM_ID">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID"><?= EmptyValue(strval($Grid->CLASS_ROOM_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->CLASS_ROOM_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->CLASS_ROOM_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->CLASS_ROOM_ID->ReadOnly || $Grid->CLASS_ROOM_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->CLASS_ROOM_ID->getErrorMessage() ?></div>
<?= $Grid->CLASS_ROOM_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_CLASS_ROOM_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->CLASS_ROOM_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" id="x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" value="<?= $Grid->CLASS_ROOM_ID->CurrentValue ?>"<?= $Grid->CLASS_ROOM_ID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_CLASS_ROOM_ID" class="form-group TREATMENT_AKOMODASI_CLASS_ROOM_ID">
<span<?= $Grid->CLASS_ROOM_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->CLASS_ROOM_ID->getDisplayValue($Grid->CLASS_ROOM_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" id="x<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" value="<?= HtmlEncode($Grid->CLASS_ROOM_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" id="o<?= $Grid->RowIndex ?>_CLASS_ROOM_ID" value="<?= HtmlEncode($Grid->CLASS_ROOM_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KELUAR_ID->Visible) { // KELUAR_ID ?>
        <td data-name="KELUAR_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_KELUAR_ID" class="form-group TREATMENT_AKOMODASI_KELUAR_ID">
    <select
        id="x<?= $Grid->RowIndex ?>_KELUAR_ID"
        name="x<?= $Grid->RowIndex ?>_KELUAR_ID"
        class="form-control ew-select<?= $Grid->KELUAR_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_KELUAR_ID"
        data-value-separator="<?= $Grid->KELUAR_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KELUAR_ID->getPlaceHolder()) ?>"
        <?= $Grid->KELUAR_ID->editAttributes() ?>>
        <?= $Grid->KELUAR_ID->selectOptionListHtml("x{$Grid->RowIndex}_KELUAR_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KELUAR_ID->getErrorMessage() ?></div>
<?= $Grid->KELUAR_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KELUAR_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KELUAR_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_KELUAR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.KELUAR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_KELUAR_ID" class="form-group TREATMENT_AKOMODASI_KELUAR_ID">
<span<?= $Grid->KELUAR_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KELUAR_ID->getDisplayValue($Grid->KELUAR_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_KELUAR_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KELUAR_ID" id="x<?= $Grid->RowIndex ?>_KELUAR_ID" value="<?= HtmlEncode($Grid->KELUAR_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_KELUAR_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KELUAR_ID" id="o<?= $Grid->RowIndex ?>_KELUAR_ID" value="<?= HtmlEncode($Grid->KELUAR_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->BED_ID->Visible) { // BED_ID ?>
        <td data-name="BED_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_BED_ID" class="form-group TREATMENT_AKOMODASI_BED_ID">
    <select
        id="x<?= $Grid->RowIndex ?>_BED_ID"
        name="x<?= $Grid->RowIndex ?>_BED_ID"
        class="form-control ew-select<?= $Grid->BED_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_BED_ID"
        data-value-separator="<?= $Grid->BED_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->BED_ID->getPlaceHolder()) ?>"
        <?= $Grid->BED_ID->editAttributes() ?>>
        <?= $Grid->BED_ID->selectOptionListHtml("x{$Grid->RowIndex}_BED_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->BED_ID->getErrorMessage() ?></div>
<?= $Grid->BED_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_BED_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_BED_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_BED_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.BED_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_BED_ID" class="form-group TREATMENT_AKOMODASI_BED_ID">
<span<?= $Grid->BED_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->BED_ID->getDisplayValue($Grid->BED_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_BED_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_BED_ID" id="x<?= $Grid->RowIndex ?>_BED_ID" value="<?= HtmlEncode($Grid->BED_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_BED_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_BED_ID" id="o<?= $Grid->RowIndex ?>_BED_ID" value="<?= HtmlEncode($Grid->BED_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <td data-name="EMPLOYEE_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_EMPLOYEE_ID" class="form-group TREATMENT_AKOMODASI_EMPLOYEE_ID">
    <select
        id="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        name="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        class="form-control ew-select<?= $Grid->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_EMPLOYEE_ID"
        data-value-separator="<?= $Grid->EMPLOYEE_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->EMPLOYEE_ID->getPlaceHolder()) ?>"
        <?= $Grid->EMPLOYEE_ID->editAttributes() ?>>
        <?= $Grid->EMPLOYEE_ID->selectOptionListHtml("x{$Grid->RowIndex}_EMPLOYEE_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->EMPLOYEE_ID->getErrorMessage() ?></div>
<?= $Grid->EMPLOYEE_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_EMPLOYEE_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", selectId: "TREATMENT_AKOMODASI_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_EMPLOYEE_ID" class="form-group TREATMENT_AKOMODASI_EMPLOYEE_ID">
<span<?= $Grid->EMPLOYEE_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->EMPLOYEE_ID->getDisplayValue($Grid->EMPLOYEE_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_EMPLOYEE_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_EMPLOYEE_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->NO_SURAT_KET->Visible) { // NO_SURAT_KET ?>
        <td data-name="NO_SURAT_KET">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_NO_SURAT_KET" class="form-group TREATMENT_AKOMODASI_NO_SURAT_KET">
<input type="<?= $Grid->NO_SURAT_KET->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" name="x<?= $Grid->RowIndex ?>_NO_SURAT_KET" id="x<?= $Grid->RowIndex ?>_NO_SURAT_KET" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->NO_SURAT_KET->getPlaceHolder()) ?>" value="<?= $Grid->NO_SURAT_KET->EditValue ?>"<?= $Grid->NO_SURAT_KET->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NO_SURAT_KET->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_NO_SURAT_KET" class="form-group TREATMENT_AKOMODASI_NO_SURAT_KET">
<span<?= $Grid->NO_SURAT_KET->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NO_SURAT_KET->getDisplayValue($Grid->NO_SURAT_KET->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" data-hidden="1" name="x<?= $Grid->RowIndex ?>_NO_SURAT_KET" id="x<?= $Grid->RowIndex ?>_NO_SURAT_KET" value="<?= HtmlEncode($Grid->NO_SURAT_KET->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NO_SURAT_KET" id="o<?= $Grid->RowIndex ?>_NO_SURAT_KET" value="<?= HtmlEncode($Grid->NO_SURAT_KET->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ID->Visible) { // ID ?>
        <td data-name="ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_ID" class="form-group TREATMENT_AKOMODASI_ID"></span>
<?php } else { ?>
<span id="el$rowindex$_TREATMENT_AKOMODASI_ID" class="form-group TREATMENT_AKOMODASI_ID">
<span<?= $Grid->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ID->getDisplayValue($Grid->ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ID" id="x<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TREATMENT_AKOMODASI" data-field="x_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ID" id="o<?= $Grid->RowIndex ?>_ID" value="<?= HtmlEncode($Grid->ID->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fTREATMENT_AKOMODASIgrid","load"], function() {
    fTREATMENT_AKOMODASIgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fTREATMENT_AKOMODASIgrid">
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
    ew.addEventHandlers("TREATMENT_AKOMODASI");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
