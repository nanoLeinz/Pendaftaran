<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MJadwalAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_jadwaladd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fm_jadwaladd = currentForm = new ew.Form("fm_jadwaladd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "m_jadwal")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.m_jadwal)
        ew.vars.tables.m_jadwal = currentTable;
    fm_jadwaladd.addFields([
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["hari_kerja", [fields.hari_kerja.visible && fields.hari_kerja.required ? ew.Validators.required(fields.hari_kerja.caption) : null], fields.hari_kerja.isInvalid],
        ["jam_mulai", [fields.jam_mulai.visible && fields.jam_mulai.required ? ew.Validators.required(fields.jam_mulai.caption) : null, ew.Validators.time], fields.jam_mulai.isInvalid],
        ["jam_selesai", [fields.jam_selesai.visible && fields.jam_selesai.required ? ew.Validators.required(fields.jam_selesai.caption) : null, ew.Validators.time], fields.jam_selesai.isInvalid],
        ["kd_poli", [fields.kd_poli.visible && fields.kd_poli.required ? ew.Validators.required(fields.kd_poli.caption) : null], fields.kd_poli.isInvalid],
        ["kouta", [fields.kouta.visible && fields.kouta.required ? ew.Validators.required(fields.kouta.caption) : null, ew.Validators.integer], fields.kouta.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fm_jadwaladd,
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
    fm_jadwaladd.validate = function () {
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

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fm_jadwaladd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_jadwaladd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fm_jadwaladd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fm_jadwaladd" id="fm_jadwaladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_jadwal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <div id="r_kd_dokter" class="form-group row">
        <label id="elh_m_jadwal_kd_dokter" for="x_kd_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_dokter->caption() ?><?= $Page->kd_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_m_jadwal_kd_dokter">
<input type="<?= $Page->kd_dokter->getInputTextType() ?>" data-table="m_jadwal" data-field="x_kd_dokter" name="x_kd_dokter" id="x_kd_dokter" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kd_dokter->getPlaceHolder()) ?>" value="<?= $Page->kd_dokter->EditValue ?>"<?= $Page->kd_dokter->editAttributes() ?> aria-describedby="x_kd_dokter_help">
<?= $Page->kd_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_dokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hari_kerja->Visible) { // hari_kerja ?>
    <div id="r_hari_kerja" class="form-group row">
        <label id="elh_m_jadwal_hari_kerja" for="x_hari_kerja" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hari_kerja->caption() ?><?= $Page->hari_kerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hari_kerja->cellAttributes() ?>>
<span id="el_m_jadwal_hari_kerja">
<input type="<?= $Page->hari_kerja->getInputTextType() ?>" data-table="m_jadwal" data-field="x_hari_kerja" name="x_hari_kerja" id="x_hari_kerja" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->hari_kerja->getPlaceHolder()) ?>" value="<?= $Page->hari_kerja->EditValue ?>"<?= $Page->hari_kerja->editAttributes() ?> aria-describedby="x_hari_kerja_help">
<?= $Page->hari_kerja->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hari_kerja->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
    <div id="r_jam_mulai" class="form-group row">
        <label id="elh_m_jadwal_jam_mulai" for="x_jam_mulai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_mulai->caption() ?><?= $Page->jam_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_mulai->cellAttributes() ?>>
<span id="el_m_jadwal_jam_mulai">
<input type="<?= $Page->jam_mulai->getInputTextType() ?>" data-table="m_jadwal" data-field="x_jam_mulai" name="x_jam_mulai" id="x_jam_mulai" placeholder="<?= HtmlEncode($Page->jam_mulai->getPlaceHolder()) ?>" value="<?= $Page->jam_mulai->EditValue ?>"<?= $Page->jam_mulai->editAttributes() ?> aria-describedby="x_jam_mulai_help">
<?= $Page->jam_mulai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_mulai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
    <div id="r_jam_selesai" class="form-group row">
        <label id="elh_m_jadwal_jam_selesai" for="x_jam_selesai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_selesai->caption() ?><?= $Page->jam_selesai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_selesai->cellAttributes() ?>>
<span id="el_m_jadwal_jam_selesai">
<input type="<?= $Page->jam_selesai->getInputTextType() ?>" data-table="m_jadwal" data-field="x_jam_selesai" name="x_jam_selesai" id="x_jam_selesai" placeholder="<?= HtmlEncode($Page->jam_selesai->getPlaceHolder()) ?>" value="<?= $Page->jam_selesai->EditValue ?>"<?= $Page->jam_selesai->editAttributes() ?> aria-describedby="x_jam_selesai_help">
<?= $Page->jam_selesai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_selesai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <div id="r_kd_poli" class="form-group row">
        <label id="elh_m_jadwal_kd_poli" for="x_kd_poli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_poli->caption() ?><?= $Page->kd_poli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_m_jadwal_kd_poli">
<input type="<?= $Page->kd_poli->getInputTextType() ?>" data-table="m_jadwal" data-field="x_kd_poli" name="x_kd_poli" id="x_kd_poli" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kd_poli->getPlaceHolder()) ?>" value="<?= $Page->kd_poli->EditValue ?>"<?= $Page->kd_poli->editAttributes() ?> aria-describedby="x_kd_poli_help">
<?= $Page->kd_poli->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_poli->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kouta->Visible) { // kouta ?>
    <div id="r_kouta" class="form-group row">
        <label id="elh_m_jadwal_kouta" for="x_kouta" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kouta->caption() ?><?= $Page->kouta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kouta->cellAttributes() ?>>
<span id="el_m_jadwal_kouta">
<input type="<?= $Page->kouta->getInputTextType() ?>" data-table="m_jadwal" data-field="x_kouta" name="x_kouta" id="x_kouta" size="30" placeholder="<?= HtmlEncode($Page->kouta->getPlaceHolder()) ?>" value="<?= $Page->kouta->EditValue ?>"<?= $Page->kouta->editAttributes() ?> aria-describedby="x_kouta_help">
<?= $Page->kouta->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kouta->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("m_jadwal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
