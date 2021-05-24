<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spk extends CI_Controller {

	public function __construct(){
       	parent::__construct();
       	if(!$this->session->userdata('sesi_admin'))
       	{
       		redirect(base_url('admin/akses'));
       	}
        // $this->load->model('PelamarModel', 'pelamar');
        $this->sesi = $this->session->userdata('sesi_admin');
        $this->load->model('SpkModel', 'spk');
    }
    public function index()
    {
        $data = [
          'judul' => "Analisis Hasil Seleksi",
          'side_row'=> 2,
          'pelamar'=> $this->spk->getAnalitc()
        ];
        $this->load->view('admin/spk',$data);
    }

    // public function logout(){
    //   $this->session->unset_userdata('sesi');
    //   redirect(base_url('login'));
    // }


}