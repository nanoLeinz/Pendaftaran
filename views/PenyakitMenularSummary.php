<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PenyakitMenularSummary = &$Page;
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
<div id="gmp_penyakit_menular" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
    <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->THENAME->Visible) { ?>
    <th data-name="THENAME" class="<?= $Page->THENAME->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_THENAME"><?= $Page->renderSort($Page->THENAME) ?></div></th>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { ?>
    <th data-name="KELUAR_ID" class="<?= $Page->KELUAR_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_KELUAR_ID"><?= $Page->renderSort($Page->KELUAR_ID) ?></div></th>
<?php } ?>
<?php if ($Page->DATE_OF_DIAGNOSA->Visible) { ?>
    <th data-name="DATE_OF_DIAGNOSA" class="<?= $Page->DATE_OF_DIAGNOSA->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_DATE_OF_DIAGNOSA"><?= $Page->renderSort($Page->DATE_OF_DIAGNOSA) ?></div></th>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { ?>
    <th data-name="DIAGNOSA_ID" class="<?= $Page->DIAGNOSA_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_DIAGNOSA_ID"><?= $Page->renderSort($Page->DIAGNOSA_ID) ?></div></th>
<?php } ?>
<?php if ($Page->SUFFER_TYPE->Visible) { ?>
    <th data-name="SUFFER_TYPE" class="<?= $Page->SUFFER_TYPE->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_SUFFER_TYPE"><?= $Page->renderSort($Page->SUFFER_TYPE) ?></div></th>
<?php } ?>
<?php if ($Page->AGEYEAR->Visible) { ?>
    <th data-name="AGEYEAR" class="<?= $Page->AGEYEAR->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_AGEYEAR"><?= $Page->renderSort($Page->AGEYEAR) ?></div></th>
<?php } ?>
<?php if ($Page->THEADDRESS->Visible) { ?>
    <th data-name="THEADDRESS" class="<?= $Page->THEADDRESS->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_THEADDRESS"><?= $Page->renderSort($Page->THEADDRESS) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
    <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>" style="white-space: nowrap;"><div class="penyakit_menular_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->ID->Visible) { ?>
    <th data-name="ID" class="<?= $Page->ID->headerCellClass() ?>"><div class="penyakit_menular_ID"><?= $Page->renderSort($Page->ID) ?></div></th>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { ?>
    <th data-name="IDXDAFTAR" class="<?= $Page->IDXDAFTAR->headerCellClass() ?>"><div class="penyakit_menular_IDXDAFTAR"><?= $Page->renderSort($Page->IDXDAFTAR) ?></div></th>
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
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
        <td data-field="NO_REGISTRATION"<?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->THENAME->Visible) { ?>
        <td data-field="THENAME"<?= $Page->THENAME->cellAttributes() ?>>
<span<?= $Page->THENAME->viewAttributes() ?>>
<?= $Page->THENAME->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { ?>
        <td data-field="KELUAR_ID"<?= $Page->KELUAR_ID->cellAttributes() ?>>
<span<?= $Page->KELUAR_ID->viewAttributes() ?>>
<?= $Page->KELUAR_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->DATE_OF_DIAGNOSA->Visible) { ?>
        <td data-field="DATE_OF_DIAGNOSA"<?= $Page->DATE_OF_DIAGNOSA->cellAttributes() ?>>
<span<?= $Page->DATE_OF_DIAGNOSA->viewAttributes() ?>>
<?= $Page->DATE_OF_DIAGNOSA->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { ?>
        <td data-field="DIAGNOSA_ID"<?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->SUFFER_TYPE->Visible) { ?>
        <td data-field="SUFFER_TYPE"<?= $Page->SUFFER_TYPE->cellAttributes() ?>>
<span<?= $Page->SUFFER_TYPE->viewAttributes() ?>>
<?= $Page->SUFFER_TYPE->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->AGEYEAR->Visible) { ?>
        <td data-field="AGEYEAR"<?= $Page->AGEYEAR->cellAttributes() ?>>
<span<?= $Page->AGEYEAR->viewAttributes() ?>>
<?= $Page->AGEYEAR->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->THEADDRESS->Visible) { ?>
        <td data-field="THEADDRESS"<?= $Page->THEADDRESS->cellAttributes() ?>>
<span<?= $Page->THEADDRESS->viewAttributes() ?>>
<?= $Page->THEADDRESS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
        <td data-field="GENDER"<?= $Page->GENDER->cellAttributes() ?>>
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ID->Visible) { ?>
        <td data-field="ID"<?= $Page->ID->cellAttributes() ?>>
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { ?>
        <td data-field="IDXDAFTAR"<?= $Page->IDXDAFTAR->cellAttributes() ?>>
<span<?= $Page->IDXDAFTAR->viewAttributes() ?>>
<?= $Page->IDXDAFTAR->getViewValue() ?></span>
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
