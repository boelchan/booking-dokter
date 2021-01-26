<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_layanan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('loged_in')) redirect(site_url(),'refresh');
        $this->load->model('T_layanan_model');
        $this->load->library('form_validation');
		$this->load->model('M_hari_model');        
    }

    public function index()
    {
        $data = array(
        );

        $this->template->load('template','t_layanan/v_t_layanan_list', $data);
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
        
        $t              = $this->T_layanan_model->get_limit_data($iDisplayStart, $iDisplayLength);
        $iTotalRecords  = $t['total_rows'];
        $get_data       = $t['get_db'];

        $records["data"] = array(); 

        $i=$iDisplayStart+1;
        if ($get_data) {
            foreach ($get_data as $d) {
                $checkbok= '<input type="checkbox" name="id[]" value="'.$d->layanan_id.'">';
                $view    = anchor(site_url('t_layanan/read/'.$d->layanan_id),'<i class="fa fa-eye fa-lg"></i>',array('title'=>'detail','class'=>'btn btn-outline btn-icon-only green'));
                $edit    = anchor(site_url('t_layanan/update/'.$d->layanan_id),'<i class="fa fa-pencil-square-o fa-lg"></i>',array('title'=>'edit','class'=>'btn btn-outline btn-icon-only blue'));
                $delete  = anchor(site_url('t_layanan/delete/'.$d->layanan_id),'<i class="fa fa-trash-o fa-lg"></i>',array('title'=>'delete','class'=>'btn btn-outline btn-icon-only red', 'data-toggle'=>'confirm', 'data-title'=>$d->{$this->T_layanan_model->label}));

                $records["data"][] = array(
                    $checkbok,
                
					@$d->m_hari->{$this->M_hari_model->label}, 
					$d->jam_buka, 
					$d->jam_tutup, 
					$d->max_antrian, 
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
        $row = $this->T_layanan_model
                    ->with_m_hari()
                    ->get($id);
        if ($row) {
            $data = array(
				'layanan_id' => $row->layanan_id,
				'm_hari_id' => @$row->m_hari->{$this->M_hari_model->label},
				'jam_buka' => $row->jam_buka,
				'jam_tutup' => $row->jam_tutup,
				'max_antrian' => $row->max_antrian,
			);
            $data['id'] = $id;
            $this->template->load('template','t_layanan/v_t_layanan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_layanan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_layanan/create_action'),
			'layanan_id' => set_value('layanan_id'),
			'm_hari_id' => set_value('m_hari_id'),
			'jam_buka' => set_value('jam_buka'),
			'jam_tutup' => set_value('jam_tutup'),
			'max_antrian' => set_value('max_antrian'),
		);
        $this->template->load('template','t_layanan/v_t_layanan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();


        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'm_hari_id' => $this->input->post('m_hari_id',TRUE),
				'jam_buka' => $this->input->post('jam_buka',TRUE),
				'jam_tutup' => $this->input->post('jam_tutup',TRUE),
				'max_antrian' => $this->input->post('max_antrian',TRUE),
			);

            $this->T_layanan_model->insert($data);
            if ($this->input->post('mode') == 'new') {
                redirect(site_url('t_layanan/create'));
                
            } else {
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('t_layanan'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_layanan_model->get($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_layanan/update_action'),
				'layanan_id' => set_value('layanan_id', $row->layanan_id),
				'm_hari_id' => set_value('m_hari_id', $row->m_hari_id),
				'jam_buka' => set_value('jam_buka', $row->jam_buka),
				'jam_tutup' => set_value('jam_tutup', $row->jam_tutup),
				'max_antrian' => set_value('max_antrian', $row->max_antrian),
			);
            $this->template->load('template','t_layanan/v_t_layanan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_layanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('layanan_id', TRUE));
        } else {
            $data = array(
				'm_hari_id' => $this->input->post('m_hari_id',TRUE),
				'jam_buka' => $this->input->post('jam_buka',TRUE),
				'jam_tutup' => $this->input->post('jam_tutup',TRUE),
				'max_antrian' => $this->input->post('max_antrian',TRUE),
		    );

            $this->T_layanan_model->update($data,$this->input->post('layanan_id', TRUE));
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_layanan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_layanan_model->get($id);

        if ($row) {
            $this->T_layanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_layanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_layanan'));
        }
    }

    public function delete_checked()
    {
        $id_array=$this->input->post('id[]');
        foreach ($id_array as $id) {
            $row = $this->T_layanan_model->get($id);

            if ($row) {
                $this->T_layanan_model->delete($id);
            } 
        }
        $result["customActionStatus"]="OK";
        $result["customActionMessage"]="Delete Record Success";
        return $result;
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('m_hari_id', 'm hari id', 'trim|numeric');
		$this->form_validation->set_rules('jam_buka', 'jam buka', 'trim');
		$this->form_validation->set_rules('jam_tutup', 'jam tutup', 'trim');
		$this->form_validation->set_rules('max_antrian', 'max antrian', 'trim|numeric');

		$this->form_validation->set_rules('layanan_id', 'layanan_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t_layanan.xls";
        $judul = "t_layanan";
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
		xlsWriteLabel($tablehead, $kolomhead++, "M Hari Id");
		xlsWriteLabel($tablehead, $kolomhead++, "Jam Buka");
		xlsWriteLabel($tablehead, $kolomhead++, "Jam Tutup");
		xlsWriteLabel($tablehead, $kolomhead++, "Max Antrian");

		foreach ($this->T_layanan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteNumber($tablebody, $kolombody++, $data->m_hari_id);
		    xlsWriteLabel($tablebody, $kolombody++, $data->jam_buka);
		    xlsWriteLabel($tablebody, $kolombody++, $data->jam_tutup);
		    xlsWriteNumber($tablebody, $kolombody++, $data->max_antrian);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file T_layanan.php */
/* Location: ./application/controllers/T_layanan.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */