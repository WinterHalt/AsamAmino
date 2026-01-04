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
}
?>