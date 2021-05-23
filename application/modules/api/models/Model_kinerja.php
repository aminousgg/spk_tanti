<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kinerja extends CI_Model {

    public function validasi_token($token){
        return $this->db->get_where('akun_mobile',array('token'=>$token));
    }
    public function getbydate($kode_reg, $date){
        return $this->db->query('
            SELECT id, kode_register, pagi, sore, rate, status
            FROM absen
            WHERE kode_register = "'.$kode_reg.'" AND pagi LIKE "'.$date.'%" AND sore LIKE "'.$date.'%"
        ');
    }
}
