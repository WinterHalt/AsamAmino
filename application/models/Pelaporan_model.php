<?php
// Final Version of Pelaporan Model to Support User & SIMRS Controller !
defined('BASEPATH') or exit('No direct script access allowed');

class Pelaporan_model extends MY_Model {
  // Pelaporan Model Responsible on Pelaporan Masalah Controller
  public function __construct(){
    // Const Parent
    parent::__construct();
  }

  // ==================================
  // Part Multi User Controller
  // ==================================
  public function DeletePelaporan($uuid){
    // Delete Pelaporan Masalah Kalau Status Pending
    $this->db->where('uuid', $uuid);
    $this->db->where('status', 'Pending');
    $this->db->delete('tabel_pelaporan_issue');
  }

  // ==================================
  // Part 01 : User
  // ==================================

  // ==================================
  // Part 02 : Adminul Mukminin
  // ==================================

  // ==================================
  // Part 03 : Timer
  // ==================================
  public function TotalSelisih($uuid){
    // Total Selisih Waktu Satu Masalah Antar Status
    $column = "lanjut, selesai, total";
    $this->db->select($column);
    $this->db->where('uuid', $uuid);
    $query = $this->db->get('issue_log_report');
    return $query->row_array();
  }
}
?>