<?php
// Final Version of User Minta Aplikasi Controller !
defined('BASEPATH') or exit('No direct script access allowed');

class Aplikasi extends Admin_Controller {
  // Controller u Handle User Minta Aplikasi
  protected $permission;
  public function __construct(){
    // Construct & Model
    parent::__construct();
    $this->permission = 'aplikasi';
    $this->load->model('aplikasi_model', 'aplimodel');
  }

  public function index(){
    // Controller u Menampilkan History Permintaan Aplikasi User
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File
    $this->data['title'] = "History Permintaan Aplikasi User";
    $this->data['sub_page'] = 'user/aplikasi/index';
    $this->data['main_menu'] = 'user';
    $this->load->view('layout/index', $this->data);
  }

  public function tabel_historia(){
    // Controller u Menampilkan Data Histori Via Ajax
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // Retrieve Data from Model
    $data = $this->aplimodel->TabelMintaAplikasiUser();
    // Return as JSON
    echo json_encode($data);
  }

  public function insert(){
    // Controller u Handle Insert File Permintaan Aplikasi
    if (!get_permission($this->permission, 'is_add')) {
      access_denied();
    }
    // File
    $this->data['title'] = "Input Permintaan Aplikasi User";
    $this->data['sub_page'] = 'user/aplikasi/insert';
    $this->data['main_menu'] = 'user';
    $this->load->view('layout/index', $this->data);
  }

  public function publish(){
    // Controller u Melakukan Publish Permintaan Aplikasi Oleh User
    if (!get_permission($this->permission, 'is_add')) {
      access_denied();
    }
    // Variable 
    $inputs = $this->input->post();
    // Auto Start Transaction
    $this->db->trans_start();
    // File Model Alur Aplikasi
    if (isset($_FILES['alurfile']) && $_FILES['alurfile']['error'] === UPLOAD_ERR_OK) {
      // File Variable
      $files = $_FILES['alurfile']['name'];
      $uploads = "uploads/aplikasi/aplikasi/alur/" . $files;
      if (move_uploaded_file($_FILES['alurfile']['tmp_name'], $uploads)) {
        // Insert to Array
        $inputs['alur'] = $files;
      }
    }
    // File Model Surat Aplikasi
    if (isset($_FILES['suratfile']) && $_FILES['suratfile']['error'] === UPLOAD_ERR_OK) {
      // File Variable
      $files = $_FILES['suratfile']['name'];
      $uploads = "uploads/aplikasi/aplikasi/surat/" . $files;
      if (move_uploaded_file($_FILES['suratfile']['tmp_name'], $uploads)) {
        // Insert to Array
        $inputs['surat'] = $files;
      }
    }
    // Publish
    $this->aplimodel->PublishMintaAplikasi($inputs);
    // Auto Complete
    $this->db->trans_complete();
    // Response Status
    if ($this->db->trans_status() === FALSE) {
      // Fail
      set_alert('error', "Input Permintaan Aplikasi Gagal !");
    } else {
      set_alert('success', "Input Permintaan Aplikasi Berhasil !");
    }
    redirect(base_url('user/aplikasi/'));
  }

  public function update($uuid){
    // Controller u Melakukan Perubahan Permintaan Aplikasi Oleh User Selagi Pending
    if (!get_permission($this->permission, 'is_edit')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->aplimodel->DetailMintaAplikasi($uuid);
    // File
    $this->data['title'] = "Update Permintaan Aplikasi User";
    $this->data['sub_page'] = 'user/aplikasi/update';
    $this->data['main_menu'] = 'user';
    $this->load->view('layout/index', $this->data);
  }

  public function detail($uuid){
    // Controller u Menampilkan Detail Permintaan Aplikasi
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->aplimodel->DetailMintaAplikasi($uuid);
    // File
    $this->data['title'] = "Detail Permintaan Aplikasi User";
    $this->data['sub_page'] = 'user/aplikasi/detail';
    $this->data['main_menu'] = 'user';
    $this->load->view('layout/index', $this->data);
  }

  public function delete($uuid){
    // Controller u Menghapus Permintaan Aplikasi User Selagi Status Pending
    if (!get_permission($this->permission, 'is_delete')) {
      access_denied();
    }
    // Model Delete
    $this->aplimodel->DeleteMintaAplikasi($uuid);
    // Return Url
    redirect(base_url('user/aplikasi/'));
  }
}
?>