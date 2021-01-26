<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_antrian_model extends MY_Model
{

    public $table = 't_antrian';
    public $primary_key = 'antrian_id';
    public $label = 'antrian_id';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array('antrian_id'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = TRUE;
        $this->has_one['t_layanan'] = array('T_layanan_model','layanan_id','layanan_id');
        $this->has_one['status'] = array('Status_model','status_id','status');
        $this->has_one['m_user'] = array('M_user_model','no_rm','no_rm');
    }
    
    // get total rows
    function get_limit_data($limit, $start) {
        $order            = $this->input->post('order');
        $dataorder = array();
        $where = array();

        $i=1;
        $dataorder[$i++] = 'layanan_id';
        $dataorder[$i++] = 'no_rm';
        $dataorder[$i++] = 'antrian_no';
        $dataorder[$i++] = 'diagnosa';
        $dataorder[$i++] = 'biaya';
        $dataorder[$i++] = 'status';
        if(!empty($this->input->post('layanan_id'))){
            $where['layanan_id'] = $this->input->post('layanan_id');
        }
        if(!empty($this->input->post('no_rm'))){
            $where['no_rm'] = $this->input->post('no_rm');
        }
        if(!empty($this->input->post('antrian_no'))){
            $where['LOWER(antrian_no) LIKE'] = '%'.strtolower($this->input->post('antrian_no')).'%';
        }
        if(!empty($this->input->post('diagnosa'))){
            $where['LOWER(diagnosa) LIKE'] = '%'.strtolower($this->input->post('diagnosa')).'%';
        }
        if(!empty($this->input->post('biaya'))){
            $where['LOWER(biaya) LIKE'] = '%'.strtolower($this->input->post('biaya')).'%';
        }
        if(!empty($this->input->post('status'))){
            $where['status'] = $this->input->post('status');
        }

        $this->where($where);
        $result['total_rows'] = $this->count_rows();
        
        $this->where($where);
        $this->order_by( $dataorder[$order[0]["column"]],  $order[0]["dir"]);
        $this->limit($start, $limit);
        $result['get_db']=$this
                            ->with_t_layanan()
                            ->with_status()
                            ->with_m_user()
                            ->get_all();
        return $result;
    }

}

/* End of file T_antrian_model.php */
/* Location: ./application/models/T_antrian_model.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */