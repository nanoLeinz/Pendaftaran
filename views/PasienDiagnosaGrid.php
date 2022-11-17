<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Set up and run Grid object
$Grid = Container("PasienDiagnosaGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPASIEN_DIAGNOSAgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fPASIEN_DIAGNOSAgrid = new ew.Form("fPASIEN_DIAGNOSAgrid", "grid");
    fPASIEN_DIAGNOSAgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PASIEN_DIAGNOSA")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PASIEN_DIAGNOSA)
        ew.vars.tables.PASIEN_DIAGNOSA = currentTable;
    fPASIEN_DIAGNOSAgrid.addFields([
        ["DATE_OF_DIAGNOSA", [fields.DATE_OF_DIAGNOSA.visible && fields.DATE_OF_DIAGNOSA.required ? ew.Validators.required(fields.DATE_OF_DIAGNOSA.caption) : null, ew.Validators.datetime(11)], fields.DATE_OF_DIAGNOSA.isInvalid],
        ["DIAGNOSA_ID", [fields.DIAGNOSA_ID.visible && fields.DIAGNOSA_ID.required ? ew.Validators.required(fields.DIAGNOSA_ID.caption) : null], fields.DIAGNOSA_ID.isInvalid],
        ["ANAMNASE", [fields.ANAMNASE.visible && fields.ANAMNASE.required ? ew.Validators.required(fields.ANAMNASE.caption) : null], fields.ANAMNASE.isInvalid],
        ["PEMERIKSAAN", [fields.PEMERIKSAAN.visible && fields.PEMERIKSAAN.required ? ew.Validators.required(fields.PEMERIKSAAN.caption) : null], fields.PEMERIKSAAN.isInvalid],
        ["TERAPHY_DESC", [fields.TERAPHY_DESC.visible && fields.TERAPHY_DESC.required ? ew.Validators.required(fields.TERAPHY_DESC.caption) : null], fields.TERAPHY_DESC.isInvalid],
        ["TGLKONTROL", [fields.TGLKONTROL.visible && fields.TGLKONTROL.required ? ew.Validators.required(fields.TGLKONTROL.caption) : null, ew.Validators.datetime(0)], fields.TGLKONTROL.isInvalid],
        ["IDXDAFTAR", [fields.IDXDAFTAR.visible && fields.IDXDAFTAR.required ? ew.Validators.required(fields.IDXDAFTAR.caption) : null, ew.Validators.integer], fields.IDXDAFTAR.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fPASIEN_DIAGNOSAgrid,
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
    fPASIEN_DIAGNOSAgrid.validate = function () {
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
    fPASIEN_DIAGNOSAgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "DATE_OF_DIAGNOSA", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "DIAGNOSA_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ANAMNASE", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "PEMERIKSAAN", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "TERAPHY_DESC", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "TGLKONTROL", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "IDXDAFTAR", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fPASIEN_DIAGNOSAgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPASIEN_DIAGNOSAgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fPASIEN_DIAGNOSAgrid.lists.DIAGNOSA_ID = <?= $Grid->DIAGNOSA_ID->toClientList($Grid) ?>;
    loadjs.done("fPASIEN_DIAGNOSAgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PASIEN_DIAGNOSA">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fPASIEN_DIAGNOSAgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_PASIEN_DIAGNOSA" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_PASIEN_DIAGNOSAgrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
        <th data-name="DATE_OF_DIAGNOSA" class="<?= $Grid->DATE_OF_DIAGNOSA->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" class="PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA"><?= $Grid->renderSort($Grid->DATE_OF_DIAGNOSA) ?></div></th>
<?php } ?>
<?php if ($Grid->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <th data-name="DIAGNOSA_ID" class="<?= $Grid->DIAGNOSA_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="PASIEN_DIAGNOSA_DIAGNOSA_ID"><?= $Grid->renderSort($Grid->DIAGNOSA_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->ANAMNASE->Visible) { // ANAMNASE ?>
        <th data-name="ANAMNASE" class="<?= $Grid->ANAMNASE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_ANAMNASE" class="PASIEN_DIAGNOSA_ANAMNASE"><?= $Grid->renderSort($Grid->ANAMNASE) ?></div></th>
<?php } ?>
<?php if ($Grid->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
        <th data-name="PEMERIKSAAN" class="<?= $Grid->PEMERIKSAAN->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_PEMERIKSAAN" class="PASIEN_DIAGNOSA_PEMERIKSAAN"><?= $Grid->renderSort($Grid->PEMERIKSAAN) ?></div></th>
<?php } ?>
<?php if ($Grid->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
        <th data-name="TERAPHY_DESC" class="<?= $Grid->TERAPHY_DESC->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_TERAPHY_DESC" class="PASIEN_DIAGNOSA_TERAPHY_DESC"><?= $Grid->renderSort($Grid->TERAPHY_DESC) ?></div></th>
<?php } ?>
<?php if ($Grid->TGLKONTROL->Visible) { // TGLKONTROL ?>
        <th data-name="TGLKONTROL" class="<?= $Grid->TGLKONTROL->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_TGLKONTROL" class="PASIEN_DIAGNOSA_TGLKONTROL"><?= $Grid->renderSort($Grid->TGLKONTROL) ?></div></th>
<?php } ?>
<?php if ($Grid->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
        <th data-name="IDXDAFTAR" class="<?= $Grid->IDXDAFTAR->headerCellClass() ?>"><div id="elh_PASIEN_DIAGNOSA_IDXDAFTAR" class="PASIEN_DIAGNOSA_IDXDAFTAR"><?= $Grid->renderSort($Grid->IDXDAFTAR) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_PASIEN_DIAGNOSA", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
        <td data-name="DATE_OF_DIAGNOSA" <?= $Grid->DATE_OF_DIAGNOSA->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" class="form-group">
<input type="<?= $Grid->DATE_OF_DIAGNOSA->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-format="11" name="x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" id="x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" placeholder="<?= HtmlEncode($Grid->DATE_OF_DIAGNOSA->getPlaceHolder()) ?>" value="<?= $Grid->DATE_OF_DIAGNOSA->EditValue ?>"<?= $Grid->DATE_OF_DIAGNOSA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DATE_OF_DIAGNOSA->getErrorMessage() ?></div>
<?php if (!$Grid->DATE_OF_DIAGNOSA->ReadOnly && !$Grid->DATE_OF_DIAGNOSA->Disabled && !isset($Grid->DATE_OF_DIAGNOSA->EditAttrs["readonly"]) && !isset($Grid->DATE_OF_DIAGNOSA->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_DIAGNOSAgrid", "x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" id="o<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" value="<?= HtmlEncode($Grid->DATE_OF_DIAGNOSA->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" class="form-group">
<input type="<?= $Grid->DATE_OF_DIAGNOSA->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-format="11" name="x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" id="x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" placeholder="<?= HtmlEncode($Grid->DATE_OF_DIAGNOSA->getPlaceHolder()) ?>" value="<?= $Grid->DATE_OF_DIAGNOSA->EditValue ?>"<?= $Grid->DATE_OF_DIAGNOSA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DATE_OF_DIAGNOSA->getErrorMessage() ?></div>
<?php if (!$Grid->DATE_OF_DIAGNOSA->ReadOnly && !$Grid->DATE_OF_DIAGNOSA->Disabled && !isset($Grid->DATE_OF_DIAGNOSA->EditAttrs["readonly"]) && !isset($Grid->DATE_OF_DIAGNOSA->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_DIAGNOSAgrid", "x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA">
<span<?= $Grid->DATE_OF_DIAGNOSA->viewAttributes() ?>>
<?= $Grid->DATE_OF_DIAGNOSA->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" id="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" value="<?= HtmlEncode($Grid->DATE_OF_DIAGNOSA->FormValue) ?>">
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" id="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" value="<?= HtmlEncode($Grid->DATE_OF_DIAGNOSA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <td data-name="DIAGNOSA_ID" <?= $Grid->DIAGNOSA_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_DIAGNOSA_ID"><?= EmptyValue(strval($Grid->DIAGNOSA_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->DIAGNOSA_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->DIAGNOSA_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->DIAGNOSA_ID->ReadOnly || $Grid->DIAGNOSA_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_DIAGNOSA_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->DIAGNOSA_ID->getErrorMessage() ?></div>
<?= $Grid->DIAGNOSA_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_DIAGNOSA_ID") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->DIAGNOSA_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" id="x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" value="<?= $Grid->DIAGNOSA_ID->CurrentValue ?>"<?= $Grid->DIAGNOSA_ID->editAttributes() ?>>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DIAGNOSA_ID" id="o<?= $Grid->RowIndex ?>_DIAGNOSA_ID" value="<?= HtmlEncode($Grid->DIAGNOSA_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_DIAGNOSA_ID"><?= EmptyValue(strval($Grid->DIAGNOSA_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->DIAGNOSA_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->DIAGNOSA_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->DIAGNOSA_ID->ReadOnly || $Grid->DIAGNOSA_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_DIAGNOSA_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->DIAGNOSA_ID->getErrorMessage() ?></div>
<?= $Grid->DIAGNOSA_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_DIAGNOSA_ID") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->DIAGNOSA_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" id="x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" value="<?= $Grid->DIAGNOSA_ID->CurrentValue ?>"<?= $Grid->DIAGNOSA_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_DIAGNOSA_ID">
<span<?= $Grid->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Grid->DIAGNOSA_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" id="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" value="<?= HtmlEncode($Grid->DIAGNOSA_ID->FormValue) ?>">
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_DIAGNOSA_ID" id="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_DIAGNOSA_ID" value="<?= HtmlEncode($Grid->DIAGNOSA_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ANAMNASE->Visible) { // ANAMNASE ?>
        <td data-name="ANAMNASE" <?= $Grid->ANAMNASE->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_ANAMNASE" class="form-group">
<textarea data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" name="x<?= $Grid->RowIndex ?>_ANAMNASE" id="x<?= $Grid->RowIndex ?>_ANAMNASE" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->ANAMNASE->getPlaceHolder()) ?>"<?= $Grid->ANAMNASE->editAttributes() ?>><?= $Grid->ANAMNASE->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->ANAMNASE->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ANAMNASE" id="o<?= $Grid->RowIndex ?>_ANAMNASE" value="<?= HtmlEncode($Grid->ANAMNASE->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_ANAMNASE" class="form-group">
<textarea data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" name="x<?= $Grid->RowIndex ?>_ANAMNASE" id="x<?= $Grid->RowIndex ?>_ANAMNASE" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->ANAMNASE->getPlaceHolder()) ?>"<?= $Grid->ANAMNASE->editAttributes() ?>><?= $Grid->ANAMNASE->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->ANAMNASE->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_ANAMNASE">
<span<?= $Grid->ANAMNASE->viewAttributes() ?>>
<?= $Grid->ANAMNASE->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_ANAMNASE" id="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_ANAMNASE" value="<?= HtmlEncode($Grid->ANAMNASE->FormValue) ?>">
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_ANAMNASE" id="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_ANAMNASE" value="<?= HtmlEncode($Grid->ANAMNASE->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
        <td data-name="PEMERIKSAAN" <?= $Grid->PEMERIKSAAN->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_PEMERIKSAAN" class="form-group">
<input type="<?= $Grid->PEMERIKSAAN->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" name="x<?= $Grid->RowIndex ?>_PEMERIKSAAN" id="x<?= $Grid->RowIndex ?>_PEMERIKSAAN" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->PEMERIKSAAN->getPlaceHolder()) ?>" value="<?= $Grid->PEMERIKSAAN->EditValue ?>"<?= $Grid->PEMERIKSAAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->PEMERIKSAAN->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_PEMERIKSAAN" id="o<?= $Grid->RowIndex ?>_PEMERIKSAAN" value="<?= HtmlEncode($Grid->PEMERIKSAAN->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_PEMERIKSAAN" class="form-group">
<input type="<?= $Grid->PEMERIKSAAN->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" name="x<?= $Grid->RowIndex ?>_PEMERIKSAAN" id="x<?= $Grid->RowIndex ?>_PEMERIKSAAN" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->PEMERIKSAAN->getPlaceHolder()) ?>" value="<?= $Grid->PEMERIKSAAN->EditValue ?>"<?= $Grid->PEMERIKSAAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->PEMERIKSAAN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_PEMERIKSAAN">
<span<?= $Grid->PEMERIKSAAN->viewAttributes() ?>>
<?= $Grid->PEMERIKSAAN->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_PEMERIKSAAN" id="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_PEMERIKSAAN" value="<?= HtmlEncode($Grid->PEMERIKSAAN->FormValue) ?>">
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_PEMERIKSAAN" id="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_PEMERIKSAAN" value="<?= HtmlEncode($Grid->PEMERIKSAAN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
        <td data-name="TERAPHY_DESC" <?= $Grid->TERAPHY_DESC->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_TERAPHY_DESC" class="form-group">
<input type="<?= $Grid->TERAPHY_DESC->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" name="x<?= $Grid->RowIndex ?>_TERAPHY_DESC" id="x<?= $Grid->RowIndex ?>_TERAPHY_DESC" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->TERAPHY_DESC->getPlaceHolder()) ?>" value="<?= $Grid->TERAPHY_DESC->EditValue ?>"<?= $Grid->TERAPHY_DESC->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TERAPHY_DESC->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TERAPHY_DESC" id="o<?= $Grid->RowIndex ?>_TERAPHY_DESC" value="<?= HtmlEncode($Grid->TERAPHY_DESC->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_TERAPHY_DESC" class="form-group">
<input type="<?= $Grid->TERAPHY_DESC->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" name="x<?= $Grid->RowIndex ?>_TERAPHY_DESC" id="x<?= $Grid->RowIndex ?>_TERAPHY_DESC" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->TERAPHY_DESC->getPlaceHolder()) ?>" value="<?= $Grid->TERAPHY_DESC->EditValue ?>"<?= $Grid->TERAPHY_DESC->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TERAPHY_DESC->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_TERAPHY_DESC">
<span<?= $Grid->TERAPHY_DESC->viewAttributes() ?>>
<?= $Grid->TERAPHY_DESC->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_TERAPHY_DESC" id="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_TERAPHY_DESC" value="<?= HtmlEncode($Grid->TERAPHY_DESC->FormValue) ?>">
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_TERAPHY_DESC" id="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_TERAPHY_DESC" value="<?= HtmlEncode($Grid->TERAPHY_DESC->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TGLKONTROL->Visible) { // TGLKONTROL ?>
        <td data-name="TGLKONTROL" <?= $Grid->TGLKONTROL->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_TGLKONTROL" class="form-group">
<input type="<?= $Grid->TGLKONTROL->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" name="x<?= $Grid->RowIndex ?>_TGLKONTROL" id="x<?= $Grid->RowIndex ?>_TGLKONTROL" placeholder="<?= HtmlEncode($Grid->TGLKONTROL->getPlaceHolder()) ?>" value="<?= $Grid->TGLKONTROL->EditValue ?>"<?= $Grid->TGLKONTROL->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TGLKONTROL->getErrorMessage() ?></div>
<?php if (!$Grid->TGLKONTROL->ReadOnly && !$Grid->TGLKONTROL->Disabled && !isset($Grid->TGLKONTROL->EditAttrs["readonly"]) && !isset($Grid->TGLKONTROL->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_DIAGNOSAgrid", "x<?= $Grid->RowIndex ?>_TGLKONTROL", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TGLKONTROL" id="o<?= $Grid->RowIndex ?>_TGLKONTROL" value="<?= HtmlEncode($Grid->TGLKONTROL->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_TGLKONTROL" class="form-group">
<input type="<?= $Grid->TGLKONTROL->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" name="x<?= $Grid->RowIndex ?>_TGLKONTROL" id="x<?= $Grid->RowIndex ?>_TGLKONTROL" placeholder="<?= HtmlEncode($Grid->TGLKONTROL->getPlaceHolder()) ?>" value="<?= $Grid->TGLKONTROL->EditValue ?>"<?= $Grid->TGLKONTROL->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TGLKONTROL->getErrorMessage() ?></div>
<?php if (!$Grid->TGLKONTROL->ReadOnly && !$Grid->TGLKONTROL->Disabled && !isset($Grid->TGLKONTROL->EditAttrs["readonly"]) && !isset($Grid->TGLKONTROL->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_DIAGNOSAgrid", "x<?= $Grid->RowIndex ?>_TGLKONTROL", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_TGLKONTROL">
<span<?= $Grid->TGLKONTROL->viewAttributes() ?>>
<?= $Grid->TGLKONTROL->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_TGLKONTROL" id="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_TGLKONTROL" value="<?= HtmlEncode($Grid->TGLKONTROL->FormValue) ?>">
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_TGLKONTROL" id="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_TGLKONTROL" value="<?= HtmlEncode($Grid->TGLKONTROL->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
        <td data-name="IDXDAFTAR" <?= $Grid->IDXDAFTAR->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_IDXDAFTAR" class="form-group">
<input type="<?= $Grid->IDXDAFTAR->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" name="x<?= $Grid->RowIndex ?>_IDXDAFTAR" id="x<?= $Grid->RowIndex ?>_IDXDAFTAR" size="30" placeholder="<?= HtmlEncode($Grid->IDXDAFTAR->getPlaceHolder()) ?>" value="<?= $Grid->IDXDAFTAR->EditValue ?>"<?= $Grid->IDXDAFTAR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->IDXDAFTAR->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" data-hidden="1" name="o<?= $Grid->RowIndex ?>_IDXDAFTAR" id="o<?= $Grid->RowIndex ?>_IDXDAFTAR" value="<?= HtmlEncode($Grid->IDXDAFTAR->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_IDXDAFTAR" class="form-group">
<input type="<?= $Grid->IDXDAFTAR->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" name="x<?= $Grid->RowIndex ?>_IDXDAFTAR" id="x<?= $Grid->RowIndex ?>_IDXDAFTAR" size="30" placeholder="<?= HtmlEncode($Grid->IDXDAFTAR->getPlaceHolder()) ?>" value="<?= $Grid->IDXDAFTAR->EditValue ?>"<?= $Grid->IDXDAFTAR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->IDXDAFTAR->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_DIAGNOSA_IDXDAFTAR">
<span<?= $Grid->IDXDAFTAR->viewAttributes() ?>>
<?= $Grid->IDXDAFTAR->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_IDXDAFTAR" id="fPASIEN_DIAGNOSAgrid$x<?= $Grid->RowIndex ?>_IDXDAFTAR" value="<?= HtmlEncode($Grid->IDXDAFTAR->FormValue) ?>">
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" data-hidden="1" name="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_IDXDAFTAR" id="fPASIEN_DIAGNOSAgrid$o<?= $Grid->RowIndex ?>_IDXDAFTAR" value="<?= HtmlEncode($Grid->IDXDAFTAR->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAgrid","load"], function () {
    fPASIEN_DIAGNOSAgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_PASIEN_DIAGNOSA", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
        <td data-name="DATE_OF_DIAGNOSA">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" class="form-group PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA">
<input type="<?= $Grid->DATE_OF_DIAGNOSA->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-format="11" name="x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" id="x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" placeholder="<?= HtmlEncode($Grid->DATE_OF_DIAGNOSA->getPlaceHolder()) ?>" value="<?= $Grid->DATE_OF_DIAGNOSA->EditValue ?>"<?= $Grid->DATE_OF_DIAGNOSA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DATE_OF_DIAGNOSA->getErrorMessage() ?></div>
<?php if (!$Grid->DATE_OF_DIAGNOSA->ReadOnly && !$Grid->DATE_OF_DIAGNOSA->Disabled && !isset($Grid->DATE_OF_DIAGNOSA->EditAttrs["readonly"]) && !isset($Grid->DATE_OF_DIAGNOSA->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_DIAGNOSAgrid", "x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" class="form-group PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA">
<span<?= $Grid->DATE_OF_DIAGNOSA->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->DATE_OF_DIAGNOSA->getDisplayValue($Grid->DATE_OF_DIAGNOSA->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-hidden="1" name="x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" id="x<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" value="<?= HtmlEncode($Grid->DATE_OF_DIAGNOSA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DATE_OF_DIAGNOSA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" id="o<?= $Grid->RowIndex ?>_DATE_OF_DIAGNOSA" value="<?= HtmlEncode($Grid->DATE_OF_DIAGNOSA->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <td data-name="DIAGNOSA_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="form-group PASIEN_DIAGNOSA_DIAGNOSA_ID">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_DIAGNOSA_ID"><?= EmptyValue(strval($Grid->DIAGNOSA_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->DIAGNOSA_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->DIAGNOSA_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->DIAGNOSA_ID->ReadOnly || $Grid->DIAGNOSA_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_DIAGNOSA_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->DIAGNOSA_ID->getErrorMessage() ?></div>
<?= $Grid->DIAGNOSA_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_DIAGNOSA_ID") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->DIAGNOSA_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" id="x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" value="<?= $Grid->DIAGNOSA_ID->CurrentValue ?>"<?= $Grid->DIAGNOSA_ID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="form-group PASIEN_DIAGNOSA_DIAGNOSA_ID">
<span<?= $Grid->DIAGNOSA_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->DIAGNOSA_ID->getDisplayValue($Grid->DIAGNOSA_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" id="x<?= $Grid->RowIndex ?>_DIAGNOSA_ID" value="<?= HtmlEncode($Grid->DIAGNOSA_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DIAGNOSA_ID" id="o<?= $Grid->RowIndex ?>_DIAGNOSA_ID" value="<?= HtmlEncode($Grid->DIAGNOSA_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ANAMNASE->Visible) { // ANAMNASE ?>
        <td data-name="ANAMNASE">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_ANAMNASE" class="form-group PASIEN_DIAGNOSA_ANAMNASE">
<textarea data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" name="x<?= $Grid->RowIndex ?>_ANAMNASE" id="x<?= $Grid->RowIndex ?>_ANAMNASE" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->ANAMNASE->getPlaceHolder()) ?>"<?= $Grid->ANAMNASE->editAttributes() ?>><?= $Grid->ANAMNASE->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->ANAMNASE->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_ANAMNASE" class="form-group PASIEN_DIAGNOSA_ANAMNASE">
<span<?= $Grid->ANAMNASE->viewAttributes() ?>>
<?= $Grid->ANAMNASE->ViewValue ?></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ANAMNASE" id="x<?= $Grid->RowIndex ?>_ANAMNASE" value="<?= HtmlEncode($Grid->ANAMNASE->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_ANAMNASE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ANAMNASE" id="o<?= $Grid->RowIndex ?>_ANAMNASE" value="<?= HtmlEncode($Grid->ANAMNASE->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
        <td data-name="PEMERIKSAAN">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_PEMERIKSAAN" class="form-group PASIEN_DIAGNOSA_PEMERIKSAAN">
<input type="<?= $Grid->PEMERIKSAAN->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" name="x<?= $Grid->RowIndex ?>_PEMERIKSAAN" id="x<?= $Grid->RowIndex ?>_PEMERIKSAAN" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->PEMERIKSAAN->getPlaceHolder()) ?>" value="<?= $Grid->PEMERIKSAAN->EditValue ?>"<?= $Grid->PEMERIKSAAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->PEMERIKSAAN->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_PEMERIKSAAN" class="form-group PASIEN_DIAGNOSA_PEMERIKSAAN">
<span<?= $Grid->PEMERIKSAAN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->PEMERIKSAAN->getDisplayValue($Grid->PEMERIKSAAN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" data-hidden="1" name="x<?= $Grid->RowIndex ?>_PEMERIKSAAN" id="x<?= $Grid->RowIndex ?>_PEMERIKSAAN" value="<?= HtmlEncode($Grid->PEMERIKSAAN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_PEMERIKSAAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_PEMERIKSAAN" id="o<?= $Grid->RowIndex ?>_PEMERIKSAAN" value="<?= HtmlEncode($Grid->PEMERIKSAAN->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
        <td data-name="TERAPHY_DESC">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_TERAPHY_DESC" class="form-group PASIEN_DIAGNOSA_TERAPHY_DESC">
<input type="<?= $Grid->TERAPHY_DESC->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" name="x<?= $Grid->RowIndex ?>_TERAPHY_DESC" id="x<?= $Grid->RowIndex ?>_TERAPHY_DESC" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->TERAPHY_DESC->getPlaceHolder()) ?>" value="<?= $Grid->TERAPHY_DESC->EditValue ?>"<?= $Grid->TERAPHY_DESC->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TERAPHY_DESC->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_TERAPHY_DESC" class="form-group PASIEN_DIAGNOSA_TERAPHY_DESC">
<span<?= $Grid->TERAPHY_DESC->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TERAPHY_DESC->getDisplayValue($Grid->TERAPHY_DESC->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TERAPHY_DESC" id="x<?= $Grid->RowIndex ?>_TERAPHY_DESC" value="<?= HtmlEncode($Grid->TERAPHY_DESC->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TERAPHY_DESC" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TERAPHY_DESC" id="o<?= $Grid->RowIndex ?>_TERAPHY_DESC" value="<?= HtmlEncode($Grid->TERAPHY_DESC->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TGLKONTROL->Visible) { // TGLKONTROL ?>
        <td data-name="TGLKONTROL">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_TGLKONTROL" class="form-group PASIEN_DIAGNOSA_TGLKONTROL">
<input type="<?= $Grid->TGLKONTROL->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" name="x<?= $Grid->RowIndex ?>_TGLKONTROL" id="x<?= $Grid->RowIndex ?>_TGLKONTROL" placeholder="<?= HtmlEncode($Grid->TGLKONTROL->getPlaceHolder()) ?>" value="<?= $Grid->TGLKONTROL->EditValue ?>"<?= $Grid->TGLKONTROL->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TGLKONTROL->getErrorMessage() ?></div>
<?php if (!$Grid->TGLKONTROL->ReadOnly && !$Grid->TGLKONTROL->Disabled && !isset($Grid->TGLKONTROL->EditAttrs["readonly"]) && !isset($Grid->TGLKONTROL->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_DIAGNOSAgrid", "x<?= $Grid->RowIndex ?>_TGLKONTROL", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_TGLKONTROL" class="form-group PASIEN_DIAGNOSA_TGLKONTROL">
<span<?= $Grid->TGLKONTROL->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TGLKONTROL->getDisplayValue($Grid->TGLKONTROL->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TGLKONTROL" id="x<?= $Grid->RowIndex ?>_TGLKONTROL" value="<?= HtmlEncode($Grid->TGLKONTROL->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_TGLKONTROL" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TGLKONTROL" id="o<?= $Grid->RowIndex ?>_TGLKONTROL" value="<?= HtmlEncode($Grid->TGLKONTROL->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
        <td data-name="IDXDAFTAR">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_IDXDAFTAR" class="form-group PASIEN_DIAGNOSA_IDXDAFTAR">
<input type="<?= $Grid->IDXDAFTAR->getInputTextType() ?>" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" name="x<?= $Grid->RowIndex ?>_IDXDAFTAR" id="x<?= $Grid->RowIndex ?>_IDXDAFTAR" size="30" placeholder="<?= HtmlEncode($Grid->IDXDAFTAR->getPlaceHolder()) ?>" value="<?= $Grid->IDXDAFTAR->EditValue ?>"<?= $Grid->IDXDAFTAR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->IDXDAFTAR->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_DIAGNOSA_IDXDAFTAR" class="form-group PASIEN_DIAGNOSA_IDXDAFTAR">
<span<?= $Grid->IDXDAFTAR->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->IDXDAFTAR->getDisplayValue($Grid->IDXDAFTAR->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" data-hidden="1" name="x<?= $Grid->RowIndex ?>_IDXDAFTAR" id="x<?= $Grid->RowIndex ?>_IDXDAFTAR" value="<?= HtmlEncode($Grid->IDXDAFTAR->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_DIAGNOSA" data-field="x_IDXDAFTAR" data-hidden="1" name="o<?= $Grid->RowIndex ?>_IDXDAFTAR" id="o<?= $Grid->RowIndex ?>_IDXDAFTAR" value="<?= HtmlEncode($Grid->IDXDAFTAR->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fPASIEN_DIAGNOSAgrid","load"], function() {
    fPASIEN_DIAGNOSAgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fPASIEN_DIAGNOSAgrid">
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
    ew.addEventHandlers("PASIEN_DIAGNOSA");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
