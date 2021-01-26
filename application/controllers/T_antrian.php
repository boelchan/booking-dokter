<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_antrian extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('loged_in')) redirect(site_url(),'refresh');

        $this->load->model('T_antrian_model');
        $this->load->library('form_validation');
		$this->load->model('T_layanan_model');
		$this->load->model('Status_model');
		$this->load->model('M_user_model');        
    }

    public function index()
    {
        $data = array(
        );

        $this->template->load('template','t_antrian/v_t_antrian_list', $data);
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
        
        $t              = $this->T_antrian_model->get_limit_data($iDisplayStart, $iDisplayLength);
        $iTotalRecords  = $t['total_rows'];
        $get_data       = $t['get_db'];

        $records["data"] = array(); 

        $i=$iDisplayStart+1;
        if ($get_data) {
            foreach ($get_data as $d) {
                $checkbok= '<input type="checkbox" name="id[]" value="'.$d->antrian_id.'">';
                $view    = anchor(site_url('t_antrian/read/'.$d->antrian_id),'<i class="fa fa-eye fa-lg"></i>',array('title'=>'detail','class'=>'btn btn-outline btn-icon-only green'));
                $edit    = anchor(site_url('t_antrian/update/'.$d->antrian_id),'<i class="fa fa-pencil-square-o fa-lg"></i>',array('title'=>'edit','class'=>'btn btn-outline btn-icon-only blue'));
                $delete  = anchor(site_url('t_antrian/delete/'.$d->antrian_id),'<i class="fa fa-trash-o fa-lg"></i>',array('title'=>'delete','class'=>'btn btn-outline btn-icon-only red', 'data-toggle'=>'confirm', 'data-title'=>$d->{$this->T_antrian_model->label}));

                $records["data"][] = array(
                    $checkbok,
                
					@$d->t_layanan->{$this->T_layanan_model->label}, 
					@$d->m_user->no_rm.' - '. @$d->m_user->nama, 
					$d->antrian_no, 
					$d->diagnosa, 
                    number_format($d->biaya), 
					@$d->status->{$this->Status_model->label}, 
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
        $row = $this->T_antrian_model
                    ->with_t_layanan()
                    ->with_status()
                    ->with_m_user()
                    ->get($id);
        if ($row) {
            $data = array(
				'antrian_id' => $row->antrian_id,
				'layanan_id' => @$row->t_layanan->{$this->T_layanan_model->label},
				'no_rm' => @$row->m_user->{$this->M_user_model->label},
				'antrian_no' => $row->antrian_no,
				'diagnosa' => $row->diagnosa,
				'biaya' => $row->biaya,
				'status' => @$row->status->{$this->Status_model->label},
			);
            $data['id'] = $id;
            $this->template->load('template','t_antrian/v_t_antrian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_antrian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_antrian/create_action'),
			'antrian_id' => set_value('antrian_id'),
			'layanan_id' => set_value('layanan_id'),
			'no_rm' => set_value('no_rm'),
			'antrian_no' => set_value('antrian_no'),
			'diagnosa' => set_value('diagnosa'),
			'biaya' => set_value('biaya'),
			'status' => set_value('status'),
		);
        $this->template->load('template','t_antrian/v_t_antrian_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();


        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'layanan_id' => $this->input->post('layanan_id',TRUE),
				'no_rm' => $this->input->post('no_rm',TRUE),
				'antrian_no' => $this->input->post('antrian_no',TRUE),
				'diagnosa' => $this->input->post('diagnosa',TRUE),
                'biaya' => str_replace('.','',$this->input->post('biaya')),
				'status' => $this->input->post('status',TRUE),
			);

            $this->T_antrian_model->insert($data);
            if ($this->input->post('mode') == 'new') {
                redirect(site_url('t_antrian/create'));
                
            } else {
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('t_antrian'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_antrian_model->get($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_antrian/update_action'),
				'antrian_id' => set_value('antrian_id', $row->antrian_id),
				'layanan_id' => set_value('layanan_id', $row->layanan_id),
				'no_rm' => set_value('no_rm', $row->no_rm),
				'antrian_no' => set_value('antrian_no', $row->antrian_no),
				'diagnosa' => set_value('diagnosa', $row->diagnosa),
				'biaya' => set_value('biaya', $row->biaya),
				'status' => set_value('status', $row->status),
			);
            $this->template->load('template','t_antrian/v_t_antrian_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_antrian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('antrian_id', TRUE));
        } else {
            $data = array(
				'layanan_id' => $this->input->post('layanan_id',TRUE),
				'no_rm' => $this->input->post('no_rm',TRUE),
				'antrian_no' => $this->input->post('antrian_no',TRUE),
				'diagnosa' => $this->input->post('diagnosa',TRUE),
                'biaya' => str_replace('.','',$this->input->post('biaya')),
				'status' => $this->input->post('status',TRUE),
		    );

            $this->T_antrian_model->update($data,$this->input->post('antrian_id', TRUE));
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_antrian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_antrian_model->get($id);

        if ($row) {
            $this->T_antrian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_antrian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_antrian'));
        }
    }

    public function delete_checked()
    {
        $id_array=$this->input->post('id[]');
        foreach ($id_array as $id) {
            $row = $this->T_antrian_model->get($id);

            if ($row) {
                $this->T_antrian_model->delete($id);
            } 
        }
        $result["customActionStatus"]="OK";
        $result["customActionMessage"]="Delete Record Success";
        return $result;
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('layanan_id', 'layanan id', 'trim|numeric');
		$this->form_validation->set_rules('no_rm', 'no rm', 'trim');
		$this->form_validation->set_rules('antrian_no', 'antrian no', 'trim|numeric');
		$this->form_validation->set_rules('diagnosa', 'diagnosa', 'trim');
		$this->form_validation->set_rules('biaya', 'biaya', 'trim|numeric');
		$this->form_validation->set_rules('status', 'status', 'trim');

		$this->form_validation->set_rules('antrian_id', 'antrian_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t_antrian.xls";
        $judul = "t_antrian";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Layanan Id");
		xlsWriteLabel($tablehead, $kolomhead++, "No Rm");
		xlsWriteLabel($tablehead, $kolomhead++, "Antrian No");
		xlsWriteLabel($tablehead, $kolomhead++, "Diagnosa");
		xlsWriteLabel($tablehead, $kolomhead++, "Biaya");
		xlsWriteLabel($tablehead, $kolomhead++, "Status");

		foreach ($this->T_antrian_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteNumber($tablebody, $kolombody++, $data->layanan_id);
		    xlsWriteLabel($tablebody, $kolombody++, $data->no_rm);
		    xlsWriteNumber($tablebody, $kolombody++, $data->antrian_no);
		    xlsWriteLabel($tablebody, $kolombody++, $data->diagnosa);
		    xlsWriteNumber($tablebody, $kolombody++, $data->biaya);
		    xlsWriteLabel($tablebody, $kolombody++, $data->status);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function booking($layanan_id) 
    {
        $row = $this->db->where('layanan_id', $layanan_id)->get('v_jadwal')->row();
        
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_antrian/booking_action'),
			'layanan_id' => $layanan_id,
			'no_rm' => $this->session->userdata('no_rm'),
			'row' => $row,
		);
        $this->template->load('template','t_antrian/v_t_antrian_booking', $data);
    }
    public function booking_action() 
    {

            $data = array(
				'layanan_id' => $this->input->post('layanan_id',TRUE),
				'no_rm' => $this->input->post('no_rm',TRUE),
				'antrian_no' => $this->input->post('antrian_no',TRUE),
				'status' => 1,
			);

            if ($this->T_antrian_model->insert($data)) {
                ?> 
                <script>
                    alert('berhasil Booking');
                    window.location.href = "<?php echo site_url('dashboard')?>";
                </script>"
                <?php 
            } else {
            }
    }

}

/* End of file T_antrian.php */
/* Location: ./application/controllers/T_antrian.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */