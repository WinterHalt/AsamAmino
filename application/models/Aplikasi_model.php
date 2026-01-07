<?php
// Final Version of Minta Aplikasi Model to Support User & SIMRS Controller !
defined('BASEPATH') or exit('No direct script access allowed');

class Aplikasi_model extends MY_Model {
  // Aplikasi Model Responsible on Minta Aplikasi Controller
  public function __construct(){
    // Const Parent
    parent::__construct();
  }

  // =====================================
  // Part Multi User Controller
  // =====================================
  public function PublishMintaAplikasi($inputs){
    // Publish Input Permintaan Aplikasi Oleh User
    if (!empty($inputs["uuid"])) {
      // Update Existing Data
      return $this->db->update('tabel_minta_aplikasi', $inputs, ['uuid' => $inputs['uuid']]);
    }
    $inputs['uuid'] = $this->uuid->v4();
    // Publish to Tabel Minta Aplikasi
    return $this->db->insert('tabel_minta_aplikasi', $inputs);
  }

  public function DetailMintaAplikasi($uuid){
    // Detail Terkait Input Permintaan Aplikasi User
    $filter = ['uuid' => $uuid];
    // Return Result
    return $this->db->get_where('join_permintaan_aplikasi', $filter)->row_array();
  }

  public function DeleteMintaAplikasi($uuid){
    // Delete Permintaan Aplikasi User Selagi Status Pending
    return $this->db->where('uuid', $uuid)->delete('tabel_minta_aplikasi');
  }

  // ==================================
  // Part 01 : User
  // ==================================
  public function TabelMintaAplikasiUser(){
    // Menampilkan Data Histori Permintaan Aplikasi Oleh User Tertentu
    // Define Multi Variable
    $user = get_user_name(false)[1];
    $column = "uuid, tanggal_pengajuan, unit, pengusul, judul, surat, alur, status";
    $table = "join_permintaan_aplikasi";
    // Return Result
    return $this->db->select($column)->from($table)->where('pengusul', $user)->get()->result_array();
  }

  // ==================================
  // Part 02 : Adminul Mukminin
  // ==================================
  public function TabelMintaAplikasiHist($start, $final){
    // Menampilkan Data Histori Permintaan Aplikasi Oleh Seluruh User
    $column = "uuid, tanggal_pengajuan, unit, pengusul, judul, surat, alur, status";
    $filter = ['DATE(tanggal_pengajuan) >=' => $start, 'DATE(tanggal_pengajuan) <=' => $final];
    // Return Result
    $this->db->select($column);
    $this->db->where($filter);
    $this->db->order_by('tanggal_pengajuan', 'DESC');
    return $this->db->get('join_permintaan_aplikasi')->result_array();
  }

  public function Finaly($inputs){
    // Function to Close User Request on Aplikasi, Available Status "Pending, Kondisional, Terima"
    $filter = ['uuid' => $inputs['uuid']];
    $alasan = empty($inputs['alasan']) ? 'Usulan Diterima' : $inputs['alasan'];
    $publish = ["status" => $inputs['status'], "alasan" => $alasan];
    return $this->db->update('tabel_minta_aplikasi', $publish, $filter);
  }
}
?>