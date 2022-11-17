<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ClinicList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fCLINIClist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fCLINIClist = currentForm = new ew.Form("fCLINIClist", "list");
    fCLINIClist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fCLINIClist");
});
var fCLINIClistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fCLINIClistsrch = currentSearchForm = new ew.Form("fCLINIClistsrch");

    // Dynamic selection lists

    // Filters
    fCLINIClistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fCLINIClistsrch");
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
<form name="fCLINIClistsrch" id="fCLINIClistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fCLINIClistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="CLINIC">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> CLINIC">
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
<form name="fCLINIClist" id="fCLINIClist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CLINIC">
<div id="gmp_CLINIC" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_CLINIClist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <th data-name="ORG_UNIT_CODE" class="<?= $Page->ORG_UNIT_CODE->headerCellClass() ?>"><div id="elh_CLINIC_ORG_UNIT_CODE" class="CLINIC_ORG_UNIT_CODE"><?= $Page->renderSort($Page->ORG_UNIT_CODE) ?></div></th>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th data-name="CLINIC_ID" class="<?= $Page->CLINIC_ID->headerCellClass() ?>"><div id="elh_CLINIC_CLINIC_ID" class="CLINIC_CLINIC_ID"><?= $Page->renderSort($Page->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Page->NAME_OF_CLINIC->Visible) { // NAME_OF_CLINIC ?>
        <th data-name="NAME_OF_CLINIC" class="<?= $Page->NAME_OF_CLINIC->headerCellClass() ?>"><div id="elh_CLINIC_NAME_OF_CLINIC" class="CLINIC_NAME_OF_CLINIC"><?= $Page->renderSort($Page->NAME_OF_CLINIC) ?></div></th>
<?php } ?>
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
        <th data-name="ORG_ID" class="<?= $Page->ORG_ID->headerCellClass() ?>"><div id="elh_CLINIC_ORG_ID" class="CLINIC_ORG_ID"><?= $Page->renderSort($Page->ORG_ID) ?></div></th>
<?php } ?>
<?php if ($Page->STYPE_ID->Visible) { // STYPE_ID ?>
        <th data-name="STYPE_ID" class="<?= $Page->STYPE_ID->headerCellClass() ?>"><div id="elh_CLINIC_STYPE_ID" class="CLINIC_STYPE_ID"><?= $Page->renderSort($Page->STYPE_ID) ?></div></th>
<?php } ?>
<?php if ($Page->CLINIC_TYPE->Visible) { // CLINIC_TYPE ?>
        <th data-name="CLINIC_TYPE" class="<?= $Page->CLINIC_TYPE->headerCellClass() ?>"><div id="elh_CLINIC_CLINIC_TYPE" class="CLINIC_CLINIC_TYPE"><?= $Page->renderSort($Page->CLINIC_TYPE) ?></div></th>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <th data-name="OTHER_ID" class="<?= $Page->OTHER_ID->headerCellClass() ?>"><div id="elh_CLINIC_OTHER_ID" class="CLINIC_OTHER_ID"><?= $Page->renderSort($Page->OTHER_ID) ?></div></th>
<?php } ?>
<?php if ($Page->ACCOUNT_ID->Visible) { // ACCOUNT_ID ?>
        <th data-name="ACCOUNT_ID" class="<?= $Page->ACCOUNT_ID->headerCellClass() ?>"><div id="elh_CLINIC_ACCOUNT_ID" class="CLINIC_ACCOUNT_ID"><?= $Page->renderSort($Page->ACCOUNT_ID) ?></div></th>
<?php } ?>
<?php if ($Page->FA_V->Visible) { // FA_V ?>
        <th data-name="FA_V" class="<?= $Page->FA_V->headerCellClass() ?>"><div id="elh_CLINIC_FA_V" class="CLINIC_FA_V"><?= $Page->renderSort($Page->FA_V) ?></div></th>
<?php } ?>
<?php if ($Page->PROFIT_ID->Visible) { // PROFIT_ID ?>
        <th data-name="PROFIT_ID" class="<?= $Page->PROFIT_ID->headerCellClass() ?>"><div id="elh_CLINIC_PROFIT_ID" class="CLINIC_PROFIT_ID"><?= $Page->renderSort($Page->PROFIT_ID) ?></div></th>
<?php } ?>
<?php if ($Page->SUPPLIED_MM->Visible) { // SUPPLIED_MM ?>
        <th data-name="SUPPLIED_MM" class="<?= $Page->SUPPLIED_MM->headerCellClass() ?>"><div id="elh_CLINIC_SUPPLIED_MM" class="CLINIC_SUPPLIED_MM"><?= $Page->renderSort($Page->SUPPLIED_MM) ?></div></th>
<?php } ?>
<?php if ($Page->KDPOLI->Visible) { // KDPOLI ?>
        <th data-name="KDPOLI" class="<?= $Page->KDPOLI->headerCellClass() ?>"><div id="elh_CLINIC_KDPOLI" class="CLINIC_KDPOLI"><?= $Page->renderSort($Page->KDPOLI) ?></div></th>
<?php } ?>
<?php if ($Page->SPESIALISTIK->Visible) { // SPESIALISTIK ?>
        <th data-name="SPESIALISTIK" class="<?= $Page->SPESIALISTIK->headerCellClass() ?>"><div id="elh_CLINIC_SPESIALISTIK" class="CLINIC_SPESIALISTIK"><?= $Page->renderSort($Page->SPESIALISTIK) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_CLINIC", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <td data-name="ORG_UNIT_CODE" <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAME_OF_CLINIC->Visible) { // NAME_OF_CLINIC ?>
        <td data-name="NAME_OF_CLINIC" <?= $Page->NAME_OF_CLINIC->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_NAME_OF_CLINIC">
<span<?= $Page->NAME_OF_CLINIC->viewAttributes() ?>>
<?= $Page->NAME_OF_CLINIC->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
        <td data-name="ORG_ID" <?= $Page->ORG_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_ORG_ID">
<span<?= $Page->ORG_ID->viewAttributes() ?>>
<?= $Page->ORG_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->STYPE_ID->Visible) { // STYPE_ID ?>
        <td data-name="STYPE_ID" <?= $Page->STYPE_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_STYPE_ID">
<span<?= $Page->STYPE_ID->viewAttributes() ?>>
<?= $Page->STYPE_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLINIC_TYPE->Visible) { // CLINIC_TYPE ?>
        <td data-name="CLINIC_TYPE" <?= $Page->CLINIC_TYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_CLINIC_TYPE">
<span<?= $Page->CLINIC_TYPE->viewAttributes() ?>>
<?= $Page->CLINIC_TYPE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <td data-name="OTHER_ID" <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_OTHER_ID">
<span<?= $Page->OTHER_ID->viewAttributes() ?>>
<?= $Page->OTHER_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ACCOUNT_ID->Visible) { // ACCOUNT_ID ?>
        <td data-name="ACCOUNT_ID" <?= $Page->ACCOUNT_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_ACCOUNT_ID">
<span<?= $Page->ACCOUNT_ID->viewAttributes() ?>>
<?= $Page->ACCOUNT_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->FA_V->Visible) { // FA_V ?>
        <td data-name="FA_V" <?= $Page->FA_V->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_FA_V">
<span<?= $Page->FA_V->viewAttributes() ?>>
<?= $Page->FA_V->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROFIT_ID->Visible) { // PROFIT_ID ?>
        <td data-name="PROFIT_ID" <?= $Page->PROFIT_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_PROFIT_ID">
<span<?= $Page->PROFIT_ID->viewAttributes() ?>>
<?= $Page->PROFIT_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SUPPLIED_MM->Visible) { // SUPPLIED_MM ?>
        <td data-name="SUPPLIED_MM" <?= $Page->SUPPLIED_MM->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_SUPPLIED_MM">
<span<?= $Page->SUPPLIED_MM->viewAttributes() ?>>
<?= $Page->SUPPLIED_MM->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KDPOLI->Visible) { // KDPOLI ?>
        <td data-name="KDPOLI" <?= $Page->KDPOLI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_KDPOLI">
<span<?= $Page->KDPOLI->viewAttributes() ?>>
<?= $Page->KDPOLI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SPESIALISTIK->Visible) { // SPESIALISTIK ?>
        <td data-name="SPESIALISTIK" <?= $Page->SPESIALISTIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_SPESIALISTIK">
<span<?= $Page->SPESIALISTIK->viewAttributes() ?>>
<?= $Page->SPESIALISTIK->getViewValue() ?></span>
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
    ew.addEventHandlers("CLINIC");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
