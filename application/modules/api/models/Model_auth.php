<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model {

    public function read($id = NULL)
    {
        if($id == NULL)
        {
            return $this->db->get('akun_mobile');
        }
        else
        {
            $this->db->where('id', $id);
            return $this->db->get('akun_mobile');
        }
    }
    public function login($where){
        return $this->db->get_where('akun_mobile', $where);
    }

    public function get_auth($token){
        $set = array(
            'device'    => $this->agent->platform().' - '.$this->agent->browser().' '.$this->agent->version()
        );
        $this->db->where('token',$token);
        if($this->db->update('akun_mobile',$set)){
            $this->db->select('token');
            return $this->db->get_where('akun_mobile', array('token'=>$token));
        }
    }

    public function set_auth($where){
        $plan =(string)rand(1000,9999);
        $set = array(
            'plantoken' => $plan,
            'token'     => md5($plan),
            'device'    => $this->agent->platform().' - '.$this->agent->browser().' '.$this->agent->version()
        );
        $this->db->where($where);
        if($this->db->update('akun_mobile',$set)){
            return array('token'=>md5($plan));
        }else{
            return false;
        }
    }

    public function kode_reg($token){
        return $this->db->get_where('akun_mobile', array('token'=>$token))->row_array()['kode_register'];
    }

    public function home($kode_reg){
        $this->db->select('nama, foto');
        $this->db->where('kode_register', $kode_reg);
        return $this->db->get('datauser');
    }
}
