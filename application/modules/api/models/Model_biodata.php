<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_biodata extends CI_Model {

    public function validasi_token($token){
        return $this->db->get_where('akun_mobile',array('token'=>$token));
    }
    public function get_bio($kode_reg){
        return $this->db->query('
            SELECT du.`id`, du.`kode_register`, du.`nama`, du.`id_ktp`, du.`tmp_lahir`, du.`tgl_lahir`, ag.`agama`,
            pem.`nama` AS nama_pembimbing, jab.`jabatan`, cab.`unit_kerja`, du.`alamat`, du.`email`, fin.`no_rek`,
            fin.`no_npwp`, fin.`no_bpjs`, du.`tgl_masuk`, du.`foto`
            FROM datauser du
            JOIN cabang cab ON du.`kode_cabang`=cab.`kode_cabang`
            JOIN agama ag ON du.`id_agama`=ag.`id`
            JOIN pembimbing pem ON cab.`kode_cabang`=pem.`kode_cabang`
            JOIN jabatan jab ON du.`id_jabatan`=jab.`id`
            JOIN finance fin ON du.`kode_register`=fin.`kode_register`
            WHERE du.`kode_register` = "'.$kode_reg.'"
        ');
    }
}
