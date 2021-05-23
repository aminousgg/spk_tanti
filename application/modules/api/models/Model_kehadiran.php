<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kehadiran extends CI_Model {

    public function validasi($token){
        return $this->db->get_where('akun_mobile', array('token'=>$token));
    }
    public function get_list($kode_reg){
        return $this->db->query('
            SELECT COUNT(*), 
                   DATE(pagi) AS daftar 
            FROM   absen
            WHERE  kode_register = "'.$kode_reg.'"
            GROUP  BY MONTH(pagi)
            ORDER BY pagi DESC
        ');
    }
    public function get_detail($kode_reg, $bulan){
        $month = date('Y')."-".sprintf('%02d', $bulan);
        return $this->db->query('
            SELECT kode_register, DATE(pagi) AS tanggal, TIME(pagi) AS jam_pagi, TIME(sore) AS jam_sore, absen.`status`
            FROM absen
            WHERE kode_register = "'.$kode_reg.'" AND pagi LIKE "'.$month.'%"
        ');
    }
}
