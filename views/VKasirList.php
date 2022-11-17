<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VKasirList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_KASIRlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fV_KASIRlist = currentForm = new ew.Form("fV_KASIRlist", "list");
    fV_KASIRlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fV_KASIRlist");
});
var fV_KASIRlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fV_KASIRlistsrch = currentSearchForm = new ew.Form("fV_KASIRlistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "V_KASIR")) ?>,
        fields = currentTable.fields;
    fV_KASIRlistsrch.addFields([
        ["CETAK", [], fields.CETAK.isInvalid],
        ["NO_REGISTRATION", [], fields.NO_REGISTRATION.isInvalid],
        ["VISIT_DATE", [], fields.VISIT_DATE.isInvalid],
        ["CLINIC_ID", [], fields.CLINIC_ID.isInvalid],
        ["GENDER", [], fields.GENDER.isInvalid],
        ["EMPLOYEE_ID", [], fields.EMPLOYEE_ID.isInvalid],
        ["PAYOR_ID", [], fields.PAYOR_ID.isInvalid],
        ["CLASS_ID", [], fields.CLASS_ID.isInvalid],
        ["PASIEN_ID", [], fields.PASIEN_ID.isInvalid],
        ["tgl_kontrol", [], fields.tgl_kontrol.isInvalid],
        ["idbooking", [], fields.idbooking.isInvalid],
        ["id_tujuan", [], fields.id_tujuan.isInvalid],
        ["id_penunjang", [], fields.id_penunjang.isInvalid],
        ["id_pembiayaan", [], fields.id_pembiayaan.isInvalid],
        ["id_procedure", [], fields.id_procedure.isInvalid],
        ["id_aspel", [], fields.id_aspel.isInvalid],
        ["id_kelas", [], fields.id_kelas.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fV_KASIRlistsrch.setInvalid();
    });

    // Validate form
    fV_KASIRlistsrch.validate = function () {
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
    fV_KASIRlistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fV_KASIRlistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fV_KASIRlistsrch.lists.CLINIC_ID = <?= $Page->CLINIC_ID->toClientList($Page) ?>;

    // Filters
    fV_KASIRlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fV_KASIRlistsrch");
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
<form name="fV_KASIRlistsrch" id="fV_KASIRlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fV_KASIRlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="V_KASIR">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_CLINIC_ID" class="ew-cell form-group">
        <label for="x_CLINIC_ID" class="ew-search-caption ew-label"><?= $Page->CLINIC_ID->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CLINIC_ID" id="z_CLINIC_ID" value="LIKE">
</span>
        <span id="el_V_KASIR_CLINIC_ID" class="ew-search-field">
    <select
        id="x_CLINIC_ID"
        name="x_CLINIC_ID"
        class="form-control ew-select<?= $Page->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_CLINIC_ID"
        data-table="V_KASIR"
        data-field="x_CLINIC_ID"
        data-value-separator="<?= $Page->CLINIC_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLINIC_ID->getPlaceHolder()) ?>"
        <?= $Page->CLINIC_ID->editAttributes() ?>>
        <?= $Page->CLINIC_ID->selectOptionListHtml("x_CLINIC_ID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->CLINIC_ID->getErrorMessage(false) ?></div>
<?= $Page->CLINIC_ID->Lookup->getParamTag($Page, "p_x_CLINIC_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_CLINIC_ID']"),
        options = { name: "x_CLINIC_ID", selectId: "V_KASIR_x_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> V_KASIR">
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
<form name="fV_KASIRlist" id="fV_KASIRlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_KASIR">
<div id="gmp_V_KASIR" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_V_KASIRlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->CETAK->Visible) { // CETAK ?>
        <th data-name="CETAK" class="<?= $Page->CETAK->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_CETAK" class="V_KASIR_CETAK"><?= $Page->renderSort($Page->CETAK) ?></div></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_NO_REGISTRATION" class="V_KASIR_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <th data-name="VISIT_DATE" class="<?= $Page->VISIT_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_VISIT_DATE" class="V_KASIR_VISIT_DATE"><?= $Page->renderSort($Page->VISIT_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th data-name="CLINIC_ID" class="<?= $Page->CLINIC_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_CLINIC_ID" class="V_KASIR_CLINIC_ID"><?= $Page->renderSort($Page->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_GENDER" class="V_KASIR_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <th data-name="EMPLOYEE_ID" class="<?= $Page->EMPLOYEE_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_EMPLOYEE_ID" class="V_KASIR_EMPLOYEE_ID"><?= $Page->renderSort($Page->EMPLOYEE_ID) ?></div></th>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <th data-name="PAYOR_ID" class="<?= $Page->PAYOR_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_PAYOR_ID" class="V_KASIR_PAYOR_ID"><?= $Page->renderSort($Page->PAYOR_ID) ?></div></th>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
        <th data-name="CLASS_ID" class="<?= $Page->CLASS_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_CLASS_ID" class="V_KASIR_CLASS_ID"><?= $Page->renderSort($Page->CLASS_ID) ?></div></th>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <th data-name="PASIEN_ID" class="<?= $Page->PASIEN_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KASIR_PASIEN_ID" class="V_KASIR_PASIEN_ID"><?= $Page->renderSort($Page->PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <th data-name="tgl_kontrol" class="<?= $Page->tgl_kontrol->headerCellClass() ?>"><div id="elh_V_KASIR_tgl_kontrol" class="V_KASIR_tgl_kontrol"><?= $Page->renderSort($Page->tgl_kontrol) ?></div></th>
<?php } ?>
<?php if ($Page->idbooking->Visible) { // idbooking ?>
        <th data-name="idbooking" class="<?= $Page->idbooking->headerCellClass() ?>"><div id="elh_V_KASIR_idbooking" class="V_KASIR_idbooking"><?= $Page->renderSort($Page->idbooking) ?></div></th>
<?php } ?>
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
        <th data-name="id_tujuan" class="<?= $Page->id_tujuan->headerCellClass() ?>"><div id="elh_V_KASIR_id_tujuan" class="V_KASIR_id_tujuan"><?= $Page->renderSort($Page->id_tujuan) ?></div></th>
<?php } ?>
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
        <th data-name="id_penunjang" class="<?= $Page->id_penunjang->headerCellClass() ?>"><div id="elh_V_KASIR_id_penunjang" class="V_KASIR_id_penunjang"><?= $Page->renderSort($Page->id_penunjang) ?></div></th>
<?php } ?>
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <th data-name="id_pembiayaan" class="<?= $Page->id_pembiayaan->headerCellClass() ?>"><div id="elh_V_KASIR_id_pembiayaan" class="V_KASIR_id_pembiayaan"><?= $Page->renderSort($Page->id_pembiayaan) ?></div></th>
<?php } ?>
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
        <th data-name="id_procedure" class="<?= $Page->id_procedure->headerCellClass() ?>"><div id="elh_V_KASIR_id_procedure" class="V_KASIR_id_procedure"><?= $Page->renderSort($Page->id_procedure) ?></div></th>
<?php } ?>
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
        <th data-name="id_aspel" class="<?= $Page->id_aspel->headerCellClass() ?>"><div id="elh_V_KASIR_id_aspel" class="V_KASIR_id_aspel"><?= $Page->renderSort($Page->id_aspel) ?></div></th>
<?php } ?>
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
        <th data-name="id_kelas" class="<?= $Page->id_kelas->headerCellClass() ?>"><div id="elh_V_KASIR_id_kelas" class="V_KASIR_id_kelas"><?= $Page->renderSort($Page->id_kelas) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_V_KASIR", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->CETAK->Visible) { // CETAK ?>
        <td data-name="CETAK" <?= $Page->CETAK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_CETAK">
<span<?= $Page->CETAK->viewAttributes() ?>><script>

function Buka(link="") {
	window.open(link, 'newwindow', 'width=800,height=400');
	return false;
}
</script>
<div class="btn-group btn-group-sm ew-btn-group">
	<a class="btn bg-navy ew-row-link ew-detail" href="print.html"
	onclick="Buka('/simrs/reporting/nota_kwitansi_semua.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">NOTA</a>
	<button class="dropdown-toggle btn bg-navy ew-detail" data-toggle="dropdown" aria-expanded="false"></button>
	<ul class="dropdown-menu" style="">
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_rekap_total.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Rekap Total</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_rincian_tindakan.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Tindakan</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_pelayanan_kasir_ranap.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">CESMIX Ringkas</a>
		</li>
		<li class="divider" style="border-bottom:1px solid #ccc!important"></li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_rincian_inacbg.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">INACBG</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_rincian_inadrg.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">INADRG</a>
		</li>
	</ul>
</div>
<div class="btn-group btn-group-sm ew-btn-group">
	<a class="btn btn-primary ew-row-link ew-detail" href="print.html"
	onclick="Buka('/simrs/reporting/jasper.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">RESUME MEDIS</a>
	<button class="dropdown-toggle btn btn-primary ew-detail" data-toggle="dropdown" aria-expanded="false"></button>
	<ul class="dropdown-menu" style="">
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_keterangan_ranap.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Ket. Rawat Inap</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_keterangan_rajal.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Ket. Rawat Jalan</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_keterangan_pasien.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Ket. Pasien</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_keterangan_meninggal.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Ket. Meninggal</a>
		</li>
		<li class="divider" style="border-bottom:1px solid #ccc!important"></li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_kontrol.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Kontrol</a>
		</li>
	</ul>
</div>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <td data-name="VISIT_DATE" <?= $Page->VISIT_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_VISIT_DATE">
<span<?= $Page->VISIT_DATE->viewAttributes() ?>>
<?= $Page->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <td data-name="EMPLOYEE_ID" <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_EMPLOYEE_ID">
<span<?= $Page->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Page->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <td data-name="PAYOR_ID" <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_PAYOR_ID">
<span<?= $Page->PAYOR_ID->viewAttributes() ?>>
<?= $Page->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
        <td data-name="CLASS_ID" <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_CLASS_ID">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <td data-name="PASIEN_ID" <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_PASIEN_ID">
<span<?= $Page->PASIEN_ID->viewAttributes() ?>>
<?= $Page->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <td data-name="tgl_kontrol" <?= $Page->tgl_kontrol->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_tgl_kontrol">
<span<?= $Page->tgl_kontrol->viewAttributes() ?>>
<?= $Page->tgl_kontrol->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idbooking->Visible) { // idbooking ?>
        <td data-name="idbooking" <?= $Page->idbooking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_idbooking">
<span<?= $Page->idbooking->viewAttributes() ?>>
<?= $Page->idbooking->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
        <td data-name="id_tujuan" <?= $Page->id_tujuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_id_tujuan">
<span<?= $Page->id_tujuan->viewAttributes() ?>>
<?= $Page->id_tujuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
        <td data-name="id_penunjang" <?= $Page->id_penunjang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_id_penunjang">
<span<?= $Page->id_penunjang->viewAttributes() ?>>
<?= $Page->id_penunjang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <td data-name="id_pembiayaan" <?= $Page->id_pembiayaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_id_pembiayaan">
<span<?= $Page->id_pembiayaan->viewAttributes() ?>>
<?= $Page->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_procedure->Visible) { // id_procedure ?>
        <td data-name="id_procedure" <?= $Page->id_procedure->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_id_procedure">
<span<?= $Page->id_procedure->viewAttributes() ?>>
<?= $Page->id_procedure->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_aspel->Visible) { // id_aspel ?>
        <td data-name="id_aspel" <?= $Page->id_aspel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_id_aspel">
<span<?= $Page->id_aspel->viewAttributes() ?>>
<?= $Page->id_aspel->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_kelas->Visible) { // id_kelas ?>
        <td data-name="id_kelas" <?= $Page->id_kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KASIR_id_kelas">
<span<?= $Page->id_kelas->viewAttributes() ?>>
<?= $Page->id_kelas->getViewValue() ?></span>
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
    ew.addEventHandlers("V_KASIR");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
