<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model(array('vendor_model'));
    }
	
	public function index()
    {
        if (!get_permission('vendor', 'is_view')) {
            access_denied();
        }
		
        $this->data['title'] = 'Vendor';
        $this->data['sub_page'] = 'vendor/index';
        $this->data['main_menu'] = 'vendor';
        $this->load->view('layout/index', $this->data);
    }
	
	public function vendor_save()
    {
        if (!get_permission('vendor', 'is_add') || !get_permission('vendor', 'is_edit')) {
            access_denied();
        }
		
        $this->form_validation->set_rules('vendor_name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('position', 'Posisi', 'trim|required');
        $this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'trim|required');
        $this->form_validation->set_rules('company_name', ' Nama Perusahaan', 'trim|required');
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('mobileno', 'No Telepon', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
        $this->form_validation->set_rules('bank_acc', 'No Rekening', 'trim|required');
		
        if ($this->form_validation->run() !== false) {
            $data = $this->input->post();
			$this->vendor_model->vendor_save($data);
            $array = array('status' => 'success', 'error' => '', 'message' => translate('information_has_been_saved_successfully'));
        } else {
            $array = array('status' => 'error', 'error' => '', 'message' => 'Gagal menyimpan data');
        }
		
		echo json_encode($array);
    }
	
	public function vendor_list()
    {
		$datatables = $this->vendor_model->vendor_list(true);
        $datatables = json_decode($datatables);
		
		$dt_data = array();

        if (!empty($datatables->data)) {
            foreach ($datatables->data as $key => $value) {
                $edit = '';
				if (get_permission('vendor', 'is_edit')) {
					$edit .= '<button class="btn btn-circle icon btn-primary" data-placement="top" data-toggle="tooltip" data-original-title="' . translate('edit') . '" id="edit_vendor" name="edit_vendor" data_edit_vendor="' . $value->penyedia_uuid . '"><i class="fas fa-pen-nib"></i></button>';
				} else {
					$edit .= '';
				}
				
				$delete = '';
				if (get_permission('vendor', 'is_delete')) {
					$delete .= btn_delete('vendor/vendor_delete/' . $value->penyedia_uuid);
				} else {
					$delete .= '';
				}
				
				$view = '<button class="btn btn-circle icon btn-info" data-placement="top" data-toggle="tooltip" data-original-title="View" id="view_vendor" name="view_vendor" data_view_vendor="' . $value->penyedia_uuid . '"><i class="fas fa-info-circle"></i></button>';
				
				$row = array();
                $row[] = $value->penyedia_uuid;
				$row[] = $value->penyedia_name . ' (' . $value->penyedia_position . ')';
				$row[] = $value->penyedia_company_name . ' (' . $value->jenis_usaha_name . ')';
                $row[] = $value->penyedia_address;
                $row[] = $value->penyedia_mobileno;
                $row[] = $value->penyedia_email;
                $row[] = $value->penyedia_bank_acc . ' | ' . $value->bank_name;
                $row[] = $edit . $view . $delete;
                $dt_data[] = $row;
            }
        }
		
        $json_data = array(
            "draw" => intval($datatables->draw),
            "recordsTotal" => intval($datatables->recordsTotal),
            "recordsFiltered" => intval($datatables->recordsFiltered),
            "data" => $dt_data,
        );
        
        echo json_encode($json_data);
    }
	
	public function vendor_detil()
    {
		if (!get_permission('vendor', 'is_add') || !get_permission('vendor', 'is_edit')) {
            access_denied();
        }
		
		$uuid = $this->input->post('data_edit_vendor');
		$data = $this->vendor_model->vendor_detil($uuid);
        
        echo json_encode($data);
    }
	
	public function vendor_delete($uuid)
    {
        if (!get_permission('vendor', 'is_delete')) {
            access_denied();
        }
        
		$this->vendor_model->vendor_delete($uuid);
    }
}
