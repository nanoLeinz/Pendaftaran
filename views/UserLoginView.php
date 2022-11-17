<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$UserLoginView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fUSER_LOGINview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fUSER_LOGINview = currentForm = new ew.Form("fUSER_LOGINview", "view");
    loadjs.done("fUSER_LOGINview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.USER_LOGIN) ew.vars.tables.USER_LOGIN = <?= JsonEncode(GetClientVar("tables", "USER_LOGIN")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fUSER_LOGINview" id="fUSER_LOGINview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="USER_LOGIN">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <tr id="r_ORG_UNIT_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_USER_LOGIN_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></td>
        <td data-name="ORG_UNIT_CODE" <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_USER_LOGIN_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <tr id="r_EMPLOYEE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_USER_LOGIN_EMPLOYEE_ID"><?= $Page->EMPLOYEE_ID->caption() ?></span></td>
        <td data-name="EMPLOYEE_ID" <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_USER_LOGIN_EMPLOYEE_ID">
<span<?= $Page->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Page->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_USERNAME->Visible) { // USERNAME ?>
    <tr id="r__USERNAME">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_USER_LOGIN__USERNAME"><?= $Page->_USERNAME->caption() ?></span></td>
        <td data-name="_USERNAME" <?= $Page->_USERNAME->cellAttributes() ?>>
<span id="el_USER_LOGIN__USERNAME">
<span<?= $Page->_USERNAME->viewAttributes() ?>>
<?= $Page->_USERNAME->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
    <tr id="r_FULLNAME">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_USER_LOGIN_FULLNAME"><?= $Page->FULLNAME->caption() ?></span></td>
        <td data-name="FULLNAME" <?= $Page->FULLNAME->cellAttributes() ?>>
<span id="el_USER_LOGIN_FULLNAME">
<span<?= $Page->FULLNAME->viewAttributes() ?>>
<?= $Page->FULLNAME->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
    <tr id="r_MODIFIED_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_USER_LOGIN_MODIFIED_DATE"><?= $Page->MODIFIED_DATE->caption() ?></span></td>
        <td data-name="MODIFIED_DATE" <?= $Page->MODIFIED_DATE->cellAttributes() ?>>
<span id="el_USER_LOGIN_MODIFIED_DATE">
<span<?= $Page->MODIFIED_DATE->viewAttributes() ?>>
<?= $Page->MODIFIED_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
    <tr id="r_MODIFIED_BY">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_USER_LOGIN_MODIFIED_BY"><?= $Page->MODIFIED_BY->caption() ?></span></td>
        <td data-name="MODIFIED_BY" <?= $Page->MODIFIED_BY->cellAttributes() ?>>
<span id="el_USER_LOGIN_MODIFIED_BY">
<span<?= $Page->MODIFIED_BY->viewAttributes() ?>>
<?= $Page->MODIFIED_BY->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
    <tr id="r_MODIFIED_FROM">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_USER_LOGIN_MODIFIED_FROM"><?= $Page->MODIFIED_FROM->caption() ?></span></td>
        <td data-name="MODIFIED_FROM" <?= $Page->MODIFIED_FROM->cellAttributes() ?>>
<span id="el_USER_LOGIN_MODIFIED_FROM">
<span<?= $Page->MODIFIED_FROM->viewAttributes() ?>>
<?= $Page->MODIFIED_FROM->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->userlevelid->Visible) { // userlevelid ?>
    <tr id="r_userlevelid">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_USER_LOGIN_userlevelid"><?= $Page->userlevelid->caption() ?></span></td>
        <td data-name="userlevelid" <?= $Page->userlevelid->cellAttributes() ?>>
<span id="el_USER_LOGIN_userlevelid">
<span<?= $Page->userlevelid->viewAttributes() ?>>
<?= $Page->userlevelid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
