<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AntrianLoginList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fANTRIAN_LOGINlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fANTRIAN_LOGINlist = currentForm = new ew.Form("fANTRIAN_LOGINlist", "list");
    fANTRIAN_LOGINlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fANTRIAN_LOGINlist");
});
var fANTRIAN_LOGINlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fANTRIAN_LOGINlistsrch = currentSearchForm = new ew.Form("fANTRIAN_LOGINlistsrch");

    // Dynamic selection lists

    // Filters
    fANTRIAN_LOGINlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fANTRIAN_LOGINlistsrch");
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
<form name="fANTRIAN_LOGINlistsrch" id="fANTRIAN_LOGINlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fANTRIAN_LOGINlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ANTRIAN_LOGIN">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ANTRIAN_LOGIN">
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
<form name="fANTRIAN_LOGINlist" id="fANTRIAN_LOGINlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ANTRIAN_LOGIN">
<div id="gmp_ANTRIAN_LOGIN" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_ANTRIAN_LOGINlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->ID->Visible) { // ID ?>
        <th data-name="ID" class="<?= $Page->ID->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_ID" class="ANTRIAN_LOGIN_ID"><?= $Page->renderSort($Page->ID) ?></div></th>
<?php } ?>
<?php if ($Page->NOMR->Visible) { // NOMR ?>
        <th data-name="NOMR" class="<?= $Page->NOMR->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_NOMR" class="ANTRIAN_LOGIN_NOMR"><?= $Page->renderSort($Page->NOMR) ?></div></th>
<?php } ?>
<?php if ($Page->NO_BPJS->Visible) { // NO_BPJS ?>
        <th data-name="NO_BPJS" class="<?= $Page->NO_BPJS->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_NO_BPJS" class="ANTRIAN_LOGIN_NO_BPJS"><?= $Page->renderSort($Page->NO_BPJS) ?></div></th>
<?php } ?>
<?php if ($Page->NAMA->Visible) { // NAMA ?>
        <th data-name="NAMA" class="<?= $Page->NAMA->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_NAMA" class="ANTRIAN_LOGIN_NAMA"><?= $Page->renderSort($Page->NAMA) ?></div></th>
<?php } ?>
<?php if ($Page->TEMPAT_LAHIR->Visible) { // TEMPAT_LAHIR ?>
        <th data-name="TEMPAT_LAHIR" class="<?= $Page->TEMPAT_LAHIR->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_TEMPAT_LAHIR" class="ANTRIAN_LOGIN_TEMPAT_LAHIR"><?= $Page->renderSort($Page->TEMPAT_LAHIR) ?></div></th>
<?php } ?>
<?php if ($Page->TANGGAL_LAHIR->Visible) { // TANGGAL_LAHIR ?>
        <th data-name="TANGGAL_LAHIR" class="<?= $Page->TANGGAL_LAHIR->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_TANGGAL_LAHIR" class="ANTRIAN_LOGIN_TANGGAL_LAHIR"><?= $Page->renderSort($Page->TANGGAL_LAHIR) ?></div></th>
<?php } ?>
<?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
        <th data-name="JENIS_KELAMIN" class="<?= $Page->JENIS_KELAMIN->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_JENIS_KELAMIN" class="ANTRIAN_LOGIN_JENIS_KELAMIN"><?= $Page->renderSort($Page->JENIS_KELAMIN) ?></div></th>
<?php } ?>
<?php if ($Page->AGAMA->Visible) { // AGAMA ?>
        <th data-name="AGAMA" class="<?= $Page->AGAMA->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_AGAMA" class="ANTRIAN_LOGIN_AGAMA"><?= $Page->renderSort($Page->AGAMA) ?></div></th>
<?php } ?>
<?php if ($Page->PEKERJAAN->Visible) { // PEKERJAAN ?>
        <th data-name="PEKERJAAN" class="<?= $Page->PEKERJAAN->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_PEKERJAAN" class="ANTRIAN_LOGIN_PEKERJAAN"><?= $Page->renderSort($Page->PEKERJAAN) ?></div></th>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <th data-name="ALAMAT" class="<?= $Page->ALAMAT->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_ALAMAT" class="ANTRIAN_LOGIN_ALAMAT"><?= $Page->renderSort($Page->ALAMAT) ?></div></th>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <th data-name="NO_TELP" class="<?= $Page->NO_TELP->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_NO_TELP" class="ANTRIAN_LOGIN_NO_TELP"><?= $Page->renderSort($Page->NO_TELP) ?></div></th>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <th data-name="NO_HP" class="<?= $Page->NO_HP->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_NO_HP" class="ANTRIAN_LOGIN_NO_HP"><?= $Page->renderSort($Page->NO_HP) ?></div></th>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <th data-name="_EMAIL" class="<?= $Page->_EMAIL->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN__EMAIL" class="ANTRIAN_LOGIN__EMAIL"><?= $Page->renderSort($Page->_EMAIL) ?></div></th>
<?php } ?>
<?php if ($Page->FOTO->Visible) { // FOTO ?>
        <th data-name="FOTO" class="<?= $Page->FOTO->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_FOTO" class="ANTRIAN_LOGIN_FOTO"><?= $Page->renderSort($Page->FOTO) ?></div></th>
<?php } ?>
<?php if ($Page->TANGGAL_REGIS->Visible) { // TANGGAL_REGIS ?>
        <th data-name="TANGGAL_REGIS" class="<?= $Page->TANGGAL_REGIS->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_TANGGAL_REGIS" class="ANTRIAN_LOGIN_TANGGAL_REGIS"><?= $Page->renderSort($Page->TANGGAL_REGIS) ?></div></th>
<?php } ?>
<?php if ($Page->NAMA_IBU->Visible) { // NAMA_IBU ?>
        <th data-name="NAMA_IBU" class="<?= $Page->NAMA_IBU->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_NAMA_IBU" class="ANTRIAN_LOGIN_NAMA_IBU"><?= $Page->renderSort($Page->NAMA_IBU) ?></div></th>
<?php } ?>
<?php if ($Page->NAMA_AYAH->Visible) { // NAMA_AYAH ?>
        <th data-name="NAMA_AYAH" class="<?= $Page->NAMA_AYAH->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_NAMA_AYAH" class="ANTRIAN_LOGIN_NAMA_AYAH"><?= $Page->renderSort($Page->NAMA_AYAH) ?></div></th>
<?php } ?>
<?php if ($Page->NAMA_PASANGAN->Visible) { // NAMA_PASANGAN ?>
        <th data-name="NAMA_PASANGAN" class="<?= $Page->NAMA_PASANGAN->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN_NAMA_PASANGAN" class="ANTRIAN_LOGIN_NAMA_PASANGAN"><?= $Page->renderSort($Page->NAMA_PASANGAN) ?></div></th>
<?php } ?>
<?php if ($Page->_PASSWORD->Visible) { // PASSWORD ?>
        <th data-name="_PASSWORD" class="<?= $Page->_PASSWORD->headerCellClass() ?>"><div id="elh_ANTRIAN_LOGIN__PASSWORD" class="ANTRIAN_LOGIN__PASSWORD"><?= $Page->renderSort($Page->_PASSWORD) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_ANTRIAN_LOGIN", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->ID->Visible) { // ID ?>
        <td data-name="ID" <?= $Page->ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NOMR->Visible) { // NOMR ?>
        <td data-name="NOMR" <?= $Page->NOMR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NOMR">
<span<?= $Page->NOMR->viewAttributes() ?>>
<?= $Page->NOMR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_BPJS->Visible) { // NO_BPJS ?>
        <td data-name="NO_BPJS" <?= $Page->NO_BPJS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NO_BPJS">
<span<?= $Page->NO_BPJS->viewAttributes() ?>>
<?= $Page->NO_BPJS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAMA->Visible) { // NAMA ?>
        <td data-name="NAMA" <?= $Page->NAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NAMA">
<span<?= $Page->NAMA->viewAttributes() ?>>
<?= $Page->NAMA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TEMPAT_LAHIR->Visible) { // TEMPAT_LAHIR ?>
        <td data-name="TEMPAT_LAHIR" <?= $Page->TEMPAT_LAHIR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_TEMPAT_LAHIR">
<span<?= $Page->TEMPAT_LAHIR->viewAttributes() ?>>
<?= $Page->TEMPAT_LAHIR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TANGGAL_LAHIR->Visible) { // TANGGAL_LAHIR ?>
        <td data-name="TANGGAL_LAHIR" <?= $Page->TANGGAL_LAHIR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_TANGGAL_LAHIR">
<span<?= $Page->TANGGAL_LAHIR->viewAttributes() ?>>
<?= $Page->TANGGAL_LAHIR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
        <td data-name="JENIS_KELAMIN" <?= $Page->JENIS_KELAMIN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_JENIS_KELAMIN">
<span<?= $Page->JENIS_KELAMIN->viewAttributes() ?>>
<?= $Page->JENIS_KELAMIN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->AGAMA->Visible) { // AGAMA ?>
        <td data-name="AGAMA" <?= $Page->AGAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_AGAMA">
<span<?= $Page->AGAMA->viewAttributes() ?>>
<?= $Page->AGAMA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PEKERJAAN->Visible) { // PEKERJAAN ?>
        <td data-name="PEKERJAAN" <?= $Page->PEKERJAAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_PEKERJAAN">
<span<?= $Page->PEKERJAAN->viewAttributes() ?>>
<?= $Page->PEKERJAAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <td data-name="ALAMAT" <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <td data-name="NO_TELP" <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <td data-name="NO_HP" <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <td data-name="_EMAIL" <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->FOTO->Visible) { // FOTO ?>
        <td data-name="FOTO" <?= $Page->FOTO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_FOTO">
<span<?= $Page->FOTO->viewAttributes() ?>>
<?= $Page->FOTO->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TANGGAL_REGIS->Visible) { // TANGGAL_REGIS ?>
        <td data-name="TANGGAL_REGIS" <?= $Page->TANGGAL_REGIS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_TANGGAL_REGIS">
<span<?= $Page->TANGGAL_REGIS->viewAttributes() ?>>
<?= $Page->TANGGAL_REGIS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAMA_IBU->Visible) { // NAMA_IBU ?>
        <td data-name="NAMA_IBU" <?= $Page->NAMA_IBU->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NAMA_IBU">
<span<?= $Page->NAMA_IBU->viewAttributes() ?>>
<?= $Page->NAMA_IBU->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAMA_AYAH->Visible) { // NAMA_AYAH ?>
        <td data-name="NAMA_AYAH" <?= $Page->NAMA_AYAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NAMA_AYAH">
<span<?= $Page->NAMA_AYAH->viewAttributes() ?>>
<?= $Page->NAMA_AYAH->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAMA_PASANGAN->Visible) { // NAMA_PASANGAN ?>
        <td data-name="NAMA_PASANGAN" <?= $Page->NAMA_PASANGAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NAMA_PASANGAN">
<span<?= $Page->NAMA_PASANGAN->viewAttributes() ?>>
<?= $Page->NAMA_PASANGAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_PASSWORD->Visible) { // PASSWORD ?>
        <td data-name="_PASSWORD" <?= $Page->_PASSWORD->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN__PASSWORD">
<span<?= $Page->_PASSWORD->viewAttributes() ?>>
<?= $Page->_PASSWORD->getViewValue() ?></span>
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
    ew.addEventHandlers("ANTRIAN_LOGIN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
