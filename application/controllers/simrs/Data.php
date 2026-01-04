<?php
// Final Version of SIMRS Data Controller !
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends Admin_Controller {
  // Controller u Handle Permintaan Data User Oleh SIMRS
  protected $permission;
  public function __construct(){
    // Construct & Model
    parent::__construct();
    $this->permission = 'mintadata';
    $this->load->model('data_model', 'datamodel');
  }

  public function index(){
    // Controller u Menampilkan Seluruh Permintaan Data (Tabel)
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->datamodel->TabelMintaData();
    // File
    $this->data['title'] = "Tabel History Permintaan Data User";
    $this->data['sub_page'] = 'simrs/data/index';
    $this->data['main_menu'] = 'simrs';
    $this->load->view('layout/index', $this->data);
  }

  public function detail($uuid){
    // Controller u Melihat Sebuah Detail Pada Permintaan User
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->datamodel->DetailMintaData($uuid);
    // File
    $this->data['title'] = "Detail Permintaan User";
    $this->data['sub_page'] = 'simrs/data/detail';
    $this->data['main_menu'] = 'simrs';
    $this->load->view('layout/index', $this->data);
  }

  public function delete($uuid){
    // Controller u Melakukan Delete Selagi Status Minta Pending
    if (!get_permission($this->permission, 'is_delete')) {
      access_denied();
    }
    // Model Delete
    $affected = $this->datamodel->DeleteMintaData($uuid);
    // Alert
    if ($affected > 0) {
      show_alert('success', 'Proses Penghapusan Permintaan Data Berhasil !');
    } else {
      show_alert('error', 'Proses Penghapusan Permintaan Data Gagal !');
    }
    // Kembali
    redirect(base_url('simrs/data/'));
  }

  public function selesai(){
    // Controller u Manipulasi Status Terkait Permintaan Data User
    if (!get_permission($this->permission, 'is_edit')) {
      access_denied();
    }
    // File Result
    $this->datamodel->Finaly($this->input->post());
    // File
    redirect(base_url('simrs/data/'));
  }
}
?>