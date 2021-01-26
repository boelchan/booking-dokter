<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends MY_Model
{

    public $table = 't_penilaian_fisik';
    public $primary_key = 'fisik_id';
    public $label = 'fisik_id';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array('fisik_id'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = TRUE;
        $this->has_one['m_user'] = array('M_user_model','user_id','pemain');
    }
    
   

}

/* End of file T_penilaian_fisik_model.php */
/* Location: ./application/models/T_penilaian_fisik_model.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */