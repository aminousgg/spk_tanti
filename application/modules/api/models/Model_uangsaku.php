<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_uangsaku extends CI_Model {

    public function validasi($token){
        return $this->db->get_where('akun_mobile',array('token'=>$token));
    }
    public function get_list($kode_reg){
        $where = array(
            'kode_register' => $kode_reg,
            // 'tahun' => date('Y'),
        );
        $this->db->select('id, bulan, tahun');
        $this->db->where($where);
        $this->db->order_by("bulan", "DESC");
        return $this->db->get('uang_saku');
    }
    public function by_bulan($id){
        $this->db->where('id',$id);
        return $this->db->get('uang_saku');
    }
}
