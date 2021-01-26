<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_user_model');
        $this->load->library('form_validation');

	}

	// redirect if needed, otherwise display the user list
	function index()
	{
		$this->load->view('login');

	}

	// log the user in
	function login_post()
	{
		$user = $this->m_user_model->get(array(
			"user_name" => $this->input->post('username'), 
			"user_pass" => $this->input->post('password'), 
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

	// log the user out
	function logout()
	{

		// log the user out
		$this->session->sess_destroy();

		// redirect them to the login page
		redirect('auth', 'refresh');
	}

    public function daftar() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('auth/create_daftar'),
			'user_id' => set_value('user_id'),
			'user_name' => set_value('user_name'),
			'user_pass' => set_value('user_pass'),
			'no_rm' => set_value('no_rm'),
			'level' => set_value('level'),
			'nama' => set_value('nama'),
			'jenis_kelamin' => set_value('jenis_kelamin'),
			'tanggal_lahir' => set_value('tanggal_lahir'),
			'alamat' => set_value('alamat'),
			'no_hp' => set_value('no_hp'),
		);
        $this->template->load('template','m_user/v_m_user_daftar', $data);
    }
	public function create_daftar()
	{
		
		$this->load->model('m_user_model');
		$this->m_user_model->create_daftar();

	}


}
