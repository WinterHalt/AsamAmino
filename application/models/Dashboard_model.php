<?php
// Final Version of Dashboard Model !
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends MY_Model {
  // Dashboard Model Responsible on Dashboard Controller !
  public function __construct(){
    // Const Parent
    parent::__construct();
  }

  public function TotalMintaData(){
    // Query Total Minta Data Oleh Seluruh User
    return $this->db->count_all('tabel_minta_data');
  }

  public function TotalMintaAplikasi(){
    // Query Total Minta Aplikasi Oleh Seluruh User
    return $this->db->count_all('tabel_minta_aplikasi');
  }

  public function TotalPelaporanMasalah(){
    // Query Total Pelaporan Masalah u Kebutuhan SIMRS
    return $this->db->count_all('tabel_pelaporan_issue');
  }

  public function TotalMasalah(){
    // Query Kategori Masalah u Chart JS
    $this->db->select('kategorikal, COUNT(*) as total');
    $this->db->from('tabel_pelaporan_issue');
    $this->db->group_by('kategorikal');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function TotalTimeResolve(){
    echo "Hallo Masalah !";
  }
}
?>