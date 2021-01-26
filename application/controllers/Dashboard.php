<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('loged_in')) redirect(site_url(),'refresh');

        $this->load->model('Dashboard_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
        );

        $data['jadwal'] = $this->db->get('v_jadwal')->result();
        

        $this->template->load('template','dashboard', $data);
    }

    
}

/* End of file T_penilaian_fisik.php */
/* Location: ./application/controllers/T_penilaian_fisik.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */