<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_raport extends CI_Model {

    public function validasi($token){
        return $this->db->get_where('akun_mobile',array('token'=>$token));
    }
    public function list_bulan($kode_reg){
        // var_dump(date('Y'));
        return $this->db->query('
            SELECT MONTH(tgl) AS bulan, YEAR(tgl) AS tahun
            FROM nilai
            WHERE kode_register="'.$kode_reg.'" AND YEAR(tgl)="'.date('Y').'"
            GROUP BY bulan
            ORDER BY bulan DESC
        ');
    }
    public function get($date, $kode_reg){
        // var_dump($date);
        return $this->db->query('
            SELECT AVG(kedisiplinan) AS kedis, AVG(ratting) AS rate, AVG(produktivitas) AS produktif, AVG(budaya) AS budaya
            FROM nilai
            WHERE kode_register="'.$kode_reg.'" AND tgl LIKE "'.$date.'%"
        ');
    }
}
