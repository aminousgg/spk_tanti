<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){
       	parent::__construct();
       	if(!$this->session->userdata('sesi_admin'))
       	{
       		redirect(base_url('admin/akses'));
       	}
        // $this->load->model('PelamarModel', 'pelamar');
        $this->sesi = $this->session->userdata('sesi_admin');
    }
    public function index()
    {
        $data = [
          'judul' => "Menu Utama",
          'side_row'=> 0
        ];
        $this->load->view('admin/main',$data);
    }

    // public function logout(){
    //   $this->session->unset_userdata('sesi');
    //   redirect(base_url('login'));
    // }


}