<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Dashboard Page object
$Dashboard2 = $Page;
?>
<script>
var currentForm, currentPageID;
var fdashboard;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "dashboard";
    fdashboard = currentForm = new ew.Form("fdashboard", "dashboard");
    loadjs.done("fdashboard");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar"></div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="container-fluid ew-dashboard ew-horizontal">
<div class="row">
<div class="<?= $Page->ItemClassNames[0] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item1" class="card">
<div class="card-header">
    <h3 class="card-title"><?= $Language->chartPhrase("harian", "KunjunganHariIni", "ChartCaption") ?></h3>
    <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$harian = Container("harian");
$harian->KunjunganHariIni->Width = 500;
$harian->KunjunganHariIni->Height = 500;
$harian->KunjunganHariIni->setParameter("clickurl", "Harian"); // Add click URL
$harian->KunjunganHariIni->DrillDownUrl = ""; // No drill down for dashboard
$harian->KunjunganHariIni->render("ew-chart-top");
?>
</div>
</div>
</div>
<div class="<?= $Page->ItemClassNames[1] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item2" class="card">
<div class="card-header">
    <h3 class="card-title"><?= $Language->chartPhrase("harian", "Chart1", "ChartCaption") ?></h3>
    <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$harian = Container("harian");
$harian->Chart1->Width = 500;
$harian->Chart1->Height = 500;
$harian->Chart1->setParameter("clickurl", "Harian"); // Add click URL
$harian->Chart1->DrillDownUrl = ""; // No drill down for dashboard
$harian->Chart1->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
