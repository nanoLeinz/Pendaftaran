<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPASIENlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fPASIENlist = currentForm = new ew.Form("fPASIENlist", "list");
    fPASIENlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fPASIENlist");
});
var fPASIENlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fPASIENlistsrch = currentSearchForm = new ew.Form("fPASIENlistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PASIEN")) ?>,
        fields = currentTable.fields;
    fPASIENlistsrch.addFields([
        ["NO_REGISTRATION", [], fields.NO_REGISTRATION.isInvalid],
        ["NAME_OF_PASIEN", [], fields.NAME_OF_PASIEN.isInvalid],
        ["PASIEN_ID", [], fields.PASIEN_ID.isInvalid],
        ["KK_NO", [], fields.KK_NO.isInvalid],
        ["GENDER", [], fields.GENDER.isInvalid],
        ["STATUS_PASIEN_ID", [], fields.STATUS_PASIEN_ID.isInvalid],
        ["MOTHER", [], fields.MOTHER.isInvalid],
        ["FATHER", [], fields.FATHER.isInvalid],
        ["SPOUSE", [], fields.SPOUSE.isInvalid],
        ["REGISTRATION_DATE", [], fields.REGISTRATION_DATE.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fPASIENlistsrch.setInvalid();
    });

    // Validate form
    fPASIENlistsrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fPASIENlistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPASIENlistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists

    // Filters
    fPASIENlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fPASIENlistsrch");
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
<form name="fPASIENlistsrch" id="fPASIENlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fPASIENlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PASIEN">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->MOTHER->Visible) { // MOTHER ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_MOTHER" class="ew-cell form-group">
        <label for="x_MOTHER" class="ew-search-caption ew-label"><?= $Page->MOTHER->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MOTHER" id="z_MOTHER" value="LIKE">
</span>
        <span id="el_PASIEN_MOTHER" class="ew-search-field">
<input type="<?= $Page->MOTHER->getInputTextType() ?>" data-table="PASIEN" data-field="x_MOTHER" name="x_MOTHER" id="x_MOTHER" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->MOTHER->getPlaceHolder()) ?>" value="<?= $Page->MOTHER->EditValue ?>"<?= $Page->MOTHER->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->MOTHER->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->FATHER->Visible) { // FATHER ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_FATHER" class="ew-cell form-group">
        <label for="x_FATHER" class="ew-search-caption ew-label"><?= $Page->FATHER->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FATHER" id="z_FATHER" value="LIKE">
</span>
        <span id="el_PASIEN_FATHER" class="ew-search-field">
<input type="<?= $Page->FATHER->getInputTextType() ?>" data-table="PASIEN" data-field="x_FATHER" name="x_FATHER" id="x_FATHER" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->FATHER->getPlaceHolder()) ?>" value="<?= $Page->FATHER->EditValue ?>"<?= $Page->FATHER->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->FATHER->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->SPOUSE->Visible) { // SPOUSE ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_SPOUSE" class="ew-cell form-group">
        <label for="x_SPOUSE" class="ew-search-caption ew-label"><?= $Page->SPOUSE->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SPOUSE" id="z_SPOUSE" value="LIKE">
</span>
        <span id="el_PASIEN_SPOUSE" class="ew-search-field">
<input type="<?= $Page->SPOUSE->getInputTextType() ?>" data-table="PASIEN" data-field="x_SPOUSE" name="x_SPOUSE" id="x_SPOUSE" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->SPOUSE->getPlaceHolder()) ?>" value="<?= $Page->SPOUSE->EditValue ?>"<?= $Page->SPOUSE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->SPOUSE->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow > 0) { ?>
</div>
    <?php } ?>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PASIEN">
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
<form name="fPASIENlist" id="fPASIENlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN">
<div id="gmp_PASIEN" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_PASIENlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_NO_REGISTRATION" class="PASIEN_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
        <th data-name="NAME_OF_PASIEN" class="<?= $Page->NAME_OF_PASIEN->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_NAME_OF_PASIEN" class="PASIEN_NAME_OF_PASIEN"><?= $Page->renderSort($Page->NAME_OF_PASIEN) ?></div></th>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <th data-name="PASIEN_ID" class="<?= $Page->PASIEN_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_PASIEN_ID" class="PASIEN_PASIEN_ID"><?= $Page->renderSort($Page->PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Page->KK_NO->Visible) { // KK_NO ?>
        <th data-name="KK_NO" class="<?= $Page->KK_NO->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_KK_NO" class="PASIEN_KK_NO"><?= $Page->renderSort($Page->KK_NO) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_GENDER" class="PASIEN_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <th data-name="STATUS_PASIEN_ID" class="<?= $Page->STATUS_PASIEN_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_STATUS_PASIEN_ID" class="PASIEN_STATUS_PASIEN_ID"><?= $Page->renderSort($Page->STATUS_PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Page->MOTHER->Visible) { // MOTHER ?>
        <th data-name="MOTHER" class="<?= $Page->MOTHER->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_MOTHER" class="PASIEN_MOTHER"><?= $Page->renderSort($Page->MOTHER) ?></div></th>
<?php } ?>
<?php if ($Page->FATHER->Visible) { // FATHER ?>
        <th data-name="FATHER" class="<?= $Page->FATHER->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_FATHER" class="PASIEN_FATHER"><?= $Page->renderSort($Page->FATHER) ?></div></th>
<?php } ?>
<?php if ($Page->SPOUSE->Visible) { // SPOUSE ?>
        <th data-name="SPOUSE" class="<?= $Page->SPOUSE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_SPOUSE" class="PASIEN_SPOUSE"><?= $Page->renderSort($Page->SPOUSE) ?></div></th>
<?php } ?>
<?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
        <th data-name="REGISTRATION_DATE" class="<?= $Page->REGISTRATION_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_REGISTRATION_DATE" class="PASIEN_REGISTRATION_DATE"><?= $Page->renderSort($Page->REGISTRATION_DATE) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_PASIEN", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_PASIEN_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
        <td data-name="NAME_OF_PASIEN" <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_NAME_OF_PASIEN">
<span<?= $Page->NAME_OF_PASIEN->viewAttributes() ?>>
<?= $Page->NAME_OF_PASIEN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <td data-name="PASIEN_ID" <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_PASIEN_ID">
<span<?= $Page->PASIEN_ID->viewAttributes() ?>>
<?= $Page->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KK_NO->Visible) { // KK_NO ?>
        <td data-name="KK_NO" <?= $Page->KK_NO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_KK_NO">
<span<?= $Page->KK_NO->viewAttributes() ?>>
<?= $Page->KK_NO->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_STATUS_PASIEN_ID">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MOTHER->Visible) { // MOTHER ?>
        <td data-name="MOTHER" <?= $Page->MOTHER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_MOTHER">
<span<?= $Page->MOTHER->viewAttributes() ?>>
<?= $Page->MOTHER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->FATHER->Visible) { // FATHER ?>
        <td data-name="FATHER" <?= $Page->FATHER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_FATHER">
<span<?= $Page->FATHER->viewAttributes() ?>>
<?= $Page->FATHER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SPOUSE->Visible) { // SPOUSE ?>
        <td data-name="SPOUSE" <?= $Page->SPOUSE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_SPOUSE">
<span<?= $Page->SPOUSE->viewAttributes() ?>>
<?= $Page->SPOUSE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
        <td data-name="REGISTRATION_DATE" <?= $Page->REGISTRATION_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_REGISTRATION_DATE">
<span<?= $Page->REGISTRATION_DATE->viewAttributes() ?>>
<?= $Page->REGISTRATION_DATE->getViewValue() ?></span>
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
    ew.addEventHandlers("PASIEN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
