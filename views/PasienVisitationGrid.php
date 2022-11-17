<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Set up and run Grid object
$Grid = Container("PasienVisitationGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPASIEN_VISITATIONgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fPASIEN_VISITATIONgrid = new ew.Form("fPASIEN_VISITATIONgrid", "grid");
    fPASIEN_VISITATIONgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PASIEN_VISITATION")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PASIEN_VISITATION)
        ew.vars.tables.PASIEN_VISITATION = currentTable;
    fPASIEN_VISITATIONgrid.addFields([
        ["TICKET_NO", [fields.TICKET_NO.visible && fields.TICKET_NO.required ? ew.Validators.required(fields.TICKET_NO.caption) : null], fields.TICKET_NO.isInvalid],
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["STATUS_PASIEN_ID", [fields.STATUS_PASIEN_ID.visible && fields.STATUS_PASIEN_ID.required ? ew.Validators.required(fields.STATUS_PASIEN_ID.caption) : null], fields.STATUS_PASIEN_ID.isInvalid],
        ["PASIEN_ID", [fields.PASIEN_ID.visible && fields.PASIEN_ID.required ? ew.Validators.required(fields.PASIEN_ID.caption) : null], fields.PASIEN_ID.isInvalid],
        ["VISIT_DATE", [fields.VISIT_DATE.visible && fields.VISIT_DATE.required ? ew.Validators.required(fields.VISIT_DATE.caption) : null, ew.Validators.datetime(11)], fields.VISIT_DATE.isInvalid],
        ["CLINIC_ID", [fields.CLINIC_ID.visible && fields.CLINIC_ID.required ? ew.Validators.required(fields.CLINIC_ID.caption) : null], fields.CLINIC_ID.isInvalid],
        ["GENDER", [fields.GENDER.visible && fields.GENDER.required ? ew.Validators.required(fields.GENDER.caption) : null], fields.GENDER.isInvalid],
        ["EMPLOYEE_ID", [fields.EMPLOYEE_ID.visible && fields.EMPLOYEE_ID.required ? ew.Validators.required(fields.EMPLOYEE_ID.caption) : null], fields.EMPLOYEE_ID.isInvalid],
        ["PAYOR_ID", [fields.PAYOR_ID.visible && fields.PAYOR_ID.required ? ew.Validators.required(fields.PAYOR_ID.caption) : null], fields.PAYOR_ID.isInvalid],
        ["CLASS_ID", [fields.CLASS_ID.visible && fields.CLASS_ID.required ? ew.Validators.required(fields.CLASS_ID.caption) : null, ew.Validators.integer], fields.CLASS_ID.isInvalid],
        ["AGEYEAR", [fields.AGEYEAR.visible && fields.AGEYEAR.required ? ew.Validators.required(fields.AGEYEAR.caption) : null, ew.Validators.integer], fields.AGEYEAR.isInvalid],
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
        var f = fPASIEN_VISITATIONgrid,
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
    fPASIEN_VISITATIONgrid.validate = function () {
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
    fPASIEN_VISITATIONgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "TICKET_NO", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "NO_REGISTRATION", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "STATUS_PASIEN_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "PASIEN_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "VISIT_DATE", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "CLINIC_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "GENDER", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "EMPLOYEE_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "PAYOR_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "CLASS_ID", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "AGEYEAR", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "SEP", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "idbooking", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "id_tujuan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "id_penunjang", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "id_pembiayaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "id_procedure", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "id_aspel", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "id_kelas", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fPASIEN_VISITATIONgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPASIEN_VISITATIONgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fPASIEN_VISITATIONgrid.lists.NO_REGISTRATION = <?= $Grid->NO_REGISTRATION->toClientList($Grid) ?>;
    fPASIEN_VISITATIONgrid.lists.STATUS_PASIEN_ID = <?= $Grid->STATUS_PASIEN_ID->toClientList($Grid) ?>;
    fPASIEN_VISITATIONgrid.lists.CLINIC_ID = <?= $Grid->CLINIC_ID->toClientList($Grid) ?>;
    fPASIEN_VISITATIONgrid.lists.GENDER = <?= $Grid->GENDER->toClientList($Grid) ?>;
    fPASIEN_VISITATIONgrid.lists.EMPLOYEE_ID = <?= $Grid->EMPLOYEE_ID->toClientList($Grid) ?>;
    fPASIEN_VISITATIONgrid.lists.CLASS_ID = <?= $Grid->CLASS_ID->toClientList($Grid) ?>;
    loadjs.done("fPASIEN_VISITATIONgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PASIEN_VISITATION">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fPASIEN_VISITATIONgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_PASIEN_VISITATION" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_PASIEN_VISITATIONgrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->TICKET_NO->Visible) { // TICKET_NO ?>
        <th data-name="TICKET_NO" class="<?= $Grid->TICKET_NO->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_TICKET_NO" class="PASIEN_VISITATION_TICKET_NO"><?= $Grid->renderSort($Grid->TICKET_NO) ?></div></th>
<?php } ?>
<?php if ($Grid->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <th data-name="NO_REGISTRATION" class="<?= $Grid->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_NO_REGISTRATION" class="PASIEN_VISITATION_NO_REGISTRATION"><?= $Grid->renderSort($Grid->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Grid->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <th data-name="STATUS_PASIEN_ID" class="<?= $Grid->STATUS_PASIEN_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_STATUS_PASIEN_ID" class="PASIEN_VISITATION_STATUS_PASIEN_ID"><?= $Grid->renderSort($Grid->STATUS_PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <th data-name="PASIEN_ID" class="<?= $Grid->PASIEN_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_PASIEN_ID" class="PASIEN_VISITATION_PASIEN_ID"><?= $Grid->renderSort($Grid->PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <th data-name="VISIT_DATE" class="<?= $Grid->VISIT_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_VISIT_DATE" class="PASIEN_VISITATION_VISIT_DATE"><?= $Grid->renderSort($Grid->VISIT_DATE) ?></div></th>
<?php } ?>
<?php if ($Grid->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th data-name="CLINIC_ID" class="<?= $Grid->CLINIC_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_CLINIC_ID" class="PASIEN_VISITATION_CLINIC_ID"><?= $Grid->renderSort($Grid->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->GENDER->Visible) { // GENDER ?>
        <th data-name="GENDER" class="<?= $Grid->GENDER->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_GENDER" class="PASIEN_VISITATION_GENDER"><?= $Grid->renderSort($Grid->GENDER) ?></div></th>
<?php } ?>
<?php if ($Grid->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <th data-name="EMPLOYEE_ID" class="<?= $Grid->EMPLOYEE_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_EMPLOYEE_ID" class="PASIEN_VISITATION_EMPLOYEE_ID"><?= $Grid->renderSort($Grid->EMPLOYEE_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <th data-name="PAYOR_ID" class="<?= $Grid->PAYOR_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_PAYOR_ID" class="PASIEN_VISITATION_PAYOR_ID"><?= $Grid->renderSort($Grid->PAYOR_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->CLASS_ID->Visible) { // CLASS_ID ?>
        <th data-name="CLASS_ID" class="<?= $Grid->CLASS_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_CLASS_ID" class="PASIEN_VISITATION_CLASS_ID"><?= $Grid->renderSort($Grid->CLASS_ID) ?></div></th>
<?php } ?>
<?php if ($Grid->AGEYEAR->Visible) { // AGEYEAR ?>
        <th data-name="AGEYEAR" class="<?= $Grid->AGEYEAR->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_AGEYEAR" class="PASIEN_VISITATION_AGEYEAR"><?= $Grid->renderSort($Grid->AGEYEAR) ?></div></th>
<?php } ?>
<?php if ($Grid->SEP->Visible) { // SEP ?>
        <th data-name="SEP" class="<?= $Grid->SEP->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_VISITATION_SEP" class="PASIEN_VISITATION_SEP"><?= $Grid->renderSort($Grid->SEP) ?></div></th>
<?php } ?>
<?php if ($Grid->idbooking->Visible) { // idbooking ?>
        <th data-name="idbooking" class="<?= $Grid->idbooking->headerCellClass() ?>"><div id="elh_PASIEN_VISITATION_idbooking" class="PASIEN_VISITATION_idbooking"><?= $Grid->renderSort($Grid->idbooking) ?></div></th>
<?php } ?>
<?php if ($Grid->id_tujuan->Visible) { // id_tujuan ?>
        <th data-name="id_tujuan" class="<?= $Grid->id_tujuan->headerCellClass() ?>"><div id="elh_PASIEN_VISITATION_id_tujuan" class="PASIEN_VISITATION_id_tujuan"><?= $Grid->renderSort($Grid->id_tujuan) ?></div></th>
<?php } ?>
<?php if ($Grid->id_penunjang->Visible) { // id_penunjang ?>
        <th data-name="id_penunjang" class="<?= $Grid->id_penunjang->headerCellClass() ?>"><div id="elh_PASIEN_VISITATION_id_penunjang" class="PASIEN_VISITATION_id_penunjang"><?= $Grid->renderSort($Grid->id_penunjang) ?></div></th>
<?php } ?>
<?php if ($Grid->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <th data-name="id_pembiayaan" class="<?= $Grid->id_pembiayaan->headerCellClass() ?>"><div id="elh_PASIEN_VISITATION_id_pembiayaan" class="PASIEN_VISITATION_id_pembiayaan"><?= $Grid->renderSort($Grid->id_pembiayaan) ?></div></th>
<?php } ?>
<?php if ($Grid->id_procedure->Visible) { // id_procedure ?>
        <th data-name="id_procedure" class="<?= $Grid->id_procedure->headerCellClass() ?>"><div id="elh_PASIEN_VISITATION_id_procedure" class="PASIEN_VISITATION_id_procedure"><?= $Grid->renderSort($Grid->id_procedure) ?></div></th>
<?php } ?>
<?php if ($Grid->id_aspel->Visible) { // id_aspel ?>
        <th data-name="id_aspel" class="<?= $Grid->id_aspel->headerCellClass() ?>"><div id="elh_PASIEN_VISITATION_id_aspel" class="PASIEN_VISITATION_id_aspel"><?= $Grid->renderSort($Grid->id_aspel) ?></div></th>
<?php } ?>
<?php if ($Grid->id_kelas->Visible) { // id_kelas ?>
        <th data-name="id_kelas" class="<?= $Grid->id_kelas->headerCellClass() ?>"><div id="elh_PASIEN_VISITATION_id_kelas" class="PASIEN_VISITATION_id_kelas"><?= $Grid->renderSort($Grid->id_kelas) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_PASIEN_VISITATION", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->TICKET_NO->Visible) { // TICKET_NO ?>
        <td data-name="TICKET_NO" <?= $Grid->TICKET_NO->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_TICKET_NO" class="form-group">
<input type="<?= $Grid->TICKET_NO->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" name="x<?= $Grid->RowIndex ?>_TICKET_NO" id="x<?= $Grid->RowIndex ?>_TICKET_NO" size="30" placeholder="<?= HtmlEncode($Grid->TICKET_NO->getPlaceHolder()) ?>" value="<?= $Grid->TICKET_NO->EditValue ?>"<?= $Grid->TICKET_NO->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TICKET_NO->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TICKET_NO" id="o<?= $Grid->RowIndex ?>_TICKET_NO" value="<?= HtmlEncode($Grid->TICKET_NO->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_TICKET_NO" class="form-group">
<span<?= $Grid->TICKET_NO->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TICKET_NO->getDisplayValue($Grid->TICKET_NO->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TICKET_NO" id="x<?= $Grid->RowIndex ?>_TICKET_NO" value="<?= HtmlEncode($Grid->TICKET_NO->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_TICKET_NO">
<span<?= $Grid->TICKET_NO->viewAttributes() ?>>
<?= $Grid->TICKET_NO->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_TICKET_NO" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_TICKET_NO" value="<?= HtmlEncode($Grid->TICKET_NO->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_TICKET_NO" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_TICKET_NO" value="<?= HtmlEncode($Grid->TICKET_NO->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td data-name="NO_REGISTRATION" <?= $Grid->NO_REGISTRATION->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->NO_REGISTRATION->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_NO_REGISTRATION" class="form-group">
<span<?= $Grid->NO_REGISTRATION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NO_REGISTRATION->getDisplayValue($Grid->NO_REGISTRATION->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" name="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= HtmlEncode($Grid->NO_REGISTRATION->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_NO_REGISTRATION" class="form-group">
<?php $Grid->NO_REGISTRATION->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_NO_REGISTRATION"><?= EmptyValue(strval($Grid->NO_REGISTRATION->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->NO_REGISTRATION->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->NO_REGISTRATION->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->NO_REGISTRATION->ReadOnly || $Grid->NO_REGISTRATION->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_NO_REGISTRATION',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->NO_REGISTRATION->getErrorMessage() ?></div>
<?= $Grid->NO_REGISTRATION->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_NO_REGISTRATION") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->NO_REGISTRATION->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" id="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= $Grid->NO_REGISTRATION->CurrentValue ?>"<?= $Grid->NO_REGISTRATION->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NO_REGISTRATION" id="o<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= HtmlEncode($Grid->NO_REGISTRATION->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->NO_REGISTRATION->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_NO_REGISTRATION" class="form-group">
<span<?= $Grid->NO_REGISTRATION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NO_REGISTRATION->getDisplayValue($Grid->NO_REGISTRATION->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" name="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= HtmlEncode($Grid->NO_REGISTRATION->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_NO_REGISTRATION" class="form-group">
<?php $Grid->NO_REGISTRATION->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_NO_REGISTRATION"><?= EmptyValue(strval($Grid->NO_REGISTRATION->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->NO_REGISTRATION->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->NO_REGISTRATION->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->NO_REGISTRATION->ReadOnly || $Grid->NO_REGISTRATION->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_NO_REGISTRATION',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->NO_REGISTRATION->getErrorMessage() ?></div>
<?= $Grid->NO_REGISTRATION->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_NO_REGISTRATION") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->NO_REGISTRATION->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" id="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= $Grid->NO_REGISTRATION->CurrentValue ?>"<?= $Grid->NO_REGISTRATION->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_NO_REGISTRATION">
<span<?= $Grid->NO_REGISTRATION->viewAttributes() ?>>
<?= $Grid->NO_REGISTRATION->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_NO_REGISTRATION" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= HtmlEncode($Grid->NO_REGISTRATION->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_NO_REGISTRATION" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= HtmlEncode($Grid->NO_REGISTRATION->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <td data-name="STATUS_PASIEN_ID" <?= $Grid->STATUS_PASIEN_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_STATUS_PASIEN_ID" class="form-group">
<?php $Grid->STATUS_PASIEN_ID->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        name="x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Grid->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        data-table="PASIEN_VISITATION"
        data-field="x_STATUS_PASIEN_ID"
        data-value-separator="<?= $Grid->STATUS_PASIEN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->STATUS_PASIEN_ID->getPlaceHolder()) ?>"
        <?= $Grid->STATUS_PASIEN_ID->editAttributes() ?>>
        <?= $Grid->STATUS_PASIEN_ID->selectOptionListHtml("x{$Grid->RowIndex}_STATUS_PASIEN_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->STATUS_PASIEN_ID->getErrorMessage() ?></div>
<?= $Grid->STATUS_PASIEN_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_STATUS_PASIEN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_STATUS_PASIEN_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" id="o<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" value="<?= HtmlEncode($Grid->STATUS_PASIEN_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_STATUS_PASIEN_ID" class="form-group">
<?php $Grid->STATUS_PASIEN_ID->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        name="x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Grid->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        data-table="PASIEN_VISITATION"
        data-field="x_STATUS_PASIEN_ID"
        data-value-separator="<?= $Grid->STATUS_PASIEN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->STATUS_PASIEN_ID->getPlaceHolder()) ?>"
        <?= $Grid->STATUS_PASIEN_ID->editAttributes() ?>>
        <?= $Grid->STATUS_PASIEN_ID->selectOptionListHtml("x{$Grid->RowIndex}_STATUS_PASIEN_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->STATUS_PASIEN_ID->getErrorMessage() ?></div>
<?= $Grid->STATUS_PASIEN_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_STATUS_PASIEN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_STATUS_PASIEN_ID">
<span<?= $Grid->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Grid->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_STATUS_PASIEN_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" value="<?= HtmlEncode($Grid->STATUS_PASIEN_ID->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_STATUS_PASIEN_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" value="<?= HtmlEncode($Grid->STATUS_PASIEN_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <td data-name="PASIEN_ID" <?= $Grid->PASIEN_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_PASIEN_ID" class="form-group">
<input type="<?= $Grid->PASIEN_ID->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" name="x<?= $Grid->RowIndex ?>_PASIEN_ID" id="x<?= $Grid->RowIndex ?>_PASIEN_ID" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->PASIEN_ID->getPlaceHolder()) ?>" value="<?= $Grid->PASIEN_ID->EditValue ?>"<?= $Grid->PASIEN_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->PASIEN_ID->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_PASIEN_ID" id="o<?= $Grid->RowIndex ?>_PASIEN_ID" value="<?= HtmlEncode($Grid->PASIEN_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_PASIEN_ID" class="form-group">
<span<?= $Grid->PASIEN_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->PASIEN_ID->getDisplayValue($Grid->PASIEN_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_PASIEN_ID" id="x<?= $Grid->RowIndex ?>_PASIEN_ID" value="<?= HtmlEncode($Grid->PASIEN_ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_PASIEN_ID">
<span<?= $Grid->PASIEN_ID->viewAttributes() ?>>
<?= $Grid->PASIEN_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_PASIEN_ID" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_PASIEN_ID" value="<?= HtmlEncode($Grid->PASIEN_ID->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_PASIEN_ID" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_PASIEN_ID" value="<?= HtmlEncode($Grid->PASIEN_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <td data-name="VISIT_DATE" <?= $Grid->VISIT_DATE->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_VISIT_DATE" class="form-group">
<input type="<?= $Grid->VISIT_DATE->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_VISIT_DATE" data-format="11" name="x<?= $Grid->RowIndex ?>_VISIT_DATE" id="x<?= $Grid->RowIndex ?>_VISIT_DATE" placeholder="<?= HtmlEncode($Grid->VISIT_DATE->getPlaceHolder()) ?>" value="<?= $Grid->VISIT_DATE->EditValue ?>"<?= $Grid->VISIT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->VISIT_DATE->getErrorMessage() ?></div>
<?php if (!$Grid->VISIT_DATE->ReadOnly && !$Grid->VISIT_DATE->Disabled && !isset($Grid->VISIT_DATE->EditAttrs["readonly"]) && !isset($Grid->VISIT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_VISITATIONgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_VISITATIONgrid", "x<?= $Grid->RowIndex ?>_VISIT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_VISIT_DATE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_VISIT_DATE" id="o<?= $Grid->RowIndex ?>_VISIT_DATE" value="<?= HtmlEncode($Grid->VISIT_DATE->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_VISIT_DATE" class="form-group">
<input type="<?= $Grid->VISIT_DATE->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_VISIT_DATE" data-format="11" name="x<?= $Grid->RowIndex ?>_VISIT_DATE" id="x<?= $Grid->RowIndex ?>_VISIT_DATE" placeholder="<?= HtmlEncode($Grid->VISIT_DATE->getPlaceHolder()) ?>" value="<?= $Grid->VISIT_DATE->EditValue ?>"<?= $Grid->VISIT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->VISIT_DATE->getErrorMessage() ?></div>
<?php if (!$Grid->VISIT_DATE->ReadOnly && !$Grid->VISIT_DATE->Disabled && !isset($Grid->VISIT_DATE->EditAttrs["readonly"]) && !isset($Grid->VISIT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_VISITATIONgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_VISITATIONgrid", "x<?= $Grid->RowIndex ?>_VISIT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_VISIT_DATE">
<span<?= $Grid->VISIT_DATE->viewAttributes() ?>>
<?= $Grid->VISIT_DATE->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_VISIT_DATE" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_VISIT_DATE" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_VISIT_DATE" value="<?= HtmlEncode($Grid->VISIT_DATE->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_VISIT_DATE" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_VISIT_DATE" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_VISIT_DATE" value="<?= HtmlEncode($Grid->VISIT_DATE->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID" <?= $Grid->CLINIC_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_CLINIC_ID" class="form-group">
<?php $Grid->CLINIC_ID->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        name="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        class="form-control ew-select<?= $Grid->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_CLINIC_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLINIC_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_CLINIC_ID" id="o<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_CLINIC_ID" class="form-group">
<?php $Grid->CLINIC_ID->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        name="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        class="form-control ew-select<?= $Grid->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_CLINIC_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_CLINIC_ID">
<span<?= $Grid->CLINIC_ID->viewAttributes() ?>>
<?= $Grid->CLINIC_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLINIC_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_CLINIC_ID" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLINIC_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_CLINIC_ID" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER" <?= $Grid->GENDER->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_GENDER" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_GENDER">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="PASIEN_VISITATION" data-field="x_GENDER" name="x<?= $Grid->RowIndex ?>_GENDER" id="x<?= $Grid->RowIndex ?>_GENDER"<?= $Grid->GENDER->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_GENDER" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_GENDER"
    name="x<?= $Grid->RowIndex ?>_GENDER"
    value="<?= HtmlEncode($Grid->GENDER->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_GENDER"
    data-target="dsl_x<?= $Grid->RowIndex ?>_GENDER"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->GENDER->isInvalidClass() ?>"
    data-table="PASIEN_VISITATION"
    data-field="x_GENDER"
    data-value-separator="<?= $Grid->GENDER->displayValueSeparatorAttribute() ?>"
    <?= $Grid->GENDER->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->GENDER->getErrorMessage() ?></div>
<?= $Grid->GENDER->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_GENDER") ?>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_GENDER" data-hidden="1" name="o<?= $Grid->RowIndex ?>_GENDER" id="o<?= $Grid->RowIndex ?>_GENDER" value="<?= HtmlEncode($Grid->GENDER->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_GENDER" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_GENDER">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="PASIEN_VISITATION" data-field="x_GENDER" name="x<?= $Grid->RowIndex ?>_GENDER" id="x<?= $Grid->RowIndex ?>_GENDER"<?= $Grid->GENDER->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_GENDER" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_GENDER"
    name="x<?= $Grid->RowIndex ?>_GENDER"
    value="<?= HtmlEncode($Grid->GENDER->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_GENDER"
    data-target="dsl_x<?= $Grid->RowIndex ?>_GENDER"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->GENDER->isInvalidClass() ?>"
    data-table="PASIEN_VISITATION"
    data-field="x_GENDER"
    data-value-separator="<?= $Grid->GENDER->displayValueSeparatorAttribute() ?>"
    <?= $Grid->GENDER->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->GENDER->getErrorMessage() ?></div>
<?= $Grid->GENDER->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_GENDER") ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_GENDER">
<span<?= $Grid->GENDER->viewAttributes() ?>>
<?= $Grid->GENDER->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_GENDER" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_GENDER" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_GENDER" value="<?= HtmlEncode($Grid->GENDER->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_GENDER" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_GENDER" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_GENDER" value="<?= HtmlEncode($Grid->GENDER->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <td data-name="EMPLOYEE_ID" <?= $Grid->EMPLOYEE_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_EMPLOYEE_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        name="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        class="form-control ew-select<?= $Grid->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_EMPLOYEE_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_EMPLOYEE_ID" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        name="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        class="form-control ew-select<?= $Grid->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_EMPLOYEE_ID">
<span<?= $Grid->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Grid->EMPLOYEE_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_EMPLOYEE_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_EMPLOYEE_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <td data-name="PAYOR_ID" <?= $Grid->PAYOR_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_PAYOR_ID" class="form-group">
<input type="<?= $Grid->PAYOR_ID->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_PAYOR_ID" name="x<?= $Grid->RowIndex ?>_PAYOR_ID" id="x<?= $Grid->RowIndex ?>_PAYOR_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->PAYOR_ID->getPlaceHolder()) ?>" value="<?= $Grid->PAYOR_ID->EditValue ?>"<?= $Grid->PAYOR_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->PAYOR_ID->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PAYOR_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_PAYOR_ID" id="o<?= $Grid->RowIndex ?>_PAYOR_ID" value="<?= HtmlEncode($Grid->PAYOR_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_PAYOR_ID" class="form-group">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PAYOR_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_PAYOR_ID" id="x<?= $Grid->RowIndex ?>_PAYOR_ID" value="<?= HtmlEncode($Grid->PAYOR_ID->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_PAYOR_ID">
<span<?= $Grid->PAYOR_ID->viewAttributes() ?>>
<?= $Grid->PAYOR_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PAYOR_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_PAYOR_ID" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_PAYOR_ID" value="<?= HtmlEncode($Grid->PAYOR_ID->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PAYOR_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_PAYOR_ID" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_PAYOR_ID" value="<?= HtmlEncode($Grid->PAYOR_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->CLASS_ID->Visible) { // CLASS_ID ?>
        <td data-name="CLASS_ID" <?= $Grid->CLASS_ID->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_CLASS_ID" class="form-group">
<?php
$onchange = $Grid->CLASS_ID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->CLASS_ID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?= $Grid->RowIndex ?>_CLASS_ID" class="ew-auto-suggest">
    <input type="<?= $Grid->CLASS_ID->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" id="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= RemoveHtml($Grid->CLASS_ID->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->CLASS_ID->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->CLASS_ID->getPlaceHolder()) ?>"<?= $Grid->CLASS_ID->editAttributes() ?>>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-input="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" data-value-separator="<?= $Grid->CLASS_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_CLASS_ID" id="x<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= HtmlEncode($Grid->CLASS_ID->CurrentValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Grid->CLASS_ID->getErrorMessage() ?></div>
<script>
loadjs.ready(["fPASIEN_VISITATIONgrid"], function() {
    fPASIEN_VISITATIONgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_CLASS_ID","forceSelect":false}, ew.vars.tables.PASIEN_VISITATION.fields.CLASS_ID.autoSuggestOptions));
});
</script>
<?= $Grid->CLASS_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_CLASS_ID") ?>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_CLASS_ID" id="o<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= HtmlEncode($Grid->CLASS_ID->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_CLASS_ID" class="form-group">
<?php
$onchange = $Grid->CLASS_ID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->CLASS_ID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?= $Grid->RowIndex ?>_CLASS_ID" class="ew-auto-suggest">
    <input type="<?= $Grid->CLASS_ID->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" id="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= RemoveHtml($Grid->CLASS_ID->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->CLASS_ID->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->CLASS_ID->getPlaceHolder()) ?>"<?= $Grid->CLASS_ID->editAttributes() ?>>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-input="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" data-value-separator="<?= $Grid->CLASS_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_CLASS_ID" id="x<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= HtmlEncode($Grid->CLASS_ID->CurrentValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Grid->CLASS_ID->getErrorMessage() ?></div>
<script>
loadjs.ready(["fPASIEN_VISITATIONgrid"], function() {
    fPASIEN_VISITATIONgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_CLASS_ID","forceSelect":false}, ew.vars.tables.PASIEN_VISITATION.fields.CLASS_ID.autoSuggestOptions));
});
</script>
<?= $Grid->CLASS_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_CLASS_ID") ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_CLASS_ID">
<span<?= $Grid->CLASS_ID->viewAttributes() ?>>
<?= $Grid->CLASS_ID->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_CLASS_ID" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= HtmlEncode($Grid->CLASS_ID->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_CLASS_ID" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= HtmlEncode($Grid->CLASS_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->AGEYEAR->Visible) { // AGEYEAR ?>
        <td data-name="AGEYEAR" <?= $Grid->AGEYEAR->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_AGEYEAR" class="form-group">
<input type="<?= $Grid->AGEYEAR->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_AGEYEAR" name="x<?= $Grid->RowIndex ?>_AGEYEAR" id="x<?= $Grid->RowIndex ?>_AGEYEAR" size="30" placeholder="<?= HtmlEncode($Grid->AGEYEAR->getPlaceHolder()) ?>" value="<?= $Grid->AGEYEAR->EditValue ?>"<?= $Grid->AGEYEAR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->AGEYEAR->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_AGEYEAR" data-hidden="1" name="o<?= $Grid->RowIndex ?>_AGEYEAR" id="o<?= $Grid->RowIndex ?>_AGEYEAR" value="<?= HtmlEncode($Grid->AGEYEAR->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_AGEYEAR" class="form-group">
<input type="<?= $Grid->AGEYEAR->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_AGEYEAR" name="x<?= $Grid->RowIndex ?>_AGEYEAR" id="x<?= $Grid->RowIndex ?>_AGEYEAR" size="30" placeholder="<?= HtmlEncode($Grid->AGEYEAR->getPlaceHolder()) ?>" value="<?= $Grid->AGEYEAR->EditValue ?>"<?= $Grid->AGEYEAR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->AGEYEAR->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_AGEYEAR">
<span<?= $Grid->AGEYEAR->viewAttributes() ?>>
<?= $Grid->AGEYEAR->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_AGEYEAR" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_AGEYEAR" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_AGEYEAR" value="<?= HtmlEncode($Grid->AGEYEAR->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_AGEYEAR" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_AGEYEAR" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_AGEYEAR" value="<?= HtmlEncode($Grid->AGEYEAR->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->SEP->Visible) { // SEP ?>
        <td data-name="SEP" <?= $Grid->SEP->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_SEP" class="form-group">
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
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_SEP" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEP" id="o<?= $Grid->RowIndex ?>_SEP" value="<?= HtmlEncode($Grid->SEP->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_SEP" class="form-group">
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
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_SEP">
<span<?= $Grid->SEP->viewAttributes() ?>>
<?= $Grid->SEP->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_SEP" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_SEP" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_SEP" value="<?= HtmlEncode($Grid->SEP->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_SEP" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_SEP" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_SEP" value="<?= HtmlEncode($Grid->SEP->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->idbooking->Visible) { // idbooking ?>
        <td data-name="idbooking" <?= $Grid->idbooking->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_idbooking" class="form-group">
<input type="<?= $Grid->idbooking->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_idbooking" name="x<?= $Grid->RowIndex ?>_idbooking" id="x<?= $Grid->RowIndex ?>_idbooking" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->idbooking->getPlaceHolder()) ?>" value="<?= $Grid->idbooking->EditValue ?>"<?= $Grid->idbooking->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->idbooking->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_idbooking" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idbooking" id="o<?= $Grid->RowIndex ?>_idbooking" value="<?= HtmlEncode($Grid->idbooking->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_idbooking" class="form-group">
<input type="<?= $Grid->idbooking->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_idbooking" name="x<?= $Grid->RowIndex ?>_idbooking" id="x<?= $Grid->RowIndex ?>_idbooking" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->idbooking->getPlaceHolder()) ?>" value="<?= $Grid->idbooking->EditValue ?>"<?= $Grid->idbooking->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->idbooking->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_idbooking">
<span<?= $Grid->idbooking->viewAttributes() ?>>
<?= $Grid->idbooking->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_idbooking" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_idbooking" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_idbooking" value="<?= HtmlEncode($Grid->idbooking->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_idbooking" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_idbooking" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_idbooking" value="<?= HtmlEncode($Grid->idbooking->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->id_tujuan->Visible) { // id_tujuan ?>
        <td data-name="id_tujuan" <?= $Grid->id_tujuan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_tujuan" class="form-group">
<input type="<?= $Grid->id_tujuan->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" name="x<?= $Grid->RowIndex ?>_id_tujuan" id="x<?= $Grid->RowIndex ?>_id_tujuan" size="30" placeholder="<?= HtmlEncode($Grid->id_tujuan->getPlaceHolder()) ?>" value="<?= $Grid->id_tujuan->EditValue ?>"<?= $Grid->id_tujuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_tujuan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_tujuan" id="o<?= $Grid->RowIndex ?>_id_tujuan" value="<?= HtmlEncode($Grid->id_tujuan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_tujuan" class="form-group">
<input type="<?= $Grid->id_tujuan->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" name="x<?= $Grid->RowIndex ?>_id_tujuan" id="x<?= $Grid->RowIndex ?>_id_tujuan" size="30" placeholder="<?= HtmlEncode($Grid->id_tujuan->getPlaceHolder()) ?>" value="<?= $Grid->id_tujuan->EditValue ?>"<?= $Grid->id_tujuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_tujuan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_tujuan">
<span<?= $Grid->id_tujuan->viewAttributes() ?>>
<?= $Grid->id_tujuan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_tujuan" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_tujuan" value="<?= HtmlEncode($Grid->id_tujuan->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_tujuan" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_tujuan" value="<?= HtmlEncode($Grid->id_tujuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->id_penunjang->Visible) { // id_penunjang ?>
        <td data-name="id_penunjang" <?= $Grid->id_penunjang->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_penunjang" class="form-group">
<input type="<?= $Grid->id_penunjang->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" name="x<?= $Grid->RowIndex ?>_id_penunjang" id="x<?= $Grid->RowIndex ?>_id_penunjang" size="30" placeholder="<?= HtmlEncode($Grid->id_penunjang->getPlaceHolder()) ?>" value="<?= $Grid->id_penunjang->EditValue ?>"<?= $Grid->id_penunjang->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_penunjang->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_penunjang" id="o<?= $Grid->RowIndex ?>_id_penunjang" value="<?= HtmlEncode($Grid->id_penunjang->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_penunjang" class="form-group">
<input type="<?= $Grid->id_penunjang->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" name="x<?= $Grid->RowIndex ?>_id_penunjang" id="x<?= $Grid->RowIndex ?>_id_penunjang" size="30" placeholder="<?= HtmlEncode($Grid->id_penunjang->getPlaceHolder()) ?>" value="<?= $Grid->id_penunjang->EditValue ?>"<?= $Grid->id_penunjang->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_penunjang->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_penunjang">
<span<?= $Grid->id_penunjang->viewAttributes() ?>>
<?= $Grid->id_penunjang->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_penunjang" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_penunjang" value="<?= HtmlEncode($Grid->id_penunjang->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_penunjang" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_penunjang" value="<?= HtmlEncode($Grid->id_penunjang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <td data-name="id_pembiayaan" <?= $Grid->id_pembiayaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_pembiayaan" class="form-group">
<input type="<?= $Grid->id_pembiayaan->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" name="x<?= $Grid->RowIndex ?>_id_pembiayaan" id="x<?= $Grid->RowIndex ?>_id_pembiayaan" size="30" placeholder="<?= HtmlEncode($Grid->id_pembiayaan->getPlaceHolder()) ?>" value="<?= $Grid->id_pembiayaan->EditValue ?>"<?= $Grid->id_pembiayaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_pembiayaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_pembiayaan" id="o<?= $Grid->RowIndex ?>_id_pembiayaan" value="<?= HtmlEncode($Grid->id_pembiayaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_pembiayaan" class="form-group">
<input type="<?= $Grid->id_pembiayaan->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" name="x<?= $Grid->RowIndex ?>_id_pembiayaan" id="x<?= $Grid->RowIndex ?>_id_pembiayaan" size="30" placeholder="<?= HtmlEncode($Grid->id_pembiayaan->getPlaceHolder()) ?>" value="<?= $Grid->id_pembiayaan->EditValue ?>"<?= $Grid->id_pembiayaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_pembiayaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_pembiayaan">
<span<?= $Grid->id_pembiayaan->viewAttributes() ?>>
<?= $Grid->id_pembiayaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_pembiayaan" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_pembiayaan" value="<?= HtmlEncode($Grid->id_pembiayaan->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_pembiayaan" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_pembiayaan" value="<?= HtmlEncode($Grid->id_pembiayaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->id_procedure->Visible) { // id_procedure ?>
        <td data-name="id_procedure" <?= $Grid->id_procedure->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_procedure" class="form-group">
<input type="<?= $Grid->id_procedure->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_procedure" name="x<?= $Grid->RowIndex ?>_id_procedure" id="x<?= $Grid->RowIndex ?>_id_procedure" size="30" placeholder="<?= HtmlEncode($Grid->id_procedure->getPlaceHolder()) ?>" value="<?= $Grid->id_procedure->EditValue ?>"<?= $Grid->id_procedure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_procedure->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_procedure" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_procedure" id="o<?= $Grid->RowIndex ?>_id_procedure" value="<?= HtmlEncode($Grid->id_procedure->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_procedure" class="form-group">
<input type="<?= $Grid->id_procedure->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_procedure" name="x<?= $Grid->RowIndex ?>_id_procedure" id="x<?= $Grid->RowIndex ?>_id_procedure" size="30" placeholder="<?= HtmlEncode($Grid->id_procedure->getPlaceHolder()) ?>" value="<?= $Grid->id_procedure->EditValue ?>"<?= $Grid->id_procedure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_procedure->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_procedure">
<span<?= $Grid->id_procedure->viewAttributes() ?>>
<?= $Grid->id_procedure->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_procedure" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_procedure" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_procedure" value="<?= HtmlEncode($Grid->id_procedure->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_procedure" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_procedure" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_procedure" value="<?= HtmlEncode($Grid->id_procedure->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->id_aspel->Visible) { // id_aspel ?>
        <td data-name="id_aspel" <?= $Grid->id_aspel->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_aspel" class="form-group">
<input type="<?= $Grid->id_aspel->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_aspel" name="x<?= $Grid->RowIndex ?>_id_aspel" id="x<?= $Grid->RowIndex ?>_id_aspel" size="30" placeholder="<?= HtmlEncode($Grid->id_aspel->getPlaceHolder()) ?>" value="<?= $Grid->id_aspel->EditValue ?>"<?= $Grid->id_aspel->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_aspel->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_aspel" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_aspel" id="o<?= $Grid->RowIndex ?>_id_aspel" value="<?= HtmlEncode($Grid->id_aspel->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_aspel" class="form-group">
<input type="<?= $Grid->id_aspel->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_aspel" name="x<?= $Grid->RowIndex ?>_id_aspel" id="x<?= $Grid->RowIndex ?>_id_aspel" size="30" placeholder="<?= HtmlEncode($Grid->id_aspel->getPlaceHolder()) ?>" value="<?= $Grid->id_aspel->EditValue ?>"<?= $Grid->id_aspel->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_aspel->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_aspel">
<span<?= $Grid->id_aspel->viewAttributes() ?>>
<?= $Grid->id_aspel->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_aspel" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_aspel" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_aspel" value="<?= HtmlEncode($Grid->id_aspel->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_aspel" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_aspel" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_aspel" value="<?= HtmlEncode($Grid->id_aspel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->id_kelas->Visible) { // id_kelas ?>
        <td data-name="id_kelas" <?= $Grid->id_kelas->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_kelas" class="form-group">
<input type="<?= $Grid->id_kelas->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_kelas" name="x<?= $Grid->RowIndex ?>_id_kelas" id="x<?= $Grid->RowIndex ?>_id_kelas" size="30" placeholder="<?= HtmlEncode($Grid->id_kelas->getPlaceHolder()) ?>" value="<?= $Grid->id_kelas->EditValue ?>"<?= $Grid->id_kelas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_kelas->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_kelas" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_kelas" id="o<?= $Grid->RowIndex ?>_id_kelas" value="<?= HtmlEncode($Grid->id_kelas->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_kelas" class="form-group">
<input type="<?= $Grid->id_kelas->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_kelas" name="x<?= $Grid->RowIndex ?>_id_kelas" id="x<?= $Grid->RowIndex ?>_id_kelas" size="30" placeholder="<?= HtmlEncode($Grid->id_kelas->getPlaceHolder()) ?>" value="<?= $Grid->id_kelas->EditValue ?>"<?= $Grid->id_kelas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_kelas->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_PASIEN_VISITATION_id_kelas">
<span<?= $Grid->id_kelas->viewAttributes() ?>>
<?= $Grid->id_kelas->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_kelas" data-hidden="1" name="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_kelas" id="fPASIEN_VISITATIONgrid$x<?= $Grid->RowIndex ?>_id_kelas" value="<?= HtmlEncode($Grid->id_kelas->FormValue) ?>">
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_kelas" data-hidden="1" name="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_kelas" id="fPASIEN_VISITATIONgrid$o<?= $Grid->RowIndex ?>_id_kelas" value="<?= HtmlEncode($Grid->id_kelas->OldValue) ?>">
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
loadjs.ready(["fPASIEN_VISITATIONgrid","load"], function () {
    fPASIEN_VISITATIONgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_PASIEN_VISITATION", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->TICKET_NO->Visible) { // TICKET_NO ?>
        <td data-name="TICKET_NO">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_TICKET_NO" class="form-group PASIEN_VISITATION_TICKET_NO">
<input type="<?= $Grid->TICKET_NO->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" name="x<?= $Grid->RowIndex ?>_TICKET_NO" id="x<?= $Grid->RowIndex ?>_TICKET_NO" size="30" placeholder="<?= HtmlEncode($Grid->TICKET_NO->getPlaceHolder()) ?>" value="<?= $Grid->TICKET_NO->EditValue ?>"<?= $Grid->TICKET_NO->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TICKET_NO->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_TICKET_NO" class="form-group PASIEN_VISITATION_TICKET_NO">
<span<?= $Grid->TICKET_NO->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TICKET_NO->getDisplayValue($Grid->TICKET_NO->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TICKET_NO" id="x<?= $Grid->RowIndex ?>_TICKET_NO" value="<?= HtmlEncode($Grid->TICKET_NO->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_TICKET_NO" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TICKET_NO" id="o<?= $Grid->RowIndex ?>_TICKET_NO" value="<?= HtmlEncode($Grid->TICKET_NO->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td data-name="NO_REGISTRATION">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->NO_REGISTRATION->getSessionValue() != "") { ?>
<span id="el$rowindex$_PASIEN_VISITATION_NO_REGISTRATION" class="form-group PASIEN_VISITATION_NO_REGISTRATION">
<span<?= $Grid->NO_REGISTRATION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NO_REGISTRATION->getDisplayValue($Grid->NO_REGISTRATION->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" name="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= HtmlEncode($Grid->NO_REGISTRATION->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_NO_REGISTRATION" class="form-group PASIEN_VISITATION_NO_REGISTRATION">
<?php $Grid->NO_REGISTRATION->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_NO_REGISTRATION"><?= EmptyValue(strval($Grid->NO_REGISTRATION->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->NO_REGISTRATION->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->NO_REGISTRATION->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->NO_REGISTRATION->ReadOnly || $Grid->NO_REGISTRATION->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_NO_REGISTRATION',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->NO_REGISTRATION->getErrorMessage() ?></div>
<?= $Grid->NO_REGISTRATION->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_NO_REGISTRATION") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->NO_REGISTRATION->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" id="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= $Grid->NO_REGISTRATION->CurrentValue ?>"<?= $Grid->NO_REGISTRATION->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_NO_REGISTRATION" class="form-group PASIEN_VISITATION_NO_REGISTRATION">
<span<?= $Grid->NO_REGISTRATION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NO_REGISTRATION->getDisplayValue($Grid->NO_REGISTRATION->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-hidden="1" name="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" id="x<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= HtmlEncode($Grid->NO_REGISTRATION->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_NO_REGISTRATION" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NO_REGISTRATION" id="o<?= $Grid->RowIndex ?>_NO_REGISTRATION" value="<?= HtmlEncode($Grid->NO_REGISTRATION->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <td data-name="STATUS_PASIEN_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_STATUS_PASIEN_ID" class="form-group PASIEN_VISITATION_STATUS_PASIEN_ID">
<?php $Grid->STATUS_PASIEN_ID->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        name="x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Grid->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID"
        data-table="PASIEN_VISITATION"
        data-field="x_STATUS_PASIEN_ID"
        data-value-separator="<?= $Grid->STATUS_PASIEN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->STATUS_PASIEN_ID->getPlaceHolder()) ?>"
        <?= $Grid->STATUS_PASIEN_ID->editAttributes() ?>>
        <?= $Grid->STATUS_PASIEN_ID->selectOptionListHtml("x{$Grid->RowIndex}_STATUS_PASIEN_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->STATUS_PASIEN_ID->getErrorMessage() ?></div>
<?= $Grid->STATUS_PASIEN_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_STATUS_PASIEN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_STATUS_PASIEN_ID" class="form-group PASIEN_VISITATION_STATUS_PASIEN_ID">
<span<?= $Grid->STATUS_PASIEN_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->STATUS_PASIEN_ID->getDisplayValue($Grid->STATUS_PASIEN_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_STATUS_PASIEN_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" id="x<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" value="<?= HtmlEncode($Grid->STATUS_PASIEN_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_STATUS_PASIEN_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" id="o<?= $Grid->RowIndex ?>_STATUS_PASIEN_ID" value="<?= HtmlEncode($Grid->STATUS_PASIEN_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <td data-name="PASIEN_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_PASIEN_ID" class="form-group PASIEN_VISITATION_PASIEN_ID">
<input type="<?= $Grid->PASIEN_ID->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" name="x<?= $Grid->RowIndex ?>_PASIEN_ID" id="x<?= $Grid->RowIndex ?>_PASIEN_ID" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->PASIEN_ID->getPlaceHolder()) ?>" value="<?= $Grid->PASIEN_ID->EditValue ?>"<?= $Grid->PASIEN_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->PASIEN_ID->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_PASIEN_ID" class="form-group PASIEN_VISITATION_PASIEN_ID">
<span<?= $Grid->PASIEN_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->PASIEN_ID->getDisplayValue($Grid->PASIEN_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_PASIEN_ID" id="x<?= $Grid->RowIndex ?>_PASIEN_ID" value="<?= HtmlEncode($Grid->PASIEN_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PASIEN_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_PASIEN_ID" id="o<?= $Grid->RowIndex ?>_PASIEN_ID" value="<?= HtmlEncode($Grid->PASIEN_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <td data-name="VISIT_DATE">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_VISIT_DATE" class="form-group PASIEN_VISITATION_VISIT_DATE">
<input type="<?= $Grid->VISIT_DATE->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_VISIT_DATE" data-format="11" name="x<?= $Grid->RowIndex ?>_VISIT_DATE" id="x<?= $Grid->RowIndex ?>_VISIT_DATE" placeholder="<?= HtmlEncode($Grid->VISIT_DATE->getPlaceHolder()) ?>" value="<?= $Grid->VISIT_DATE->EditValue ?>"<?= $Grid->VISIT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->VISIT_DATE->getErrorMessage() ?></div>
<?php if (!$Grid->VISIT_DATE->ReadOnly && !$Grid->VISIT_DATE->Disabled && !isset($Grid->VISIT_DATE->EditAttrs["readonly"]) && !isset($Grid->VISIT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIEN_VISITATIONgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIEN_VISITATIONgrid", "x<?= $Grid->RowIndex ?>_VISIT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_VISIT_DATE" class="form-group PASIEN_VISITATION_VISIT_DATE">
<span<?= $Grid->VISIT_DATE->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->VISIT_DATE->getDisplayValue($Grid->VISIT_DATE->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_VISIT_DATE" data-hidden="1" name="x<?= $Grid->RowIndex ?>_VISIT_DATE" id="x<?= $Grid->RowIndex ?>_VISIT_DATE" value="<?= HtmlEncode($Grid->VISIT_DATE->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_VISIT_DATE" data-hidden="1" name="o<?= $Grid->RowIndex ?>_VISIT_DATE" id="o<?= $Grid->RowIndex ?>_VISIT_DATE" value="<?= HtmlEncode($Grid->VISIT_DATE->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_CLINIC_ID" class="form-group PASIEN_VISITATION_CLINIC_ID">
<?php $Grid->CLINIC_ID->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        name="x<?= $Grid->RowIndex ?>_CLINIC_ID"
        class="form-control ew-select<?= $Grid->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_CLINIC_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_CLINIC_ID" class="form-group PASIEN_VISITATION_CLINIC_ID">
<span<?= $Grid->CLINIC_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->CLINIC_ID->getDisplayValue($Grid->CLINIC_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLINIC_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_CLINIC_ID" id="x<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLINIC_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_CLINIC_ID" id="o<?= $Grid->RowIndex ?>_CLINIC_ID" value="<?= HtmlEncode($Grid->CLINIC_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_GENDER" class="form-group PASIEN_VISITATION_GENDER">
<template id="tp_x<?= $Grid->RowIndex ?>_GENDER">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="PASIEN_VISITATION" data-field="x_GENDER" name="x<?= $Grid->RowIndex ?>_GENDER" id="x<?= $Grid->RowIndex ?>_GENDER"<?= $Grid->GENDER->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_GENDER" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_GENDER"
    name="x<?= $Grid->RowIndex ?>_GENDER"
    value="<?= HtmlEncode($Grid->GENDER->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_GENDER"
    data-target="dsl_x<?= $Grid->RowIndex ?>_GENDER"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->GENDER->isInvalidClass() ?>"
    data-table="PASIEN_VISITATION"
    data-field="x_GENDER"
    data-value-separator="<?= $Grid->GENDER->displayValueSeparatorAttribute() ?>"
    <?= $Grid->GENDER->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->GENDER->getErrorMessage() ?></div>
<?= $Grid->GENDER->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_GENDER") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_GENDER" class="form-group PASIEN_VISITATION_GENDER">
<span<?= $Grid->GENDER->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->GENDER->getDisplayValue($Grid->GENDER->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_GENDER" data-hidden="1" name="x<?= $Grid->RowIndex ?>_GENDER" id="x<?= $Grid->RowIndex ?>_GENDER" value="<?= HtmlEncode($Grid->GENDER->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_GENDER" data-hidden="1" name="o<?= $Grid->RowIndex ?>_GENDER" id="o<?= $Grid->RowIndex ?>_GENDER" value="<?= HtmlEncode($Grid->GENDER->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <td data-name="EMPLOYEE_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_EMPLOYEE_ID" class="form-group PASIEN_VISITATION_EMPLOYEE_ID">
    <select
        id="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        name="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        class="form-control ew-select<?= $Grid->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID"
        data-table="PASIEN_VISITATION"
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
    var el = document.querySelector("select[data-select2-id='PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID']"),
        options = { name: "x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", selectId: "PASIEN_VISITATION_x<?= $Grid->RowIndex ?>_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN_VISITATION.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_EMPLOYEE_ID" class="form-group PASIEN_VISITATION_EMPLOYEE_ID">
<span<?= $Grid->EMPLOYEE_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->EMPLOYEE_ID->getDisplayValue($Grid->EMPLOYEE_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_EMPLOYEE_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="x<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_EMPLOYEE_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" id="o<?= $Grid->RowIndex ?>_EMPLOYEE_ID" value="<?= HtmlEncode($Grid->EMPLOYEE_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <td data-name="PAYOR_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_PAYOR_ID" class="form-group PASIEN_VISITATION_PAYOR_ID">
<input type="<?= $Grid->PAYOR_ID->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_PAYOR_ID" name="x<?= $Grid->RowIndex ?>_PAYOR_ID" id="x<?= $Grid->RowIndex ?>_PAYOR_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->PAYOR_ID->getPlaceHolder()) ?>" value="<?= $Grid->PAYOR_ID->EditValue ?>"<?= $Grid->PAYOR_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->PAYOR_ID->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PAYOR_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_PAYOR_ID" id="x<?= $Grid->RowIndex ?>_PAYOR_ID" value="<?= HtmlEncode($Grid->PAYOR_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_PAYOR_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_PAYOR_ID" id="o<?= $Grid->RowIndex ?>_PAYOR_ID" value="<?= HtmlEncode($Grid->PAYOR_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->CLASS_ID->Visible) { // CLASS_ID ?>
        <td data-name="CLASS_ID">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_CLASS_ID" class="form-group PASIEN_VISITATION_CLASS_ID">
<?php
$onchange = $Grid->CLASS_ID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->CLASS_ID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?= $Grid->RowIndex ?>_CLASS_ID" class="ew-auto-suggest">
    <input type="<?= $Grid->CLASS_ID->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" id="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= RemoveHtml($Grid->CLASS_ID->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->CLASS_ID->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->CLASS_ID->getPlaceHolder()) ?>"<?= $Grid->CLASS_ID->editAttributes() ?>>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-input="sv_x<?= $Grid->RowIndex ?>_CLASS_ID" data-value-separator="<?= $Grid->CLASS_ID->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_CLASS_ID" id="x<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= HtmlEncode($Grid->CLASS_ID->CurrentValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Grid->CLASS_ID->getErrorMessage() ?></div>
<script>
loadjs.ready(["fPASIEN_VISITATIONgrid"], function() {
    fPASIEN_VISITATIONgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_CLASS_ID","forceSelect":false}, ew.vars.tables.PASIEN_VISITATION.fields.CLASS_ID.autoSuggestOptions));
});
</script>
<?= $Grid->CLASS_ID->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_CLASS_ID") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_CLASS_ID" class="form-group PASIEN_VISITATION_CLASS_ID">
<span<?= $Grid->CLASS_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->CLASS_ID->getDisplayValue($Grid->CLASS_ID->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-hidden="1" name="x<?= $Grid->RowIndex ?>_CLASS_ID" id="x<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= HtmlEncode($Grid->CLASS_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_CLASS_ID" data-hidden="1" name="o<?= $Grid->RowIndex ?>_CLASS_ID" id="o<?= $Grid->RowIndex ?>_CLASS_ID" value="<?= HtmlEncode($Grid->CLASS_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->AGEYEAR->Visible) { // AGEYEAR ?>
        <td data-name="AGEYEAR">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_AGEYEAR" class="form-group PASIEN_VISITATION_AGEYEAR">
<input type="<?= $Grid->AGEYEAR->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_AGEYEAR" name="x<?= $Grid->RowIndex ?>_AGEYEAR" id="x<?= $Grid->RowIndex ?>_AGEYEAR" size="30" placeholder="<?= HtmlEncode($Grid->AGEYEAR->getPlaceHolder()) ?>" value="<?= $Grid->AGEYEAR->EditValue ?>"<?= $Grid->AGEYEAR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->AGEYEAR->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_AGEYEAR" class="form-group PASIEN_VISITATION_AGEYEAR">
<span<?= $Grid->AGEYEAR->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->AGEYEAR->getDisplayValue($Grid->AGEYEAR->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_AGEYEAR" data-hidden="1" name="x<?= $Grid->RowIndex ?>_AGEYEAR" id="x<?= $Grid->RowIndex ?>_AGEYEAR" value="<?= HtmlEncode($Grid->AGEYEAR->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_AGEYEAR" data-hidden="1" name="o<?= $Grid->RowIndex ?>_AGEYEAR" id="o<?= $Grid->RowIndex ?>_AGEYEAR" value="<?= HtmlEncode($Grid->AGEYEAR->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->SEP->Visible) { // SEP ?>
        <td data-name="SEP">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_SEP" class="form-group PASIEN_VISITATION_SEP">
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
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_SEP" class="form-group PASIEN_VISITATION_SEP">
<span<?= $Grid->SEP->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->SEP->getDisplayValue($Grid->SEP->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_SEP" data-hidden="1" name="x<?= $Grid->RowIndex ?>_SEP" id="x<?= $Grid->RowIndex ?>_SEP" value="<?= HtmlEncode($Grid->SEP->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_SEP" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEP" id="o<?= $Grid->RowIndex ?>_SEP" value="<?= HtmlEncode($Grid->SEP->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idbooking->Visible) { // idbooking ?>
        <td data-name="idbooking">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_idbooking" class="form-group PASIEN_VISITATION_idbooking">
<input type="<?= $Grid->idbooking->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_idbooking" name="x<?= $Grid->RowIndex ?>_idbooking" id="x<?= $Grid->RowIndex ?>_idbooking" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->idbooking->getPlaceHolder()) ?>" value="<?= $Grid->idbooking->EditValue ?>"<?= $Grid->idbooking->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->idbooking->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_idbooking" class="form-group PASIEN_VISITATION_idbooking">
<span<?= $Grid->idbooking->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idbooking->getDisplayValue($Grid->idbooking->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_idbooking" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idbooking" id="x<?= $Grid->RowIndex ?>_idbooking" value="<?= HtmlEncode($Grid->idbooking->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_idbooking" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idbooking" id="o<?= $Grid->RowIndex ?>_idbooking" value="<?= HtmlEncode($Grid->idbooking->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->id_tujuan->Visible) { // id_tujuan ?>
        <td data-name="id_tujuan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_tujuan" class="form-group PASIEN_VISITATION_id_tujuan">
<input type="<?= $Grid->id_tujuan->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" name="x<?= $Grid->RowIndex ?>_id_tujuan" id="x<?= $Grid->RowIndex ?>_id_tujuan" size="30" placeholder="<?= HtmlEncode($Grid->id_tujuan->getPlaceHolder()) ?>" value="<?= $Grid->id_tujuan->EditValue ?>"<?= $Grid->id_tujuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_tujuan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_tujuan" class="form-group PASIEN_VISITATION_id_tujuan">
<span<?= $Grid->id_tujuan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_tujuan->getDisplayValue($Grid->id_tujuan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_tujuan" id="x<?= $Grid->RowIndex ?>_id_tujuan" value="<?= HtmlEncode($Grid->id_tujuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_tujuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_tujuan" id="o<?= $Grid->RowIndex ?>_id_tujuan" value="<?= HtmlEncode($Grid->id_tujuan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->id_penunjang->Visible) { // id_penunjang ?>
        <td data-name="id_penunjang">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_penunjang" class="form-group PASIEN_VISITATION_id_penunjang">
<input type="<?= $Grid->id_penunjang->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" name="x<?= $Grid->RowIndex ?>_id_penunjang" id="x<?= $Grid->RowIndex ?>_id_penunjang" size="30" placeholder="<?= HtmlEncode($Grid->id_penunjang->getPlaceHolder()) ?>" value="<?= $Grid->id_penunjang->EditValue ?>"<?= $Grid->id_penunjang->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_penunjang->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_penunjang" class="form-group PASIEN_VISITATION_id_penunjang">
<span<?= $Grid->id_penunjang->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_penunjang->getDisplayValue($Grid->id_penunjang->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_penunjang" id="x<?= $Grid->RowIndex ?>_id_penunjang" value="<?= HtmlEncode($Grid->id_penunjang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_penunjang" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_penunjang" id="o<?= $Grid->RowIndex ?>_id_penunjang" value="<?= HtmlEncode($Grid->id_penunjang->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <td data-name="id_pembiayaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_pembiayaan" class="form-group PASIEN_VISITATION_id_pembiayaan">
<input type="<?= $Grid->id_pembiayaan->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" name="x<?= $Grid->RowIndex ?>_id_pembiayaan" id="x<?= $Grid->RowIndex ?>_id_pembiayaan" size="30" placeholder="<?= HtmlEncode($Grid->id_pembiayaan->getPlaceHolder()) ?>" value="<?= $Grid->id_pembiayaan->EditValue ?>"<?= $Grid->id_pembiayaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_pembiayaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_pembiayaan" class="form-group PASIEN_VISITATION_id_pembiayaan">
<span<?= $Grid->id_pembiayaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_pembiayaan->getDisplayValue($Grid->id_pembiayaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_pembiayaan" id="x<?= $Grid->RowIndex ?>_id_pembiayaan" value="<?= HtmlEncode($Grid->id_pembiayaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_pembiayaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_pembiayaan" id="o<?= $Grid->RowIndex ?>_id_pembiayaan" value="<?= HtmlEncode($Grid->id_pembiayaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->id_procedure->Visible) { // id_procedure ?>
        <td data-name="id_procedure">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_procedure" class="form-group PASIEN_VISITATION_id_procedure">
<input type="<?= $Grid->id_procedure->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_procedure" name="x<?= $Grid->RowIndex ?>_id_procedure" id="x<?= $Grid->RowIndex ?>_id_procedure" size="30" placeholder="<?= HtmlEncode($Grid->id_procedure->getPlaceHolder()) ?>" value="<?= $Grid->id_procedure->EditValue ?>"<?= $Grid->id_procedure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_procedure->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_procedure" class="form-group PASIEN_VISITATION_id_procedure">
<span<?= $Grid->id_procedure->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_procedure->getDisplayValue($Grid->id_procedure->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_procedure" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_procedure" id="x<?= $Grid->RowIndex ?>_id_procedure" value="<?= HtmlEncode($Grid->id_procedure->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_procedure" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_procedure" id="o<?= $Grid->RowIndex ?>_id_procedure" value="<?= HtmlEncode($Grid->id_procedure->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->id_aspel->Visible) { // id_aspel ?>
        <td data-name="id_aspel">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_aspel" class="form-group PASIEN_VISITATION_id_aspel">
<input type="<?= $Grid->id_aspel->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_aspel" name="x<?= $Grid->RowIndex ?>_id_aspel" id="x<?= $Grid->RowIndex ?>_id_aspel" size="30" placeholder="<?= HtmlEncode($Grid->id_aspel->getPlaceHolder()) ?>" value="<?= $Grid->id_aspel->EditValue ?>"<?= $Grid->id_aspel->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_aspel->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_aspel" class="form-group PASIEN_VISITATION_id_aspel">
<span<?= $Grid->id_aspel->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_aspel->getDisplayValue($Grid->id_aspel->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_aspel" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_aspel" id="x<?= $Grid->RowIndex ?>_id_aspel" value="<?= HtmlEncode($Grid->id_aspel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_aspel" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_aspel" id="o<?= $Grid->RowIndex ?>_id_aspel" value="<?= HtmlEncode($Grid->id_aspel->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->id_kelas->Visible) { // id_kelas ?>
        <td data-name="id_kelas">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_kelas" class="form-group PASIEN_VISITATION_id_kelas">
<input type="<?= $Grid->id_kelas->getInputTextType() ?>" data-table="PASIEN_VISITATION" data-field="x_id_kelas" name="x<?= $Grid->RowIndex ?>_id_kelas" id="x<?= $Grid->RowIndex ?>_id_kelas" size="30" placeholder="<?= HtmlEncode($Grid->id_kelas->getPlaceHolder()) ?>" value="<?= $Grid->id_kelas->EditValue ?>"<?= $Grid->id_kelas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id_kelas->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_PASIEN_VISITATION_id_kelas" class="form-group PASIEN_VISITATION_id_kelas">
<span<?= $Grid->id_kelas->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_kelas->getDisplayValue($Grid->id_kelas->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_kelas" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_kelas" id="x<?= $Grid->RowIndex ?>_id_kelas" value="<?= HtmlEncode($Grid->id_kelas->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="PASIEN_VISITATION" data-field="x_id_kelas" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_kelas" id="o<?= $Grid->RowIndex ?>_id_kelas" value="<?= HtmlEncode($Grid->id_kelas->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fPASIEN_VISITATIONgrid","load"], function() {
    fPASIEN_VISITATIONgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fPASIEN_VISITATIONgrid">
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
    ew.addEventHandlers("PASIEN_VISITATION");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
