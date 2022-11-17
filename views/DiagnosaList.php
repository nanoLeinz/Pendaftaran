<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$DiagnosaList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fDIAGNOSAlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fDIAGNOSAlist = currentForm = new ew.Form("fDIAGNOSAlist", "list");
    fDIAGNOSAlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fDIAGNOSAlist");
});
var fDIAGNOSAlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fDIAGNOSAlistsrch = currentSearchForm = new ew.Form("fDIAGNOSAlistsrch");

    // Dynamic selection lists

    // Filters
    fDIAGNOSAlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fDIAGNOSAlistsrch");
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
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fDIAGNOSAlistsrch" id="fDIAGNOSAlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fDIAGNOSAlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="DIAGNOSA">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> DIAGNOSA">
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
<form name="fDIAGNOSAlist" id="fDIAGNOSAlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="DIAGNOSA">
<div id="gmp_DIAGNOSA" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_DIAGNOSAlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->DTYPE->Visible) { // DTYPE ?>
        <th data-name="DTYPE" class="<?= $Page->DTYPE->headerCellClass() ?>"><div id="elh_DIAGNOSA_DTYPE" class="DIAGNOSA_DTYPE"><?= $Page->renderSort($Page->DTYPE) ?></div></th>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <th data-name="DIAGNOSA_ID" class="<?= $Page->DIAGNOSA_ID->headerCellClass() ?>"><div id="elh_DIAGNOSA_DIAGNOSA_ID" class="DIAGNOSA_DIAGNOSA_ID"><?= $Page->renderSort($Page->DIAGNOSA_ID) ?></div></th>
<?php } ?>
<?php if ($Page->NAME_OF_DIAGNOSA->Visible) { // NAME_OF_DIAGNOSA ?>
        <th data-name="NAME_OF_DIAGNOSA" class="<?= $Page->NAME_OF_DIAGNOSA->headerCellClass() ?>"><div id="elh_DIAGNOSA_NAME_OF_DIAGNOSA" class="DIAGNOSA_NAME_OF_DIAGNOSA"><?= $Page->renderSort($Page->NAME_OF_DIAGNOSA) ?></div></th>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <th data-name="OTHER_ID" class="<?= $Page->OTHER_ID->headerCellClass() ?>"><div id="elh_DIAGNOSA_OTHER_ID" class="DIAGNOSA_OTHER_ID"><?= $Page->renderSort($Page->OTHER_ID) ?></div></th>
<?php } ?>
<?php if ($Page->OTHER_ID2->Visible) { // OTHER_ID2 ?>
        <th data-name="OTHER_ID2" class="<?= $Page->OTHER_ID2->headerCellClass() ?>"><div id="elh_DIAGNOSA_OTHER_ID2" class="DIAGNOSA_OTHER_ID2"><?= $Page->renderSort($Page->OTHER_ID2) ?></div></th>
<?php } ?>
<?php if ($Page->ISMENULAR->Visible) { // ISMENULAR ?>
        <th data-name="ISMENULAR" class="<?= $Page->ISMENULAR->headerCellClass() ?>"><div id="elh_DIAGNOSA_ISMENULAR" class="DIAGNOSA_ISMENULAR"><?= $Page->renderSort($Page->ISMENULAR) ?></div></th>
<?php } ?>
<?php if ($Page->ENGLISH_DIAGNOSA->Visible) { // ENGLISH_DIAGNOSA ?>
        <th data-name="ENGLISH_DIAGNOSA" class="<?= $Page->ENGLISH_DIAGNOSA->headerCellClass() ?>"><div id="elh_DIAGNOSA_ENGLISH_DIAGNOSA" class="DIAGNOSA_ENGLISH_DIAGNOSA"><?= $Page->renderSort($Page->ENGLISH_DIAGNOSA) ?></div></th>
<?php } ?>
<?php if ($Page->issurveylans->Visible) { // issurveylans ?>
        <th data-name="issurveylans" class="<?= $Page->issurveylans->headerCellClass() ?>"><div id="elh_DIAGNOSA_issurveylans" class="DIAGNOSA_issurveylans"><?= $Page->renderSort($Page->issurveylans) ?></div></th>
<?php } ?>
<?php if ($Page->kode_bpjs->Visible) { // kode_bpjs ?>
        <th data-name="kode_bpjs" class="<?= $Page->kode_bpjs->headerCellClass() ?>"><div id="elh_DIAGNOSA_kode_bpjs" class="DIAGNOSA_kode_bpjs"><?= $Page->renderSort($Page->kode_bpjs) ?></div></th>
<?php } ?>
<?php if ($Page->diagnosa_bpjs->Visible) { // diagnosa_bpjs ?>
        <th data-name="diagnosa_bpjs" class="<?= $Page->diagnosa_bpjs->headerCellClass() ?>"><div id="elh_DIAGNOSA_diagnosa_bpjs" class="DIAGNOSA_diagnosa_bpjs"><?= $Page->renderSort($Page->diagnosa_bpjs) ?></div></th>
<?php } ?>
<?php if ($Page->DIAGNOSA_KLINIS->Visible) { // DIAGNOSA_KLINIS ?>
        <th data-name="DIAGNOSA_KLINIS" class="<?= $Page->DIAGNOSA_KLINIS->headerCellClass() ?>"><div id="elh_DIAGNOSA_DIAGNOSA_KLINIS" class="DIAGNOSA_DIAGNOSA_KLINIS"><?= $Page->renderSort($Page->DIAGNOSA_KLINIS) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_DIAGNOSA", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->DTYPE->Visible) { // DTYPE ?>
        <td data-name="DTYPE" <?= $Page->DTYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_DTYPE">
<span<?= $Page->DTYPE->viewAttributes() ?>>
<?= $Page->DTYPE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <td data-name="DIAGNOSA_ID" <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_DIAGNOSA_ID">
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAME_OF_DIAGNOSA->Visible) { // NAME_OF_DIAGNOSA ?>
        <td data-name="NAME_OF_DIAGNOSA" <?= $Page->NAME_OF_DIAGNOSA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_NAME_OF_DIAGNOSA">
<span<?= $Page->NAME_OF_DIAGNOSA->viewAttributes() ?>>
<?= $Page->NAME_OF_DIAGNOSA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <td data-name="OTHER_ID" <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_OTHER_ID">
<span<?= $Page->OTHER_ID->viewAttributes() ?>>
<?= $Page->OTHER_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->OTHER_ID2->Visible) { // OTHER_ID2 ?>
        <td data-name="OTHER_ID2" <?= $Page->OTHER_ID2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_OTHER_ID2">
<span<?= $Page->OTHER_ID2->viewAttributes() ?>>
<?= $Page->OTHER_ID2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ISMENULAR->Visible) { // ISMENULAR ?>
        <td data-name="ISMENULAR" <?= $Page->ISMENULAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_ISMENULAR">
<span<?= $Page->ISMENULAR->viewAttributes() ?>>
<?= $Page->ISMENULAR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ENGLISH_DIAGNOSA->Visible) { // ENGLISH_DIAGNOSA ?>
        <td data-name="ENGLISH_DIAGNOSA" <?= $Page->ENGLISH_DIAGNOSA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_ENGLISH_DIAGNOSA">
<span<?= $Page->ENGLISH_DIAGNOSA->viewAttributes() ?>>
<?= $Page->ENGLISH_DIAGNOSA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->issurveylans->Visible) { // issurveylans ?>
        <td data-name="issurveylans" <?= $Page->issurveylans->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_issurveylans">
<span<?= $Page->issurveylans->viewAttributes() ?>>
<?= $Page->issurveylans->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kode_bpjs->Visible) { // kode_bpjs ?>
        <td data-name="kode_bpjs" <?= $Page->kode_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_kode_bpjs">
<span<?= $Page->kode_bpjs->viewAttributes() ?>>
<?= $Page->kode_bpjs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->diagnosa_bpjs->Visible) { // diagnosa_bpjs ?>
        <td data-name="diagnosa_bpjs" <?= $Page->diagnosa_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_diagnosa_bpjs">
<span<?= $Page->diagnosa_bpjs->viewAttributes() ?>>
<?= $Page->diagnosa_bpjs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DIAGNOSA_KLINIS->Visible) { // DIAGNOSA_KLINIS ?>
        <td data-name="DIAGNOSA_KLINIS" <?= $Page->DIAGNOSA_KLINIS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_DIAGNOSA_KLINIS">
<span<?= $Page->DIAGNOSA_KLINIS->viewAttributes() ?>>
<?= $Page->DIAGNOSA_KLINIS->getViewValue() ?></span>
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
    ew.addEventHandlers("DIAGNOSA");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
