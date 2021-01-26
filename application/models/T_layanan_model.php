<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_layanan_model extends MY_Model
{

    public $table = 't_layanan';
    public $primary_key = 'layanan_id';
    public $label = 'layanan_id';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array('layanan_id'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = TRUE;
        $this->has_one['m_hari'] = array('M_hari_model','hari_id','m_hari_id');
    }
    
    // get total rows
    function get_limit_data($limit, $start) {
        $order            = $this->input->post('order');
        $dataorder = array();
        $where = array();

        $i=1;
        $dataorder[$i++] = 'm_hari_id';
        $dataorder[$i++] = 'jam_buka';
        $dataorder[$i++] = 'jam_tutup';
        $dataorder[$i++] = 'max_antrian';
        if(!empty($this->input->post('m_hari_id'))){
            $where['m_hari_id'] = $this->input->post('m_hari_id');
        }
        if(!empty($this->input->post('jam_buka'))){
            $where['LOWER(jam_buka) LIKE'] = '%'.strtolower($this->input->post('jam_buka')).'%';
        }
        if(!empty($this->input->post('jam_tutup'))){
            $where['LOWER(jam_tutup) LIKE'] = '%'.strtolower($this->input->post('jam_tutup')).'%';
        }
        if(!empty($this->input->post('max_antrian'))){
            $where['LOWER(max_antrian) LIKE'] = '%'.strtolower($this->input->post('max_antrian')).'%';
        }

        $this->where($where);
        $result['total_rows'] = $this->count_rows();
        
        $this->where($where);
        $this->order_by( $dataorder[$order[0]["column"]],  $order[0]["dir"]);
        $this->limit($start, $limit);
        $result['get_db']=$this
                            ->with_m_hari()
                            ->get_all();
        return $result;
    }

}

/* End of file T_layanan_model.php */
/* Location: ./application/models/T_layanan_model.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */