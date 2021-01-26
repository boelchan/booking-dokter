<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_user extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('loged_in')) redirect(site_url(),'refresh');
        
        $this->load->model('M_user_model');
        $this->load->library('form_validation');
		$this->load->model('M_level_model');        
    }

    public function index()
    {
        $data = array(
        );

        $this->template->load('template','m_user/v_m_user_list', $data);
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
        
        $t              = $this->M_user_model->get_limit_data($iDisplayStart, $iDisplayLength);
        $iTotalRecords  = $t['total_rows'];
        $get_data       = $t['get_db'];

        $records["data"] = array(); 

        $i=$iDisplayStart+1;
        if ($get_data) {
            if ($this->session->userdata('group') == 1) {
                foreach ($get_data as $d) {
                    $checkbok= '<input type="checkbox" name="id[]" value="'.$d->user_id.'">';
                    $view    = anchor(site_url('m_user/read/'.$d->user_id),'<i class="fa fa-eye fa-lg"></i>',array('title'=>'detail','class'=>'btn btn-outline btn-icon-only green'));
                    $edit    = anchor(site_url('m_user/update/'.$d->user_id),'<i class="fa fa-pencil-square-o fa-lg"></i>',array('title'=>'edit','class'=>'btn btn-outline btn-icon-only blue'));
                    $delete  = anchor(site_url('m_user/delete/'.$d->user_id),'<i class="fa fa-trash-o fa-lg"></i>',array('title'=>'delete','class'=>'btn btn-outline btn-icon-only red', 'data-toggle'=>'confirm', 'data-title'=>$d->{$this->M_user_model->label}));

                    $records["data"][] = array(
                        $checkbok,
                    
                        $d->user_name, 
                        $d->user_pass, 
                        $d->no_rm, 
                        @$d->m_level->{$this->M_level_model->label}, 
                        $d->nama, 
                        $d->jenis_kelamin, 
                        $d->tanggal_lahir, 
                        $d->alamat, 
                        $d->no_hp, 
                        $view.$edit.$delete
                    );
                }
            } else {
                foreach ($get_data as $d) {
                    $checkbok= '<input type="checkbox" name="id[]" value="'.$d->user_id.'">';
                    $view    = anchor(site_url('m_user/read/'.$d->user_id),'<i class="fa fa-eye fa-lg"></i>',array('title'=>'detail','class'=>'btn btn-outline btn-icon-only green'));
                    $edit    = anchor(site_url('m_user/update/'.$d->user_id),'<i class="fa fa-pencil-square-o fa-lg"></i>',array('title'=>'edit','class'=>'btn btn-outline btn-icon-only blue'));
                    $delete  = anchor(site_url('m_user/delete/'.$d->user_id),'<i class="fa fa-trash-o fa-lg"></i>',array('title'=>'delete','class'=>'btn btn-outline btn-icon-only red', 'data-toggle'=>'confirm', 'data-title'=>$d->{$this->M_user_model->label}));

                    $records["data"][] = array(
                        $checkbok,
                    
                        $d->user_name, 
                        $d->user_pass, 
                        $d->no_rm, 
                        $d->nama, 
                        $d->jenis_kelamin, 
                        $d->tanggal_lahir, 
                        $d->alamat, 
                        $d->no_hp, 
                        $view.$edit.$delete
                    );
                }
            }
            
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function read($id) 
    {
        $row = $this->M_user_model
                    ->with_m_level()
                    ->get($id);
        if ($row) {
            $data = array(
				'user_id' => $row->user_id,
				'user_name' => $row->user_name,
				'user_pass' => $row->user_pass,
				'no_rm' => $row->no_rm,
				'level' => @$row->m_level->{$this->M_level_model->label},
				'nama' => $row->nama,
				'jenis_kelamin' => $row->jenis_kelamin,
				'tanggal_lahir' => $row->tanggal_lahir,
				'alamat' => $row->alamat,
				'no_hp' => $row->no_hp,
			);
            $data['id'] = $id;
            $this->template->load('template','m_user/v_m_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_user/create_action'),
			'user_id' => set_value('user_id'),
			'user_name' => set_value('user_name'),
			'user_pass' => set_value('user_pass'),
			'level' => set_value('level'),
			'nama' => set_value('nama'),
			'jenis_kelamin' => set_value('jenis_kelamin'),
			'tanggal_lahir' => set_value('tanggal_lahir'),
			'alamat' => set_value('alamat'),
			'no_hp' => set_value('no_hp'),
		);
        $this->template->load('template','m_user/v_m_user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();


        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'user_name' => $this->input->post('user_name',TRUE),
				'user_pass' => $this->input->post('user_pass',TRUE),
                'no_rm' => $this->M_user_model->get_no_rm(),
				'level' => $this->input->post('level',TRUE),
				'nama' => $this->input->post('nama',TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
				'alamat' => $this->input->post('alamat',TRUE),
				'no_hp' => $this->input->post('no_hp',TRUE),
			);

            $this->M_user_model->insert($data);
            if ($this->input->post('mode') == 'new') {
                redirect(site_url('m_user/create'));
                
            } else {
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('m_user'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_user_model->get($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_user/update_action'),
				'user_id' => set_value('user_id', $row->user_id),
				'user_name' => set_value('user_name', $row->user_name),
				'user_pass' => set_value('user_pass', $row->user_pass),
				'level' => set_value('level', $row->level),
				'nama' => set_value('nama', $row->nama),
				'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
				'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
				'alamat' => set_value('alamat', $row->alamat),
				'no_hp' => set_value('no_hp', $row->no_hp),
			);
            $this->template->load('template','m_user/v_m_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('user_id', TRUE));
        } else {
            $data = array(
				'user_name' => $this->input->post('user_name',TRUE),
				'user_pass' => $this->input->post('user_pass',TRUE),
				'level' => $this->input->post('level',TRUE),
				'nama' => $this->input->post('nama',TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
				'alamat' => $this->input->post('alamat',TRUE),
				'no_hp' => $this->input->post('no_hp',TRUE),
		    );

            $this->M_user_model->update($data,$this->input->post('user_id', TRUE));
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_user_model->get($id);

        if ($row) {
            $this->M_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_user'));
        }
    }

    public function delete_checked()
    {
        $id_array=$this->input->post('id[]');
        foreach ($id_array as $id) {
            $row = $this->M_user_model->get($id);

            if ($row) {
                $this->M_user_model->delete($id);
            } 
        }
        $result["customActionStatus"]="OK";
        $result["customActionMessage"]="Delete Record Success";
        return $result;
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('user_name', 'user name', 'trim|required');
		$this->form_validation->set_rules('user_pass', 'user pass', 'trim|required');
		$this->form_validation->set_rules('level', 'level', 'trim|required|numeric');
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');

		$this->form_validation->set_rules('user_id', 'user_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "m_user.xls";
        $judul = "m_user";
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
		xlsWriteLabel($tablehead, $kolomhead++, "User Name");
		xlsWriteLabel($tablehead, $kolomhead++, "User Pass");
		xlsWriteLabel($tablehead, $kolomhead++, "No Rm");
		xlsWriteLabel($tablehead, $kolomhead++, "Level");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama");
		xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
		xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
		xlsWriteLabel($tablehead, $kolomhead++, "No Hp");

		foreach ($this->M_user_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, $data->user_name);
		    xlsWriteLabel($tablebody, $kolombody++, $data->user_pass);
		    xlsWriteLabel($tablebody, $kolombody++, $data->no_rm);
		    xlsWriteNumber($tablebody, $kolombody++, $data->level);
		    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
		    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
		    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
		    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
		    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }




}

/* End of file M_user.php */
/* Location: ./application/controllers/M_user.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */