<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PayorInfoList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPAYOR_INFOlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fPAYOR_INFOlist = currentForm = new ew.Form("fPAYOR_INFOlist", "list");
    fPAYOR_INFOlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fPAYOR_INFOlist");
});
var fPAYOR_INFOlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fPAYOR_INFOlistsrch = currentSearchForm = new ew.Form("fPAYOR_INFOlistsrch");

    // Dynamic selection lists

    // Filters
    fPAYOR_INFOlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fPAYOR_INFOlistsrch");
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
<form name="fPAYOR_INFOlistsrch" id="fPAYOR_INFOlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fPAYOR_INFOlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PAYOR_INFO">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PAYOR_INFO">
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
<form name="fPAYOR_INFOlist" id="fPAYOR_INFOlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYOR_INFO">
<div id="gmp_PAYOR_INFO" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_PAYOR_INFOlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="ORG_UNIT_CODE" class="<?= $Page->ORG_UNIT_CODE->headerCellClass() ?>"><div id="elh_PAYOR_INFO_ORG_UNIT_CODE" class="PAYOR_INFO_ORG_UNIT_CODE"><?= $Page->renderSort($Page->ORG_UNIT_CODE) ?></div></th>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <th data-name="PAYOR_ID" class="<?= $Page->PAYOR_ID->headerCellClass() ?>"><div id="elh_PAYOR_INFO_PAYOR_ID" class="PAYOR_INFO_PAYOR_ID"><?= $Page->renderSort($Page->PAYOR_ID) ?></div></th>
<?php } ?>
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
        <th data-name="PAYOR_TYPE" class="<?= $Page->PAYOR_TYPE->headerCellClass() ?>"><div id="elh_PAYOR_INFO_PAYOR_TYPE" class="PAYOR_INFO_PAYOR_TYPE"><?= $Page->renderSort($Page->PAYOR_TYPE) ?></div></th>
<?php } ?>
<?php if ($Page->PAYOR->Visible) { // PAYOR ?>
        <th data-name="PAYOR" class="<?= $Page->PAYOR->headerCellClass() ?>"><div id="elh_PAYOR_INFO_PAYOR" class="PAYOR_INFO_PAYOR"><?= $Page->renderSort($Page->PAYOR) ?></div></th>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
        <th data-name="ADDRESS" class="<?= $Page->ADDRESS->headerCellClass() ?>"><div id="elh_PAYOR_INFO_ADDRESS" class="PAYOR_INFO_ADDRESS"><?= $Page->renderSort($Page->ADDRESS) ?></div></th>
<?php } ?>
<?php if ($Page->CITY->Visible) { // CITY ?>
        <th data-name="CITY" class="<?= $Page->CITY->headerCellClass() ?>"><div id="elh_PAYOR_INFO_CITY" class="PAYOR_INFO_CITY"><?= $Page->renderSort($Page->CITY) ?></div></th>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
        <th data-name="PHONE" class="<?= $Page->PHONE->headerCellClass() ?>"><div id="elh_PAYOR_INFO_PHONE" class="PAYOR_INFO_PHONE"><?= $Page->renderSort($Page->PHONE) ?></div></th>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
        <th data-name="FAX" class="<?= $Page->FAX->headerCellClass() ?>"><div id="elh_PAYOR_INFO_FAX" class="PAYOR_INFO_FAX"><?= $Page->renderSort($Page->FAX) ?></div></th>
<?php } ?>
<?php if ($Page->KDVKLAIM->Visible) { // KDVKLAIM ?>
        <th data-name="KDVKLAIM" class="<?= $Page->KDVKLAIM->headerCellClass() ?>"><div id="elh_PAYOR_INFO_KDVKLAIM" class="PAYOR_INFO_KDVKLAIM"><?= $Page->renderSort($Page->KDVKLAIM) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_PAYOR_INFO", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <td data-name="PAYOR_ID" <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_PAYOR_ID">
<span<?= $Page->PAYOR_ID->viewAttributes() ?>>
<?= $Page->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
        <td data-name="PAYOR_TYPE" <?= $Page->PAYOR_TYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_PAYOR_TYPE">
<span<?= $Page->PAYOR_TYPE->viewAttributes() ?>>
<?= $Page->PAYOR_TYPE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PAYOR->Visible) { // PAYOR ?>
        <td data-name="PAYOR" <?= $Page->PAYOR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_PAYOR">
<span<?= $Page->PAYOR->viewAttributes() ?>>
<?= $Page->PAYOR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
        <td data-name="ADDRESS" <?= $Page->ADDRESS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_ADDRESS">
<span<?= $Page->ADDRESS->viewAttributes() ?>>
<?= $Page->ADDRESS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CITY->Visible) { // CITY ?>
        <td data-name="CITY" <?= $Page->CITY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_CITY">
<span<?= $Page->CITY->viewAttributes() ?>>
<?= $Page->CITY->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PHONE->Visible) { // PHONE ?>
        <td data-name="PHONE" <?= $Page->PHONE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_PHONE">
<span<?= $Page->PHONE->viewAttributes() ?>>
<?= $Page->PHONE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->FAX->Visible) { // FAX ?>
        <td data-name="FAX" <?= $Page->FAX->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_FAX">
<span<?= $Page->FAX->viewAttributes() ?>>
<?= $Page->FAX->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KDVKLAIM->Visible) { // KDVKLAIM ?>
        <td data-name="KDVKLAIM" <?= $Page->KDVKLAIM->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_KDVKLAIM">
<span<?= $Page->KDVKLAIM->viewAttributes() ?>>
<?= $Page->KDVKLAIM->getViewValue() ?></span>
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
    ew.addEventHandlers("PAYOR_INFO");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
