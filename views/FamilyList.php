<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$FamilyList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fFAMILYlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fFAMILYlist = currentForm = new ew.Form("fFAMILYlist", "list");
    fFAMILYlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fFAMILYlist");
});
var fFAMILYlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fFAMILYlistsrch = currentSearchForm = new ew.Form("fFAMILYlistsrch");

    // Dynamic selection lists

    // Filters
    fFAMILYlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fFAMILYlistsrch");
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
<form name="fFAMILYlistsrch" id="fFAMILYlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fFAMILYlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="FAMILY">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> FAMILY">
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
<form name="fFAMILYlist" id="fFAMILYlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="FAMILY">
<div id="gmp_FAMILY" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_FAMILYlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="ORG_UNIT_CODE" class="<?= $Page->ORG_UNIT_CODE->headerCellClass() ?>"><div id="elh_FAMILY_ORG_UNIT_CODE" class="FAMILY_ORG_UNIT_CODE"><?= $Page->renderSort($Page->ORG_UNIT_CODE) ?></div></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>"><div id="elh_FAMILY_NO_REGISTRATION" class="FAMILY_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->FAMILY_ID->Visible) { // FAMILY_ID ?>
        <th data-name="FAMILY_ID" class="<?= $Page->FAMILY_ID->headerCellClass() ?>"><div id="elh_FAMILY_FAMILY_ID" class="FAMILY_FAMILY_ID"><?= $Page->renderSort($Page->FAMILY_ID) ?></div></th>
<?php } ?>
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
        <th data-name="FAMILY_STATUS_ID" class="<?= $Page->FAMILY_STATUS_ID->headerCellClass() ?>"><div id="elh_FAMILY_FAMILY_STATUS_ID" class="FAMILY_FAMILY_STATUS_ID"><?= $Page->renderSort($Page->FAMILY_STATUS_ID) ?></div></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION2->Visible) { // NO_REGISTRATION2 ?>
        <th data-name="NO_REGISTRATION2" class="<?= $Page->NO_REGISTRATION2->headerCellClass() ?>"><div id="elh_FAMILY_NO_REGISTRATION2" class="FAMILY_NO_REGISTRATION2"><?= $Page->renderSort($Page->NO_REGISTRATION2) ?></div></th>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
        <th data-name="FULLNAME" class="<?= $Page->FULLNAME->headerCellClass() ?>"><div id="elh_FAMILY_FULLNAME" class="FAMILY_FULLNAME"><?= $Page->renderSort($Page->FULLNAME) ?></div></th>
<?php } ?>
<?php if ($Page->ISRESPONSIBLE->Visible) { // ISRESPONSIBLE ?>
        <th data-name="ISRESPONSIBLE" class="<?= $Page->ISRESPONSIBLE->headerCellClass() ?>"><div id="elh_FAMILY_ISRESPONSIBLE" class="FAMILY_ISRESPONSIBLE"><?= $Page->renderSort($Page->ISRESPONSIBLE) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>"><div id="elh_FAMILY_GENDER" class="FAMILY_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
        <th data-name="DATE_OF_BIRTH" class="<?= $Page->DATE_OF_BIRTH->headerCellClass() ?>"><div id="elh_FAMILY_DATE_OF_BIRTH" class="FAMILY_DATE_OF_BIRTH"><?= $Page->renderSort($Page->DATE_OF_BIRTH) ?></div></th>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
        <th data-name="PLACE_OF_BIRTH" class="<?= $Page->PLACE_OF_BIRTH->headerCellClass() ?>"><div id="elh_FAMILY_PLACE_OF_BIRTH" class="FAMILY_PLACE_OF_BIRTH"><?= $Page->renderSort($Page->PLACE_OF_BIRTH) ?></div></th>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
        <th data-name="KODE_AGAMA" class="<?= $Page->KODE_AGAMA->headerCellClass() ?>"><div id="elh_FAMILY_KODE_AGAMA" class="FAMILY_KODE_AGAMA"><?= $Page->renderSort($Page->KODE_AGAMA) ?></div></th>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
        <th data-name="EDUCATION_TYPE_CODE" class="<?= $Page->EDUCATION_TYPE_CODE->headerCellClass() ?>"><div id="elh_FAMILY_EDUCATION_TYPE_CODE" class="FAMILY_EDUCATION_TYPE_CODE"><?= $Page->renderSort($Page->EDUCATION_TYPE_CODE) ?></div></th>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
        <th data-name="JOB_ID" class="<?= $Page->JOB_ID->headerCellClass() ?>"><div id="elh_FAMILY_JOB_ID" class="FAMILY_JOB_ID"><?= $Page->renderSort($Page->JOB_ID) ?></div></th>
<?php } ?>
<?php if ($Page->BLOOD_ID->Visible) { // BLOOD_ID ?>
        <th data-name="BLOOD_ID" class="<?= $Page->BLOOD_ID->headerCellClass() ?>"><div id="elh_FAMILY_BLOOD_ID" class="FAMILY_BLOOD_ID"><?= $Page->renderSort($Page->BLOOD_ID) ?></div></th>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
        <th data-name="MARITALSTATUSID" class="<?= $Page->MARITALSTATUSID->headerCellClass() ?>"><div id="elh_FAMILY_MARITALSTATUSID" class="FAMILY_MARITALSTATUSID"><?= $Page->renderSort($Page->MARITALSTATUSID) ?></div></th>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
        <th data-name="ADDRESS" class="<?= $Page->ADDRESS->headerCellClass() ?>"><div id="elh_FAMILY_ADDRESS" class="FAMILY_ADDRESS"><?= $Page->renderSort($Page->ADDRESS) ?></div></th>
<?php } ?>
<?php if ($Page->KOTA->Visible) { // KOTA ?>
        <th data-name="KOTA" class="<?= $Page->KOTA->headerCellClass() ?>"><div id="elh_FAMILY_KOTA" class="FAMILY_KOTA"><?= $Page->renderSort($Page->KOTA) ?></div></th>
<?php } ?>
<?php if ($Page->RT->Visible) { // RT ?>
        <th data-name="RT" class="<?= $Page->RT->headerCellClass() ?>"><div id="elh_FAMILY_RT" class="FAMILY_RT"><?= $Page->renderSort($Page->RT) ?></div></th>
<?php } ?>
<?php if ($Page->RW->Visible) { // RW ?>
        <th data-name="RW" class="<?= $Page->RW->headerCellClass() ?>"><div id="elh_FAMILY_RW" class="FAMILY_RW"><?= $Page->renderSort($Page->RW) ?></div></th>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
        <th data-name="PHONE" class="<?= $Page->PHONE->headerCellClass() ?>"><div id="elh_FAMILY_PHONE" class="FAMILY_PHONE"><?= $Page->renderSort($Page->PHONE) ?></div></th>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { // MOBILE ?>
        <th data-name="MOBILE" class="<?= $Page->MOBILE->headerCellClass() ?>"><div id="elh_FAMILY_MOBILE" class="FAMILY_MOBILE"><?= $Page->renderSort($Page->MOBILE) ?></div></th>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
        <th data-name="FAX" class="<?= $Page->FAX->headerCellClass() ?>"><div id="elh_FAMILY_FAX" class="FAMILY_FAX"><?= $Page->renderSort($Page->FAX) ?></div></th>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <th data-name="_EMAIL" class="<?= $Page->_EMAIL->headerCellClass() ?>"><div id="elh_FAMILY__EMAIL" class="FAMILY__EMAIL"><?= $Page->renderSort($Page->_EMAIL) ?></div></th>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <th data-name="DESCRIPTION" class="<?= $Page->DESCRIPTION->headerCellClass() ?>"><div id="elh_FAMILY_DESCRIPTION" class="FAMILY_DESCRIPTION"><?= $Page->renderSort($Page->DESCRIPTION) ?></div></th>
<?php } ?>
<?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
        <th data-name="MODIFIED_DATE" class="<?= $Page->MODIFIED_DATE->headerCellClass() ?>"><div id="elh_FAMILY_MODIFIED_DATE" class="FAMILY_MODIFIED_DATE"><?= $Page->renderSort($Page->MODIFIED_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
        <th data-name="MODIFIED_BY" class="<?= $Page->MODIFIED_BY->headerCellClass() ?>"><div id="elh_FAMILY_MODIFIED_BY" class="FAMILY_MODIFIED_BY"><?= $Page->renderSort($Page->MODIFIED_BY) ?></div></th>
<?php } ?>
<?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
        <th data-name="MODIFIED_FROM" class="<?= $Page->MODIFIED_FROM->headerCellClass() ?>"><div id="elh_FAMILY_MODIFIED_FROM" class="FAMILY_MODIFIED_FROM"><?= $Page->renderSort($Page->MODIFIED_FROM) ?></div></th>
<?php } ?>
<?php if ($Page->COUNTRY_CODE->Visible) { // COUNTRY_CODE ?>
        <th data-name="COUNTRY_CODE" class="<?= $Page->COUNTRY_CODE->headerCellClass() ?>"><div id="elh_FAMILY_COUNTRY_CODE" class="FAMILY_COUNTRY_CODE"><?= $Page->renderSort($Page->COUNTRY_CODE) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_FAMILY", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_FAMILY_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->FAMILY_ID->Visible) { // FAMILY_ID ?>
        <td data-name="FAMILY_ID" <?= $Page->FAMILY_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_FAMILY_ID">
<span<?= $Page->FAMILY_ID->viewAttributes() ?>>
<?= $Page->FAMILY_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
        <td data-name="FAMILY_STATUS_ID" <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_FAMILY_STATUS_ID">
<span<?= $Page->FAMILY_STATUS_ID->viewAttributes() ?>>
<?= $Page->FAMILY_STATUS_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_REGISTRATION2->Visible) { // NO_REGISTRATION2 ?>
        <td data-name="NO_REGISTRATION2" <?= $Page->NO_REGISTRATION2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_NO_REGISTRATION2">
<span<?= $Page->NO_REGISTRATION2->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
        <td data-name="FULLNAME" <?= $Page->FULLNAME->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_FULLNAME">
<span<?= $Page->FULLNAME->viewAttributes() ?>>
<?= $Page->FULLNAME->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ISRESPONSIBLE->Visible) { // ISRESPONSIBLE ?>
        <td data-name="ISRESPONSIBLE" <?= $Page->ISRESPONSIBLE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_ISRESPONSIBLE">
<span<?= $Page->ISRESPONSIBLE->viewAttributes() ?>>
<?= $Page->ISRESPONSIBLE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
        <td data-name="DATE_OF_BIRTH" <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_DATE_OF_BIRTH">
<span<?= $Page->DATE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->DATE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
        <td data-name="PLACE_OF_BIRTH" <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_PLACE_OF_BIRTH">
<span<?= $Page->PLACE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->PLACE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
        <td data-name="KODE_AGAMA" <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_KODE_AGAMA">
<span<?= $Page->KODE_AGAMA->viewAttributes() ?>>
<?= $Page->KODE_AGAMA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
        <td data-name="EDUCATION_TYPE_CODE" <?= $Page->EDUCATION_TYPE_CODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_EDUCATION_TYPE_CODE">
<span<?= $Page->EDUCATION_TYPE_CODE->viewAttributes() ?>>
<?= $Page->EDUCATION_TYPE_CODE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
        <td data-name="JOB_ID" <?= $Page->JOB_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_JOB_ID">
<span<?= $Page->JOB_ID->viewAttributes() ?>>
<?= $Page->JOB_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->BLOOD_ID->Visible) { // BLOOD_ID ?>
        <td data-name="BLOOD_ID" <?= $Page->BLOOD_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_BLOOD_ID">
<span<?= $Page->BLOOD_ID->viewAttributes() ?>>
<?= $Page->BLOOD_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
        <td data-name="MARITALSTATUSID" <?= $Page->MARITALSTATUSID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MARITALSTATUSID">
<span<?= $Page->MARITALSTATUSID->viewAttributes() ?>>
<?= $Page->MARITALSTATUSID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
        <td data-name="ADDRESS" <?= $Page->ADDRESS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_ADDRESS">
<span<?= $Page->ADDRESS->viewAttributes() ?>>
<?= $Page->ADDRESS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KOTA->Visible) { // KOTA ?>
        <td data-name="KOTA" <?= $Page->KOTA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_KOTA">
<span<?= $Page->KOTA->viewAttributes() ?>>
<?= $Page->KOTA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->RT->Visible) { // RT ?>
        <td data-name="RT" <?= $Page->RT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_RT">
<span<?= $Page->RT->viewAttributes() ?>>
<?= $Page->RT->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->RW->Visible) { // RW ?>
        <td data-name="RW" <?= $Page->RW->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_RW">
<span<?= $Page->RW->viewAttributes() ?>>
<?= $Page->RW->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PHONE->Visible) { // PHONE ?>
        <td data-name="PHONE" <?= $Page->PHONE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_PHONE">
<span<?= $Page->PHONE->viewAttributes() ?>>
<?= $Page->PHONE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MOBILE->Visible) { // MOBILE ?>
        <td data-name="MOBILE" <?= $Page->MOBILE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MOBILE">
<span<?= $Page->MOBILE->viewAttributes() ?>>
<?= $Page->MOBILE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->FAX->Visible) { // FAX ?>
        <td data-name="FAX" <?= $Page->FAX->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_FAX">
<span<?= $Page->FAX->viewAttributes() ?>>
<?= $Page->FAX->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <td data-name="_EMAIL" <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <td data-name="DESCRIPTION" <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_DESCRIPTION">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
        <td data-name="MODIFIED_DATE" <?= $Page->MODIFIED_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MODIFIED_DATE">
<span<?= $Page->MODIFIED_DATE->viewAttributes() ?>>
<?= $Page->MODIFIED_DATE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
        <td data-name="MODIFIED_BY" <?= $Page->MODIFIED_BY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MODIFIED_BY">
<span<?= $Page->MODIFIED_BY->viewAttributes() ?>>
<?= $Page->MODIFIED_BY->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
        <td data-name="MODIFIED_FROM" <?= $Page->MODIFIED_FROM->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MODIFIED_FROM">
<span<?= $Page->MODIFIED_FROM->viewAttributes() ?>>
<?= $Page->MODIFIED_FROM->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->COUNTRY_CODE->Visible) { // COUNTRY_CODE ?>
        <td data-name="COUNTRY_CODE" <?= $Page->COUNTRY_CODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_COUNTRY_CODE">
<span<?= $Page->COUNTRY_CODE->viewAttributes() ?>>
<?= $Page->COUNTRY_CODE->getViewValue() ?></span>
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
    ew.addEventHandlers("FAMILY");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
