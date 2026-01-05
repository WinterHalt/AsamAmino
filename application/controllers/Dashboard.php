<?php
// Final Version of SIMRS Dashboard Controller !
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
  // Controller u Handle Primary Dashboard SIMRS
  protected $permission;
  public function __construct(){
    // Construct & Model
    parent::__construct();
    $this->permission = 'dashboard';
    $this->load->model('dashboard_model');
  }

  public function index(){
    // Single File of Dashboard Controller Main File
    // Model on Total of Data
    $this->data['total_minta_data'] = $this->dashboard_model->TotalMintaData();
    $this->data['total_minta_aplikasi'] = $this->dashboard_model->TotalMintaAplikasi();
    $this->data['total_pelaporan_masalah'] = $this->dashboard_model->TotalPelaporanMasalah();
    // Plotly
    $barplot = $this->dashboard_model->TotalMasalah();
    // Variable
    $label = []; $total = [];
    // Push to Arrays
    foreach($barplot as $data){
      $label[] = $data['kategorikal']; 
      $total[] = (int) $data['total'];
    }
    // Result Plot Label
    $this->data['label_masalah'] = json_encode($label);
    // Result Plot Total
    $this->data['total_masalah'] = json_encode($total);
    // File
    $this->data['title'] = translate('dashboard');
    $this->data['sub_page'] = 'dashboard/index';
    $this->data['main_menu'] = 'dashboard';
    $this->load->view('layout/index', $this->data);
  }
}
?>