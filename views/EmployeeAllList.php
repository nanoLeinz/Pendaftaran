<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$EmployeeAllList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fEMPLOYEE_ALLlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fEMPLOYEE_ALLlist = currentForm = new ew.Form("fEMPLOYEE_ALLlist", "list");
    fEMPLOYEE_ALLlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fEMPLOYEE_ALLlist");
});
var fEMPLOYEE_ALLlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fEMPLOYEE_ALLlistsrch = currentSearchForm = new ew.Form("fEMPLOYEE_ALLlistsrch");

    // Dynamic selection lists

    // Filters
    fEMPLOYEE_ALLlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fEMPLOYEE_ALLlistsrch");
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
<form name="fEMPLOYEE_ALLlistsrch" id="fEMPLOYEE_ALLlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fEMPLOYEE_ALLlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="EMPLOYEE_ALL">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> EMPLOYEE_ALL">
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
<form name="fEMPLOYEE_ALLlist" id="fEMPLOYEE_ALLlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="EMPLOYEE_ALL">
<div id="gmp_EMPLOYEE_ALL" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_EMPLOYEE_ALLlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
        <th data-name="FULLNAME" class="<?= $Page->FULLNAME->headerCellClass() ?>"><div id="elh_EMPLOYEE_ALL_FULLNAME" class="EMPLOYEE_ALL_FULLNAME"><?= $Page->renderSort($Page->FULLNAME) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>"><div id="elh_EMPLOYEE_ALL_GENDER" class="EMPLOYEE_ALL_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
        <th data-name="ORG_ID" class="<?= $Page->ORG_ID->headerCellClass() ?>"><div id="elh_EMPLOYEE_ALL_ORG_ID" class="EMPLOYEE_ALL_ORG_ID"><?= $Page->renderSort($Page->ORG_ID) ?></div></th>
<?php } ?>
<?php if ($Page->SPECIALIST_TYPE_ID->Visible) { // SPECIALIST_TYPE_ID ?>
        <th data-name="SPECIALIST_TYPE_ID" class="<?= $Page->SPECIALIST_TYPE_ID->headerCellClass() ?>"><div id="elh_EMPLOYEE_ALL_SPECIALIST_TYPE_ID" class="EMPLOYEE_ALL_SPECIALIST_TYPE_ID"><?= $Page->renderSort($Page->SPECIALIST_TYPE_ID) ?></div></th>
<?php } ?>
<?php if ($Page->NIP->Visible) { // NIP ?>
        <th data-name="NIP" class="<?= $Page->NIP->headerCellClass() ?>"><div id="elh_EMPLOYEE_ALL_NIP" class="EMPLOYEE_ALL_NIP"><?= $Page->renderSort($Page->NIP) ?></div></th>
<?php } ?>
<?php if ($Page->DPJP->Visible) { // DPJP ?>
        <th data-name="DPJP" class="<?= $Page->DPJP->headerCellClass() ?>"><div id="elh_EMPLOYEE_ALL_DPJP" class="EMPLOYEE_ALL_DPJP"><?= $Page->renderSort($Page->DPJP) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_EMPLOYEE_ALL", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
        <td data-name="FULLNAME" <?= $Page->FULLNAME->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_ALL_FULLNAME">
<span<?= $Page->FULLNAME->viewAttributes() ?>>
<?= $Page->FULLNAME->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_ALL_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
        <td data-name="ORG_ID" <?= $Page->ORG_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_ALL_ORG_ID">
<span<?= $Page->ORG_ID->viewAttributes() ?>>
<?= $Page->ORG_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SPECIALIST_TYPE_ID->Visible) { // SPECIALIST_TYPE_ID ?>
        <td data-name="SPECIALIST_TYPE_ID" <?= $Page->SPECIALIST_TYPE_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_ALL_SPECIALIST_TYPE_ID">
<span<?= $Page->SPECIALIST_TYPE_ID->viewAttributes() ?>>
<?= $Page->SPECIALIST_TYPE_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NIP->Visible) { // NIP ?>
        <td data-name="NIP" <?= $Page->NIP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_ALL_NIP">
<span<?= $Page->NIP->viewAttributes() ?>>
<?= $Page->NIP->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DPJP->Visible) { // DPJP ?>
        <td data-name="DPJP" <?= $Page->DPJP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_ALL_DPJP">
<span<?= $Page->DPJP->viewAttributes() ?>>
<?= $Page->DPJP->getViewValue() ?></span>
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
    ew.addEventHandlers("EMPLOYEE_ALL");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
