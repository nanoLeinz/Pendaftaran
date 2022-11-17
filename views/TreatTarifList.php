<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatTarifList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fTREAT_TARIFlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fTREAT_TARIFlist = currentForm = new ew.Form("fTREAT_TARIFlist", "list");
    fTREAT_TARIFlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "TREAT_TARIF")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.TREAT_TARIF)
        ew.vars.tables.TREAT_TARIF = currentTable;
    fTREAT_TARIFlist.addFields([
        ["KODE", [fields.KODE.visible && fields.KODE.required ? ew.Validators.required(fields.KODE.caption) : null], fields.KODE.isInvalid],
        ["TARIF_NAME", [fields.TARIF_NAME.visible && fields.TARIF_NAME.required ? ew.Validators.required(fields.TARIF_NAME.caption) : null], fields.TARIF_NAME.isInvalid],
        ["TARIF_TYPE", [fields.TARIF_TYPE.visible && fields.TARIF_TYPE.required ? ew.Validators.required(fields.TARIF_TYPE.caption) : null], fields.TARIF_TYPE.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fTREAT_TARIFlist,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fTREAT_TARIFlist.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }
        return true;
    }

    // Form_CustomValidate
    fTREAT_TARIFlist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fTREAT_TARIFlist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fTREAT_TARIFlist.lists.TARIF_TYPE = <?= $Page->TARIF_TYPE->toClientList($Page) ?>;
    loadjs.done("fTREAT_TARIFlist");
});
var fTREAT_TARIFlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fTREAT_TARIFlistsrch = currentSearchForm = new ew.Form("fTREAT_TARIFlistsrch");

    // Dynamic selection lists

    // Filters
    fTREAT_TARIFlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fTREAT_TARIFlistsrch");
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
<form name="fTREAT_TARIFlistsrch" id="fTREAT_TARIFlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fTREAT_TARIFlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="TREAT_TARIF">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TREAT_TARIF">
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
<form name="fTREAT_TARIFlist" id="fTREAT_TARIFlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREAT_TARIF">
<div id="gmp_TREAT_TARIF" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_TREAT_TARIFlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->KODE->Visible) { // KODE ?>
        <th data-name="KODE" class="<?= $Page->KODE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREAT_TARIF_KODE" class="TREAT_TARIF_KODE"><?= $Page->renderSort($Page->KODE) ?></div></th>
<?php } ?>
<?php if ($Page->TARIF_NAME->Visible) { // TARIF_NAME ?>
        <th data-name="TARIF_NAME" class="<?= $Page->TARIF_NAME->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREAT_TARIF_TARIF_NAME" class="TREAT_TARIF_TARIF_NAME"><?= $Page->renderSort($Page->TARIF_NAME) ?></div></th>
<?php } ?>
<?php if ($Page->TARIF_TYPE->Visible) { // TARIF_TYPE ?>
        <th data-name="TARIF_TYPE" class="<?= $Page->TARIF_TYPE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREAT_TARIF_TARIF_TYPE" class="TREAT_TARIF_TARIF_TYPE"><?= $Page->renderSort($Page->TARIF_TYPE) ?></div></th>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <th data-name="DESCRIPTION" class="<?= $Page->DESCRIPTION->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_TREAT_TARIF_DESCRIPTION" class="TREAT_TARIF_DESCRIPTION"><?= $Page->renderSort($Page->DESCRIPTION) ?></div></th>
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

// Restore number of post back records
if ($CurrentForm && ($Page->isConfirm() || $Page->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Page->FormKeyCountName) && ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm())) {
        $Page->KeyCount = $CurrentForm->getValue($Page->FormKeyCountName);
        $Page->StopRecord = $Page->StartRecord + $Page->KeyCount - 1;
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
$Page->EditRowCount = 0;
if ($Page->isEdit())
    $Page->RowIndex = 1;
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
        if ($Page->isEdit()) {
            if ($Page->checkInlineEditKey() && $Page->EditRowCount == 0) { // Inline edit
                $Page->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Page->isEdit() && $Page->RowType == ROWTYPE_EDIT && $Page->EventCancelled) { // Update failed
            $CurrentForm->Index = 1;
            $Page->restoreFormValues(); // Restore form values
        }
        if ($Page->RowType == ROWTYPE_EDIT) { // Edit row
            $Page->EditRowCount++;
        }

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_TREAT_TARIF", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->KODE->Visible) { // KODE ?>
        <td data-name="KODE" <?= $Page->KODE->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_TREAT_TARIF_KODE" class="form-group">
<input type="<?= $Page->KODE->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_KODE" name="x<?= $Page->RowIndex ?>_KODE" id="x<?= $Page->RowIndex ?>_KODE" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->KODE->getPlaceHolder()) ?>" value="<?= $Page->KODE->EditValue ?>"<?= $Page->KODE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->KODE->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_TREAT_TARIF_KODE">
<span<?= $Page->KODE->viewAttributes() ?>>
<?= $Page->KODE->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->TARIF_NAME->Visible) { // TARIF_NAME ?>
        <td data-name="TARIF_NAME" <?= $Page->TARIF_NAME->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_TREAT_TARIF_TARIF_NAME" class="form-group">
<input type="<?= $Page->TARIF_NAME->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_TARIF_NAME" name="x<?= $Page->RowIndex ?>_TARIF_NAME" id="x<?= $Page->RowIndex ?>_TARIF_NAME" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->TARIF_NAME->getPlaceHolder()) ?>" value="<?= $Page->TARIF_NAME->EditValue ?>"<?= $Page->TARIF_NAME->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TARIF_NAME->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_TREAT_TARIF_TARIF_NAME">
<span<?= $Page->TARIF_NAME->viewAttributes() ?>>
<?= $Page->TARIF_NAME->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->TARIF_TYPE->Visible) { // TARIF_TYPE ?>
        <td data-name="TARIF_TYPE" <?= $Page->TARIF_TYPE->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_TREAT_TARIF_TARIF_TYPE" class="form-group">
    <select
        id="x<?= $Page->RowIndex ?>_TARIF_TYPE"
        name="x<?= $Page->RowIndex ?>_TARIF_TYPE"
        class="form-control ew-select<?= $Page->TARIF_TYPE->isInvalidClass() ?>"
        data-select2-id="TREAT_TARIF_x<?= $Page->RowIndex ?>_TARIF_TYPE"
        data-table="TREAT_TARIF"
        data-field="x_TARIF_TYPE"
        data-value-separator="<?= $Page->TARIF_TYPE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->TARIF_TYPE->getPlaceHolder()) ?>"
        <?= $Page->TARIF_TYPE->editAttributes() ?>>
        <?= $Page->TARIF_TYPE->selectOptionListHtml("x{$Page->RowIndex}_TARIF_TYPE") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->TARIF_TYPE->getErrorMessage() ?></div>
<?= $Page->TARIF_TYPE->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_TARIF_TYPE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREAT_TARIF_x<?= $Page->RowIndex ?>_TARIF_TYPE']"),
        options = { name: "x<?= $Page->RowIndex ?>_TARIF_TYPE", selectId: "TREAT_TARIF_x<?= $Page->RowIndex ?>_TARIF_TYPE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREAT_TARIF.fields.TARIF_TYPE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_TREAT_TARIF_TARIF_TYPE">
<span<?= $Page->TARIF_TYPE->viewAttributes() ?>>
<?= $Page->TARIF_TYPE->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <td data-name="DESCRIPTION" <?= $Page->DESCRIPTION->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_TREAT_TARIF_DESCRIPTION" class="form-group">
<input type="<?= $Page->DESCRIPTION->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_DESCRIPTION" name="x<?= $Page->RowIndex ?>_DESCRIPTION" id="x<?= $Page->RowIndex ?>_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Page->DESCRIPTION->EditValue ?>"<?= $Page->DESCRIPTION->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DESCRIPTION->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_TREAT_TARIF_DESCRIPTION">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fTREAT_TARIFlist","load"], function () {
    fTREAT_TARIFlist.updateLists(<?= $Page->RowIndex ?>);
});
</script>
<?php } ?>
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
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php } ?>
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
    ew.addEventHandlers("TREAT_TARIF");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
