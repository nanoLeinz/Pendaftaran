<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // AGAMA
    $app->any('/AgamaList[/{KODE_AGAMA}]', AgamaController::class . ':list')->add(PermissionMiddleware::class)->setName('AgamaList-AGAMA-list'); // list
    $app->any('/AgamaAdd[/{KODE_AGAMA}]', AgamaController::class . ':add')->add(PermissionMiddleware::class)->setName('AgamaAdd-AGAMA-add'); // add
    $app->any('/AgamaView[/{KODE_AGAMA}]', AgamaController::class . ':view')->add(PermissionMiddleware::class)->setName('AgamaView-AGAMA-view'); // view
    $app->any('/AgamaEdit[/{KODE_AGAMA}]', AgamaController::class . ':edit')->add(PermissionMiddleware::class)->setName('AgamaEdit-AGAMA-edit'); // edit
    $app->any('/AgamaDelete[/{KODE_AGAMA}]', AgamaController::class . ':delete')->add(PermissionMiddleware::class)->setName('AgamaDelete-AGAMA-delete'); // delete
    $app->group(
        '/AGAMA',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{KODE_AGAMA}]', AgamaController::class . ':list')->add(PermissionMiddleware::class)->setName('AGAMA/list-AGAMA-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{KODE_AGAMA}]', AgamaController::class . ':add')->add(PermissionMiddleware::class)->setName('AGAMA/add-AGAMA-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{KODE_AGAMA}]', AgamaController::class . ':view')->add(PermissionMiddleware::class)->setName('AGAMA/view-AGAMA-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{KODE_AGAMA}]', AgamaController::class . ':edit')->add(PermissionMiddleware::class)->setName('AGAMA/edit-AGAMA-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{KODE_AGAMA}]', AgamaController::class . ':delete')->add(PermissionMiddleware::class)->setName('AGAMA/delete-AGAMA-delete-2'); // delete
        }
    );

    // AGE
    $app->any('/AgeList[/{CAT}/{GROUP_ID}]', AgeController::class . ':list')->add(PermissionMiddleware::class)->setName('AgeList-AGE-list'); // list
    $app->any('/AgeAdd[/{CAT}/{GROUP_ID}]', AgeController::class . ':add')->add(PermissionMiddleware::class)->setName('AgeAdd-AGE-add'); // add
    $app->any('/AgeView[/{CAT}/{GROUP_ID}]', AgeController::class . ':view')->add(PermissionMiddleware::class)->setName('AgeView-AGE-view'); // view
    $app->any('/AgeEdit[/{CAT}/{GROUP_ID}]', AgeController::class . ':edit')->add(PermissionMiddleware::class)->setName('AgeEdit-AGE-edit'); // edit
    $app->any('/AgeDelete[/{CAT}/{GROUP_ID}]', AgeController::class . ':delete')->add(PermissionMiddleware::class)->setName('AgeDelete-AGE-delete'); // delete
    $app->group(
        '/AGE',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{CAT}/{GROUP_ID}]', AgeController::class . ':list')->add(PermissionMiddleware::class)->setName('AGE/list-AGE-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{CAT}/{GROUP_ID}]', AgeController::class . ':add')->add(PermissionMiddleware::class)->setName('AGE/add-AGE-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{CAT}/{GROUP_ID}]', AgeController::class . ':view')->add(PermissionMiddleware::class)->setName('AGE/view-AGE-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{CAT}/{GROUP_ID}]', AgeController::class . ':edit')->add(PermissionMiddleware::class)->setName('AGE/edit-AGE-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{CAT}/{GROUP_ID}]', AgeController::class . ':delete')->add(PermissionMiddleware::class)->setName('AGE/delete-AGE-delete-2'); // delete
        }
    );

    // ANTRIAN_PENDAFTARAN
    $app->any('/AntrianPendaftaranList[/{Id}]', AntrianPendaftaranController::class . ':list')->add(PermissionMiddleware::class)->setName('AntrianPendaftaranList-ANTRIAN_PENDAFTARAN-list'); // list
    $app->any('/AntrianPendaftaranAdd[/{Id}]', AntrianPendaftaranController::class . ':add')->add(PermissionMiddleware::class)->setName('AntrianPendaftaranAdd-ANTRIAN_PENDAFTARAN-add'); // add
    $app->any('/AntrianPendaftaranView[/{Id}]', AntrianPendaftaranController::class . ':view')->add(PermissionMiddleware::class)->setName('AntrianPendaftaranView-ANTRIAN_PENDAFTARAN-view'); // view
    $app->any('/AntrianPendaftaranEdit[/{Id}]', AntrianPendaftaranController::class . ':edit')->add(PermissionMiddleware::class)->setName('AntrianPendaftaranEdit-ANTRIAN_PENDAFTARAN-edit'); // edit
    $app->any('/AntrianPendaftaranDelete[/{Id}]', AntrianPendaftaranController::class . ':delete')->add(PermissionMiddleware::class)->setName('AntrianPendaftaranDelete-ANTRIAN_PENDAFTARAN-delete'); // delete
    $app->group(
        '/ANTRIAN_PENDAFTARAN',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Id}]', AntrianPendaftaranController::class . ':list')->add(PermissionMiddleware::class)->setName('ANTRIAN_PENDAFTARAN/list-ANTRIAN_PENDAFTARAN-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Id}]', AntrianPendaftaranController::class . ':add')->add(PermissionMiddleware::class)->setName('ANTRIAN_PENDAFTARAN/add-ANTRIAN_PENDAFTARAN-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Id}]', AntrianPendaftaranController::class . ':view')->add(PermissionMiddleware::class)->setName('ANTRIAN_PENDAFTARAN/view-ANTRIAN_PENDAFTARAN-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Id}]', AntrianPendaftaranController::class . ':edit')->add(PermissionMiddleware::class)->setName('ANTRIAN_PENDAFTARAN/edit-ANTRIAN_PENDAFTARAN-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Id}]', AntrianPendaftaranController::class . ':delete')->add(PermissionMiddleware::class)->setName('ANTRIAN_PENDAFTARAN/delete-ANTRIAN_PENDAFTARAN-delete-2'); // delete
        }
    );

    // CLASS2
    $app->any('/Class2List[/{CLASS_ID}]', Class2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Class2List-CLASS2-list'); // list
    $app->any('/Class2Add[/{CLASS_ID}]', Class2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('Class2Add-CLASS2-add'); // add
    $app->any('/Class2View[/{CLASS_ID}]', Class2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('Class2View-CLASS2-view'); // view
    $app->any('/Class2Edit[/{CLASS_ID}]', Class2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('Class2Edit-CLASS2-edit'); // edit
    $app->any('/Class2Delete[/{CLASS_ID}]', Class2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('Class2Delete-CLASS2-delete'); // delete
    $app->group(
        '/CLASS2',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{CLASS_ID}]', Class2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('CLASS2/list-CLASS2-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{CLASS_ID}]', Class2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('CLASS2/add-CLASS2-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{CLASS_ID}]', Class2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('CLASS2/view-CLASS2-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{CLASS_ID}]', Class2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('CLASS2/edit-CLASS2-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{CLASS_ID}]', Class2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('CLASS2/delete-CLASS2-delete-2'); // delete
        }
    );

    // CLASS_ROOM
    $app->any('/ClassRoomList[/{ORG_UNIT_CODE}/{CLASS_ROOM_ID}]', ClassRoomController::class . ':list')->add(PermissionMiddleware::class)->setName('ClassRoomList-CLASS_ROOM-list'); // list
    $app->group(
        '/CLASS_ROOM',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{CLASS_ROOM_ID}]', ClassRoomController::class . ':list')->add(PermissionMiddleware::class)->setName('CLASS_ROOM/list-CLASS_ROOM-list-2'); // list
        }
    );

    // CLINIC
    $app->any('/ClinicList[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':list')->add(PermissionMiddleware::class)->setName('ClinicList-CLINIC-list'); // list
    $app->any('/ClinicAdd[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':add')->add(PermissionMiddleware::class)->setName('ClinicAdd-CLINIC-add'); // add
    $app->any('/ClinicView[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':view')->add(PermissionMiddleware::class)->setName('ClinicView-CLINIC-view'); // view
    $app->any('/ClinicEdit[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':edit')->add(PermissionMiddleware::class)->setName('ClinicEdit-CLINIC-edit'); // edit
    $app->any('/ClinicDelete[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':delete')->add(PermissionMiddleware::class)->setName('ClinicDelete-CLINIC-delete'); // delete
    $app->group(
        '/CLINIC',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':list')->add(PermissionMiddleware::class)->setName('CLINIC/list-CLINIC-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':add')->add(PermissionMiddleware::class)->setName('CLINIC/add-CLINIC-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':view')->add(PermissionMiddleware::class)->setName('CLINIC/view-CLINIC-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':edit')->add(PermissionMiddleware::class)->setName('CLINIC/edit-CLINIC-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ORG_UNIT_CODE}/{CLINIC_ID}]', ClinicController::class . ':delete')->add(PermissionMiddleware::class)->setName('CLINIC/delete-CLINIC-delete-2'); // delete
        }
    );

    // DIAGNOSA
    $app->any('/DiagnosaList[/{DIAGNOSA_ID}]', DiagnosaController::class . ':list')->add(PermissionMiddleware::class)->setName('DiagnosaList-DIAGNOSA-list'); // list
    $app->any('/DiagnosaAdd[/{DIAGNOSA_ID}]', DiagnosaController::class . ':add')->add(PermissionMiddleware::class)->setName('DiagnosaAdd-DIAGNOSA-add'); // add
    $app->any('/DiagnosaEdit[/{DIAGNOSA_ID}]', DiagnosaController::class . ':edit')->add(PermissionMiddleware::class)->setName('DiagnosaEdit-DIAGNOSA-edit'); // edit
    $app->any('/DiagnosaDelete[/{DIAGNOSA_ID}]', DiagnosaController::class . ':delete')->add(PermissionMiddleware::class)->setName('DiagnosaDelete-DIAGNOSA-delete'); // delete
    $app->group(
        '/DIAGNOSA',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{DIAGNOSA_ID}]', DiagnosaController::class . ':list')->add(PermissionMiddleware::class)->setName('DIAGNOSA/list-DIAGNOSA-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{DIAGNOSA_ID}]', DiagnosaController::class . ':add')->add(PermissionMiddleware::class)->setName('DIAGNOSA/add-DIAGNOSA-add-2'); // add
            $group->any('/' . Config("EDIT_ACTION") . '[/{DIAGNOSA_ID}]', DiagnosaController::class . ':edit')->add(PermissionMiddleware::class)->setName('DIAGNOSA/edit-DIAGNOSA-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{DIAGNOSA_ID}]', DiagnosaController::class . ':delete')->add(PermissionMiddleware::class)->setName('DIAGNOSA/delete-DIAGNOSA-delete-2'); // delete
        }
    );

    // EMPLOYEE_ALL
    $app->any('/EmployeeAllList[/{ORG_UNIT_CODE}/{EMPLOYEE_ID}]', EmployeeAllController::class . ':list')->add(PermissionMiddleware::class)->setName('EmployeeAllList-EMPLOYEE_ALL-list'); // list
    $app->group(
        '/EMPLOYEE_ALL',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{EMPLOYEE_ID}]', EmployeeAllController::class . ':list')->add(PermissionMiddleware::class)->setName('EMPLOYEE_ALL/list-EMPLOYEE_ALL-list-2'); // list
        }
    );

    // EMPLOYEE_JABATAN
    $app->any('/EmployeeJabatanList[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':list')->add(PermissionMiddleware::class)->setName('EmployeeJabatanList-EMPLOYEE_JABATAN-list'); // list
    $app->any('/EmployeeJabatanAdd[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':add')->add(PermissionMiddleware::class)->setName('EmployeeJabatanAdd-EMPLOYEE_JABATAN-add'); // add
    $app->any('/EmployeeJabatanView[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':view')->add(PermissionMiddleware::class)->setName('EmployeeJabatanView-EMPLOYEE_JABATAN-view'); // view
    $app->any('/EmployeeJabatanEdit[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('EmployeeJabatanEdit-EMPLOYEE_JABATAN-edit'); // edit
    $app->any('/EmployeeJabatanDelete[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('EmployeeJabatanDelete-EMPLOYEE_JABATAN-delete'); // delete
    $app->group(
        '/EMPLOYEE_JABATAN',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':list')->add(PermissionMiddleware::class)->setName('EMPLOYEE_JABATAN/list-EMPLOYEE_JABATAN-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':add')->add(PermissionMiddleware::class)->setName('EMPLOYEE_JABATAN/add-EMPLOYEE_JABATAN-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':view')->add(PermissionMiddleware::class)->setName('EMPLOYEE_JABATAN/view-EMPLOYEE_JABATAN-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('EMPLOYEE_JABATAN/edit-EMPLOYEE_JABATAN-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{KODE_JABATAN}]', EmployeeJabatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('EMPLOYEE_JABATAN/delete-EMPLOYEE_JABATAN-delete-2'); // delete
        }
    );

    // FAMILY
    $app->any('/FamilyList[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':list')->add(PermissionMiddleware::class)->setName('FamilyList-FAMILY-list'); // list
    $app->any('/FamilyAdd[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':add')->add(PermissionMiddleware::class)->setName('FamilyAdd-FAMILY-add'); // add
    $app->any('/FamilyView[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':view')->add(PermissionMiddleware::class)->setName('FamilyView-FAMILY-view'); // view
    $app->any('/FamilyEdit[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':edit')->add(PermissionMiddleware::class)->setName('FamilyEdit-FAMILY-edit'); // edit
    $app->any('/FamilyDelete[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':delete')->add(PermissionMiddleware::class)->setName('FamilyDelete-FAMILY-delete'); // delete
    $app->group(
        '/FAMILY',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':list')->add(PermissionMiddleware::class)->setName('FAMILY/list-FAMILY-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':add')->add(PermissionMiddleware::class)->setName('FAMILY/add-FAMILY-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':view')->add(PermissionMiddleware::class)->setName('FAMILY/view-FAMILY-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':edit')->add(PermissionMiddleware::class)->setName('FAMILY/edit-FAMILY-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ORG_UNIT_CODE}/{NO_REGISTRATION}/{FAMILY_ID}]', FamilyController::class . ':delete')->add(PermissionMiddleware::class)->setName('FAMILY/delete-FAMILY-delete-2'); // delete
        }
    );

    // FAMILY_STATUS
    $app->any('/FamilyStatusList[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':list')->add(PermissionMiddleware::class)->setName('FamilyStatusList-FAMILY_STATUS-list'); // list
    $app->any('/FamilyStatusAdd[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':add')->add(PermissionMiddleware::class)->setName('FamilyStatusAdd-FAMILY_STATUS-add'); // add
    $app->any('/FamilyStatusView[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':view')->add(PermissionMiddleware::class)->setName('FamilyStatusView-FAMILY_STATUS-view'); // view
    $app->any('/FamilyStatusEdit[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':edit')->add(PermissionMiddleware::class)->setName('FamilyStatusEdit-FAMILY_STATUS-edit'); // edit
    $app->any('/FamilyStatusDelete[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':delete')->add(PermissionMiddleware::class)->setName('FamilyStatusDelete-FAMILY_STATUS-delete'); // delete
    $app->group(
        '/FAMILY_STATUS',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':list')->add(PermissionMiddleware::class)->setName('FAMILY_STATUS/list-FAMILY_STATUS-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':add')->add(PermissionMiddleware::class)->setName('FAMILY_STATUS/add-FAMILY_STATUS-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':view')->add(PermissionMiddleware::class)->setName('FAMILY_STATUS/view-FAMILY_STATUS-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':edit')->add(PermissionMiddleware::class)->setName('FAMILY_STATUS/edit-FAMILY_STATUS-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{FAMILY_STATUS_ID}]', FamilyStatusController::class . ':delete')->add(PermissionMiddleware::class)->setName('FAMILY_STATUS/delete-FAMILY_STATUS-delete-2'); // delete
        }
    );

    // INASIS_JENIS_PESERTA
    $app->any('/InasisJenisPesertaList[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':list')->add(PermissionMiddleware::class)->setName('InasisJenisPesertaList-INASIS_JENIS_PESERTA-list'); // list
    $app->any('/InasisJenisPesertaAdd[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':add')->add(PermissionMiddleware::class)->setName('InasisJenisPesertaAdd-INASIS_JENIS_PESERTA-add'); // add
    $app->any('/InasisJenisPesertaView[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':view')->add(PermissionMiddleware::class)->setName('InasisJenisPesertaView-INASIS_JENIS_PESERTA-view'); // view
    $app->any('/InasisJenisPesertaEdit[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':edit')->add(PermissionMiddleware::class)->setName('InasisJenisPesertaEdit-INASIS_JENIS_PESERTA-edit'); // edit
    $app->any('/InasisJenisPesertaDelete[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':delete')->add(PermissionMiddleware::class)->setName('InasisJenisPesertaDelete-INASIS_JENIS_PESERTA-delete'); // delete
    $app->group(
        '/INASIS_JENIS_PESERTA',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':list')->add(PermissionMiddleware::class)->setName('INASIS_JENIS_PESERTA/list-INASIS_JENIS_PESERTA-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':add')->add(PermissionMiddleware::class)->setName('INASIS_JENIS_PESERTA/add-INASIS_JENIS_PESERTA-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':view')->add(PermissionMiddleware::class)->setName('INASIS_JENIS_PESERTA/view-INASIS_JENIS_PESERTA-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':edit')->add(PermissionMiddleware::class)->setName('INASIS_JENIS_PESERTA/edit-INASIS_JENIS_PESERTA-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{KDJNSPESERTA}]', InasisJenisPesertaController::class . ':delete')->add(PermissionMiddleware::class)->setName('INASIS_JENIS_PESERTA/delete-INASIS_JENIS_PESERTA-delete-2'); // delete
        }
    );

    // INASIS_KELASRAWAT
    $app->any('/InasisKelasrawatList[/{KDKELAS}]', InasisKelasrawatController::class . ':list')->add(PermissionMiddleware::class)->setName('InasisKelasrawatList-INASIS_KELASRAWAT-list'); // list
    $app->any('/InasisKelasrawatAdd[/{KDKELAS}]', InasisKelasrawatController::class . ':add')->add(PermissionMiddleware::class)->setName('InasisKelasrawatAdd-INASIS_KELASRAWAT-add'); // add
    $app->any('/InasisKelasrawatView[/{KDKELAS}]', InasisKelasrawatController::class . ':view')->add(PermissionMiddleware::class)->setName('InasisKelasrawatView-INASIS_KELASRAWAT-view'); // view
    $app->any('/InasisKelasrawatEdit[/{KDKELAS}]', InasisKelasrawatController::class . ':edit')->add(PermissionMiddleware::class)->setName('InasisKelasrawatEdit-INASIS_KELASRAWAT-edit'); // edit
    $app->any('/InasisKelasrawatDelete[/{KDKELAS}]', InasisKelasrawatController::class . ':delete')->add(PermissionMiddleware::class)->setName('InasisKelasrawatDelete-INASIS_KELASRAWAT-delete'); // delete
    $app->group(
        '/INASIS_KELASRAWAT',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{KDKELAS}]', InasisKelasrawatController::class . ':list')->add(PermissionMiddleware::class)->setName('INASIS_KELASRAWAT/list-INASIS_KELASRAWAT-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{KDKELAS}]', InasisKelasrawatController::class . ':add')->add(PermissionMiddleware::class)->setName('INASIS_KELASRAWAT/add-INASIS_KELASRAWAT-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{KDKELAS}]', InasisKelasrawatController::class . ':view')->add(PermissionMiddleware::class)->setName('INASIS_KELASRAWAT/view-INASIS_KELASRAWAT-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{KDKELAS}]', InasisKelasrawatController::class . ':edit')->add(PermissionMiddleware::class)->setName('INASIS_KELASRAWAT/edit-INASIS_KELASRAWAT-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{KDKELAS}]', InasisKelasrawatController::class . ':delete')->add(PermissionMiddleware::class)->setName('INASIS_KELASRAWAT/delete-INASIS_KELASRAWAT-delete-2'); // delete
        }
    );

    // INASIS_STATUS_PESERTA
    $app->any('/InasisStatusPesertaList[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':list')->add(PermissionMiddleware::class)->setName('InasisStatusPesertaList-INASIS_STATUS_PESERTA-list'); // list
    $app->any('/InasisStatusPesertaAdd[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':add')->add(PermissionMiddleware::class)->setName('InasisStatusPesertaAdd-INASIS_STATUS_PESERTA-add'); // add
    $app->any('/InasisStatusPesertaView[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':view')->add(PermissionMiddleware::class)->setName('InasisStatusPesertaView-INASIS_STATUS_PESERTA-view'); // view
    $app->any('/InasisStatusPesertaEdit[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':edit')->add(PermissionMiddleware::class)->setName('InasisStatusPesertaEdit-INASIS_STATUS_PESERTA-edit'); // edit
    $app->any('/InasisStatusPesertaDelete[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':delete')->add(PermissionMiddleware::class)->setName('InasisStatusPesertaDelete-INASIS_STATUS_PESERTA-delete'); // delete
    $app->group(
        '/INASIS_STATUS_PESERTA',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':list')->add(PermissionMiddleware::class)->setName('INASIS_STATUS_PESERTA/list-INASIS_STATUS_PESERTA-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':add')->add(PermissionMiddleware::class)->setName('INASIS_STATUS_PESERTA/add-INASIS_STATUS_PESERTA-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':view')->add(PermissionMiddleware::class)->setName('INASIS_STATUS_PESERTA/view-INASIS_STATUS_PESERTA-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':edit')->add(PermissionMiddleware::class)->setName('INASIS_STATUS_PESERTA/edit-INASIS_STATUS_PESERTA-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{STATUS_PESERTA_KODE}]', InasisStatusPesertaController::class . ':delete')->add(PermissionMiddleware::class)->setName('INASIS_STATUS_PESERTA/delete-INASIS_STATUS_PESERTA-delete-2'); // delete
        }
    );

    // MUTATION_DOCS
    $app->any('/MutationDocsList[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':list')->add(PermissionMiddleware::class)->setName('MutationDocsList-MUTATION_DOCS-list'); // list
    $app->any('/MutationDocsAdd[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':add')->add(PermissionMiddleware::class)->setName('MutationDocsAdd-MUTATION_DOCS-add'); // add
    $app->any('/MutationDocsView[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':view')->add(PermissionMiddleware::class)->setName('MutationDocsView-MUTATION_DOCS-view'); // view
    $app->any('/MutationDocsEdit[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MutationDocsEdit-MUTATION_DOCS-edit'); // edit
    $app->any('/MutationDocsDelete[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MutationDocsDelete-MUTATION_DOCS-delete'); // delete
    $app->group(
        '/MUTATION_DOCS',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':list')->add(PermissionMiddleware::class)->setName('MUTATION_DOCS/list-MUTATION_DOCS-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':add')->add(PermissionMiddleware::class)->setName('MUTATION_DOCS/add-MUTATION_DOCS-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':view')->add(PermissionMiddleware::class)->setName('MUTATION_DOCS/view-MUTATION_DOCS-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MUTATION_DOCS/edit-MUTATION_DOCS-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ORG_UNIT_CODE}/{DOC_NO}]', MutationDocsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MUTATION_DOCS/delete-MUTATION_DOCS-delete-2'); // delete
        }
    );

    // PASIEN
    $app->any('/PasienList[/{ID}]', PasienController::class . ':list')->add(PermissionMiddleware::class)->setName('PasienList-PASIEN-list'); // list
    $app->any('/PasienAdd[/{ID}]', PasienController::class . ':add')->add(PermissionMiddleware::class)->setName('PasienAdd-PASIEN-add'); // add
    $app->any('/PasienView[/{ID}]', PasienController::class . ':view')->add(PermissionMiddleware::class)->setName('PasienView-PASIEN-view'); // view
    $app->any('/PasienEdit[/{ID}]', PasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('PasienEdit-PASIEN-edit'); // edit
    $app->group(
        '/PASIEN',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', PasienController::class . ':list')->add(PermissionMiddleware::class)->setName('PASIEN/list-PASIEN-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', PasienController::class . ':add')->add(PermissionMiddleware::class)->setName('PASIEN/add-PASIEN-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', PasienController::class . ':view')->add(PermissionMiddleware::class)->setName('PASIEN/view-PASIEN-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', PasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('PASIEN/edit-PASIEN-edit-2'); // edit
        }
    );

    // PASIEN_DIAGNOSA
    $app->any('/PasienDiagnosaList[/{ID}]', PasienDiagnosaController::class . ':list')->add(PermissionMiddleware::class)->setName('PasienDiagnosaList-PASIEN_DIAGNOSA-list'); // list
    $app->any('/PasienDiagnosaAdd[/{ID}]', PasienDiagnosaController::class . ':add')->add(PermissionMiddleware::class)->setName('PasienDiagnosaAdd-PASIEN_DIAGNOSA-add'); // add
    $app->any('/PasienDiagnosaView[/{ID}]', PasienDiagnosaController::class . ':view')->add(PermissionMiddleware::class)->setName('PasienDiagnosaView-PASIEN_DIAGNOSA-view'); // view
    $app->any('/PasienDiagnosaEdit[/{ID}]', PasienDiagnosaController::class . ':edit')->add(PermissionMiddleware::class)->setName('PasienDiagnosaEdit-PASIEN_DIAGNOSA-edit'); // edit
    $app->any('/PasienDiagnosaDelete[/{ID}]', PasienDiagnosaController::class . ':delete')->add(PermissionMiddleware::class)->setName('PasienDiagnosaDelete-PASIEN_DIAGNOSA-delete'); // delete
    $app->group(
        '/PASIEN_DIAGNOSA',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', PasienDiagnosaController::class . ':list')->add(PermissionMiddleware::class)->setName('PASIEN_DIAGNOSA/list-PASIEN_DIAGNOSA-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', PasienDiagnosaController::class . ':add')->add(PermissionMiddleware::class)->setName('PASIEN_DIAGNOSA/add-PASIEN_DIAGNOSA-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', PasienDiagnosaController::class . ':view')->add(PermissionMiddleware::class)->setName('PASIEN_DIAGNOSA/view-PASIEN_DIAGNOSA-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', PasienDiagnosaController::class . ':edit')->add(PermissionMiddleware::class)->setName('PASIEN_DIAGNOSA/edit-PASIEN_DIAGNOSA-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ID}]', PasienDiagnosaController::class . ':delete')->add(PermissionMiddleware::class)->setName('PASIEN_DIAGNOSA/delete-PASIEN_DIAGNOSA-delete-2'); // delete
        }
    );

    // PASIEN_VISITATION
    $app->any('/PasienVisitationList[/{IDXDAFTAR}]', PasienVisitationController::class . ':list')->add(PermissionMiddleware::class)->setName('PasienVisitationList-PASIEN_VISITATION-list'); // list
    $app->any('/PasienVisitationAdd[/{IDXDAFTAR}]', PasienVisitationController::class . ':add')->add(PermissionMiddleware::class)->setName('PasienVisitationAdd-PASIEN_VISITATION-add'); // add
    $app->any('/PasienVisitationView[/{IDXDAFTAR}]', PasienVisitationController::class . ':view')->add(PermissionMiddleware::class)->setName('PasienVisitationView-PASIEN_VISITATION-view'); // view
    $app->any('/PasienVisitationEdit[/{IDXDAFTAR}]', PasienVisitationController::class . ':edit')->add(PermissionMiddleware::class)->setName('PasienVisitationEdit-PASIEN_VISITATION-edit'); // edit
    $app->any('/PasienVisitationSearch', PasienVisitationController::class . ':search')->add(PermissionMiddleware::class)->setName('PasienVisitationSearch-PASIEN_VISITATION-search'); // search
    $app->group(
        '/PASIEN_VISITATION',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', PasienVisitationController::class . ':list')->add(PermissionMiddleware::class)->setName('PASIEN_VISITATION/list-PASIEN_VISITATION-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{IDXDAFTAR}]', PasienVisitationController::class . ':add')->add(PermissionMiddleware::class)->setName('PASIEN_VISITATION/add-PASIEN_VISITATION-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{IDXDAFTAR}]', PasienVisitationController::class . ':view')->add(PermissionMiddleware::class)->setName('PASIEN_VISITATION/view-PASIEN_VISITATION-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{IDXDAFTAR}]', PasienVisitationController::class . ':edit')->add(PermissionMiddleware::class)->setName('PASIEN_VISITATION/edit-PASIEN_VISITATION-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', PasienVisitationController::class . ':search')->add(PermissionMiddleware::class)->setName('PASIEN_VISITATION/search-PASIEN_VISITATION-search-2'); // search
        }
    );

    // PAYMENT_METHOD
    $app->any('/PaymentMethodList[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':list')->add(PermissionMiddleware::class)->setName('PaymentMethodList-PAYMENT_METHOD-list'); // list
    $app->any('/PaymentMethodAdd[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':add')->add(PermissionMiddleware::class)->setName('PaymentMethodAdd-PAYMENT_METHOD-add'); // add
    $app->any('/PaymentMethodView[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':view')->add(PermissionMiddleware::class)->setName('PaymentMethodView-PAYMENT_METHOD-view'); // view
    $app->any('/PaymentMethodEdit[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':edit')->add(PermissionMiddleware::class)->setName('PaymentMethodEdit-PAYMENT_METHOD-edit'); // edit
    $app->any('/PaymentMethodDelete[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':delete')->add(PermissionMiddleware::class)->setName('PaymentMethodDelete-PAYMENT_METHOD-delete'); // delete
    $app->group(
        '/PAYMENT_METHOD',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':list')->add(PermissionMiddleware::class)->setName('PAYMENT_METHOD/list-PAYMENT_METHOD-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':add')->add(PermissionMiddleware::class)->setName('PAYMENT_METHOD/add-PAYMENT_METHOD-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':view')->add(PermissionMiddleware::class)->setName('PAYMENT_METHOD/view-PAYMENT_METHOD-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':edit')->add(PermissionMiddleware::class)->setName('PAYMENT_METHOD/edit-PAYMENT_METHOD-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{PAY_METHOD_ID}]', PaymentMethodController::class . ':delete')->add(PermissionMiddleware::class)->setName('PAYMENT_METHOD/delete-PAYMENT_METHOD-delete-2'); // delete
        }
    );

    // PAYOR_INFO
    $app->any('/PayorInfoList[/{PAYOR_ID}]', PayorInfoController::class . ':list')->add(PermissionMiddleware::class)->setName('PayorInfoList-PAYOR_INFO-list'); // list
    $app->any('/PayorInfoAdd[/{PAYOR_ID}]', PayorInfoController::class . ':add')->add(PermissionMiddleware::class)->setName('PayorInfoAdd-PAYOR_INFO-add'); // add
    $app->any('/PayorInfoView[/{PAYOR_ID}]', PayorInfoController::class . ':view')->add(PermissionMiddleware::class)->setName('PayorInfoView-PAYOR_INFO-view'); // view
    $app->any('/PayorInfoEdit[/{PAYOR_ID}]', PayorInfoController::class . ':edit')->add(PermissionMiddleware::class)->setName('PayorInfoEdit-PAYOR_INFO-edit'); // edit
    $app->any('/PayorInfoDelete[/{PAYOR_ID}]', PayorInfoController::class . ':delete')->add(PermissionMiddleware::class)->setName('PayorInfoDelete-PAYOR_INFO-delete'); // delete
    $app->group(
        '/PAYOR_INFO',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{PAYOR_ID}]', PayorInfoController::class . ':list')->add(PermissionMiddleware::class)->setName('PAYOR_INFO/list-PAYOR_INFO-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{PAYOR_ID}]', PayorInfoController::class . ':add')->add(PermissionMiddleware::class)->setName('PAYOR_INFO/add-PAYOR_INFO-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{PAYOR_ID}]', PayorInfoController::class . ':view')->add(PermissionMiddleware::class)->setName('PAYOR_INFO/view-PAYOR_INFO-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{PAYOR_ID}]', PayorInfoController::class . ':edit')->add(PermissionMiddleware::class)->setName('PAYOR_INFO/edit-PAYOR_INFO-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{PAYOR_ID}]', PayorInfoController::class . ':delete')->add(PermissionMiddleware::class)->setName('PAYOR_INFO/delete-PAYOR_INFO-delete-2'); // delete
        }
    );

    // PAYOR_TYPE
    $app->any('/PayorTypeList[/{PAYOR_TYPE}]', PayorTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('PayorTypeList-PAYOR_TYPE-list'); // list
    $app->any('/PayorTypeAdd[/{PAYOR_TYPE}]', PayorTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('PayorTypeAdd-PAYOR_TYPE-add'); // add
    $app->any('/PayorTypeView[/{PAYOR_TYPE}]', PayorTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('PayorTypeView-PAYOR_TYPE-view'); // view
    $app->any('/PayorTypeEdit[/{PAYOR_TYPE}]', PayorTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('PayorTypeEdit-PAYOR_TYPE-edit'); // edit
    $app->any('/PayorTypeDelete[/{PAYOR_TYPE}]', PayorTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('PayorTypeDelete-PAYOR_TYPE-delete'); // delete
    $app->group(
        '/PAYOR_TYPE',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{PAYOR_TYPE}]', PayorTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('PAYOR_TYPE/list-PAYOR_TYPE-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{PAYOR_TYPE}]', PayorTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('PAYOR_TYPE/add-PAYOR_TYPE-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{PAYOR_TYPE}]', PayorTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('PAYOR_TYPE/view-PAYOR_TYPE-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{PAYOR_TYPE}]', PayorTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('PAYOR_TYPE/edit-PAYOR_TYPE-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{PAYOR_TYPE}]', PayorTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('PAYOR_TYPE/delete-PAYOR_TYPE-delete-2'); // delete
        }
    );

    // SEX
    $app->any('/SexList[/{GENDER}]', SexController::class . ':list')->add(PermissionMiddleware::class)->setName('SexList-SEX-list'); // list
    $app->any('/SexAdd[/{GENDER}]', SexController::class . ':add')->add(PermissionMiddleware::class)->setName('SexAdd-SEX-add'); // add
    $app->any('/SexView[/{GENDER}]', SexController::class . ':view')->add(PermissionMiddleware::class)->setName('SexView-SEX-view'); // view
    $app->any('/SexEdit[/{GENDER}]', SexController::class . ':edit')->add(PermissionMiddleware::class)->setName('SexEdit-SEX-edit'); // edit
    $app->any('/SexDelete[/{GENDER}]', SexController::class . ':delete')->add(PermissionMiddleware::class)->setName('SexDelete-SEX-delete'); // delete
    $app->group(
        '/SEX',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{GENDER}]', SexController::class . ':list')->add(PermissionMiddleware::class)->setName('SEX/list-SEX-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{GENDER}]', SexController::class . ':add')->add(PermissionMiddleware::class)->setName('SEX/add-SEX-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{GENDER}]', SexController::class . ':view')->add(PermissionMiddleware::class)->setName('SEX/view-SEX-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{GENDER}]', SexController::class . ':edit')->add(PermissionMiddleware::class)->setName('SEX/edit-SEX-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{GENDER}]', SexController::class . ':delete')->add(PermissionMiddleware::class)->setName('SEX/delete-SEX-delete-2'); // delete
        }
    );

    // TREAT_TARIF
    $app->any('/TreatTarifList[/{ORG_UNIT_CODE}/{TARIF_ID}]', TreatTarifController::class . ':list')->add(PermissionMiddleware::class)->setName('TreatTarifList-TREAT_TARIF-list'); // list
    $app->any('/TreatTarifAdd[/{ORG_UNIT_CODE}/{TARIF_ID}]', TreatTarifController::class . ':add')->add(PermissionMiddleware::class)->setName('TreatTarifAdd-TREAT_TARIF-add'); // add
    $app->group(
        '/TREAT_TARIF',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{TARIF_ID}]', TreatTarifController::class . ':list')->add(PermissionMiddleware::class)->setName('TREAT_TARIF/list-TREAT_TARIF-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ORG_UNIT_CODE}/{TARIF_ID}]', TreatTarifController::class . ':add')->add(PermissionMiddleware::class)->setName('TREAT_TARIF/add-TREAT_TARIF-add-2'); // add
        }
    );

    // TREATMENT_AKOMODASI
    $app->any('/TreatmentAkomodasiList[/{ID}]', TreatmentAkomodasiController::class . ':list')->add(PermissionMiddleware::class)->setName('TreatmentAkomodasiList-TREATMENT_AKOMODASI-list'); // list
    $app->any('/TreatmentAkomodasiAdd[/{ID}]', TreatmentAkomodasiController::class . ':add')->add(PermissionMiddleware::class)->setName('TreatmentAkomodasiAdd-TREATMENT_AKOMODASI-add'); // add
    $app->any('/TreatmentAkomodasiView[/{ID}]', TreatmentAkomodasiController::class . ':view')->add(PermissionMiddleware::class)->setName('TreatmentAkomodasiView-TREATMENT_AKOMODASI-view'); // view
    $app->any('/TreatmentAkomodasiEdit[/{ID}]', TreatmentAkomodasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('TreatmentAkomodasiEdit-TREATMENT_AKOMODASI-edit'); // edit
    $app->any('/TreatmentAkomodasiDelete[/{ID}]', TreatmentAkomodasiController::class . ':delete')->add(PermissionMiddleware::class)->setName('TreatmentAkomodasiDelete-TREATMENT_AKOMODASI-delete'); // delete
    $app->group(
        '/TREATMENT_AKOMODASI',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', TreatmentAkomodasiController::class . ':list')->add(PermissionMiddleware::class)->setName('TREATMENT_AKOMODASI/list-TREATMENT_AKOMODASI-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', TreatmentAkomodasiController::class . ':add')->add(PermissionMiddleware::class)->setName('TREATMENT_AKOMODASI/add-TREATMENT_AKOMODASI-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', TreatmentAkomodasiController::class . ':view')->add(PermissionMiddleware::class)->setName('TREATMENT_AKOMODASI/view-TREATMENT_AKOMODASI-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', TreatmentAkomodasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('TREATMENT_AKOMODASI/edit-TREATMENT_AKOMODASI-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ID}]', TreatmentAkomodasiController::class . ':delete')->add(PermissionMiddleware::class)->setName('TREATMENT_AKOMODASI/delete-TREATMENT_AKOMODASI-delete-2'); // delete
        }
    );

    // TREATMENT_BILL
    $app->any('/TreatmentBillList[/{ID}]', TreatmentBillController::class . ':list')->add(PermissionMiddleware::class)->setName('TreatmentBillList-TREATMENT_BILL-list'); // list
    $app->any('/TreatmentBillAdd[/{ID}]', TreatmentBillController::class . ':add')->add(PermissionMiddleware::class)->setName('TreatmentBillAdd-TREATMENT_BILL-add'); // add
    $app->any('/TreatmentBillView[/{ID}]', TreatmentBillController::class . ':view')->add(PermissionMiddleware::class)->setName('TreatmentBillView-TREATMENT_BILL-view'); // view
    $app->any('/TreatmentBillEdit[/{ID}]', TreatmentBillController::class . ':edit')->add(PermissionMiddleware::class)->setName('TreatmentBillEdit-TREATMENT_BILL-edit'); // edit
    $app->any('/TreatmentBillDelete[/{ID}]', TreatmentBillController::class . ':delete')->add(PermissionMiddleware::class)->setName('TreatmentBillDelete-TREATMENT_BILL-delete'); // delete
    $app->group(
        '/TREATMENT_BILL',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', TreatmentBillController::class . ':list')->add(PermissionMiddleware::class)->setName('TREATMENT_BILL/list-TREATMENT_BILL-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', TreatmentBillController::class . ':add')->add(PermissionMiddleware::class)->setName('TREATMENT_BILL/add-TREATMENT_BILL-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', TreatmentBillController::class . ':view')->add(PermissionMiddleware::class)->setName('TREATMENT_BILL/view-TREATMENT_BILL-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', TreatmentBillController::class . ':edit')->add(PermissionMiddleware::class)->setName('TREATMENT_BILL/edit-TREATMENT_BILL-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ID}]', TreatmentBillController::class . ':delete')->add(PermissionMiddleware::class)->setName('TREATMENT_BILL/delete-TREATMENT_BILL-delete-2'); // delete
        }
    );

    // TREATMENT_OBAT
    $app->any('/TreatmentObatList[/{ID}]', TreatmentObatController::class . ':list')->add(PermissionMiddleware::class)->setName('TreatmentObatList-TREATMENT_OBAT-list'); // list
    $app->any('/TreatmentObatAdd[/{ID}]', TreatmentObatController::class . ':add')->add(PermissionMiddleware::class)->setName('TreatmentObatAdd-TREATMENT_OBAT-add'); // add
    $app->any('/TreatmentObatView[/{ID}]', TreatmentObatController::class . ':view')->add(PermissionMiddleware::class)->setName('TreatmentObatView-TREATMENT_OBAT-view'); // view
    $app->any('/TreatmentObatEdit[/{ID}]', TreatmentObatController::class . ':edit')->add(PermissionMiddleware::class)->setName('TreatmentObatEdit-TREATMENT_OBAT-edit'); // edit
    $app->any('/TreatmentObatDelete[/{ID}]', TreatmentObatController::class . ':delete')->add(PermissionMiddleware::class)->setName('TreatmentObatDelete-TREATMENT_OBAT-delete'); // delete
    $app->group(
        '/TREATMENT_OBAT',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', TreatmentObatController::class . ':list')->add(PermissionMiddleware::class)->setName('TREATMENT_OBAT/list-TREATMENT_OBAT-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', TreatmentObatController::class . ':add')->add(PermissionMiddleware::class)->setName('TREATMENT_OBAT/add-TREATMENT_OBAT-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', TreatmentObatController::class . ':view')->add(PermissionMiddleware::class)->setName('TREATMENT_OBAT/view-TREATMENT_OBAT-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', TreatmentObatController::class . ':edit')->add(PermissionMiddleware::class)->setName('TREATMENT_OBAT/edit-TREATMENT_OBAT-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ID}]', TreatmentObatController::class . ':delete')->add(PermissionMiddleware::class)->setName('TREATMENT_OBAT/delete-TREATMENT_OBAT-delete-2'); // delete
        }
    );

    // USER_LOGIN
    $app->any('/UserLoginList[/{ORG_UNIT_CODE}/{_USERNAME}]', UserLoginController::class . ':list')->add(PermissionMiddleware::class)->setName('UserLoginList-USER_LOGIN-list'); // list
    $app->any('/UserLoginAdd[/{ORG_UNIT_CODE}/{_USERNAME}]', UserLoginController::class . ':add')->add(PermissionMiddleware::class)->setName('UserLoginAdd-USER_LOGIN-add'); // add
    $app->any('/UserLoginView[/{ORG_UNIT_CODE}/{_USERNAME}]', UserLoginController::class . ':view')->add(PermissionMiddleware::class)->setName('UserLoginView-USER_LOGIN-view'); // view
    $app->any('/UserLoginEdit[/{ORG_UNIT_CODE}/{_USERNAME}]', UserLoginController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserLoginEdit-USER_LOGIN-edit'); // edit
    $app->group(
        '/USER_LOGIN',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{_USERNAME}]', UserLoginController::class . ':list')->add(PermissionMiddleware::class)->setName('USER_LOGIN/list-USER_LOGIN-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ORG_UNIT_CODE}/{_USERNAME}]', UserLoginController::class . ':add')->add(PermissionMiddleware::class)->setName('USER_LOGIN/add-USER_LOGIN-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ORG_UNIT_CODE}/{_USERNAME}]', UserLoginController::class . ':view')->add(PermissionMiddleware::class)->setName('USER_LOGIN/view-USER_LOGIN-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ORG_UNIT_CODE}/{_USERNAME}]', UserLoginController::class . ':edit')->add(PermissionMiddleware::class)->setName('USER_LOGIN/edit-USER_LOGIN-edit-2'); // edit
        }
    );

    // V_PASIENVISITATIONRJ
    $app->any('/VPasienvisitationrjList[/{NO_REGISTRATION}/{ORG_UNIT_CODE}/{visit_id}]', VPasienvisitationrjController::class . ':list')->add(PermissionMiddleware::class)->setName('VPasienvisitationrjList-V_PASIENVISITATIONRJ-list'); // list
    $app->any('/VPasienvisitationrjAdd[/{NO_REGISTRATION}/{ORG_UNIT_CODE}/{visit_id}]', VPasienvisitationrjController::class . ':add')->add(PermissionMiddleware::class)->setName('VPasienvisitationrjAdd-V_PASIENVISITATIONRJ-add'); // add
    $app->any('/VPasienvisitationrjView[/{NO_REGISTRATION}/{ORG_UNIT_CODE}/{visit_id}]', VPasienvisitationrjController::class . ':view')->add(PermissionMiddleware::class)->setName('VPasienvisitationrjView-V_PASIENVISITATIONRJ-view'); // view
    $app->any('/VPasienvisitationrjEdit[/{NO_REGISTRATION}/{ORG_UNIT_CODE}/{visit_id}]', VPasienvisitationrjController::class . ':edit')->add(PermissionMiddleware::class)->setName('VPasienvisitationrjEdit-V_PASIENVISITATIONRJ-edit'); // edit
    $app->group(
        '/V_PASIENVISITATIONRJ',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NO_REGISTRATION}/{ORG_UNIT_CODE}/{visit_id}]', VPasienvisitationrjController::class . ':list')->add(PermissionMiddleware::class)->setName('V_PASIENVISITATIONRJ/list-V_PASIENVISITATIONRJ-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NO_REGISTRATION}/{ORG_UNIT_CODE}/{visit_id}]', VPasienvisitationrjController::class . ':add')->add(PermissionMiddleware::class)->setName('V_PASIENVISITATIONRJ/add-V_PASIENVISITATIONRJ-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NO_REGISTRATION}/{ORG_UNIT_CODE}/{visit_id}]', VPasienvisitationrjController::class . ':view')->add(PermissionMiddleware::class)->setName('V_PASIENVISITATIONRJ/view-V_PASIENVISITATIONRJ-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NO_REGISTRATION}/{ORG_UNIT_CODE}/{visit_id}]', VPasienvisitationrjController::class . ':edit')->add(PermissionMiddleware::class)->setName('V_PASIENVISITATIONRJ/edit-V_PASIENVISITATIONRJ-edit-2'); // edit
        }
    );

    // V_DAFTAR_PASIEN
    $app->any('/VDaftarPasienList[/{ORG_UNIT_CODE}/{NO_REGISTRATION}]', VDaftarPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('VDaftarPasienList-V_DAFTAR_PASIEN-list'); // list
    $app->any('/VDaftarPasienAdd[/{ORG_UNIT_CODE}/{NO_REGISTRATION}]', VDaftarPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('VDaftarPasienAdd-V_DAFTAR_PASIEN-add'); // add
    $app->any('/VDaftarPasienView[/{ORG_UNIT_CODE}/{NO_REGISTRATION}]', VDaftarPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('VDaftarPasienView-V_DAFTAR_PASIEN-view'); // view
    $app->group(
        '/V_DAFTAR_PASIEN',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{NO_REGISTRATION}]', VDaftarPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('V_DAFTAR_PASIEN/list-V_DAFTAR_PASIEN-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ORG_UNIT_CODE}/{NO_REGISTRATION}]', VDaftarPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('V_DAFTAR_PASIEN/add-V_DAFTAR_PASIEN-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ORG_UNIT_CODE}/{NO_REGISTRATION}]', VDaftarPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('V_DAFTAR_PASIEN/view-V_DAFTAR_PASIEN-view-2'); // view
        }
    );

    // V_FARMASI
    $app->any('/VFarmasiList[/{IDXDAFTAR}]', VFarmasiController::class . ':list')->add(PermissionMiddleware::class)->setName('VFarmasiList-V_FARMASI-list'); // list
    $app->any('/VFarmasiAdd[/{IDXDAFTAR}]', VFarmasiController::class . ':add')->add(PermissionMiddleware::class)->setName('VFarmasiAdd-V_FARMASI-add'); // add
    $app->any('/VFarmasiView[/{IDXDAFTAR}]', VFarmasiController::class . ':view')->add(PermissionMiddleware::class)->setName('VFarmasiView-V_FARMASI-view'); // view
    $app->any('/VFarmasiEdit[/{IDXDAFTAR}]', VFarmasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('VFarmasiEdit-V_FARMASI-edit'); // edit
    $app->any('/VFarmasiSearch', VFarmasiController::class . ':search')->add(PermissionMiddleware::class)->setName('VFarmasiSearch-V_FARMASI-search'); // search
    $app->group(
        '/V_FARMASI',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', VFarmasiController::class . ':list')->add(PermissionMiddleware::class)->setName('V_FARMASI/list-V_FARMASI-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{IDXDAFTAR}]', VFarmasiController::class . ':add')->add(PermissionMiddleware::class)->setName('V_FARMASI/add-V_FARMASI-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{IDXDAFTAR}]', VFarmasiController::class . ':view')->add(PermissionMiddleware::class)->setName('V_FARMASI/view-V_FARMASI-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{IDXDAFTAR}]', VFarmasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('V_FARMASI/edit-V_FARMASI-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', VFarmasiController::class . ':search')->add(PermissionMiddleware::class)->setName('V_FARMASI/search-V_FARMASI-search-2'); // search
        }
    );

    // V_KASIR
    $app->any('/VKasirList[/{IDXDAFTAR}]', VKasirController::class . ':list')->add(PermissionMiddleware::class)->setName('VKasirList-V_KASIR-list'); // list
    $app->any('/VKasirView[/{IDXDAFTAR}]', VKasirController::class . ':view')->add(PermissionMiddleware::class)->setName('VKasirView-V_KASIR-view'); // view
    $app->any('/VKasirEdit[/{IDXDAFTAR}]', VKasirController::class . ':edit')->add(PermissionMiddleware::class)->setName('VKasirEdit-V_KASIR-edit'); // edit
    $app->any('/VKasirSearch', VKasirController::class . ':search')->add(PermissionMiddleware::class)->setName('VKasirSearch-V_KASIR-search'); // search
    $app->group(
        '/V_KASIR',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', VKasirController::class . ':list')->add(PermissionMiddleware::class)->setName('V_KASIR/list-V_KASIR-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{IDXDAFTAR}]', VKasirController::class . ':view')->add(PermissionMiddleware::class)->setName('V_KASIR/view-V_KASIR-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{IDXDAFTAR}]', VKasirController::class . ':edit')->add(PermissionMiddleware::class)->setName('V_KASIR/edit-V_KASIR-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', VKasirController::class . ':search')->add(PermissionMiddleware::class)->setName('V_KASIR/search-V_KASIR-search-2'); // search
        }
    );

    // V_REKAM_MEDIS
    $app->any('/VRekamMedisList[/{IDXDAFTAR}]', VRekamMedisController::class . ':list')->add(PermissionMiddleware::class)->setName('VRekamMedisList-V_REKAM_MEDIS-list'); // list
    $app->any('/VRekamMedisView[/{IDXDAFTAR}]', VRekamMedisController::class . ':view')->add(PermissionMiddleware::class)->setName('VRekamMedisView-V_REKAM_MEDIS-view'); // view
    $app->any('/VRekamMedisEdit[/{IDXDAFTAR}]', VRekamMedisController::class . ':edit')->add(PermissionMiddleware::class)->setName('VRekamMedisEdit-V_REKAM_MEDIS-edit'); // edit
    $app->any('/VRekamMedisSearch', VRekamMedisController::class . ':search')->add(PermissionMiddleware::class)->setName('VRekamMedisSearch-V_REKAM_MEDIS-search'); // search
    $app->group(
        '/V_REKAM_MEDIS',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', VRekamMedisController::class . ':list')->add(PermissionMiddleware::class)->setName('V_REKAM_MEDIS/list-V_REKAM_MEDIS-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{IDXDAFTAR}]', VRekamMedisController::class . ':view')->add(PermissionMiddleware::class)->setName('V_REKAM_MEDIS/view-V_REKAM_MEDIS-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{IDXDAFTAR}]', VRekamMedisController::class . ':edit')->add(PermissionMiddleware::class)->setName('V_REKAM_MEDIS/edit-V_REKAM_MEDIS-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', VRekamMedisController::class . ':search')->add(PermissionMiddleware::class)->setName('V_REKAM_MEDIS/search-V_REKAM_MEDIS-search-2'); // search
        }
    );

    // V_SENSUS
    $app->any('/VSensusList[/{NO_REGISTRATION}]', VSensusController::class . ':list')->add(PermissionMiddleware::class)->setName('VSensusList-V_SENSUS-list'); // list
    $app->group(
        '/V_SENSUS',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NO_REGISTRATION}]', VSensusController::class . ':list')->add(PermissionMiddleware::class)->setName('V_SENSUS/list-V_SENSUS-list-2'); // list
        }
    );

    // V_KUNJUNGAN
    $app->any('/VKunjunganList[/{NO_REGISTRATION}/{VISIT_ID}]', VKunjunganController::class . ':list')->add(PermissionMiddleware::class)->setName('VKunjunganList-V_KUNJUNGAN-list'); // list
    $app->group(
        '/V_KUNJUNGAN',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NO_REGISTRATION}/{VISIT_ID}]', VKunjunganController::class . ':list')->add(PermissionMiddleware::class)->setName('V_KUNJUNGAN/list-V_KUNJUNGAN-list-2'); // list
        }
    );

    // V_LABORATORIUM
    $app->any('/VLaboratoriumList[/{IDXDAFTAR}]', VLaboratoriumController::class . ':list')->add(PermissionMiddleware::class)->setName('VLaboratoriumList-V_LABORATORIUM-list'); // list
    $app->any('/VLaboratoriumView[/{IDXDAFTAR}]', VLaboratoriumController::class . ':view')->add(PermissionMiddleware::class)->setName('VLaboratoriumView-V_LABORATORIUM-view'); // view
    $app->any('/VLaboratoriumEdit[/{IDXDAFTAR}]', VLaboratoriumController::class . ':edit')->add(PermissionMiddleware::class)->setName('VLaboratoriumEdit-V_LABORATORIUM-edit'); // edit
    $app->group(
        '/V_LABORATORIUM',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', VLaboratoriumController::class . ':list')->add(PermissionMiddleware::class)->setName('V_LABORATORIUM/list-V_LABORATORIUM-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{IDXDAFTAR}]', VLaboratoriumController::class . ':view')->add(PermissionMiddleware::class)->setName('V_LABORATORIUM/view-V_LABORATORIUM-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{IDXDAFTAR}]', VLaboratoriumController::class . ':edit')->add(PermissionMiddleware::class)->setName('V_LABORATORIUM/edit-V_LABORATORIUM-edit-2'); // edit
        }
    );

    // V_RADIOLOGI
    $app->any('/VRadiologiList[/{IDXDAFTAR}]', VRadiologiController::class . ':list')->add(PermissionMiddleware::class)->setName('VRadiologiList-V_RADIOLOGI-list'); // list
    $app->any('/VRadiologiView[/{IDXDAFTAR}]', VRadiologiController::class . ':view')->add(PermissionMiddleware::class)->setName('VRadiologiView-V_RADIOLOGI-view'); // view
    $app->any('/VRadiologiEdit[/{IDXDAFTAR}]', VRadiologiController::class . ':edit')->add(PermissionMiddleware::class)->setName('VRadiologiEdit-V_RADIOLOGI-edit'); // edit
    $app->any('/VRadiologiSearch', VRadiologiController::class . ':search')->add(PermissionMiddleware::class)->setName('VRadiologiSearch-V_RADIOLOGI-search'); // search
    $app->group(
        '/V_RADIOLOGI',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', VRadiologiController::class . ':list')->add(PermissionMiddleware::class)->setName('V_RADIOLOGI/list-V_RADIOLOGI-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{IDXDAFTAR}]', VRadiologiController::class . ':view')->add(PermissionMiddleware::class)->setName('V_RADIOLOGI/view-V_RADIOLOGI-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{IDXDAFTAR}]', VRadiologiController::class . ':edit')->add(PermissionMiddleware::class)->setName('V_RADIOLOGI/edit-V_RADIOLOGI-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', VRadiologiController::class . ':search')->add(PermissionMiddleware::class)->setName('V_RADIOLOGI/search-V_RADIOLOGI-search-2'); // search
        }
    );

    // ANTRIAN_LOGIN
    $app->any('/AntrianLoginList[/{ID}]', AntrianLoginController::class . ':list')->add(PermissionMiddleware::class)->setName('AntrianLoginList-ANTRIAN_LOGIN-list'); // list
    $app->any('/AntrianLoginAdd[/{ID}]', AntrianLoginController::class . ':add')->add(PermissionMiddleware::class)->setName('AntrianLoginAdd-ANTRIAN_LOGIN-add'); // add
    $app->any('/AntrianLoginView[/{ID}]', AntrianLoginController::class . ':view')->add(PermissionMiddleware::class)->setName('AntrianLoginView-ANTRIAN_LOGIN-view'); // view
    $app->any('/AntrianLoginEdit[/{ID}]', AntrianLoginController::class . ':edit')->add(PermissionMiddleware::class)->setName('AntrianLoginEdit-ANTRIAN_LOGIN-edit'); // edit
    $app->any('/AntrianLoginDelete[/{ID}]', AntrianLoginController::class . ':delete')->add(PermissionMiddleware::class)->setName('AntrianLoginDelete-ANTRIAN_LOGIN-delete'); // delete
    $app->group(
        '/ANTRIAN_LOGIN',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', AntrianLoginController::class . ':list')->add(PermissionMiddleware::class)->setName('ANTRIAN_LOGIN/list-ANTRIAN_LOGIN-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', AntrianLoginController::class . ':add')->add(PermissionMiddleware::class)->setName('ANTRIAN_LOGIN/add-ANTRIAN_LOGIN-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', AntrianLoginController::class . ':view')->add(PermissionMiddleware::class)->setName('ANTRIAN_LOGIN/view-ANTRIAN_LOGIN-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', AntrianLoginController::class . ':edit')->add(PermissionMiddleware::class)->setName('ANTRIAN_LOGIN/edit-ANTRIAN_LOGIN-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ID}]', AntrianLoginController::class . ':delete')->add(PermissionMiddleware::class)->setName('ANTRIAN_LOGIN/delete-ANTRIAN_LOGIN-delete-2'); // delete
        }
    );

    // l_set_cssd
    $app->any('/LSetCssdList[/{id_set}]', LSetCssdController::class . ':list')->add(PermissionMiddleware::class)->setName('LSetCssdList-l_set_cssd-list'); // list
    $app->any('/LSetCssdAdd[/{id_set}]', LSetCssdController::class . ':add')->add(PermissionMiddleware::class)->setName('LSetCssdAdd-l_set_cssd-add'); // add
    $app->any('/LSetCssdView[/{id_set}]', LSetCssdController::class . ':view')->add(PermissionMiddleware::class)->setName('LSetCssdView-l_set_cssd-view'); // view
    $app->any('/LSetCssdEdit[/{id_set}]', LSetCssdController::class . ':edit')->add(PermissionMiddleware::class)->setName('LSetCssdEdit-l_set_cssd-edit'); // edit
    $app->any('/LSetCssdDelete[/{id_set}]', LSetCssdController::class . ':delete')->add(PermissionMiddleware::class)->setName('LSetCssdDelete-l_set_cssd-delete'); // delete
    $app->group(
        '/l_set_cssd',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_set}]', LSetCssdController::class . ':list')->add(PermissionMiddleware::class)->setName('l_set_cssd/list-l_set_cssd-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_set}]', LSetCssdController::class . ':add')->add(PermissionMiddleware::class)->setName('l_set_cssd/add-l_set_cssd-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_set}]', LSetCssdController::class . ':view')->add(PermissionMiddleware::class)->setName('l_set_cssd/view-l_set_cssd-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_set}]', LSetCssdController::class . ':edit')->add(PermissionMiddleware::class)->setName('l_set_cssd/edit-l_set_cssd-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_set}]', LSetCssdController::class . ':delete')->add(PermissionMiddleware::class)->setName('l_set_cssd/delete-l_set_cssd-delete-2'); // delete
        }
    );

    // m_alat_cssd
    $app->any('/MAlatCssdList[/{alat_id}]', MAlatCssdController::class . ':list')->add(PermissionMiddleware::class)->setName('MAlatCssdList-m_alat_cssd-list'); // list
    $app->any('/MAlatCssdAdd[/{alat_id}]', MAlatCssdController::class . ':add')->add(PermissionMiddleware::class)->setName('MAlatCssdAdd-m_alat_cssd-add'); // add
    $app->any('/MAlatCssdView[/{alat_id}]', MAlatCssdController::class . ':view')->add(PermissionMiddleware::class)->setName('MAlatCssdView-m_alat_cssd-view'); // view
    $app->any('/MAlatCssdEdit[/{alat_id}]', MAlatCssdController::class . ':edit')->add(PermissionMiddleware::class)->setName('MAlatCssdEdit-m_alat_cssd-edit'); // edit
    $app->any('/MAlatCssdDelete[/{alat_id}]', MAlatCssdController::class . ':delete')->add(PermissionMiddleware::class)->setName('MAlatCssdDelete-m_alat_cssd-delete'); // delete
    $app->group(
        '/m_alat_cssd',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{alat_id}]', MAlatCssdController::class . ':list')->add(PermissionMiddleware::class)->setName('m_alat_cssd/list-m_alat_cssd-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{alat_id}]', MAlatCssdController::class . ':add')->add(PermissionMiddleware::class)->setName('m_alat_cssd/add-m_alat_cssd-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{alat_id}]', MAlatCssdController::class . ':view')->add(PermissionMiddleware::class)->setName('m_alat_cssd/view-m_alat_cssd-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{alat_id}]', MAlatCssdController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_alat_cssd/edit-m_alat_cssd-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{alat_id}]', MAlatCssdController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_alat_cssd/delete-m_alat_cssd-delete-2'); // delete
        }
    );

    // kedatangan_pasien
    $app->any('/KedatanganPasien', KedatanganPasienController::class)->add(PermissionMiddleware::class)->setName('KedatanganPasien-kedatangan_pasien-summary'); // summary

    // register_pasien
    $app->any('/RegisterPasien', RegisterPasienController::class)->add(PermissionMiddleware::class)->setName('RegisterPasien-register_pasien-summary'); // summary

    // V_KUNJUNGAN_PASIEN
    $app->any('/VKunjunganPasienList[/{VISIT_ID}]', VKunjunganPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('VKunjunganPasienList-V_KUNJUNGAN_PASIEN-list'); // list
    $app->any('/VKunjunganPasienView[/{VISIT_ID}]', VKunjunganPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('VKunjunganPasienView-V_KUNJUNGAN_PASIEN-view'); // view
    $app->any('/VKunjunganPasienEdit[/{VISIT_ID}]', VKunjunganPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('VKunjunganPasienEdit-V_KUNJUNGAN_PASIEN-edit'); // edit
    $app->group(
        '/V_KUNJUNGAN_PASIEN',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{VISIT_ID}]', VKunjunganPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('V_KUNJUNGAN_PASIEN/list-V_KUNJUNGAN_PASIEN-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{VISIT_ID}]', VKunjunganPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('V_KUNJUNGAN_PASIEN/view-V_KUNJUNGAN_PASIEN-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{VISIT_ID}]', VKunjunganPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('V_KUNJUNGAN_PASIEN/edit-V_KUNJUNGAN_PASIEN-edit-2'); // edit
        }
    );

    // TARIF_TEMP
    $app->any('/TarifTempList', TarifTempController::class . ':list')->add(PermissionMiddleware::class)->setName('TarifTempList-TARIF_TEMP-list'); // list
    $app->group(
        '/TARIF_TEMP',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', TarifTempController::class . ':list')->add(PermissionMiddleware::class)->setName('TARIF_TEMP/list-TARIF_TEMP-list-2'); // list
        }
    );

    // register_cara_bayar
    $app->any('/RegisterCaraBayar', RegisterCaraBayarController::class)->add(PermissionMiddleware::class)->setName('RegisterCaraBayar-register_cara_bayar-summary'); // summary

    // penyakit_menular
    $app->any('/PenyakitMenular', PenyakitMenularController::class)->add(PermissionMiddleware::class)->setName('PenyakitMenular-penyakit_menular-summary'); // summary

    // V_SENSUS_MATA_SYARAF
    $app->any('/VSensusMataSyarafList', VSensusMataSyarafController::class . ':list')->add(PermissionMiddleware::class)->setName('VSensusMataSyarafList-V_SENSUS_MATA_SYARAF-list'); // list
    $app->group(
        '/V_SENSUS_MATA_SYARAF',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VSensusMataSyarafController::class . ':list')->add(PermissionMiddleware::class)->setName('V_SENSUS_MATA_SYARAF/list-V_SENSUS_MATA_SYARAF-list-2'); // list
        }
    );

    // mata_dan_syaraf
    $app->any('/MataDanSyaraf', MataDanSyarafController::class)->add(PermissionMiddleware::class)->setName('MataDanSyaraf-mata_dan_syaraf-summary'); // summary

    // V_RIWAYAT_RM
    $app->any('/VRiwayatRmList[/{IDXDAFTAR}]', VRiwayatRmController::class . ':list')->add(PermissionMiddleware::class)->setName('VRiwayatRmList-V_RIWAYAT_RM-list'); // list
    $app->group(
        '/V_RIWAYAT_RM',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', VRiwayatRmController::class . ':list')->add(PermissionMiddleware::class)->setName('V_RIWAYAT_RM/list-V_RIWAYAT_RM-list-2'); // list
        }
    );

    // v_riwayat_sep
    $app->any('/VRiwayatSepList[/{IDXDAFTAR}]', VRiwayatSepController::class . ':list')->add(PermissionMiddleware::class)->setName('VRiwayatSepList-v_riwayat_sep-list'); // list
    $app->group(
        '/v_riwayat_sep',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', VRiwayatSepController::class . ':list')->add(PermissionMiddleware::class)->setName('v_riwayat_sep/list-v_riwayat_sep-list-2'); // list
        }
    );

    // sensus_hari_ini
    $app->any('/SensusHariIniList', SensusHariIniController::class . ':list')->add(PermissionMiddleware::class)->setName('SensusHariIniList-sensus_hari_ini-list'); // list
    $app->group(
        '/sensus_hari_ini',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', SensusHariIniController::class . ':list')->add(PermissionMiddleware::class)->setName('sensus_hari_ini/list-sensus_hari_ini-list-2'); // list
        }
    );

    // harian
    $app->any('/Harian', HarianController::class)->add(PermissionMiddleware::class)->setName('Harian-harian-summary'); // summary

    // Dashboard2
    $app->any('/Dashboard2', Dashboard2Controller::class)->add(PermissionMiddleware::class)->setName('Dashboard2-Dashboard2-dashboard'); // dashboard

    // register_perpoli_harian
    $app->any('/RegisterPerpoliHarian', RegisterPerpoliHarianController::class)->add(PermissionMiddleware::class)->setName('RegisterPerpoliHarian-register_perpoli_harian-summary'); // summary

    // register_perpoli_bulanan
    $app->any('/RegisterPerpoliBulanan', RegisterPerpoliBulananController::class)->add(PermissionMiddleware::class)->setName('RegisterPerpoliBulanan-register_perpoli_bulanan-summary'); // summary

    // register_perpoli_tahunan
    $app->any('/RegisterPerpoliTahunan', RegisterPerpoliTahunanController::class)->add(PermissionMiddleware::class)->setName('RegisterPerpoliTahunan-register_perpoli_tahunan-summary'); // summary

    // register_ranap
    $app->any('/RegisterRanap', RegisterRanapController::class)->add(PermissionMiddleware::class)->setName('RegisterRanap-register_ranap-summary'); // summary

    // V_EMPLOYE
    $app->any('/VEmployeList[/{ORG_UNIT_CODE}/{EMPLOYEE_ID}]', VEmployeController::class . ':list')->add(PermissionMiddleware::class)->setName('VEmployeList-V_EMPLOYE-list'); // list
    $app->group(
        '/V_EMPLOYE',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{EMPLOYEE_ID}]', VEmployeController::class . ':list')->add(PermissionMiddleware::class)->setName('V_EMPLOYE/list-V_EMPLOYE-list-2'); // list
        }
    );

    // V_RAWAT_INAP
    $app->any('/VRawatInapList[/{ORG_UNIT_CODE}/{BILL_ID}]', VRawatInapController::class . ':list')->add(PermissionMiddleware::class)->setName('VRawatInapList-V_RAWAT_INAP-list'); // list
    $app->any('/VRawatInapView[/{ORG_UNIT_CODE}/{BILL_ID}]', VRawatInapController::class . ':view')->add(PermissionMiddleware::class)->setName('VRawatInapView-V_RAWAT_INAP-view'); // view
    $app->any('/VRawatInapEdit[/{ORG_UNIT_CODE}/{BILL_ID}]', VRawatInapController::class . ':edit')->add(PermissionMiddleware::class)->setName('VRawatInapEdit-V_RAWAT_INAP-edit'); // edit
    $app->group(
        '/V_RAWAT_INAP',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ORG_UNIT_CODE}/{BILL_ID}]', VRawatInapController::class . ':list')->add(PermissionMiddleware::class)->setName('V_RAWAT_INAP/list-V_RAWAT_INAP-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{ORG_UNIT_CODE}/{BILL_ID}]', VRawatInapController::class . ':view')->add(PermissionMiddleware::class)->setName('V_RAWAT_INAP/view-V_RAWAT_INAP-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ORG_UNIT_CODE}/{BILL_ID}]', VRawatInapController::class . ':edit')->add(PermissionMiddleware::class)->setName('V_RAWAT_INAP/edit-V_RAWAT_INAP-edit-2'); // edit
        }
    );

    // cv_pasien
    $app->any('/CvPasienList[/{ID}]', CvPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('CvPasienList-cv_pasien-list'); // list
    $app->any('/CvPasienAdd[/{ID}]', CvPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('CvPasienAdd-cv_pasien-add'); // add
    $app->any('/CvPasienView[/{ID}]', CvPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('CvPasienView-cv_pasien-view'); // view
    $app->any('/CvPasienEdit[/{ID}]', CvPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('CvPasienEdit-cv_pasien-edit'); // edit
    $app->group(
        '/cv_pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', CvPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('cv_pasien/list-cv_pasien-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', CvPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('cv_pasien/add-cv_pasien-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', CvPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('cv_pasien/view-cv_pasien-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', CvPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('cv_pasien/edit-cv_pasien-edit-2'); // edit
        }
    );

    // cv_visit
    $app->any('/CvVisitList[/{IDXDAFTAR}]', CvVisitController::class . ':list')->add(PermissionMiddleware::class)->setName('CvVisitList-cv_visit-list'); // list
    $app->any('/CvVisitAdd[/{IDXDAFTAR}]', CvVisitController::class . ':add')->add(PermissionMiddleware::class)->setName('CvVisitAdd-cv_visit-add'); // add
    $app->any('/CvVisitView[/{IDXDAFTAR}]', CvVisitController::class . ':view')->add(PermissionMiddleware::class)->setName('CvVisitView-cv_visit-view'); // view
    $app->any('/CvVisitEdit[/{IDXDAFTAR}]', CvVisitController::class . ':edit')->add(PermissionMiddleware::class)->setName('CvVisitEdit-cv_visit-edit'); // edit
    $app->any('/CvVisitSearch', CvVisitController::class . ':search')->add(PermissionMiddleware::class)->setName('CvVisitSearch-cv_visit-search'); // search
    $app->group(
        '/cv_visit',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{IDXDAFTAR}]', CvVisitController::class . ':list')->add(PermissionMiddleware::class)->setName('cv_visit/list-cv_visit-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{IDXDAFTAR}]', CvVisitController::class . ':add')->add(PermissionMiddleware::class)->setName('cv_visit/add-cv_visit-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{IDXDAFTAR}]', CvVisitController::class . ':view')->add(PermissionMiddleware::class)->setName('cv_visit/view-cv_visit-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{IDXDAFTAR}]', CvVisitController::class . ':edit')->add(PermissionMiddleware::class)->setName('cv_visit/edit-cv_visit-edit-2'); // edit
            $group->any('/' . Config("SEARCH_ACTION") . '', CvVisitController::class . ':search')->add(PermissionMiddleware::class)->setName('cv_visit/search-cv_visit-search-2'); // search
        }
    );

    // booking_operasi
    $app->any('/BookingOperasiList[/{id}]', BookingOperasiController::class . ':list')->add(PermissionMiddleware::class)->setName('BookingOperasiList-booking_operasi-list'); // list
    $app->any('/BookingOperasiAdd[/{id}]', BookingOperasiController::class . ':add')->add(PermissionMiddleware::class)->setName('BookingOperasiAdd-booking_operasi-add'); // add
    $app->any('/BookingOperasiView[/{id}]', BookingOperasiController::class . ':view')->add(PermissionMiddleware::class)->setName('BookingOperasiView-booking_operasi-view'); // view
    $app->any('/BookingOperasiEdit[/{id}]', BookingOperasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('BookingOperasiEdit-booking_operasi-edit'); // edit
    $app->any('/BookingOperasiDelete[/{id}]', BookingOperasiController::class . ':delete')->add(PermissionMiddleware::class)->setName('BookingOperasiDelete-booking_operasi-delete'); // delete
    $app->group(
        '/booking_operasi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BookingOperasiController::class . ':list')->add(PermissionMiddleware::class)->setName('booking_operasi/list-booking_operasi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BookingOperasiController::class . ':add')->add(PermissionMiddleware::class)->setName('booking_operasi/add-booking_operasi-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BookingOperasiController::class . ':view')->add(PermissionMiddleware::class)->setName('booking_operasi/view-booking_operasi-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BookingOperasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('booking_operasi/edit-booking_operasi-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BookingOperasiController::class . ':delete')->add(PermissionMiddleware::class)->setName('booking_operasi/delete-booking_operasi-delete-2'); // delete
        }
    );

    // l_aspel
    $app->any('/LAspelList[/{id_aspel}]', LAspelController::class . ':list')->add(PermissionMiddleware::class)->setName('LAspelList-l_aspel-list'); // list
    $app->any('/LAspelAdd[/{id_aspel}]', LAspelController::class . ':add')->add(PermissionMiddleware::class)->setName('LAspelAdd-l_aspel-add'); // add
    $app->any('/LAspelView[/{id_aspel}]', LAspelController::class . ':view')->add(PermissionMiddleware::class)->setName('LAspelView-l_aspel-view'); // view
    $app->any('/LAspelEdit[/{id_aspel}]', LAspelController::class . ':edit')->add(PermissionMiddleware::class)->setName('LAspelEdit-l_aspel-edit'); // edit
    $app->any('/LAspelDelete[/{id_aspel}]', LAspelController::class . ':delete')->add(PermissionMiddleware::class)->setName('LAspelDelete-l_aspel-delete'); // delete
    $app->group(
        '/l_aspel',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_aspel}]', LAspelController::class . ':list')->add(PermissionMiddleware::class)->setName('l_aspel/list-l_aspel-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_aspel}]', LAspelController::class . ':add')->add(PermissionMiddleware::class)->setName('l_aspel/add-l_aspel-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_aspel}]', LAspelController::class . ':view')->add(PermissionMiddleware::class)->setName('l_aspel/view-l_aspel-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_aspel}]', LAspelController::class . ':edit')->add(PermissionMiddleware::class)->setName('l_aspel/edit-l_aspel-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_aspel}]', LAspelController::class . ':delete')->add(PermissionMiddleware::class)->setName('l_aspel/delete-l_aspel-delete-2'); // delete
        }
    );

    // l_flagprocedure
    $app->any('/LFlagprocedureList[/{id_procedure}]', LFlagprocedureController::class . ':list')->add(PermissionMiddleware::class)->setName('LFlagprocedureList-l_flagprocedure-list'); // list
    $app->any('/LFlagprocedureAdd[/{id_procedure}]', LFlagprocedureController::class . ':add')->add(PermissionMiddleware::class)->setName('LFlagprocedureAdd-l_flagprocedure-add'); // add
    $app->any('/LFlagprocedureView[/{id_procedure}]', LFlagprocedureController::class . ':view')->add(PermissionMiddleware::class)->setName('LFlagprocedureView-l_flagprocedure-view'); // view
    $app->any('/LFlagprocedureEdit[/{id_procedure}]', LFlagprocedureController::class . ':edit')->add(PermissionMiddleware::class)->setName('LFlagprocedureEdit-l_flagprocedure-edit'); // edit
    $app->any('/LFlagprocedureDelete[/{id_procedure}]', LFlagprocedureController::class . ':delete')->add(PermissionMiddleware::class)->setName('LFlagprocedureDelete-l_flagprocedure-delete'); // delete
    $app->group(
        '/l_flagprocedure',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_procedure}]', LFlagprocedureController::class . ':list')->add(PermissionMiddleware::class)->setName('l_flagprocedure/list-l_flagprocedure-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_procedure}]', LFlagprocedureController::class . ':add')->add(PermissionMiddleware::class)->setName('l_flagprocedure/add-l_flagprocedure-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_procedure}]', LFlagprocedureController::class . ':view')->add(PermissionMiddleware::class)->setName('l_flagprocedure/view-l_flagprocedure-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_procedure}]', LFlagprocedureController::class . ':edit')->add(PermissionMiddleware::class)->setName('l_flagprocedure/edit-l_flagprocedure-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_procedure}]', LFlagprocedureController::class . ':delete')->add(PermissionMiddleware::class)->setName('l_flagprocedure/delete-l_flagprocedure-delete-2'); // delete
        }
    );

    // l_kelas
    $app->any('/LKelasList[/{id_kelas}]', LKelasController::class . ':list')->add(PermissionMiddleware::class)->setName('LKelasList-l_kelas-list'); // list
    $app->any('/LKelasAdd[/{id_kelas}]', LKelasController::class . ':add')->add(PermissionMiddleware::class)->setName('LKelasAdd-l_kelas-add'); // add
    $app->any('/LKelasView[/{id_kelas}]', LKelasController::class . ':view')->add(PermissionMiddleware::class)->setName('LKelasView-l_kelas-view'); // view
    $app->any('/LKelasEdit[/{id_kelas}]', LKelasController::class . ':edit')->add(PermissionMiddleware::class)->setName('LKelasEdit-l_kelas-edit'); // edit
    $app->any('/LKelasDelete[/{id_kelas}]', LKelasController::class . ':delete')->add(PermissionMiddleware::class)->setName('LKelasDelete-l_kelas-delete'); // delete
    $app->group(
        '/l_kelas',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_kelas}]', LKelasController::class . ':list')->add(PermissionMiddleware::class)->setName('l_kelas/list-l_kelas-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_kelas}]', LKelasController::class . ':add')->add(PermissionMiddleware::class)->setName('l_kelas/add-l_kelas-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_kelas}]', LKelasController::class . ':view')->add(PermissionMiddleware::class)->setName('l_kelas/view-l_kelas-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_kelas}]', LKelasController::class . ':edit')->add(PermissionMiddleware::class)->setName('l_kelas/edit-l_kelas-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_kelas}]', LKelasController::class . ':delete')->add(PermissionMiddleware::class)->setName('l_kelas/delete-l_kelas-delete-2'); // delete
        }
    );

    // l_pembiayaan
    $app->any('/LPembiayaanList[/{id_pembiayaan}]', LPembiayaanController::class . ':list')->add(PermissionMiddleware::class)->setName('LPembiayaanList-l_pembiayaan-list'); // list
    $app->any('/LPembiayaanAdd[/{id_pembiayaan}]', LPembiayaanController::class . ':add')->add(PermissionMiddleware::class)->setName('LPembiayaanAdd-l_pembiayaan-add'); // add
    $app->any('/LPembiayaanView[/{id_pembiayaan}]', LPembiayaanController::class . ':view')->add(PermissionMiddleware::class)->setName('LPembiayaanView-l_pembiayaan-view'); // view
    $app->any('/LPembiayaanEdit[/{id_pembiayaan}]', LPembiayaanController::class . ':edit')->add(PermissionMiddleware::class)->setName('LPembiayaanEdit-l_pembiayaan-edit'); // edit
    $app->any('/LPembiayaanDelete[/{id_pembiayaan}]', LPembiayaanController::class . ':delete')->add(PermissionMiddleware::class)->setName('LPembiayaanDelete-l_pembiayaan-delete'); // delete
    $app->group(
        '/l_pembiayaan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_pembiayaan}]', LPembiayaanController::class . ':list')->add(PermissionMiddleware::class)->setName('l_pembiayaan/list-l_pembiayaan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_pembiayaan}]', LPembiayaanController::class . ':add')->add(PermissionMiddleware::class)->setName('l_pembiayaan/add-l_pembiayaan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_pembiayaan}]', LPembiayaanController::class . ':view')->add(PermissionMiddleware::class)->setName('l_pembiayaan/view-l_pembiayaan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_pembiayaan}]', LPembiayaanController::class . ':edit')->add(PermissionMiddleware::class)->setName('l_pembiayaan/edit-l_pembiayaan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_pembiayaan}]', LPembiayaanController::class . ':delete')->add(PermissionMiddleware::class)->setName('l_pembiayaan/delete-l_pembiayaan-delete-2'); // delete
        }
    );

    // l_penunjang
    $app->any('/LPenunjangList[/{id_penunjang}]', LPenunjangController::class . ':list')->add(PermissionMiddleware::class)->setName('LPenunjangList-l_penunjang-list'); // list
    $app->any('/LPenunjangAdd[/{id_penunjang}]', LPenunjangController::class . ':add')->add(PermissionMiddleware::class)->setName('LPenunjangAdd-l_penunjang-add'); // add
    $app->any('/LPenunjangView[/{id_penunjang}]', LPenunjangController::class . ':view')->add(PermissionMiddleware::class)->setName('LPenunjangView-l_penunjang-view'); // view
    $app->any('/LPenunjangEdit[/{id_penunjang}]', LPenunjangController::class . ':edit')->add(PermissionMiddleware::class)->setName('LPenunjangEdit-l_penunjang-edit'); // edit
    $app->any('/LPenunjangDelete[/{id_penunjang}]', LPenunjangController::class . ':delete')->add(PermissionMiddleware::class)->setName('LPenunjangDelete-l_penunjang-delete'); // delete
    $app->group(
        '/l_penunjang',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_penunjang}]', LPenunjangController::class . ':list')->add(PermissionMiddleware::class)->setName('l_penunjang/list-l_penunjang-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_penunjang}]', LPenunjangController::class . ':add')->add(PermissionMiddleware::class)->setName('l_penunjang/add-l_penunjang-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_penunjang}]', LPenunjangController::class . ':view')->add(PermissionMiddleware::class)->setName('l_penunjang/view-l_penunjang-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_penunjang}]', LPenunjangController::class . ':edit')->add(PermissionMiddleware::class)->setName('l_penunjang/edit-l_penunjang-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_penunjang}]', LPenunjangController::class . ':delete')->add(PermissionMiddleware::class)->setName('l_penunjang/delete-l_penunjang-delete-2'); // delete
        }
    );

    // l_tujuankunj
    $app->any('/LTujuankunjList[/{id_tujuan}]', LTujuankunjController::class . ':list')->add(PermissionMiddleware::class)->setName('LTujuankunjList-l_tujuankunj-list'); // list
    $app->any('/LTujuankunjAdd[/{id_tujuan}]', LTujuankunjController::class . ':add')->add(PermissionMiddleware::class)->setName('LTujuankunjAdd-l_tujuankunj-add'); // add
    $app->any('/LTujuankunjView[/{id_tujuan}]', LTujuankunjController::class . ':view')->add(PermissionMiddleware::class)->setName('LTujuankunjView-l_tujuankunj-view'); // view
    $app->any('/LTujuankunjEdit[/{id_tujuan}]', LTujuankunjController::class . ':edit')->add(PermissionMiddleware::class)->setName('LTujuankunjEdit-l_tujuankunj-edit'); // edit
    $app->any('/LTujuankunjDelete[/{id_tujuan}]', LTujuankunjController::class . ':delete')->add(PermissionMiddleware::class)->setName('LTujuankunjDelete-l_tujuankunj-delete'); // delete
    $app->group(
        '/l_tujuankunj',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_tujuan}]', LTujuankunjController::class . ':list')->add(PermissionMiddleware::class)->setName('l_tujuankunj/list-l_tujuankunj-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_tujuan}]', LTujuankunjController::class . ':add')->add(PermissionMiddleware::class)->setName('l_tujuankunj/add-l_tujuankunj-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_tujuan}]', LTujuankunjController::class . ':view')->add(PermissionMiddleware::class)->setName('l_tujuankunj/view-l_tujuankunj-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_tujuan}]', LTujuankunjController::class . ':edit')->add(PermissionMiddleware::class)->setName('l_tujuankunj/edit-l_tujuankunj-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_tujuan}]', LTujuankunjController::class . ':delete')->add(PermissionMiddleware::class)->setName('l_tujuankunj/delete-l_tujuankunj-delete-2'); // delete
        }
    );

    // m_dokter_bpjs
    $app->any('/MDokterBpjsList[/{id}]', MDokterBpjsController::class . ':list')->add(PermissionMiddleware::class)->setName('MDokterBpjsList-m_dokter_bpjs-list'); // list
    $app->any('/MDokterBpjsAdd[/{id}]', MDokterBpjsController::class . ':add')->add(PermissionMiddleware::class)->setName('MDokterBpjsAdd-m_dokter_bpjs-add'); // add
    $app->any('/MDokterBpjsView[/{id}]', MDokterBpjsController::class . ':view')->add(PermissionMiddleware::class)->setName('MDokterBpjsView-m_dokter_bpjs-view'); // view
    $app->any('/MDokterBpjsEdit[/{id}]', MDokterBpjsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MDokterBpjsEdit-m_dokter_bpjs-edit'); // edit
    $app->any('/MDokterBpjsDelete[/{id}]', MDokterBpjsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MDokterBpjsDelete-m_dokter_bpjs-delete'); // delete
    $app->group(
        '/m_dokter_bpjs',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', MDokterBpjsController::class . ':list')->add(PermissionMiddleware::class)->setName('m_dokter_bpjs/list-m_dokter_bpjs-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', MDokterBpjsController::class . ':add')->add(PermissionMiddleware::class)->setName('m_dokter_bpjs/add-m_dokter_bpjs-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', MDokterBpjsController::class . ':view')->add(PermissionMiddleware::class)->setName('m_dokter_bpjs/view-m_dokter_bpjs-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', MDokterBpjsController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_dokter_bpjs/edit-m_dokter_bpjs-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', MDokterBpjsController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_dokter_bpjs/delete-m_dokter_bpjs-delete-2'); // delete
        }
    );

    // m_jadwal
    $app->any('/MJadwalList[/{id_jadwal}]', MJadwalController::class . ':list')->add(PermissionMiddleware::class)->setName('MJadwalList-m_jadwal-list'); // list
    $app->any('/MJadwalAdd[/{id_jadwal}]', MJadwalController::class . ':add')->add(PermissionMiddleware::class)->setName('MJadwalAdd-m_jadwal-add'); // add
    $app->any('/MJadwalView[/{id_jadwal}]', MJadwalController::class . ':view')->add(PermissionMiddleware::class)->setName('MJadwalView-m_jadwal-view'); // view
    $app->any('/MJadwalEdit[/{id_jadwal}]', MJadwalController::class . ':edit')->add(PermissionMiddleware::class)->setName('MJadwalEdit-m_jadwal-edit'); // edit
    $app->any('/MJadwalDelete[/{id_jadwal}]', MJadwalController::class . ':delete')->add(PermissionMiddleware::class)->setName('MJadwalDelete-m_jadwal-delete'); // delete
    $app->group(
        '/m_jadwal',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_jadwal}]', MJadwalController::class . ':list')->add(PermissionMiddleware::class)->setName('m_jadwal/list-m_jadwal-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_jadwal}]', MJadwalController::class . ':add')->add(PermissionMiddleware::class)->setName('m_jadwal/add-m_jadwal-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_jadwal}]', MJadwalController::class . ':view')->add(PermissionMiddleware::class)->setName('m_jadwal/view-m_jadwal-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_jadwal}]', MJadwalController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_jadwal/edit-m_jadwal-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_jadwal}]', MJadwalController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_jadwal/delete-m_jadwal-delete-2'); // delete
        }
    );

    // m_poli_bpjs
    $app->any('/MPoliBpjsList[/{id}]', MPoliBpjsController::class . ':list')->add(PermissionMiddleware::class)->setName('MPoliBpjsList-m_poli_bpjs-list'); // list
    $app->any('/MPoliBpjsAdd[/{id}]', MPoliBpjsController::class . ':add')->add(PermissionMiddleware::class)->setName('MPoliBpjsAdd-m_poli_bpjs-add'); // add
    $app->any('/MPoliBpjsView[/{id}]', MPoliBpjsController::class . ':view')->add(PermissionMiddleware::class)->setName('MPoliBpjsView-m_poli_bpjs-view'); // view
    $app->any('/MPoliBpjsEdit[/{id}]', MPoliBpjsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MPoliBpjsEdit-m_poli_bpjs-edit'); // edit
    $app->any('/MPoliBpjsDelete[/{id}]', MPoliBpjsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MPoliBpjsDelete-m_poli_bpjs-delete'); // delete
    $app->group(
        '/m_poli_bpjs',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', MPoliBpjsController::class . ':list')->add(PermissionMiddleware::class)->setName('m_poli_bpjs/list-m_poli_bpjs-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', MPoliBpjsController::class . ':add')->add(PermissionMiddleware::class)->setName('m_poli_bpjs/add-m_poli_bpjs-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', MPoliBpjsController::class . ':view')->add(PermissionMiddleware::class)->setName('m_poli_bpjs/view-m_poli_bpjs-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', MPoliBpjsController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_poli_bpjs/edit-m_poli_bpjs-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', MPoliBpjsController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_poli_bpjs/delete-m_poli_bpjs-delete-2'); // delete
        }
    );

    // referensi_mobilejkn_bpjs
    $app->any('/ReferensiMobilejknBpjsList[/{id}]', ReferensiMobilejknBpjsController::class . ':list')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsList-referensi_mobilejkn_bpjs-list'); // list
    $app->any('/ReferensiMobilejknBpjsAdd[/{id}]', ReferensiMobilejknBpjsController::class . ':add')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsAdd-referensi_mobilejkn_bpjs-add'); // add
    $app->any('/ReferensiMobilejknBpjsView[/{id}]', ReferensiMobilejknBpjsController::class . ':view')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsView-referensi_mobilejkn_bpjs-view'); // view
    $app->any('/ReferensiMobilejknBpjsEdit[/{id}]', ReferensiMobilejknBpjsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsEdit-referensi_mobilejkn_bpjs-edit'); // edit
    $app->any('/ReferensiMobilejknBpjsDelete[/{id}]', ReferensiMobilejknBpjsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsDelete-referensi_mobilejkn_bpjs-delete'); // delete
    $app->group(
        '/referensi_mobilejkn_bpjs',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ReferensiMobilejknBpjsController::class . ':list')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs/list-referensi_mobilejkn_bpjs-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ReferensiMobilejknBpjsController::class . ':add')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs/add-referensi_mobilejkn_bpjs-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ReferensiMobilejknBpjsController::class . ':view')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs/view-referensi_mobilejkn_bpjs-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ReferensiMobilejknBpjsController::class . ':edit')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs/edit-referensi_mobilejkn_bpjs-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ReferensiMobilejknBpjsController::class . ':delete')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs/delete-referensi_mobilejkn_bpjs-delete-2'); // delete
        }
    );

    // referensi_mobilejkn_bpjs_batal
    $app->any('/ReferensiMobilejknBpjsBatalList[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':list')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsBatalList-referensi_mobilejkn_bpjs_batal-list'); // list
    $app->any('/ReferensiMobilejknBpjsBatalAdd[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':add')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsBatalAdd-referensi_mobilejkn_bpjs_batal-add'); // add
    $app->any('/ReferensiMobilejknBpjsBatalView[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':view')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsBatalView-referensi_mobilejkn_bpjs_batal-view'); // view
    $app->any('/ReferensiMobilejknBpjsBatalEdit[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':edit')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsBatalEdit-referensi_mobilejkn_bpjs_batal-edit'); // edit
    $app->any('/ReferensiMobilejknBpjsBatalDelete[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':delete')->add(PermissionMiddleware::class)->setName('ReferensiMobilejknBpjsBatalDelete-referensi_mobilejkn_bpjs_batal-delete'); // delete
    $app->group(
        '/referensi_mobilejkn_bpjs_batal',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':list')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs_batal/list-referensi_mobilejkn_bpjs_batal-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':add')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs_batal/add-referensi_mobilejkn_bpjs_batal-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':view')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs_batal/view-referensi_mobilejkn_bpjs_batal-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':edit')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs_batal/edit-referensi_mobilejkn_bpjs_batal-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{nobooking}]', ReferensiMobilejknBpjsBatalController::class . ':delete')->add(PermissionMiddleware::class)->setName('referensi_mobilejkn_bpjs_batal/delete-referensi_mobilejkn_bpjs_batal-delete-2'); // delete
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
