<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_hari_model extends MY_Model
{

    public $table = 'm_hari';
    public $primary_key = 'hari_id';
    public $label = 'hari_nama';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array('hari_id'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = TRUE;
    }
    
    // get total rows
    function get_limit_data($limit, $start) {
        $order            = $this->input->post('order');
        $dataorder = array();
        $where = array();

        $i=1;
        $dataorder[$i++] = 'hari_nama';
        if(!empty($this->input->post('hari_nama'))){
            $where['LOWER(hari_nama) LIKE'] = '%'.strtolower($this->input->post('hari_nama')).'%';
        }

        $this->where($where);
        $result['total_rows'] = $this->count_rows();
        
        $this->where($where);
        $this->order_by( $dataorder[$order[0]["column"]],  $order[0]["dir"]);
        $this->limit($start, $limit);
        $result['get_db']=$this
                            ->get_all();
        return $result;
    }

}

/* End of file M_hari_model.php */
/* Location: ./application/models/M_hari_model.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */