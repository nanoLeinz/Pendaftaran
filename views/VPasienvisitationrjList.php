<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VPasienvisitationrjList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_PASIENVISITATIONRJlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fV_PASIENVISITATIONRJlist = currentForm = new ew.Form("fV_PASIENVISITATIONRJlist", "list");
    fV_PASIENVISITATIONRJlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fV_PASIENVISITATIONRJlist");
});
var fV_PASIENVISITATIONRJlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fV_PASIENVISITATIONRJlistsrch = currentSearchForm = new ew.Form("fV_PASIENVISITATIONRJlistsrch");

    // Dynamic selection lists

    // Filters
    fV_PASIENVISITATIONRJlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fV_PASIENVISITATIONRJlistsrch");
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
<form name="fV_PASIENVISITATIONRJlistsrch" id="fV_PASIENVISITATIONRJlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fV_PASIENVISITATIONRJlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="V_PASIENVISITATIONRJ">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> V_PASIENVISITATIONRJ">
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
<form name="fV_PASIENVISITATIONRJlist" id="fV_PASIENVISITATIONRJlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_PASIENVISITATIONRJ">
<div id="gmp_V_PASIENVISITATIONRJ" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_V_PASIENVISITATIONRJlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
        <th data-name="NAME_OF_PASIEN" class="<?= $Page->NAME_OF_PASIEN->headerCellClass() ?>"><div id="elh_V_PASIENVISITATIONRJ_NAME_OF_PASIEN" class="V_PASIENVISITATIONRJ_NAME_OF_PASIEN"><?= $Page->renderSort($Page->NAME_OF_PASIEN) ?></div></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>"><div id="elh_V_PASIENVISITATIONRJ_NO_REGISTRATION" class="V_PASIENVISITATIONRJ_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
        <th data-name="CONTACT_ADDRESS" class="<?= $Page->CONTACT_ADDRESS->headerCellClass() ?>"><div id="elh_V_PASIENVISITATIONRJ_CONTACT_ADDRESS" class="V_PASIENVISITATIONRJ_CONTACT_ADDRESS"><?= $Page->renderSort($Page->CONTACT_ADDRESS) ?></div></th>
<?php } ?>
<?php if ($Page->name_of_clinic->Visible) { // name_of_clinic ?>
        <th data-name="name_of_clinic" class="<?= $Page->name_of_clinic->headerCellClass() ?>"><div id="elh_V_PASIENVISITATIONRJ_name_of_clinic" class="V_PASIENVISITATIONRJ_name_of_clinic"><?= $Page->renderSort($Page->name_of_clinic) ?></div></th>
<?php } ?>
<?php if ($Page->fullname->Visible) { // fullname ?>
        <th data-name="fullname" class="<?= $Page->fullname->headerCellClass() ?>"><div id="elh_V_PASIENVISITATIONRJ_fullname" class="V_PASIENVISITATIONRJ_fullname"><?= $Page->renderSort($Page->fullname) ?></div></th>
<?php } ?>
<?php if ($Page->visit_date->Visible) { // visit_date ?>
        <th data-name="visit_date" class="<?= $Page->visit_date->headerCellClass() ?>"><div id="elh_V_PASIENVISITATIONRJ_visit_date" class="V_PASIENVISITATIONRJ_visit_date"><?= $Page->renderSort($Page->visit_date) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_V_PASIENVISITATIONRJ", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
        <td data-name="NAME_OF_PASIEN" <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_PASIENVISITATIONRJ_NAME_OF_PASIEN">
<span<?= $Page->NAME_OF_PASIEN->viewAttributes() ?>>
<?= $Page->NAME_OF_PASIEN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_PASIENVISITATIONRJ_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
        <td data-name="CONTACT_ADDRESS" <?= $Page->CONTACT_ADDRESS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_PASIENVISITATIONRJ_CONTACT_ADDRESS">
<span<?= $Page->CONTACT_ADDRESS->viewAttributes() ?>>
<?= $Page->CONTACT_ADDRESS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->name_of_clinic->Visible) { // name_of_clinic ?>
        <td data-name="name_of_clinic" <?= $Page->name_of_clinic->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_PASIENVISITATIONRJ_name_of_clinic">
<span<?= $Page->name_of_clinic->viewAttributes() ?>>
<?= $Page->name_of_clinic->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fullname->Visible) { // fullname ?>
        <td data-name="fullname" <?= $Page->fullname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_PASIENVISITATIONRJ_fullname">
<span<?= $Page->fullname->viewAttributes() ?>>
<?= $Page->fullname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->visit_date->Visible) { // visit_date ?>
        <td data-name="visit_date" <?= $Page->visit_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_PASIENVISITATIONRJ_visit_date">
<span<?= $Page->visit_date->viewAttributes() ?>>
<?= $Page->visit_date->getViewValue() ?></span>
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
    ew.addEventHandlers("V_PASIENVISITATIONRJ");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
