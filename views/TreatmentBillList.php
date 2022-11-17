<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatmentBillList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fTREATMENT_BILLlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fTREATMENT_BILLlist = currentForm = new ew.Form("fTREATMENT_BILLlist", "list");
    fTREATMENT_BILLlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fTREATMENT_BILLlist");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "V_LABORATORIUM") {
    if ($Page->MasterRecordExists) {
        include_once "views/VLaboratoriumMaster.php";
    }
}
?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "V_RADIOLOGI") {
    if ($Page->MasterRecordExists) {
        include_once "views/VRadiologiMaster.php";
    }
}
?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "V_FARMASI") {
    if ($Page->MasterRecordExists) {
        include_once "views/VFarmasiMaster.php";
    }
}
?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "V_KASIR") {
    if ($Page->MasterRecordExists) {
        include_once "views/VKasirMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TREATMENT_BILL">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fTREATMENT_BILLlist" id="fTREATMENT_BILLlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREATMENT_BILL">
<?php if ($Page->getCurrentMasterTable() == "V_LABORATORIUM" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_LABORATORIUM">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "V_RADIOLOGI" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_RADIOLOGI">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "V_FARMASI" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_FARMASI">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "V_KASIR" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_KASIR">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_TREATMENT_BILL" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_TREATMENT_BILLlist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
        <th data-name="TARIF_ID" class="<?= $Page->TARIF_ID->headerCellClass() ?>"><div id="elh_TREATMENT_BILL_TARIF_ID" class="TREATMENT_BILL_TARIF_ID"><?= $Page->renderSort($Page->TARIF_ID) ?></div></th>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th data-name="CLINIC_ID" class="<?= $Page->CLINIC_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_BILL_CLINIC_ID" class="TREATMENT_BILL_CLINIC_ID"><?= $Page->renderSort($Page->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Page->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <th data-name="TREAT_DATE" class="<?= $Page->TREAT_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_BILL_TREAT_DATE" class="TREATMENT_BILL_TREAT_DATE"><?= $Page->renderSort($Page->TREAT_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->QUANTITY->Visible) { // QUANTITY ?>
        <th data-name="QUANTITY" class="<?= $Page->QUANTITY->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_BILL_QUANTITY" class="TREATMENT_BILL_QUANTITY"><?= $Page->renderSort($Page->QUANTITY) ?></div></th>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <th data-name="EMPLOYEE_ID" class="<?= $Page->EMPLOYEE_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_BILL_EMPLOYEE_ID" class="TREATMENT_BILL_EMPLOYEE_ID"><?= $Page->renderSort($Page->EMPLOYEE_ID) ?></div></th>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { // amount_paid ?>
        <th data-name="amount_paid" class="<?= $Page->amount_paid->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREATMENT_BILL_amount_paid" class="TREATMENT_BILL_amount_paid"><?= $Page->renderSort($Page->amount_paid) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_TREATMENT_BILL", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
        <td data-name="TARIF_ID" <?= $Page->TARIF_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_TARIF_ID">
<span<?= $Page->TARIF_ID->viewAttributes() ?>>
<?= $Page->TARIF_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <td data-name="TREAT_DATE" <?= $Page->TREAT_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_TREAT_DATE">
<span<?= $Page->TREAT_DATE->viewAttributes() ?>>
<?= $Page->TREAT_DATE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->QUANTITY->Visible) { // QUANTITY ?>
        <td data-name="QUANTITY" <?= $Page->QUANTITY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_QUANTITY">
<span<?= $Page->QUANTITY->viewAttributes() ?>>
<?= $Page->QUANTITY->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <td data-name="EMPLOYEE_ID" <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_EMPLOYEE_ID">
<span<?= $Page->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Page->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->amount_paid->Visible) { // amount_paid ?>
        <td data-name="amount_paid" <?= $Page->amount_paid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_amount_paid">
<span<?= $Page->amount_paid->viewAttributes() ?>>
<?= $Page->amount_paid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
<?php } ?>
