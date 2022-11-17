<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienDiagnosaList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPASIEN_DIAGNOSAlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fPASIEN_DIAGNOSAlist = currentForm = new ew.Form("fPASIEN_DIAGNOSAlist", "list");
    fPASIEN_DIAGNOSAlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fPASIEN_DIAGNOSAlist");
});
var fPASIEN_DIAGNOSAlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fPASIEN_DIAGNOSAlistsrch = currentSearchForm = new ew.Form("fPASIEN_DIAGNOSAlistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PASIEN_DIAGNOSA")) ?>,
        fields = currentTable.fields;
    fPASIEN_DIAGNOSAlistsrch.addFields([
        ["DATE_OF_DIAGNOSA", [], fields.DATE_OF_DIAGNOSA.isInvalid],
        ["DIAGNOSA_ID", [], fields.DIAGNOSA_ID.isInvalid],
        ["ANAMNASE", [], fields.ANAMNASE.isInvalid],
        ["PEMERIKSAAN", [], fields.PEMERIKSAAN.isInvalid],
        ["TERAPHY_DESC", [], fields.TERAPHY_DESC.isInvalid],
        ["TGLKONTROL", [], fields.TGLKONTROL.isInvalid],
        ["IDXDAFTAR", [], fields.IDXDAFTAR.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fPASIEN_DIAGNOSAlistsrch.setInvalid();
    });

    // Validate form
    fPASIEN_DIAGNOSAlistsrch.validate = function () {
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
    fPASIEN_DIAGNOSAlistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPASIEN_DIAGNOSAlistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fPASIEN_DIAGNOSAlistsrch.lists.DIAGNOSA_ID = <?= $Page->DIAGNOSA_ID->toClientList($Page) ?>;

    // Filters
    fPASIEN_DIAGNOSAlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fPASIEN_DIAGNOSAlistsrch");
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "V_RIWAYAT_RM") {
    if ($Page->MasterRecordExists) {
        include_once "views/VRiwayatRmMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fPASIEN_DIAGNOSAlistsrch" id="fPASIEN_DIAGNOSAlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fPASIEN_DIAGNOSAlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PASIEN_DIAGNOSA">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_DIAGNOSA_ID" class="ew-cell form-group">
        <label for="x_DIAGNOSA_ID" class="ew-search-caption ew-label"><?= $Page->DIAGNOSA_ID->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DIAGNOSA_ID" id="z_DIAGNOSA_ID" value="LIKE">
</span>
        <span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="ew-search-field">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID"><?= EmptyValue(strval($Page->DIAGNOSA_ID->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID->ReadOnly || $Page->DIAGNOSA_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID->getErrorMessage(false) ?></div>
<?= $Page->DIAGNOSA_ID->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID") ?>
<input type="hidden" is="selection-list" data-table="PASIEN_DIAGNOSA" data-field="x_DIAGNOSA_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID" id="x_DIAGNOSA_ID" value="<?= $Page->DIAGNOSA_ID->AdvancedSearch->SearchValue ?>"<?= $Page->DIAGNOSA_ID->editAttributes() ?>>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PASIEN_DIAGNOSA">
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
<form name="fPASIEN_DIAGNOSAlist" id="fPASIEN_DIAGNOSAlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN_DIAGNOSA">
<?php if ($Page->getCurrentMasterTable() == "V_RIWAYAT_RM" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_RIWAYAT_RM">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_PASIEN_DIAGNOSA" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_PASIEN_DIAGNOSAlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
        <th data-name="DATE_OF_DIAGNOSA" class="<?= $Page->DATE_OF_DIAGNOSA->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" class="PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA"><?= $Page->renderSort($Page->DATE_OF_DIAGNOSA) ?></div></th>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <th data-name="DIAGNOSA_ID" class="<?= $Page->DIAGNOSA_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="PASIEN_DIAGNOSA_DIAGNOSA_ID"><?= $Page->renderSort($Page->DIAGNOSA_ID) ?></div></th>
<?php } ?>
<?php if ($Page->ANAMNASE->Visible) { // ANAMNASE ?>
        <th data-name="ANAMNASE" class="<?= $Page->ANAMNASE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_ANAMNASE" class="PASIEN_DIAGNOSA_ANAMNASE"><?= $Page->renderSort($Page->ANAMNASE) ?></div></th>
<?php } ?>
<?php if ($Page->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
        <th data-name="PEMERIKSAAN" class="<?= $Page->PEMERIKSAAN->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_PEMERIKSAAN" class="PASIEN_DIAGNOSA_PEMERIKSAAN"><?= $Page->renderSort($Page->PEMERIKSAAN) ?></div></th>
<?php } ?>
<?php if ($Page->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
        <th data-name="TERAPHY_DESC" class="<?= $Page->TERAPHY_DESC->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_TERAPHY_DESC" class="PASIEN_DIAGNOSA_TERAPHY_DESC"><?= $Page->renderSort($Page->TERAPHY_DESC) ?></div></th>
<?php } ?>
<?php if ($Page->TGLKONTROL->Visible) { // TGLKONTROL ?>
        <th data-name="TGLKONTROL" class="<?= $Page->TGLKONTROL->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_PASIEN_DIAGNOSA_TGLKONTROL" class="PASIEN_DIAGNOSA_TGLKONTROL"><?= $Page->renderSort($Page->TGLKONTROL) ?></div></th>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
        <th data-name="IDXDAFTAR" class="<?= $Page->IDXDAFTAR->headerCellClass() ?>"><div id="elh_PASIEN_DIAGNOSA_IDXDAFTAR" class="PASIEN_DIAGNOSA_IDXDAFTAR"><?= $Page->renderSort($Page->IDXDAFTAR) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_PASIEN_DIAGNOSA", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
        <td data-name="DATE_OF_DIAGNOSA" <?= $Page->DATE_OF_DIAGNOSA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA">
<span<?= $Page->DATE_OF_DIAGNOSA->viewAttributes() ?>>
<?= $Page->DATE_OF_DIAGNOSA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <td data-name="DIAGNOSA_ID" <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_DIAGNOSA_ID">
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ANAMNASE->Visible) { // ANAMNASE ?>
        <td data-name="ANAMNASE" <?= $Page->ANAMNASE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_ANAMNASE">
<span<?= $Page->ANAMNASE->viewAttributes() ?>>
<?= $Page->ANAMNASE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
        <td data-name="PEMERIKSAAN" <?= $Page->PEMERIKSAAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_PEMERIKSAAN">
<span<?= $Page->PEMERIKSAAN->viewAttributes() ?>>
<?= $Page->PEMERIKSAAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
        <td data-name="TERAPHY_DESC" <?= $Page->TERAPHY_DESC->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_TERAPHY_DESC">
<span<?= $Page->TERAPHY_DESC->viewAttributes() ?>>
<?= $Page->TERAPHY_DESC->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TGLKONTROL->Visible) { // TGLKONTROL ?>
        <td data-name="TGLKONTROL" <?= $Page->TGLKONTROL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_TGLKONTROL">
<span<?= $Page->TGLKONTROL->viewAttributes() ?>>
<?= $Page->TGLKONTROL->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
        <td data-name="IDXDAFTAR" <?= $Page->IDXDAFTAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_IDXDAFTAR">
<span<?= $Page->IDXDAFTAR->viewAttributes() ?>>
<?= $Page->IDXDAFTAR->getViewValue() ?></span>
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
    ew.addEventHandlers("PASIEN_DIAGNOSA");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
