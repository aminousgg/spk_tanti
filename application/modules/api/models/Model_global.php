<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_global extends CI_Model {

    public function validasi($token){
        return $this->db->get_where('akun_mobile', array('token'=>$token));
    }
    public function show_info(){
        return $this->db->get('info');
    }
}
