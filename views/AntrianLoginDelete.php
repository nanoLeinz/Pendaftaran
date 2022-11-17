<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AntrianLoginDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fANTRIAN_LOGINdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fANTRIAN_LOGINdelete = currentForm = new ew.Form("fANTRIAN_LOGINdelete", "delete");
    loadjs.done("fANTRIAN_LOGINdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.ANTRIAN_LOGIN) ew.vars.tables.ANTRIAN_LOGIN = <?= JsonEncode(GetClientVar("tables", "ANTRIAN_LOGIN")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fANTRIAN_LOGINdelete" id="fANTRIAN_LOGINdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ANTRIAN_LOGIN">
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
<?php if ($Page->ID->Visible) { // ID ?>
        <th class="<?= $Page->ID->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_ID" class="ANTRIAN_LOGIN_ID"><?= $Page->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NOMR->Visible) { // NOMR ?>
        <th class="<?= $Page->NOMR->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_NOMR" class="ANTRIAN_LOGIN_NOMR"><?= $Page->NOMR->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_BPJS->Visible) { // NO_BPJS ?>
        <th class="<?= $Page->NO_BPJS->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_NO_BPJS" class="ANTRIAN_LOGIN_NO_BPJS"><?= $Page->NO_BPJS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA->Visible) { // NAMA ?>
        <th class="<?= $Page->NAMA->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_NAMA" class="ANTRIAN_LOGIN_NAMA"><?= $Page->NAMA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TEMPAT_LAHIR->Visible) { // TEMPAT_LAHIR ?>
        <th class="<?= $Page->TEMPAT_LAHIR->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_TEMPAT_LAHIR" class="ANTRIAN_LOGIN_TEMPAT_LAHIR"><?= $Page->TEMPAT_LAHIR->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL_LAHIR->Visible) { // TANGGAL_LAHIR ?>
        <th class="<?= $Page->TANGGAL_LAHIR->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_TANGGAL_LAHIR" class="ANTRIAN_LOGIN_TANGGAL_LAHIR"><?= $Page->TANGGAL_LAHIR->caption() ?></span></th>
<?php } ?>
<?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
        <th class="<?= $Page->JENIS_KELAMIN->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_JENIS_KELAMIN" class="ANTRIAN_LOGIN_JENIS_KELAMIN"><?= $Page->JENIS_KELAMIN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->AGAMA->Visible) { // AGAMA ?>
        <th class="<?= $Page->AGAMA->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_AGAMA" class="ANTRIAN_LOGIN_AGAMA"><?= $Page->AGAMA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PEKERJAAN->Visible) { // PEKERJAAN ?>
        <th class="<?= $Page->PEKERJAAN->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_PEKERJAAN" class="ANTRIAN_LOGIN_PEKERJAAN"><?= $Page->PEKERJAAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <th class="<?= $Page->ALAMAT->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_ALAMAT" class="ANTRIAN_LOGIN_ALAMAT"><?= $Page->ALAMAT->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <th class="<?= $Page->NO_TELP->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_NO_TELP" class="ANTRIAN_LOGIN_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <th class="<?= $Page->NO_HP->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_NO_HP" class="ANTRIAN_LOGIN_NO_HP"><?= $Page->NO_HP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <th class="<?= $Page->_EMAIL->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN__EMAIL" class="ANTRIAN_LOGIN__EMAIL"><?= $Page->_EMAIL->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FOTO->Visible) { // FOTO ?>
        <th class="<?= $Page->FOTO->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_FOTO" class="ANTRIAN_LOGIN_FOTO"><?= $Page->FOTO->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL_REGIS->Visible) { // TANGGAL_REGIS ?>
        <th class="<?= $Page->TANGGAL_REGIS->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_TANGGAL_REGIS" class="ANTRIAN_LOGIN_TANGGAL_REGIS"><?= $Page->TANGGAL_REGIS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA_IBU->Visible) { // NAMA_IBU ?>
        <th class="<?= $Page->NAMA_IBU->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_NAMA_IBU" class="ANTRIAN_LOGIN_NAMA_IBU"><?= $Page->NAMA_IBU->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA_AYAH->Visible) { // NAMA_AYAH ?>
        <th class="<?= $Page->NAMA_AYAH->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_NAMA_AYAH" class="ANTRIAN_LOGIN_NAMA_AYAH"><?= $Page->NAMA_AYAH->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA_PASANGAN->Visible) { // NAMA_PASANGAN ?>
        <th class="<?= $Page->NAMA_PASANGAN->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN_NAMA_PASANGAN" class="ANTRIAN_LOGIN_NAMA_PASANGAN"><?= $Page->NAMA_PASANGAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_PASSWORD->Visible) { // PASSWORD ?>
        <th class="<?= $Page->_PASSWORD->headerCellClass() ?>"><span id="elh_ANTRIAN_LOGIN__PASSWORD" class="ANTRIAN_LOGIN__PASSWORD"><?= $Page->_PASSWORD->caption() ?></span></th>
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
<?php if ($Page->ID->Visible) { // ID ?>
        <td <?= $Page->ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_ID" class="ANTRIAN_LOGIN_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NOMR->Visible) { // NOMR ?>
        <td <?= $Page->NOMR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NOMR" class="ANTRIAN_LOGIN_NOMR">
<span<?= $Page->NOMR->viewAttributes() ?>>
<?= $Page->NOMR->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_BPJS->Visible) { // NO_BPJS ?>
        <td <?= $Page->NO_BPJS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NO_BPJS" class="ANTRIAN_LOGIN_NO_BPJS">
<span<?= $Page->NO_BPJS->viewAttributes() ?>>
<?= $Page->NO_BPJS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA->Visible) { // NAMA ?>
        <td <?= $Page->NAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NAMA" class="ANTRIAN_LOGIN_NAMA">
<span<?= $Page->NAMA->viewAttributes() ?>>
<?= $Page->NAMA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TEMPAT_LAHIR->Visible) { // TEMPAT_LAHIR ?>
        <td <?= $Page->TEMPAT_LAHIR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_TEMPAT_LAHIR" class="ANTRIAN_LOGIN_TEMPAT_LAHIR">
<span<?= $Page->TEMPAT_LAHIR->viewAttributes() ?>>
<?= $Page->TEMPAT_LAHIR->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL_LAHIR->Visible) { // TANGGAL_LAHIR ?>
        <td <?= $Page->TANGGAL_LAHIR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_TANGGAL_LAHIR" class="ANTRIAN_LOGIN_TANGGAL_LAHIR">
<span<?= $Page->TANGGAL_LAHIR->viewAttributes() ?>>
<?= $Page->TANGGAL_LAHIR->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
        <td <?= $Page->JENIS_KELAMIN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_JENIS_KELAMIN" class="ANTRIAN_LOGIN_JENIS_KELAMIN">
<span<?= $Page->JENIS_KELAMIN->viewAttributes() ?>>
<?= $Page->JENIS_KELAMIN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->AGAMA->Visible) { // AGAMA ?>
        <td <?= $Page->AGAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_AGAMA" class="ANTRIAN_LOGIN_AGAMA">
<span<?= $Page->AGAMA->viewAttributes() ?>>
<?= $Page->AGAMA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PEKERJAAN->Visible) { // PEKERJAAN ?>
        <td <?= $Page->PEKERJAAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_PEKERJAAN" class="ANTRIAN_LOGIN_PEKERJAAN">
<span<?= $Page->PEKERJAAN->viewAttributes() ?>>
<?= $Page->PEKERJAAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <td <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_ALAMAT" class="ANTRIAN_LOGIN_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <td <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NO_TELP" class="ANTRIAN_LOGIN_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <td <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NO_HP" class="ANTRIAN_LOGIN_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <td <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN__EMAIL" class="ANTRIAN_LOGIN__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FOTO->Visible) { // FOTO ?>
        <td <?= $Page->FOTO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_FOTO" class="ANTRIAN_LOGIN_FOTO">
<span<?= $Page->FOTO->viewAttributes() ?>>
<?= $Page->FOTO->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL_REGIS->Visible) { // TANGGAL_REGIS ?>
        <td <?= $Page->TANGGAL_REGIS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_TANGGAL_REGIS" class="ANTRIAN_LOGIN_TANGGAL_REGIS">
<span<?= $Page->TANGGAL_REGIS->viewAttributes() ?>>
<?= $Page->TANGGAL_REGIS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA_IBU->Visible) { // NAMA_IBU ?>
        <td <?= $Page->NAMA_IBU->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NAMA_IBU" class="ANTRIAN_LOGIN_NAMA_IBU">
<span<?= $Page->NAMA_IBU->viewAttributes() ?>>
<?= $Page->NAMA_IBU->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA_AYAH->Visible) { // NAMA_AYAH ?>
        <td <?= $Page->NAMA_AYAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NAMA_AYAH" class="ANTRIAN_LOGIN_NAMA_AYAH">
<span<?= $Page->NAMA_AYAH->viewAttributes() ?>>
<?= $Page->NAMA_AYAH->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA_PASANGAN->Visible) { // NAMA_PASANGAN ?>
        <td <?= $Page->NAMA_PASANGAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN_NAMA_PASANGAN" class="ANTRIAN_LOGIN_NAMA_PASANGAN">
<span<?= $Page->NAMA_PASANGAN->viewAttributes() ?>>
<?= $Page->NAMA_PASANGAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_PASSWORD->Visible) { // PASSWORD ?>
        <td <?= $Page->_PASSWORD->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_LOGIN__PASSWORD" class="ANTRIAN_LOGIN__PASSWORD">
<span<?= $Page->_PASSWORD->viewAttributes() ?>>
<?= $Page->_PASSWORD->getViewValue() ?></span>
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
