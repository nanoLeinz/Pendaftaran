<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ReferensiMobilejknBpjsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var freferensi_mobilejkn_bpjsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    freferensi_mobilejkn_bpjsdelete = currentForm = new ew.Form("freferensi_mobilejkn_bpjsdelete", "delete");
    loadjs.done("freferensi_mobilejkn_bpjsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.referensi_mobilejkn_bpjs) ew.vars.tables.referensi_mobilejkn_bpjs = <?= JsonEncode(GetClientVar("tables", "referensi_mobilejkn_bpjs")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="freferensi_mobilejkn_bpjsdelete" id="freferensi_mobilejkn_bpjsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_id" class="referensi_mobilejkn_bpjs_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
        <th class="<?= $Page->nobooking->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_nobooking" class="referensi_mobilejkn_bpjs_nobooking"><?= $Page->nobooking->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_no_rawat" class="referensi_mobilejkn_bpjs_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nomorkartu->Visible) { // nomorkartu ?>
        <th class="<?= $Page->nomorkartu->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_nomorkartu" class="referensi_mobilejkn_bpjs_nomorkartu"><?= $Page->nomorkartu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_nik" class="referensi_mobilejkn_bpjs_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nohp->Visible) { // nohp ?>
        <th class="<?= $Page->nohp->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_nohp" class="referensi_mobilejkn_bpjs_nohp"><?= $Page->nohp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kodepoli->Visible) { // kodepoli ?>
        <th class="<?= $Page->kodepoli->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_kodepoli" class="referensi_mobilejkn_bpjs_kodepoli"><?= $Page->kodepoli->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pasienbaru->Visible) { // pasienbaru ?>
        <th class="<?= $Page->pasienbaru->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_pasienbaru" class="referensi_mobilejkn_bpjs_pasienbaru"><?= $Page->pasienbaru->caption() ?></span></th>
<?php } ?>
<?php if ($Page->norm->Visible) { // norm ?>
        <th class="<?= $Page->norm->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_norm" class="referensi_mobilejkn_bpjs_norm"><?= $Page->norm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggalperiksa->Visible) { // tanggalperiksa ?>
        <th class="<?= $Page->tanggalperiksa->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_tanggalperiksa" class="referensi_mobilejkn_bpjs_tanggalperiksa"><?= $Page->tanggalperiksa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kodedokter->Visible) { // kodedokter ?>
        <th class="<?= $Page->kodedokter->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_kodedokter" class="referensi_mobilejkn_bpjs_kodedokter"><?= $Page->kodedokter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jampraktek->Visible) { // jampraktek ?>
        <th class="<?= $Page->jampraktek->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_jampraktek" class="referensi_mobilejkn_bpjs_jampraktek"><?= $Page->jampraktek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jeniskunjungan->Visible) { // jeniskunjungan ?>
        <th class="<?= $Page->jeniskunjungan->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_jeniskunjungan" class="referensi_mobilejkn_bpjs_jeniskunjungan"><?= $Page->jeniskunjungan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
        <th class="<?= $Page->nomorreferensi->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_nomorreferensi" class="referensi_mobilejkn_bpjs_nomorreferensi"><?= $Page->nomorreferensi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nomorantrean->Visible) { // nomorantrean ?>
        <th class="<?= $Page->nomorantrean->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_nomorantrean" class="referensi_mobilejkn_bpjs_nomorantrean"><?= $Page->nomorantrean->caption() ?></span></th>
<?php } ?>
<?php if ($Page->angkaantrean->Visible) { // angkaantrean ?>
        <th class="<?= $Page->angkaantrean->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_angkaantrean" class="referensi_mobilejkn_bpjs_angkaantrean"><?= $Page->angkaantrean->caption() ?></span></th>
<?php } ?>
<?php if ($Page->estimasidilayani->Visible) { // estimasidilayani ?>
        <th class="<?= $Page->estimasidilayani->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_estimasidilayani" class="referensi_mobilejkn_bpjs_estimasidilayani"><?= $Page->estimasidilayani->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sisakuotajkn->Visible) { // sisakuotajkn ?>
        <th class="<?= $Page->sisakuotajkn->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_sisakuotajkn" class="referensi_mobilejkn_bpjs_sisakuotajkn"><?= $Page->sisakuotajkn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kuotajkn->Visible) { // kuotajkn ?>
        <th class="<?= $Page->kuotajkn->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_kuotajkn" class="referensi_mobilejkn_bpjs_kuotajkn"><?= $Page->kuotajkn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sisakuotanonjkn->Visible) { // sisakuotanonjkn ?>
        <th class="<?= $Page->sisakuotanonjkn->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_sisakuotanonjkn" class="referensi_mobilejkn_bpjs_sisakuotanonjkn"><?= $Page->sisakuotanonjkn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kuotanonjkn->Visible) { // kuotanonjkn ?>
        <th class="<?= $Page->kuotanonjkn->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_kuotanonjkn" class="referensi_mobilejkn_bpjs_kuotanonjkn"><?= $Page->kuotanonjkn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_status" class="referensi_mobilejkn_bpjs_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->validasi->Visible) { // validasi ?>
        <th class="<?= $Page->validasi->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_validasi" class="referensi_mobilejkn_bpjs_validasi"><?= $Page->validasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
        <th class="<?= $Page->statuskirim->headerCellClass() ?>"><span id="elh_referensi_mobilejkn_bpjs_statuskirim" class="referensi_mobilejkn_bpjs_statuskirim"><?= $Page->statuskirim->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_id" class="referensi_mobilejkn_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
        <td <?= $Page->nobooking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nobooking" class="referensi_mobilejkn_bpjs_nobooking">
<span<?= $Page->nobooking->viewAttributes() ?>>
<?= $Page->nobooking->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_no_rawat" class="referensi_mobilejkn_bpjs_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nomorkartu->Visible) { // nomorkartu ?>
        <td <?= $Page->nomorkartu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nomorkartu" class="referensi_mobilejkn_bpjs_nomorkartu">
<span<?= $Page->nomorkartu->viewAttributes() ?>>
<?= $Page->nomorkartu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <td <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nik" class="referensi_mobilejkn_bpjs_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nohp->Visible) { // nohp ?>
        <td <?= $Page->nohp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nohp" class="referensi_mobilejkn_bpjs_nohp">
<span<?= $Page->nohp->viewAttributes() ?>>
<?= $Page->nohp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kodepoli->Visible) { // kodepoli ?>
        <td <?= $Page->kodepoli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_kodepoli" class="referensi_mobilejkn_bpjs_kodepoli">
<span<?= $Page->kodepoli->viewAttributes() ?>>
<?= $Page->kodepoli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pasienbaru->Visible) { // pasienbaru ?>
        <td <?= $Page->pasienbaru->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_pasienbaru" class="referensi_mobilejkn_bpjs_pasienbaru">
<span<?= $Page->pasienbaru->viewAttributes() ?>>
<?= $Page->pasienbaru->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->norm->Visible) { // norm ?>
        <td <?= $Page->norm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_norm" class="referensi_mobilejkn_bpjs_norm">
<span<?= $Page->norm->viewAttributes() ?>>
<?= $Page->norm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggalperiksa->Visible) { // tanggalperiksa ?>
        <td <?= $Page->tanggalperiksa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_tanggalperiksa" class="referensi_mobilejkn_bpjs_tanggalperiksa">
<span<?= $Page->tanggalperiksa->viewAttributes() ?>>
<?= $Page->tanggalperiksa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kodedokter->Visible) { // kodedokter ?>
        <td <?= $Page->kodedokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_kodedokter" class="referensi_mobilejkn_bpjs_kodedokter">
<span<?= $Page->kodedokter->viewAttributes() ?>>
<?= $Page->kodedokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jampraktek->Visible) { // jampraktek ?>
        <td <?= $Page->jampraktek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_jampraktek" class="referensi_mobilejkn_bpjs_jampraktek">
<span<?= $Page->jampraktek->viewAttributes() ?>>
<?= $Page->jampraktek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jeniskunjungan->Visible) { // jeniskunjungan ?>
        <td <?= $Page->jeniskunjungan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_jeniskunjungan" class="referensi_mobilejkn_bpjs_jeniskunjungan">
<span<?= $Page->jeniskunjungan->viewAttributes() ?>>
<?= $Page->jeniskunjungan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
        <td <?= $Page->nomorreferensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nomorreferensi" class="referensi_mobilejkn_bpjs_nomorreferensi">
<span<?= $Page->nomorreferensi->viewAttributes() ?>>
<?= $Page->nomorreferensi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nomorantrean->Visible) { // nomorantrean ?>
        <td <?= $Page->nomorantrean->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nomorantrean" class="referensi_mobilejkn_bpjs_nomorantrean">
<span<?= $Page->nomorantrean->viewAttributes() ?>>
<?= $Page->nomorantrean->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->angkaantrean->Visible) { // angkaantrean ?>
        <td <?= $Page->angkaantrean->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_angkaantrean" class="referensi_mobilejkn_bpjs_angkaantrean">
<span<?= $Page->angkaantrean->viewAttributes() ?>>
<?= $Page->angkaantrean->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->estimasidilayani->Visible) { // estimasidilayani ?>
        <td <?= $Page->estimasidilayani->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_estimasidilayani" class="referensi_mobilejkn_bpjs_estimasidilayani">
<span<?= $Page->estimasidilayani->viewAttributes() ?>>
<?= $Page->estimasidilayani->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sisakuotajkn->Visible) { // sisakuotajkn ?>
        <td <?= $Page->sisakuotajkn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_sisakuotajkn" class="referensi_mobilejkn_bpjs_sisakuotajkn">
<span<?= $Page->sisakuotajkn->viewAttributes() ?>>
<?= $Page->sisakuotajkn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kuotajkn->Visible) { // kuotajkn ?>
        <td <?= $Page->kuotajkn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_kuotajkn" class="referensi_mobilejkn_bpjs_kuotajkn">
<span<?= $Page->kuotajkn->viewAttributes() ?>>
<?= $Page->kuotajkn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sisakuotanonjkn->Visible) { // sisakuotanonjkn ?>
        <td <?= $Page->sisakuotanonjkn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_sisakuotanonjkn" class="referensi_mobilejkn_bpjs_sisakuotanonjkn">
<span<?= $Page->sisakuotanonjkn->viewAttributes() ?>>
<?= $Page->sisakuotanonjkn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kuotanonjkn->Visible) { // kuotanonjkn ?>
        <td <?= $Page->kuotanonjkn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_kuotanonjkn" class="referensi_mobilejkn_bpjs_kuotanonjkn">
<span<?= $Page->kuotanonjkn->viewAttributes() ?>>
<?= $Page->kuotanonjkn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_status" class="referensi_mobilejkn_bpjs_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->validasi->Visible) { // validasi ?>
        <td <?= $Page->validasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_validasi" class="referensi_mobilejkn_bpjs_validasi">
<span<?= $Page->validasi->viewAttributes() ?>>
<?= $Page->validasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
        <td <?= $Page->statuskirim->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_statuskirim" class="referensi_mobilejkn_bpjs_statuskirim">
<span<?= $Page->statuskirim->viewAttributes() ?>>
<?= $Page->statuskirim->getViewValue() ?></span>
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
