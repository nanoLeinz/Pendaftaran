<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$RegisterRanapSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentForm, currentPageID;
var fsummary, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fsummary = currentForm = new ew.Form("fsummary", "summary");
    currentPageID = ew.PAGE_ID = "summary";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "register_ranap")) ?>,
        fields = currentTable.fields;
    fsummary.addFields([
        ["NO_REGISTRATION", [], fields.NO_REGISTRATION.isInvalid],
        ["GENDER", [], fields.GENDER.isInvalid],
        ["TREATMENT", [], fields.TREATMENT.isInvalid],
        ["CLASS_ROOM_ID", [], fields.CLASS_ROOM_ID.isInvalid],
        ["BED_ID", [], fields.BED_ID.isInvalid],
        ["DOCTOR", [], fields.DOCTOR.isInvalid],
        ["SERVED_INAP", [ew.Validators.datetime(7)], fields.SERVED_INAP.isInvalid],
        ["STATUS_PASIEN_ID", [], fields.STATUS_PASIEN_ID.isInvalid],
        ["ISRJ", [], fields.ISRJ.isInvalid],
        ["VISIT_ID", [], fields.VISIT_ID.isInvalid],
        ["IDXDAFTAR", [], fields.IDXDAFTAR.isInvalid],
        ["DIANTAR_OLEH", [], fields.DIANTAR_OLEH.isInvalid],
        ["EXIT_DATE", [], fields.EXIT_DATE.isInvalid],
        ["KELUAR_ID", [], fields.KELUAR_ID.isInvalid],
        ["AGEYEAR", [], fields.AGEYEAR.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fsummary.setInvalid();
    });

    // Validate form
    fsummary.validate = function () {
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
    fsummary.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsummary.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fsummary.lists.CLASS_ROOM_ID = <?= $Page->CLASS_ROOM_ID->toClientList($Page) ?>;

    // Filters
    fsummary.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fsummary");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?= $Page->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fsummary-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="register_ranap">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_CLASS_ROOM_ID" class="ew-cell form-group">
        <label for="x_CLASS_ROOM_ID" class="ew-search-caption ew-label"><?= $Page->CLASS_ROOM_ID->caption() ?></label>
        <span id="el_register_ranap_CLASS_ROOM_ID" class="ew-search-field">
    <select
        id="x_CLASS_ROOM_ID"
        name="x_CLASS_ROOM_ID"
        class="form-control ew-select<?= $Page->CLASS_ROOM_ID->isInvalidClass() ?>"
        data-select2-id="register_ranap_x_CLASS_ROOM_ID"
        data-table="register_ranap"
        data-field="x_CLASS_ROOM_ID"
        data-value-separator="<?= $Page->CLASS_ROOM_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLASS_ROOM_ID->getPlaceHolder()) ?>"
        <?= $Page->CLASS_ROOM_ID->editAttributes() ?>>
        <?= $Page->CLASS_ROOM_ID->selectOptionListHtml("x_CLASS_ROOM_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->CLASS_ROOM_ID->getErrorMessage() ?></div>
<?= $Page->CLASS_ROOM_ID->Lookup->getParamTag($Page, "p_x_CLASS_ROOM_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='register_ranap_x_CLASS_ROOM_ID']"),
        options = { name: "x_CLASS_ROOM_ID", selectId: "register_ranap_x_CLASS_ROOM_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.register_ranap.fields.CLASS_ROOM_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->SERVED_INAP->Visible) { // SERVED_INAP ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_SERVED_INAP" class="ew-cell form-group">
        <label for="x_SERVED_INAP" class="ew-search-caption ew-label"><?= $Page->SERVED_INAP->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_SERVED_INAP" id="z_SERVED_INAP" value="=">
</span>
        <span id="el_register_ranap_SERVED_INAP" class="ew-search-field">
<input type="<?= $Page->SERVED_INAP->getInputTextType() ?>" data-table="register_ranap" data-field="x_SERVED_INAP" data-format="7" name="x_SERVED_INAP" id="x_SERVED_INAP" placeholder="<?= HtmlEncode($Page->SERVED_INAP->getPlaceHolder()) ?>" value="<?= $Page->SERVED_INAP->EditValue ?>"<?= $Page->SERVED_INAP->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->SERVED_INAP->getErrorMessage() ?></div>
<?php if (!$Page->SERVED_INAP->ReadOnly && !$Page->SERVED_INAP->Disabled && !isset($Page->SERVED_INAP->EditAttrs["readonly"]) && !isset($Page->SERVED_INAP->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsummary", "datetimepicker"], function() {
    ew.createDateTimePicker("fsummary", "x_SERVED_INAP", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
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
    <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?= $Page->ReportTableStyle ?>>
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_register_ranap" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
    <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div class="register_ranap_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
    <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>" style="white-space: nowrap;"><div class="register_ranap_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { ?>
    <th data-name="TREATMENT" class="<?= $Page->TREATMENT->headerCellClass() ?>" style="white-space: nowrap;"><div class="register_ranap_TREATMENT"><?= $Page->renderSort($Page->TREATMENT) ?></div></th>
<?php } ?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { ?>
    <th data-name="CLASS_ROOM_ID" class="<?= $Page->CLASS_ROOM_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="register_ranap_CLASS_ROOM_ID"><?= $Page->renderSort($Page->CLASS_ROOM_ID) ?></div></th>
<?php } ?>
<?php if ($Page->BED_ID->Visible) { ?>
    <th data-name="BED_ID" class="<?= $Page->BED_ID->headerCellClass() ?>"><div class="register_ranap_BED_ID"><?= $Page->renderSort($Page->BED_ID) ?></div></th>
<?php } ?>
<?php if ($Page->DOCTOR->Visible) { ?>
    <th data-name="DOCTOR" class="<?= $Page->DOCTOR->headerCellClass() ?>"><div class="register_ranap_DOCTOR"><?= $Page->renderSort($Page->DOCTOR) ?></div></th>
<?php } ?>
<?php if ($Page->SERVED_INAP->Visible) { ?>
    <th data-name="SERVED_INAP" class="<?= $Page->SERVED_INAP->headerCellClass() ?>"><div class="register_ranap_SERVED_INAP"><?= $Page->renderSort($Page->SERVED_INAP) ?></div></th>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { ?>
    <th data-name="STATUS_PASIEN_ID" class="<?= $Page->STATUS_PASIEN_ID->headerCellClass() ?>"><div class="register_ranap_STATUS_PASIEN_ID"><?= $Page->renderSort($Page->STATUS_PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Page->ISRJ->Visible) { ?>
    <th data-name="ISRJ" class="<?= $Page->ISRJ->headerCellClass() ?>" style="white-space: nowrap;"><div class="register_ranap_ISRJ"><?= $Page->renderSort($Page->ISRJ) ?></div></th>
<?php } ?>
<?php if ($Page->VISIT_ID->Visible) { ?>
    <th data-name="VISIT_ID" class="<?= $Page->VISIT_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="register_ranap_VISIT_ID"><?= $Page->renderSort($Page->VISIT_ID) ?></div></th>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { ?>
    <th data-name="IDXDAFTAR" class="<?= $Page->IDXDAFTAR->headerCellClass() ?>" style="white-space: nowrap;"><div class="register_ranap_IDXDAFTAR"><?= $Page->renderSort($Page->IDXDAFTAR) ?></div></th>
<?php } ?>
<?php if ($Page->DIANTAR_OLEH->Visible) { ?>
    <th data-name="DIANTAR_OLEH" class="<?= $Page->DIANTAR_OLEH->headerCellClass() ?>" style="white-space: nowrap;"><div class="register_ranap_DIANTAR_OLEH"><?= $Page->renderSort($Page->DIANTAR_OLEH) ?></div></th>
<?php } ?>
<?php if ($Page->EXIT_DATE->Visible) { ?>
    <th data-name="EXIT_DATE" class="<?= $Page->EXIT_DATE->headerCellClass() ?>"><div class="register_ranap_EXIT_DATE"><?= $Page->renderSort($Page->EXIT_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { ?>
    <th data-name="KELUAR_ID" class="<?= $Page->KELUAR_ID->headerCellClass() ?>"><div class="register_ranap_KELUAR_ID"><?= $Page->renderSort($Page->KELUAR_ID) ?></div></th>
<?php } ?>
<?php if ($Page->AGEYEAR->Visible) { ?>
    <th data-name="AGEYEAR" class="<?= $Page->AGEYEAR->headerCellClass() ?>"><div class="register_ranap_AGEYEAR"><?= $Page->renderSort($Page->AGEYEAR) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
        <td data-field="NO_REGISTRATION"<?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
        <td data-field="GENDER"<?= $Page->GENDER->cellAttributes() ?>>
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { ?>
        <td data-field="TREATMENT"<?= $Page->TREATMENT->cellAttributes() ?>>
<span<?= $Page->TREATMENT->viewAttributes() ?>>
<?= $Page->TREATMENT->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { ?>
        <td data-field="CLASS_ROOM_ID"<?= $Page->CLASS_ROOM_ID->cellAttributes() ?>>
<span<?= $Page->CLASS_ROOM_ID->viewAttributes() ?>>
<?= $Page->CLASS_ROOM_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->BED_ID->Visible) { ?>
        <td data-field="BED_ID"<?= $Page->BED_ID->cellAttributes() ?>>
<span<?= $Page->BED_ID->viewAttributes() ?>>
<?= $Page->BED_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->DOCTOR->Visible) { ?>
        <td data-field="DOCTOR"<?= $Page->DOCTOR->cellAttributes() ?>>
<span<?= $Page->DOCTOR->viewAttributes() ?>>
<?= $Page->DOCTOR->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->SERVED_INAP->Visible) { ?>
        <td data-field="SERVED_INAP"<?= $Page->SERVED_INAP->cellAttributes() ?>>
<span<?= $Page->SERVED_INAP->viewAttributes() ?>>
<?= $Page->SERVED_INAP->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { ?>
        <td data-field="STATUS_PASIEN_ID"<?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ISRJ->Visible) { ?>
        <td data-field="ISRJ"<?= $Page->ISRJ->cellAttributes() ?>>
<span<?= $Page->ISRJ->viewAttributes() ?>>
<?= $Page->ISRJ->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->VISIT_ID->Visible) { ?>
        <td data-field="VISIT_ID"<?= $Page->VISIT_ID->cellAttributes() ?>>
<span<?= $Page->VISIT_ID->viewAttributes() ?>>
<?= $Page->VISIT_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { ?>
        <td data-field="IDXDAFTAR"<?= $Page->IDXDAFTAR->cellAttributes() ?>>
<span<?= $Page->IDXDAFTAR->viewAttributes() ?>>
<?= $Page->IDXDAFTAR->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->DIANTAR_OLEH->Visible) { ?>
        <td data-field="DIANTAR_OLEH"<?= $Page->DIANTAR_OLEH->cellAttributes() ?>>
<span<?= $Page->DIANTAR_OLEH->viewAttributes() ?>>
<?= $Page->DIANTAR_OLEH->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->EXIT_DATE->Visible) { ?>
        <td data-field="EXIT_DATE"<?= $Page->EXIT_DATE->cellAttributes() ?>>
<span<?= $Page->EXIT_DATE->viewAttributes() ?>>
<?= $Page->EXIT_DATE->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { ?>
        <td data-field="KELUAR_ID"<?= $Page->KELUAR_ID->cellAttributes() ?>>
<span<?= $Page->KELUAR_ID->viewAttributes() ?>>
<?= $Page->KELUAR_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->AGEYEAR->Visible) { ?>
        <td data-field="AGEYEAR"<?= $Page->AGEYEAR->cellAttributes() ?>>
<span<?= $Page->AGEYEAR->viewAttributes() ?>>
<?= $Page->AGEYEAR->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_TOTAL;
    $Page->RowTotalType = ROWTOTAL_GRAND;
    $Page->RowTotalSubType = ROWTOTAL_FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, 0); ?></span>)</span></td></tr>
    <tr<?= $Page->rowAttributes() ?>>
<?php if ($Page->GroupColumnCount > 0) { ?>
        <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
        <td data-field="NO_REGISTRATION"<?= $Page->NO_REGISTRATION->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
        <td data-field="GENDER"<?= $Page->GENDER->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { ?>
        <td data-field="TREATMENT"<?= $Page->TREATMENT->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { ?>
        <td data-field="CLASS_ROOM_ID"<?= $Page->CLASS_ROOM_ID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->BED_ID->Visible) { ?>
        <td data-field="BED_ID"<?= $Page->BED_ID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->DOCTOR->Visible) { ?>
        <td data-field="DOCTOR"<?= $Page->DOCTOR->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SERVED_INAP->Visible) { ?>
        <td data-field="SERVED_INAP"<?= $Page->SERVED_INAP->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { ?>
        <td data-field="STATUS_PASIEN_ID"<?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->ISRJ->Visible) { ?>
        <td data-field="ISRJ"<?= $Page->ISRJ->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->VISIT_ID->Visible) { ?>
        <td data-field="VISIT_ID"<?= $Page->VISIT_ID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { ?>
        <td data-field="IDXDAFTAR"<?= $Page->IDXDAFTAR->cellAttributes() ?>><span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?= $Page->IDXDAFTAR->viewAttributes() ?>><?= $Page->IDXDAFTAR->CntViewValue ?></span></span></td>
<?php } ?>
<?php if ($Page->DIANTAR_OLEH->Visible) { ?>
        <td data-field="DIANTAR_OLEH"<?= $Page->DIANTAR_OLEH->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->EXIT_DATE->Visible) { ?>
        <td data-field="EXIT_DATE"<?= $Page->EXIT_DATE->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { ?>
        <td data-field="KELUAR_ID"<?= $Page->KELUAR_ID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->AGEYEAR->Visible) { ?>
        <td data-field="AGEYEAR"<?= $Page->AGEYEAR->cellAttributes() ?>></td>
<?php } ?>
    </tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, 0); ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
    <tr<?= $Page->rowAttributes() ?>>
<?php if ($Page->NO_REGISTRATION->Visible) { ?>
        <td data-field="NO_REGISTRATION"<?= $Page->NO_REGISTRATION->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->GENDER->Visible) { ?>
        <td data-field="GENDER"<?= $Page->GENDER->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { ?>
        <td data-field="TREATMENT"<?= $Page->TREATMENT->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { ?>
        <td data-field="CLASS_ROOM_ID"<?= $Page->CLASS_ROOM_ID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->BED_ID->Visible) { ?>
        <td data-field="BED_ID"<?= $Page->BED_ID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->DOCTOR->Visible) { ?>
        <td data-field="DOCTOR"<?= $Page->DOCTOR->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SERVED_INAP->Visible) { ?>
        <td data-field="SERVED_INAP"<?= $Page->SERVED_INAP->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { ?>
        <td data-field="STATUS_PASIEN_ID"<?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->ISRJ->Visible) { ?>
        <td data-field="ISRJ"<?= $Page->ISRJ->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->VISIT_ID->Visible) { ?>
        <td data-field="VISIT_ID"<?= $Page->VISIT_ID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { ?>
        <td data-field="IDXDAFTAR"<?= $Page->IDXDAFTAR->cellAttributes() ?>><span class="ew-aggregate"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateColon") ?>
<span<?= $Page->IDXDAFTAR->viewAttributes() ?>>
<?= $Page->IDXDAFTAR->CntViewValue ?></span>
</td>
<?php } ?>
<?php if ($Page->DIANTAR_OLEH->Visible) { ?>
        <td data-field="DIANTAR_OLEH"<?= $Page->DIANTAR_OLEH->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->EXIT_DATE->Visible) { ?>
        <td data-field="EXIT_DATE"<?= $Page->EXIT_DATE->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { ?>
        <td data-field="KELUAR_ID"<?= $Page->KELUAR_ID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->AGEYEAR->Visible) { ?>
        <td data-field="AGEYEAR"<?= $Page->AGEYEAR->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
    </tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
