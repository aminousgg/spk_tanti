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
      // var_dump($this->spk->arrayOfMax()['maxPend']); die;
      // die;
      // $max = $this->spk->arrayOfMax();
      $data = [
        'judul' => "Analisis Hasil Seleksi",
        'side_row'=> 2,
        'pelamar'=> $this->spk->getAnalitc(),
        'max' => $this->spk->arrayOfMax()
      ];
      $this->load->view('admin/spk',$data);
  }

  public function perhitungan()
  {
      $data = [
        'judul' => "Proses Perhitungan",
        'side_row'=> 3,
        'pelamar'=> $this->spk->getProcessView(),
        'max' => $this->spk->arrayOfMax(),
        'akurasi' => $this->spk->acuracy()
      ];
      $this->load->view('admin/perhitungan',$data);
  }

    // public function logout(){
    //   $this->session->unset_userdata('sesi');
    //   redirect(base_url('login'));
    // }

  public function bobot()
  {
    $data = [
      'judul' => "Pembobotan",
      'side_row'=> 4,
      'pelamar'=> $this->spk->getProcessView(),
      'max' => $this->spk->arrayOfMax()
    ];
    $this->load->view('admin/bobot',$data);
  }


}