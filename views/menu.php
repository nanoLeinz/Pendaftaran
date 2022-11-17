<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(6290, "mi_booking_operasi", $MenuLanguage->MenuPhrase("6290", "MenuText"), $MenuRelativePath . "BookingOperasiList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}booking_operasi'), false, false, "", "", false);
$sideMenu->addMenuItem(6291, "mi_l_aspel", $MenuLanguage->MenuPhrase("6291", "MenuText"), $MenuRelativePath . "LAspelList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}l_aspel'), false, false, "", "", false);
$sideMenu->addMenuItem(6292, "mi_l_flagprocedure", $MenuLanguage->MenuPhrase("6292", "MenuText"), $MenuRelativePath . "LFlagprocedureList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}l_flagprocedure'), false, false, "", "", false);
$sideMenu->addMenuItem(6293, "mi_l_kelas", $MenuLanguage->MenuPhrase("6293", "MenuText"), $MenuRelativePath . "LKelasList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}l_kelas'), false, false, "", "", false);
$sideMenu->addMenuItem(6294, "mi_l_pembiayaan", $MenuLanguage->MenuPhrase("6294", "MenuText"), $MenuRelativePath . "LPembiayaanList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}l_pembiayaan'), false, false, "", "", false);
$sideMenu->addMenuItem(6295, "mi_l_penunjang", $MenuLanguage->MenuPhrase("6295", "MenuText"), $MenuRelativePath . "LPenunjangList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}l_penunjang'), false, false, "", "", false);
$sideMenu->addMenuItem(6296, "mi_l_tujuankunj", $MenuLanguage->MenuPhrase("6296", "MenuText"), $MenuRelativePath . "LTujuankunjList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}l_tujuankunj'), false, false, "", "", false);
$sideMenu->addMenuItem(6297, "mi_m_dokter_bpjs", $MenuLanguage->MenuPhrase("6297", "MenuText"), $MenuRelativePath . "MDokterBpjsList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}m_dokter_bpjs'), false, false, "", "", false);
$sideMenu->addMenuItem(6298, "mi_m_jadwal", $MenuLanguage->MenuPhrase("6298", "MenuText"), $MenuRelativePath . "MJadwalList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}m_jadwal'), false, false, "", "", false);
$sideMenu->addMenuItem(6299, "mi_m_poli_bpjs", $MenuLanguage->MenuPhrase("6299", "MenuText"), $MenuRelativePath . "MPoliBpjsList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}m_poli_bpjs'), false, false, "", "", false);
$sideMenu->addMenuItem(6300, "mi_referensi_mobilejkn_bpjs", $MenuLanguage->MenuPhrase("6300", "MenuText"), $MenuRelativePath . "ReferensiMobilejknBpjsList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}referensi_mobilejkn_bpjs'), false, false, "", "", false);
$sideMenu->addMenuItem(6301, "mi_referensi_mobilejkn_bpjs_batal", $MenuLanguage->MenuPhrase("6301", "MenuText"), $MenuRelativePath . "ReferensiMobilejknBpjsBatalList", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}referensi_mobilejkn_bpjs_batal'), false, false, "", "", false);
$sideMenu->addMenuItem(6281, "mi_Dashboard2", $MenuLanguage->MenuPhrase("6281", "MenuText"), $MenuRelativePath . "Dashboard2", -1, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}Dashboard'), false, false, "", "", false);
$sideMenu->addMenuItem(467, "mci_Pendaftaran", $MenuLanguage->MenuPhrase("467", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(6288, "mi_cv_pasien", $MenuLanguage->MenuPhrase("6288", "MenuText"), $MenuRelativePath . "CvPasienList", 467, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}cv_pasien'), false, false, "", "", false);
$sideMenu->addMenuItem(6289, "mi_cv_visit", $MenuLanguage->MenuPhrase("6289", "MenuText"), $MenuRelativePath . "CvVisitList", 467, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}cv_visit'), false, false, "", "", false);
$sideMenu->addMenuItem(6269, "mi_v_riwayat_sep", $MenuLanguage->MenuPhrase("6269", "MenuText"), $MenuRelativePath . "VRiwayatSepList", 467, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}v_riwayat_sep'), false, false, "", "", false);
$sideMenu->addMenuItem(471, "mi_V_DAFTAR_PASIEN", $MenuLanguage->MenuPhrase("471", "MenuText"), $MenuRelativePath . "VDaftarPasienList", 467, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}V_DAFTAR_PASIEN'), false, false, "", "", false);
$sideMenu->addMenuItem(2837, "mci_Laporan", $MenuLanguage->MenuPhrase("2837", "MenuText"), "", 467, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(2840, "mi_V_SENSUS", $MenuLanguage->MenuPhrase("2840", "MenuText"), $MenuRelativePath . "VSensusList", 2837, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}V_SENSUS'), false, false, "", "", false);
$sideMenu->addMenuItem(6267, "mi_V_KUNJUNGAN", $MenuLanguage->MenuPhrase("6267", "MenuText"), $MenuRelativePath . "VKunjunganList", 2837, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}V_KUNJUNGAN'), false, false, "", "", false);
$sideMenu->addMenuItem(321, "mi_PASIEN_VISITATION", $MenuLanguage->MenuPhrase("321", "MenuText"), $MenuRelativePath . "PasienVisitationList?cmd=resetall", 468, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}PASIEN_VISITATION'), false, false, "", "", false);
$sideMenu->addMenuItem(4786, "mci_Laporan", $MenuLanguage->MenuPhrase("4786", "MenuText"), "", 468, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(4287, "mi_register_pasien", $MenuLanguage->MenuPhrase("4287", "MenuText"), $MenuRelativePath . "RegisterPasien", 4786, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}register_pasien'), false, false, "", "", false);
$sideMenu->addMenuItem(5274, "mi_register_cara_bayar", $MenuLanguage->MenuPhrase("5274", "MenuText"), $MenuRelativePath . "RegisterCaraBayar", 4786, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}register_cara_bayar'), false, false, "", "", false);
$sideMenu->addMenuItem(6282, "mi_register_perpoli_harian", $MenuLanguage->MenuPhrase("6282", "MenuText"), $MenuRelativePath . "RegisterPerpoliHarian", 4786, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}register_perpoli_harian'), false, false, "", "", false);
$sideMenu->addMenuItem(6283, "mi_register_perpoli_bulanan", $MenuLanguage->MenuPhrase("6283", "MenuText"), $MenuRelativePath . "RegisterPerpoliBulanan", 4786, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}register_perpoli_bulanan'), false, false, "", "", false);
$sideMenu->addMenuItem(6284, "mi_register_perpoli_tahunan", $MenuLanguage->MenuPhrase("6284", "MenuText"), $MenuRelativePath . "RegisterPerpoliTahunan", 4786, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}register_perpoli_tahunan'), false, false, "", "", false);
$sideMenu->addMenuItem(3323, "mci_Master", $MenuLanguage->MenuPhrase("3323", "MenuText"), "", 468, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(148, "mi_EMPLOYEE_ALL", $MenuLanguage->MenuPhrase("148", "MenuText"), $MenuRelativePath . "EmployeeAllList", 3323, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}EMPLOYEE_ALL'), false, false, "", "", false);
$sideMenu->addMenuItem(1883, "mci_Mutasi_Barang", $MenuLanguage->MenuPhrase("1883", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(1887, "mci_Permintaan_Barang_Alkes", $MenuLanguage->MenuPhrase("1887", "MenuText"), $MenuRelativePath . "MutationDocsAdd", 1883, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(284, "mi_MUTATION_DOCS", $MenuLanguage->MenuPhrase("284", "MenuText"), $MenuRelativePath . "MutationDocsList", 1883, "", AllowListMenu('{67E7B67B-A753-4E5E-ACF9-6EF1B38EF4E3}MUTATION_DOCS'), false, false, "", "", false);
echo $sideMenu->toScript();
