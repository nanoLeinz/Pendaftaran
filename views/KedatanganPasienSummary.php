<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$KedatanganPasienSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentForm, currentPageID;
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?= $Page->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?= $Page->ReportTableStyle ?>>
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_kedatangan_pasien" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->VISIT_DATE->Visible) { ?>
    <th data-name="VISIT_DATE" class="<?= $Page->VISIT_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div class="kedatangan_pasien_VISIT_DATE"><?= $Page->renderSort($Page->VISIT_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
    <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>"><div class="kedatangan_pasien_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { ?>
    <th data-name="CLINIC_ID" class="<?= $Page->CLINIC_ID->headerCellClass() ?>"><div class="kedatangan_pasien_CLINIC_ID"><?= $Page->renderSort($Page->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
    <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>"><div class="kedatangan_pasien_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { ?>
    <th data-name="STATUS_PASIEN_ID" class="<?= $Page->STATUS_PASIEN_ID->headerCellClass() ?>"><div class="kedatangan_pasien_STATUS_PASIEN_ID"><?= $Page->renderSort($Page->STATUS_PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Page->VISIT_ID->Visible) { ?>
    <th data-name="VISIT_ID" class="<?= $Page->VISIT_ID->headerCellClass() ?>"><div class="kedatangan_pasien_VISIT_ID"><?= $Page->renderSort($Page->VISIT_ID) ?></div></th>
<?php } ?>
<?php if ($Page->NAME_OF_CLINIC->Visible) { ?>
    <th data-name="NAME_OF_CLINIC" class="<?= $Page->NAME_OF_CLINIC->headerCellClass() ?>"><div class="kedatangan_pasien_NAME_OF_CLINIC"><?= $Page->renderSort($Page->NAME_OF_CLINIC) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->VISIT_DATE->Visible) { ?>
        <td data-field="VISIT_DATE"<?= $Page->VISIT_DATE->cellAttributes() ?>>
<span<?= $Page->VISIT_DATE->viewAttributes() ?>>
<?= $Page->VISIT_DATE->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
        <td data-field="NO_REGISTRATION"<?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { ?>
        <td data-field="CLINIC_ID"<?= $Page->CLINIC_ID->cellAttributes() ?>>
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
        <td data-field="GENDER"<?= $Page->GENDER->cellAttributes() ?>>
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { ?>
        <td data-field="STATUS_PASIEN_ID"<?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->VISIT_ID->Visible) { ?>
        <td data-field="VISIT_ID"<?= $Page->VISIT_ID->cellAttributes() ?>>
<span<?= $Page->VISIT_ID->viewAttributes() ?>>
<?= $Page->VISIT_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->NAME_OF_CLINIC->Visible) { ?>
        <td data-field="NAME_OF_CLINIC"<?= $Page->NAME_OF_CLINIC->cellAttributes() ?>>
<span<?= $Page->NAME_OF_CLINIC->viewAttributes() ?>>
<?= $Page->NAME_OF_CLINIC->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_TOTAL;
    $Page->RowTotalType = ROWTOTAL_GRAND;
    $Page->RowTotalSubType = ROWTOTAL_FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, 0); ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
