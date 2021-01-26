<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_user_model extends MY_Model
{

    public $table = 'm_user';
    public $primary_key = 'user_id';
    public $label = 'user_id';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array('user_id'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = TRUE;
        $this->has_one['m_level'] = array('M_level_model','level_id','level');
    }
    
    // get total rows
    function get_limit_data($limit, $start) {
        $order            = $this->input->post('order');
        $dataorder = array();
        $where = array();

        $i=1;
        $dataorder[$i++] = 'user_name';
        $dataorder[$i++] = 'user_pass';
        $dataorder[$i++] = 'no_rm';
        $dataorder[$i++] = 'level';
        $dataorder[$i++] = 'nama';
        $dataorder[$i++] = 'jenis_kelamin';
        $dataorder[$i++] = 'tanggal_lahir';
        $dataorder[$i++] = 'alamat';
        $dataorder[$i++] = 'no_hp';
        if(!empty($this->input->post('user_name'))){
            $where['LOWER(user_name) LIKE'] = '%'.strtolower($this->input->post('user_name')).'%';
        }
        if(!empty($this->input->post('user_pass'))){
            $where['LOWER(user_pass) LIKE'] = '%'.strtolower($this->input->post('user_pass')).'%';
        }
        if(!empty($this->input->post('no_rm'))){
            $where['LOWER(no_rm) LIKE'] = '%'.strtolower($this->input->post('no_rm')).'%';
        }
        if(!empty($this->input->post('level'))){
            $where['level'] = $this->input->post('level');
        }
        if(!empty($this->input->post('nama'))){
            $where['LOWER(nama) LIKE'] = '%'.strtolower($this->input->post('nama')).'%';
        }
        if(!empty($this->input->post('jenis_kelamin'))){
            $where['LOWER(jenis_kelamin) LIKE'] = '%'.strtolower($this->input->post('jenis_kelamin')).'%';
        }
        if(!empty($this->input->post('tanggal_lahir_start'))){
            $where['tanggal_lahir >='] = $this->input->post('tanggal_lahir_start');
        }
        if(!empty($this->input->post('tanggal_lahir_end'))){
            $where['tanggal_lahir <='] = $this->input->post('tanggal_lahir_end');
        }
        if(!empty($this->input->post('alamat'))){
            $where['LOWER(alamat) LIKE'] = '%'.strtolower($this->input->post('alamat')).'%';
        }
        if(!empty($this->input->post('no_hp'))){
            $where['LOWER(no_hp) LIKE'] = '%'.strtolower($this->input->post('no_hp')).'%';
        }
        if ($this->session->userdata('group') == 1) {
            $where["level in (2,3)"] = NULL;
        } else {
            $where["level in (3)"] = NULL;
        }
        

        $this->where($where);
        $result['total_rows'] = $this->count_rows();
        
        $this->where($where);
        $this->order_by( $dataorder[$order[0]["column"]],  $order[0]["dir"]);
        $this->limit($start, $limit);
        $result['get_db']=$this
                            ->with_m_level()
                            ->get_all();
        return $result;
    }

    public function create_daftar() 
    {
        $this->_rules();


        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'user_name' => $this->input->post('user_name',TRUE),
				'user_pass' => $this->input->post('user_pass',TRUE),
				'no_rm' => $this->get_no_rm(),
				'level' => 3,
				'nama' => $this->input->post('nama',TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
				'alamat' => $this->input->post('alamat',TRUE),
				'no_hp' => $this->input->post('no_hp',TRUE),
			);

            if($this->insert($data)){
                $user = $this->get(array(
                    "user_name" => $this->input->post('user_name'), 
                    "user_pass" => $this->input->post('user_pass'), 
                    ));

                if ($user) {
                    $array = array(
                        'userid' => $user->user_id,
                        'username' => $user->user_name,
                        'nama' => $user->nama,
        				'no_rm' => $user->no_rm,
                        'group' => $user->level,
                        'loged_in' => TRUE,
                    );
                    
                    $this->session->set_userdata( $array );
                    if ($user->level == 1) {
                        redirect('dashboard','refresh');
                    }elseif ($user->level == 2) {
                        redirect('dashboard','refresh');
                    }else{ //$user->level == 3
                        redirect('dashboard','refresh');
                    }
                }else{
                    $this->session->set_flashdata('msg', 'Username atau password Anda Salah! Silahkan coba lagi');
                    redirect('auth','refresh');
                }
            }
        }
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

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function get_no_rm()
    {
        $cek = $this->db
                ->order_by('user_id', 'desc')
                ->get($this->table);
        if ($cek->num_rows() > 0) {
            $res = $cek->row()->no_rm;
            $res++;
        } else {
            $res = 1;
        }
        
        return $res;
    }

}

/* End of file M_user_model.php */
/* Location: ./application/models/M_user_model.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */