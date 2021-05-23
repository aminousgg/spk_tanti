<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
       	parent::__construct();

       	if($this->session->userdata('sesi'))
       	{
       		redirect(base_url());
       	}
        $this->load->model('PelamarModel', 'pelamar');

    }
    public function index()
    {
    	$data = [
    		'judul'	=> "Register"
    	];
        $this->load->view('auth/main', $data);
    }

    public function register()
    {
    	$pass 	= $this->input->post('password');
    	$pass1	= $this->input->post('password1');
    	if($pass != $pass1)
    	{
    		$this->session->set_flashdata('notif_0', 'password tidak cocok');
    		redirect(base_url('auth'));
    	}

    	$data_in = [
    		'username'	=> $this->input->post('username'),
    		'password'	=> md5($this->input->post('password'))
    	];
    	$cek = $this->db->insert('auth',$data_in);
    	if($cek == true)
    	{
            $this->db->select('id_user');
            $get_id = $this->db->get_where('auth',['username'=> $this->input->post('username')])->row_array()['id_user'];
            $final = $this->pelamar->insertID($get_id);
            if($final == true)
            {
                $this->session->set_flashdata('notif_1', 'Berhasil mendaftar!');
                redirect(base_url('auth'));
            }
            else
            {   //gagal insert id pelamar
                $this->session->set_flashdata('notif_0', 'Gagal Mendaftar!');
                redirect(base_url('auth'));
            }
    		
    	}
    	else
    	{
    		$this->session->set_flashdata('notif_0', 'Gagal Mendaftar!');
    		redirect(base_url('auth'));
    	}
    }

    public function login()
    {
    	$data = [
    		'judul'	=> "Login"
    	];
    	$this->load->view('auth/login',$data);
    }

    public function login_in()
    {
    	$where = [
    		'username'	=> $this->input->post('username'),
    		'password'	=> md5($this->input->post('password'))
    	];
    	$this->db->where($where);
    	$result = $this->db->get('auth');
    	if($result->num_rows()>0)
    	{
    		// login berhasil
    		$this->session->set_userdata('sesi', $result->row_array());
    		redirect(base_url());
    	}
    	else
    	{
    		$this->session->set_flashdata('notif_0', 'username or password, Salah');
    		redirect(base_url('login'));
    	}
    }

}