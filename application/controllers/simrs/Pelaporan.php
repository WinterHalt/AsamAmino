<?php
// Final Version of SIMRS Controller u Pelaporan Masalah !
defined('BASEPATH') or exit('No direct script access allowed');

class Pelaporan extends Admin_Controller {
  // Controller u Handle Pelaporan Masalah User Oleh SIMRS
  protected $permission;
  public function __construct(){
    // Construct & Model
    parent::__construct();
    $this->permission = 'laporan';
    $this->load->model('pelaporan_model', 'pelamodel');
  }

  public function index(){
    // Controller u Menampilkan Seluruh Laporan Masalah User (Tabel)
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->pelamodel->TabelMasalah();
    // File
    $this->data['title'] = "Tabel Pelaporan Masalah User";
    $this->data['sub_page'] = 'simrs/pelaporan/index';
    $this->data['main_menu'] = 'simrs';
    $this->load->view('layout/index', $this->data);
  }

  public function detail($uuid){
    // Controller u Melihat Detail Pelaporan Masalah User
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->pelamodel->DetailPelaporan($uuid);
    // File
    $this->data['title'] = "Detail Pelaporan Masalah User";
    $this->data['sub_page'] = 'simrs/pelaporan/detail';
    $this->data['main_menu'] = 'simrs';
    $this->load->view('layout/index', $this->data);
  }

  public function delete($uuid){
    // Controller u Delete Pelaporan Masalah User Selagi Pending
    if (!get_permission($this->permission, 'is_delete')) {
      access_denied();
    }
    // Model Delete
    $this->pelamodel->DeleteMintaData($uuid);
    // Kembali
    redirect(base_url('simrs/pelaporan/'));
  }

  public function selesai(){
    // Controller u Manipulasi Level Follow Up Masalah & Jenis Masalah
    if (!get_permission($this->permission, 'is_edit')) {
      access_denied();
    }
    // File Result
    $this->pelamodel->Finaly($this->input->post());
    // Kembali
    redirect(base_url('simrs/pelaporan/'));
  }
}
?>