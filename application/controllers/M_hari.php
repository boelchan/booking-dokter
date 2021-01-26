<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_hari extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('loged_in')) redirect(site_url(),'refresh');
        $this->load->model('M_hari_model');
        $this->load->library('form_validation');        
    }

    public function index()
    {
        $data = array(
        );

        $this->template->load('template','m_hari/v_m_hari_list', $data);
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
        
        $t              = $this->M_hari_model->get_limit_data($iDisplayStart, $iDisplayLength);
        $iTotalRecords  = $t['total_rows'];
        $get_data       = $t['get_db'];

        $records["data"] = array(); 

        $i=$iDisplayStart+1;
        if ($get_data) {
            foreach ($get_data as $d) {
                $checkbok= '<input type="checkbox" name="id[]" value="'.$d->hari_id.'">';
                $view    = anchor(site_url('m_hari/read/'.$d->hari_id),'<i class="fa fa-eye fa-lg"></i>',array('title'=>'detail','class'=>'btn btn-outline btn-icon-only green'));
                $edit    = anchor(site_url('m_hari/update/'.$d->hari_id),'<i class="fa fa-pencil-square-o fa-lg"></i>',array('title'=>'edit','class'=>'btn btn-outline btn-icon-only blue'));
                $delete  = anchor(site_url('m_hari/delete/'.$d->hari_id),'<i class="fa fa-trash-o fa-lg"></i>',array('title'=>'delete','class'=>'btn btn-outline btn-icon-only red', 'data-toggle'=>'confirm', 'data-title'=>$d->{$this->M_hari_model->label}));

                $records["data"][] = array(
                    $checkbok,
                
					$d->hari_nama, 
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
        $row = $this->M_hari_model
                    ->get($id);
        if ($row) {
            $data = array(
				'hari_id' => $row->hari_id,
				'hari_nama' => $row->hari_nama,
			);
            $data['id'] = $id;
            $this->template->load('template','m_hari/v_m_hari_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_hari'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_hari/create_action'),
			'hari_id' => set_value('hari_id'),
			'hari_nama' => set_value('hari_nama'),
		);
        $this->template->load('template','m_hari/v_m_hari_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();


        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'hari_nama' => $this->input->post('hari_nama',TRUE),
			);

            $this->M_hari_model->insert($data);
            if ($this->input->post('mode') == 'new') {
                redirect(site_url('m_hari/create'));
                
            } else {
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('m_hari'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_hari_model->get($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_hari/update_action'),
				'hari_id' => set_value('hari_id', $row->hari_id),
				'hari_nama' => set_value('hari_nama', $row->hari_nama),
			);
            $this->template->load('template','m_hari/v_m_hari_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_hari'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('hari_id', TRUE));
        } else {
            $data = array(
				'hari_nama' => $this->input->post('hari_nama',TRUE),
		    );

            $this->M_hari_model->update($data,$this->input->post('hari_id', TRUE));
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m_hari'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_hari_model->get($id);

        if ($row) {
            $this->M_hari_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m_hari'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_hari'));
        }
    }

    public function delete_checked()
    {
        $id_array=$this->input->post('id[]');
        foreach ($id_array as $id) {
            $row = $this->M_hari_model->get($id);

            if ($row) {
                $this->M_hari_model->delete($id);
            } 
        }
        $result["customActionStatus"]="OK";
        $result["customActionMessage"]="Delete Record Success";
        return $result;
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('hari_nama', 'hari nama', 'trim');

		$this->form_validation->set_rules('hari_id', 'hari_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "m_hari.xls";
        $judul = "m_hari";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Hari Nama");

		foreach ($this->M_hari_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, $data->hari_nama);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file M_hari.php */
/* Location: ./application/controllers/M_hari.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */