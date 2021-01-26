<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Status_model');
        $this->load->library('form_validation');        
    }

    public function index()
    {
        $data = array(
        );

        $this->template->load('template','status/v_status_list', $data);
    }

    public function getDatatable()
    {
        $customActionName=$this->input->post('customActionName');
        $records         = array();

        if ($customActionName == "delete") {
            $records=$this-> delete_checked();
        }

        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart  = intval($_REQUEST['start']);
        $sEcho          = intval($_REQUEST['draw']);
        
        $t              = $this->Status_model->get_limit_data($iDisplayStart, $iDisplayLength);
        $iTotalRecords  = $t['total_rows'];
        $get_data       = $t['get_db'];

        $records["data"] = array(); 

        $i=$iDisplayStart+1;
        if ($get_data) {
            foreach ($get_data as $d) {
                $checkbok= '<input type="checkbox" name="id[]" value="'.$d->status_id.'">';
                $view    = anchor(site_url('status/read/'.$d->status_id),'<i class="fa fa-eye fa-lg"></i>',array('title'=>'detail','class'=>'btn btn-outline btn-icon-only green'));
                $edit    = anchor(site_url('status/update/'.$d->status_id),'<i class="fa fa-pencil-square-o fa-lg"></i>',array('title'=>'edit','class'=>'btn btn-outline btn-icon-only blue'));
                $delete  = anchor(site_url('status/delete/'.$d->status_id),'<i class="fa fa-trash-o fa-lg"></i>',array('title'=>'delete','class'=>'btn btn-outline btn-icon-only red', 'data-toggle'=>'confirm', 'data-title'=>$d->{$this->Status_model->label}));

                $records["data"][] = array(
                    $checkbok,
                
					$d->status_nama, 
					$d->keterangan, 
                    $view.$edit.$delete
                );
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function read($id) 
    {
        $row = $this->Status_model
                    ->get($id);
        if ($row) {
            $data = array(
				'status_id' => $row->status_id,
				'status_nama' => $row->status_nama,
				'keterangan' => $row->keterangan,
			);
            $data['id'] = $id;
            $this->template->load('template','status/v_status_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('status/create_action'),
			'status_id' => set_value('status_id'),
			'status_nama' => set_value('status_nama'),
			'keterangan' => set_value('keterangan'),
		);
        $this->template->load('template','status/v_status_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();


        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'status_nama' => $this->input->post('status_nama',TRUE),
				'keterangan' => $this->input->post('keterangan',TRUE),
			);

            $this->Status_model->insert($data);
            if ($this->input->post('mode') == 'new') {
                redirect(site_url('status/create'));
                
            } else {
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('status'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Status_model->get($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('status/update_action'),
				'status_id' => set_value('status_id', $row->status_id),
				'status_nama' => set_value('status_nama', $row->status_nama),
				'keterangan' => set_value('keterangan', $row->keterangan),
			);
            $this->template->load('template','status/v_status_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('status_id', TRUE));
        } else {
            $data = array(
				'status_nama' => $this->input->post('status_nama',TRUE),
				'keterangan' => $this->input->post('keterangan',TRUE),
		    );

            $this->Status_model->update($data,$this->input->post('status_id', TRUE));
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('status'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Status_model->get($id);

        if ($row) {
            $this->Status_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('status'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status'));
        }
    }

    public function delete_checked()
    {
        $id_array=$this->input->post('id[]');
        foreach ($id_array as $id) {
            $row = $this->Status_model->get($id);

            if ($row) {
                $this->Status_model->delete($id);
            } 
        }
        $result["customActionStatus"]="OK";
        $result["customActionMessage"]="Delete Record Success";
        return $result;
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('status_nama', 'status nama', 'trim');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim');

		$this->form_validation->set_rules('status_id', 'status_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "status.xls";
        $judul = "status";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Nama");
		xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

		foreach ($this->Status_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, $data->status_nama);
		    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Status.php */
/* Location: ./application/controllers/Status.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */