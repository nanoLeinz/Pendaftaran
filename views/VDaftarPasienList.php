<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VDaftarPasienList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_DAFTAR_PASIENlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fV_DAFTAR_PASIENlist = currentForm = new ew.Form("fV_DAFTAR_PASIENlist", "list");
    fV_DAFTAR_PASIENlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fV_DAFTAR_PASIENlist");
});
var fV_DAFTAR_PASIENlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fV_DAFTAR_PASIENlistsrch = currentSearchForm = new ew.Form("fV_DAFTAR_PASIENlistsrch");

    // Dynamic selection lists

    // Filters
    fV_DAFTAR_PASIENlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fV_DAFTAR_PASIENlistsrch");
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
<form name="fV_DAFTAR_PASIENlistsrch" id="fV_DAFTAR_PASIENlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fV_DAFTAR_PASIENlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="V_DAFTAR_PASIEN">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> V_DAFTAR_PASIEN">
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
<form name="fV_DAFTAR_PASIENlist" id="fV_DAFTAR_PASIENlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_DAFTAR_PASIEN">
<div id="gmp_V_DAFTAR_PASIEN" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_V_DAFTAR_PASIENlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_NO_REGISTRATION" class="V_DAFTAR_PASIEN_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->KK_NO->Visible) { // KK_NO ?>
        <th data-name="KK_NO" class="<?= $Page->KK_NO->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_KK_NO" class="V_DAFTAR_PASIEN_KK_NO"><?= $Page->renderSort($Page->KK_NO) ?></div></th>
<?php } ?>
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
        <th data-name="NAME_OF_PASIEN" class="<?= $Page->NAME_OF_PASIEN->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_NAME_OF_PASIEN" class="V_DAFTAR_PASIEN_NAME_OF_PASIEN"><?= $Page->renderSort($Page->NAME_OF_PASIEN) ?></div></th>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
        <th data-name="PLACE_OF_BIRTH" class="<?= $Page->PLACE_OF_BIRTH->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_PLACE_OF_BIRTH" class="V_DAFTAR_PASIEN_PLACE_OF_BIRTH"><?= $Page->renderSort($Page->PLACE_OF_BIRTH) ?></div></th>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
        <th data-name="DATE_OF_BIRTH" class="<?= $Page->DATE_OF_BIRTH->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_DATE_OF_BIRTH" class="V_DAFTAR_PASIEN_DATE_OF_BIRTH"><?= $Page->renderSort($Page->DATE_OF_BIRTH) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_GENDER" class="V_DAFTAR_PASIEN_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
        <th data-name="KODE_AGAMA" class="<?= $Page->KODE_AGAMA->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_KODE_AGAMA" class="V_DAFTAR_PASIEN_KODE_AGAMA"><?= $Page->renderSort($Page->KODE_AGAMA) ?></div></th>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <th data-name="STATUS_PASIEN_ID" class="<?= $Page->STATUS_PASIEN_ID->headerCellClass() ?>"><div id="elh_V_DAFTAR_PASIEN_STATUS_PASIEN_ID" class="V_DAFTAR_PASIEN_STATUS_PASIEN_ID"><?= $Page->renderSort($Page->STATUS_PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
        <th data-name="CONTACT_ADDRESS" class="<?= $Page->CONTACT_ADDRESS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_CONTACT_ADDRESS" class="V_DAFTAR_PASIEN_CONTACT_ADDRESS"><?= $Page->renderSort($Page->CONTACT_ADDRESS) ?></div></th>
<?php } ?>
<?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
        <th data-name="REGISTRATION_DATE" class="<?= $Page->REGISTRATION_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_DAFTAR_PASIEN_REGISTRATION_DATE" class="V_DAFTAR_PASIEN_REGISTRATION_DATE"><?= $Page->renderSort($Page->REGISTRATION_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->newapp->Visible) { // newapp ?>
        <th data-name="newapp" class="<?= $Page->newapp->headerCellClass() ?>"><div id="elh_V_DAFTAR_PASIEN_newapp" class="V_DAFTAR_PASIEN_newapp"><?= $Page->renderSort($Page->newapp) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_V_DAFTAR_PASIEN", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KK_NO->Visible) { // KK_NO ?>
        <td data-name="KK_NO" <?= $Page->KK_NO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_KK_NO">
<span<?= $Page->KK_NO->viewAttributes() ?>>
<?= $Page->KK_NO->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
        <td data-name="NAME_OF_PASIEN" <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_NAME_OF_PASIEN">
<span<?= $Page->NAME_OF_PASIEN->viewAttributes() ?>>
<?= $Page->NAME_OF_PASIEN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
        <td data-name="PLACE_OF_BIRTH" <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_PLACE_OF_BIRTH">
<span<?= $Page->PLACE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->PLACE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
        <td data-name="DATE_OF_BIRTH" <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_DATE_OF_BIRTH">
<span<?= $Page->DATE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->DATE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
        <td data-name="KODE_AGAMA" <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_KODE_AGAMA">
<span<?= $Page->KODE_AGAMA->viewAttributes() ?>>
<?= $Page->KODE_AGAMA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_STATUS_PASIEN_ID">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
        <td data-name="CONTACT_ADDRESS" <?= $Page->CONTACT_ADDRESS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_CONTACT_ADDRESS">
<span<?= $Page->CONTACT_ADDRESS->viewAttributes() ?>>
<?= $Page->CONTACT_ADDRESS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
        <td data-name="REGISTRATION_DATE" <?= $Page->REGISTRATION_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_REGISTRATION_DATE">
<span<?= $Page->REGISTRATION_DATE->viewAttributes() ?>>
<?= $Page->REGISTRATION_DATE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->newapp->Visible) { // newapp ?>
        <td data-name="newapp" <?= $Page->newapp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_DAFTAR_PASIEN_newapp">
<span<?= $Page->newapp->viewAttributes() ?>>
<?= $Page->newapp->getViewValue() ?></span>
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
    ew.addEventHandlers("V_DAFTAR_PASIEN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
