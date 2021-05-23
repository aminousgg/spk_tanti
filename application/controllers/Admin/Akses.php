<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses extends CI_Controller {

	public function __construct(){
       	parent::__construct();
        if($this->session->userdata('sesi_admin'))
        {
          redirect(base_url('admin'));
        }
       	
        $this->load->model('PelamarModel', 'pelamar');

    }
    public function index()
    {
    	$data = [
    		'judul'	=> "Login"
    	];
        $this->load->view('admin/login', $data);
    }

    public function login_in()
    {
        $where = [
          'username'  => $this->input->post('username'),
          'password'  => md5($this->input->post('password')),
          'level'     => "Admin"
        ];
        $this->db->where($where);
        $result = $this->db->get('auth');
        if($result->num_rows()>0)
        {
            $this->session->set_userdata('sesi_admin', $result->row_array());
            redirect(base_url('Admin'));
        }
        else
        {
            $this->session->set_flashdata('notif_0', 'Gagal Login!');
            redirect(base_url('admin/akses'));
        }
    }

}