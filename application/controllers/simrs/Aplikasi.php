<?php
// Final Version of SIMRS Controller u Handle User Minta Aplikasi !
defined('BASEPATH') or exit('No direct script access allowed');

class Aplikasi extends Admin_Controller {
  // Controller u Handle Permintaan Aplikasi User Oleh SIMRS
  protected $permission;
  public function __construct(){
    // Construct & Model
    parent::__construct();
    $this->permission = 'aplikasi';
    $this->load->model('aplikasi_model', 'aplimodel');
  }

  public function index(){
    // Controller u Menampilkan Seluruh Permintaan Aplikasi User (Tabel)
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }    
    // File
    $this->data['title'] = "Tabel History Permintaan Aplikasi";
    $this->data['sub_page'] = 'simrs/aplikasi/index';
    $this->data['main_menu'] = 'simrs';
    $this->load->view('layout/index', $this->data);
  }

  public function tabel_historia(){
    // Controller u Menampilkan Tabel Historia Permintaan Aplikasi User (AJAX)
    // Retrieve Variable
    $start = $this->input->get('start');
    $final = $this->input->get('final');
    // Retrieve Data from Model
    $data = $this->aplimodel->TabelMintaAplikasiHist($start, $final);
    // Return as JSON
    echo json_encode($data);
  }

  public function detail($uuid){
    // Controller u Menampilkan Detail Permintaan Aplikasi User
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->aplimodel->DetailMintaAplikasi($uuid);
    // File
    $this->data['title'] = "Detail Permintaan Aplikasi";
    $this->data['sub_page'] = 'simrs/aplikasi/detail';
    $this->data['main_menu'] = 'simrs';
    $this->load->view('layout/index', $this->data);
  }

  public function delete($uuid){
    // Controller u Delete Permintaan Aplikasi Selagi Status Pending
    if (!get_permission($this->permission, 'is_delete')) {
      access_denied();
    }
    // Model Delete
    $this->aplimodel->DeleteMintaAplikasi($uuid);
    // Kembali
    redirect(base_url('admin/aplikasi/'));
  }

  public function selesai(){
    // Controller u Menyelesaikan Proses Permintaan Aplikasi User
    if (!get_permission($this->permission, 'is_edit')) {
      access_denied();
    }
    // File Result
    $this->aplimodel->Finaly($this->input->post());
    // Kembali
    redirect(base_url('simrs/aplikasi/'));
  }
}

?>