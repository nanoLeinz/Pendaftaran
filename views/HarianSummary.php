<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$HarianSummary = &$Page;
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
<div id="gmp_harian" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->VISIT_DATE->Visible) { ?>
    <th data-name="VISIT_DATE" class="<?= $Page->VISIT_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div class="harian_VISIT_DATE"><?= $Page->renderSort($Page->VISIT_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
    <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div class="harian_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { ?>
    <th data-name="CLINIC_ID" class="<?= $Page->CLINIC_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="harian_CLINIC_ID"><?= $Page->renderSort($Page->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
    <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>" style="white-space: nowrap;"><div class="harian_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { ?>
    <th data-name="STATUS_PASIEN_ID" class="<?= $Page->STATUS_PASIEN_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="harian_STATUS_PASIEN_ID"><?= $Page->renderSort($Page->STATUS_PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Page->NAME_OF_STATUS_PASIEN->Visible) { ?>
    <th data-name="NAME_OF_STATUS_PASIEN" class="<?= $Page->NAME_OF_STATUS_PASIEN->headerCellClass() ?>"><div class="harian_NAME_OF_STATUS_PASIEN"><?= $Page->renderSort($Page->NAME_OF_STATUS_PASIEN) ?></div></th>
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
<?php if ($Page->NAME_OF_STATUS_PASIEN->Visible) { ?>
        <td data-field="NAME_OF_STATUS_PASIEN"<?= $Page->NAME_OF_STATUS_PASIEN->cellAttributes() ?>>
<span<?= $Page->NAME_OF_STATUS_PASIEN->viewAttributes() ?>>
<?= $Page->NAME_OF_STATUS_PASIEN->getViewValue() ?></span>
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
<!-- Bottom Container -->
<div class="row">
    <div id="ew-bottom" class="<?= $Page->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up page break
    if (($Page->isExport("print") || $Page->isExport("pdf") || $Page->isExport("email") || $Page->isExport("excel") && Config("USE_PHPEXCEL") || $Page->isExport("word") && Config("USE_PHPWORD")) && $Page->ExportChartPageBreak) {
        // Page_Breaking server event
        $Page->pageBreaking($Page->ExportChartPageBreak, $Page->PageBreakContent);

        // Set up chart page break
        $Page->KunjunganHariIni->PageBreakType = "before"; // Page break type
        $Page->KunjunganHariIni->PageBreak = $Page->ExportChartPageBreak;
        $Page->KunjunganHariIni->PageBreakContent = $Page->PageBreakContent;
    }

    // Set up chart drilldown
    $Page->KunjunganHariIni->DrillDownInPanel = $Page->DrillDownInPanel;
    $Page->KunjunganHariIni->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->KunjunganHariIni->hasData()) { ?>
<?php if (!$Page->isExport()) { ?>
<div class="mb-3"><a href="#" class="ew-top-link" onclick="$(document).scrollTop($('#top').offset().top); return false;"><?= $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up page break
    if (($Page->isExport("print") || $Page->isExport("pdf") || $Page->isExport("email") || $Page->isExport("excel") && Config("USE_PHPEXCEL") || $Page->isExport("word") && Config("USE_PHPWORD")) && $Page->ExportChartPageBreak) {
        // Page_Breaking server event
        $Page->pageBreaking($Page->ExportChartPageBreak, $Page->PageBreakContent);

        // Set up chart page break
        $Page->Chart1->PageBreakType = "before"; // Page break type
        $Page->Chart1->PageBreak = $Page->ExportChartPageBreak;
        $Page->Chart1->PageBreakContent = $Page->PageBreakContent;
    }

    // Set up chart drilldown
    $Page->Chart1->DrillDownInPanel = $Page->DrillDownInPanel;
    $Page->Chart1->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->Chart1->hasData()) { ?>
<?php if (!$Page->isExport()) { ?>
<div class="mb-3"><a href="#" class="ew-top-link" onclick="$(document).scrollTop($('#top').offset().top); return false;"><?= $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
    </div>
</div>
<!-- /#ew-bottom -->
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
