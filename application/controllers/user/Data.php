<?php
// Final Version of User Melakukan Minta Data Controller !
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends Admin_Controller {
  // Controller u Handle Permintaan Data Oleh User
  protected $permission;
  public function __construct(){
    // Construct & Model
    parent::__construct();
    $this->permission = 'mintadata';
    $this->load->model('data_model', 'datamodel');
  }

  public function index(){
    // Controller u Menampilkan Permintaan Data Oleh Single User
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File
    $this->data['title'] = "Tabel History Permintaan Data User";
    $this->data['sub_page'] = 'user/data/index';
    $this->data['main_menu'] = 'user';
    $this->load->view('layout/index', $this->data);
  }

  public function tabel_historia(){
    // Controller u Menampilkan Data Tabel Historia via Ajax
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // Retrieve Data from Model
    $data = $this->datamodel->TabelMintaDataUser();
    // Return as JSON
    echo json_encode($data);
  }

  public function insert(){
    // Controller u Melakukan Input Permintaan Data User
    if (!get_permission($this->permission, 'is_add')) {
      access_denied();
    }
    // File
    $this->data['title'] = "Input Permintaan Data User";
    $this->data['sub_page'] = 'user/data/insert';
    $this->data['main_menu'] = 'user';
    $this->load->view('layout/index', $this->data);
  }

  public function publish(){
    // Controller u Melakukan Publish Input Permintaan Data User
    if (!get_permission($this->permission, 'is_add')) {
      access_denied();
    }
    // Variable
    $inputs = $this->input->post();
    // Auto Start Transaction
    $this->db->trans_start();
    // File Model
    if (isset($_FILES['uploadfiles']) && $_FILES['uploadfiles']['error'] === UPLOAD_ERR_OK) {
      // File Variable
      $files = $_FILES['uploadfiles']['name'];
      $uploads = "uploads/aplikasi/data/" . $files;
      if (move_uploaded_file($_FILES['uploadfiles']['tmp_name'], $uploads)) {
        // Insert to Array
        $inputs['uploadfiles'] = $files;
      }
    }
    // Publish
    $this->datamodel->PublishMintaData($inputs);
    // Auto Complete
    $this->db->trans_complete();
    // Response Status
    if ($this->db->trans_status() === FALSE) {
      // Fail
      set_alert('error', "Input Permintaan Data Gagal !");
    } else {
      set_alert('success', "Input Permintaan Data Berhasil !");
    }
    redirect(base_url('user/data/'));
  }

  public function update($uuid){
    // Controller u Melakukan Update Pada Input Permintaan Data User Selagi Pending
    if (!get_permission($this->permission, 'is_edit')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->datamodel->DetailMintaData($uuid);
    // File
    $this->data['title'] = "Update Permintaan Data User";
    $this->data['sub_page'] = 'user/data/update';
    $this->data['main_menu'] = 'user';
    $this->load->view('layout/index', $this->data);
  }

  public function detail($uuid){
    // Controller u Melihat Detail Pada Permintaan Data User
    if (!get_permission($this->permission, 'is_view')) {
      access_denied();
    }
    // File Result
    $this->data['result'] = $this->datamodel->DetailMintaData($uuid);
    // File
    $this->data['title'] = "Detail Permintaan Data User";
    $this->data['sub_page'] = 'user/data/detail';
    $this->data['main_menu'] = 'user';
    $this->load->view('layout/index', $this->data);
  }

  public function delete($uuid){
    // Controller u Melakukan Penghapusan Input Permintaan Data
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
    redirect(base_url('user/data/'));
  }
}
?>