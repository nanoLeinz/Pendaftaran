<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AgeList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fAGElist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fAGElist = currentForm = new ew.Form("fAGElist", "list");
    fAGElist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fAGElist");
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
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> AGE">
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
<form name="fAGElist" id="fAGElist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="AGE">
<div id="gmp_AGE" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_AGElist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->CAT->Visible) { // CAT ?>
        <th data-name="CAT" class="<?= $Page->CAT->headerCellClass() ?>"><div id="elh_AGE_CAT" class="AGE_CAT"><?= $Page->renderSort($Page->CAT) ?></div></th>
<?php } ?>
<?php if ($Page->GROUP_ID->Visible) { // GROUP_ID ?>
        <th data-name="GROUP_ID" class="<?= $Page->GROUP_ID->headerCellClass() ?>"><div id="elh_AGE_GROUP_ID" class="AGE_GROUP_ID"><?= $Page->renderSort($Page->GROUP_ID) ?></div></th>
<?php } ?>
<?php if ($Page->BAT_BAWAH->Visible) { // BAT_BAWAH ?>
        <th data-name="BAT_BAWAH" class="<?= $Page->BAT_BAWAH->headerCellClass() ?>"><div id="elh_AGE_BAT_BAWAH" class="AGE_BAT_BAWAH"><?= $Page->renderSort($Page->BAT_BAWAH) ?></div></th>
<?php } ?>
<?php if ($Page->BAT_ATAS->Visible) { // BAT_ATAS ?>
        <th data-name="BAT_ATAS" class="<?= $Page->BAT_ATAS->headerCellClass() ?>"><div id="elh_AGE_BAT_ATAS" class="AGE_BAT_ATAS"><?= $Page->renderSort($Page->BAT_ATAS) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_AGE", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->CAT->Visible) { // CAT ?>
        <td data-name="CAT" <?= $Page->CAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGE_CAT">
<span<?= $Page->CAT->viewAttributes() ?>>
<?= $Page->CAT->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->GROUP_ID->Visible) { // GROUP_ID ?>
        <td data-name="GROUP_ID" <?= $Page->GROUP_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGE_GROUP_ID">
<span<?= $Page->GROUP_ID->viewAttributes() ?>>
<?= $Page->GROUP_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->BAT_BAWAH->Visible) { // BAT_BAWAH ?>
        <td data-name="BAT_BAWAH" <?= $Page->BAT_BAWAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGE_BAT_BAWAH">
<span<?= $Page->BAT_BAWAH->viewAttributes() ?>>
<?= $Page->BAT_BAWAH->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->BAT_ATAS->Visible) { // BAT_ATAS ?>
        <td data-name="BAT_ATAS" <?= $Page->BAT_ATAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGE_BAT_ATAS">
<span<?= $Page->BAT_ATAS->viewAttributes() ?>>
<?= $Page->BAT_ATAS->getViewValue() ?></span>
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
    ew.addEventHandlers("AGE");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
