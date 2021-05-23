<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller {

	public function __construct(){
       	parent::__construct();
       	if(!$this->session->userdata('sesi_admin'))
       	{
       		redirect(base_url('admin/akses'));
       	}
        $this->load->model('PelamarModel', 'pelamar');
        $this->sesi = $this->session->userdata('sesi_admin');
    }
    public function index()
    {
        $pelamar = $this->db->query('
          SELECT
            id, id_user, nik, nama, tgl_lahir, tmp_lahir, no_hp
          FROM
            pelamar
          WHERE nama IS NOT NULL
            AND nik IS NOT NULL
            AND tgl_lahir IS NOT NULL
            AND tmp_lahir IS NOT NULL
            AND no_hp IS NOT NULL
        ')->result();
        $data = [
          'judul'     => "Daftar Pelamar",
          'side_row'  => 1,
          'data'      => $pelamar
        ];
        $this->load->view('admin/pelamar_main',$data);
    }

    // public function logout(){
    //   $this->session->unset_userdata('sesi');
    //   redirect(base_url('login'));
    // }

    public function detail($id)
    {
        $pelamar = $this->db->get_where('pelamar',['id_user' => $id])->row_array();
        $w_pend1 = [
          'id_user'   => $id,
          'jenis_pend'=> "Formal" 
        ];
        $w_pend2 = [
          'id_user'   => $id,
          'jenis_pend'=> "Non" 
        ];
        $data = [
          'judul'       => "Data Diri",
          'side_row'    => 1,
          'kelengkapan' => $this->pelamar->KelengkapanDataAdmin($id),
          'pelamar'     => $pelamar,
          'pendidikan1' => $this->db->get_where('pendidikan',$w_pend1)->result(),
          'pendidikan2' => $this->db->get_where('pendidikan',$w_pend2)->result(),
          'pekerjaan'   => $this->db->get_where('riwayat_kerja',['id_user' => $id])->result(),
          'foto'        => $pelamar['foto']
        ];
        $this->load->view('admin/pelamar_detail',$data);
    }


}