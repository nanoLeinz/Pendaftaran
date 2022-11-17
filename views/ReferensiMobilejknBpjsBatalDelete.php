<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ReferensiMobilejknBpjsBatalDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var freferensi_mobilejkn_bpjs_bataldelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    freferensi_mobilejkn_bpjs_bataldelete = currentForm = new ew.Form("freferensi_mobilejkn_bpjs_bataldelete", "delete");
    loadjs.done("freferensi_mobilejkn_bpjs_bataldelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.referensi_mobilejkn_bpjs_batal) ew.vars.tables.referensi_mobilejkn_bpjs_batal = <?= JsonEncode(GetClientVar("tables", "referensi_mobilejkn_bpjs_batal")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="freferensi_mobilejkn_bpjs_bataldelete" id="freferensi_mobilejkn_bpjs_bataldelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs_batal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_no_rkm_medis" class="referensi_mobilejkn_bpjs_batal_no_rkm_medis"><?= $Page->no_rkm_medis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
        <th class="<?= $Page->nomorreferensi->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_nomorreferensi" class="referensi_mobilejkn_bpjs_batal_nomorreferensi"><?= $Page->nomorreferensi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggalbatal->Visible) { // tanggalbatal ?>
        <th class="<?= $Page->tanggalbatal->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_tanggalbatal" class="referensi_mobilejkn_bpjs_batal_tanggalbatal"><?= $Page->tanggalbatal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_keterangan" class="referensi_mobilejkn_bpjs_batal_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
        <th class="<?= $Page->statuskirim->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_statuskirim" class="referensi_mobilejkn_bpjs_batal_statuskirim"><?= $Page->statuskirim->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
        <th class="<?= $Page->nobooking->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_nobooking" class="referensi_mobilejkn_bpjs_batal_nobooking"><?= $Page->nobooking->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_no_rkm_medis" class="referensi_mobilejkn_bpjs_batal_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
        <td <?= $Page->nomorreferensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_nomorreferensi" class="referensi_mobilejkn_bpjs_batal_nomorreferensi">
<span<?= $Page->nomorreferensi->viewAttributes() ?>>
<?= $Page->nomorreferensi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggalbatal->Visible) { // tanggalbatal ?>
        <td <?= $Page->tanggalbatal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_tanggalbatal" class="referensi_mobilejkn_bpjs_batal_tanggalbatal">
<span<?= $Page->tanggalbatal->viewAttributes() ?>>
<?= $Page->tanggalbatal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td <?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_keterangan" class="referensi_mobilejkn_bpjs_batal_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
        <td <?= $Page->statuskirim->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_statuskirim" class="referensi_mobilejkn_bpjs_batal_statuskirim">
<span<?= $Page->statuskirim->viewAttributes() ?>>
<?= $Page->statuskirim->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
        <td <?= $Page->nobooking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_nobooking" class="referensi_mobilejkn_bpjs_batal_nobooking">
<span<?= $Page->nobooking->viewAttributes() ?>>
<?= $Page->nobooking->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
