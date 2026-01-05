<?php
// Final Version of Data Model to Support User & SIMRS Controller !
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends MY_Model {
  // Data Model Responsible on Minta Data Controller
  public function __construct(){
    // Const Parent
    parent::__construct();
  }

  // ==================================
  // Part Multi User Controller
  // ==================================
  public function PublishMintaData($uuid){
    // Publish Input Permintaan Data User
    if (!empty($inputs["uuid"])) {
      // Update Existing Data
      return $this->db->update('tabel_minta_data', $inputs, ['uuid' => $inputs['uuid']]);
    }
    $inputs['uuid'] = $this->uuid->v4();
    // Publish to Tabel Minta Data
    return $this->db->insert('tabel_minta_data', $inputs);
  }

  public function DetailMintaData($uuid){
    // Retrieve Detail Minta on Certain Key Identifier
    $column = "tmd.*, s.name AS user, s.staff_id AS said";
    $joined = "JOIN staff s ON tmd.user = s.staff_id";
    $sqlquery = "SELECT $column FROM tabel_minta_data tmd $joined WHERE tmd.uuid = ?";  
    // Return Result
    return $this->db->query($sqlquery, [$uuid])->row_array();
  }

  public function DeleteMintaData($uuid){
    // Delete Data if Data Still Pending
    $this->db->where('uuid', $uuid);
    $this->db->where('status', 'Pending');
    $this->db->delete('tabel_minta_data');
    return $this->db->affected_rows();
  }

  // ==================================
  // Part 01 : User
  // ==================================
  public function TabelMintaDataUser(){
    // Retrieve Table Content on User Staff
    $column = "s.name, tmd.tanggal, tmd.status, tmd.uploadfiles, tmd.uuid";
    $joined = "JOIN staff s ON tmd.user = s.staff_id";
    $orderby = "ORDER BY tmd.tanggal DESC";
    $sqlquery = "SELECT $column FROM tabel_minta_data tmd $joined WHERE tmd.user = ? $orderby LIMIT 12";
    return $this->db->query($sqlquery, [get_user_name(false)[0]])->result_array();
  }

  // ==================================
  // Part 02 : Adminul Mukminin
  // ==================================
  public function TabelMintaData(){
    // Model u Melihat Seluruh Permintaan Data User
    $column = "s.name, tmd.tanggal, tmd.status, tmd.telephone, tmd.uploadfiles, tmd.uuid";
    $joined = "JOIN staff s ON tmd.user = s.staff_id";
    $orderby = "ORDER BY tmd.tanggal DESC";
    $sqlquery = "SELECT $column FROM tabel_minta_data tmd $joined $orderby";
    return $this->db->query($sqlquery)->result_array();
  }

  public function Finaly($inputs){
     // Function to Close User Request on Data, Available Status "Pending, Terima, Tolak"
    // Finale Status
    $filter = ['uuid' => $inputs['uuid']];
    $alasan = empty($inputs['alasan']) ? 'Usulan Diterima' : $inputs['alasan'];
    // Publish Status & Alasan
    $publish = ["status" => $inputs['status'], "alasan" => $alasan];
    return $this->db->update('tabel_minta_data', $publish, $filter);
  }
}
?>