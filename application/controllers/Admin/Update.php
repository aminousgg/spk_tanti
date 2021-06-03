<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

	public function __construct(){
       	parent::__construct();
        $this->load->model('PelamarModel', 'pelamar');
        $this->sesi = $this->session->userdata('sesi');
    }
    public function index()
    {
        $data = [
          'judul' => "Menu Utama",
          'side_row'=> 0
        ];
        $this->load->view('main',$data);
    }

    public function logout(){
      $this->session->unset_userdata('sesi');
      redirect(base_url('login'));
    }

    public function datadiri()
    {
        // var_dump($this->pelamar->KelengkapanData()); die;
        $pelamar = $this->db->get_where('pelamar',['id_user' => $this->sesi['id_user']])->row_array();
        $w_pend1 = [
          'id_user'   => $this->sesi['id_user'],
          'jenis_pend'=> "Formal" 
        ];
        $w_pend2 = [
          'id_user'   => $this->sesi['id_user'],
          'jenis_pend'=> "Non" 
        ];
        $data = [
          'judul'       => "Data Diri",
          'side_row'    => 1,
          'kelengkapan' => $this->pelamar->KelengkapanData(),
          'pelamar'     => $pelamar,
          'pendidikan1' => $this->db->get_where('pendidikan',$w_pend1)->result(),
          'pendidikan2' => $this->db->get_where('pendidikan',$w_pend2)->result(),
          'pekerjaan'   => $this->db->get_where('riwayat_kerja',['id_user' => $this->sesi['id_user']])->result(),
          'foto'        => $pelamar['foto']
        ];
        $this->load->view('pelamar/datadiri',$data);
    }
    public function insertDatadiri($id)
    {
        $data_in = $this->input->post();
        $this->db->where('id_user',$id);
        $cek = $this->db->update('pelamar',$data_in);
        if($cek == true)
        {
            $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
            redirect(base_url('admin/pelamar'));
        }
    }
    public function insertRiwayatPendidikan($id)
    {
        if($this->input->post('status')=="baru")
        {
          $data_in = $this->input->post();
          unset($data_in['status']);
          $this->db->where('id_user',$id);
          $cek = $this->db->update('pendidikan',$data_in);
          if($cek == true)
          {
              $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
              redirect(base_url('admin/pelamar'));
          }
        }
        if($this->input->post('status')=="tambah")
        {
          // $data_in = $this->input->post();
          unset($data_in['status']);
          $data_in = [
            'id_user'   => $id,
            'tingkat'   => $this->input->post('tingkat'),
            'nama'      => $this->input->post('nama'),
            'tahun'     => $this->input->post('tahun'),
            'jenis_pend'=> $this->input->post('jenis_pend'),
            'bidang'    => $this->input->post('bidang')
          ];
          // $this->db->where('id_user',$id);
          $cek = $this->db->insert('pendidikan',$data_in);
          if($cek == true)
          {
              $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
              redirect(base_url('admin/pelamar'));
          }
        }
        
    }

    public function insertRiwayatPekerjaan($id)
    {
        if($this->input->post('status')=="baru")
        {
          $data_in = $this->input->post();
          unset($data_in['status']);
          $this->db->where('id_user',$id);
          $cek = $this->db->update('riwayat_kerja',$data_in);
          if($cek == true)
          {
              $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
              redirect(base_url('admin/pelamar'));
          }
        }
        if($this->input->post('status')=="tambah")
        {
          // $data_in = $this->input->post();
          unset($data_in['status']);
          $data_in = [
            'id_user'         => $id,
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'jabatan'         => $this->input->post('jabatan'),
            'tahun_mulai'     => $this->input->post('tahun_mulai'),
            'tahun_selesai'   => $this->input->post('tahun_selesai'),
            'gaji'            => $this->input->post('gaji')
          ];
          // $this->db->where('id_user',$id);
          $cek = $this->db->insert('riwayat_kerja',$data_in);
          if($cek == true)
          {
              $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
              redirect(base_url('admin/pelamar'));
          }
        }
        
    }

    public function insertBerkas($id)
    {
        // echo json_encode($_FILES);
        $ktp    = $this->upFileKtp($_POST);
        $cv     = $this->upFileCv($_POST);
        $ijasah = $this->upFileIjasah($_POST);
        $data_in = [
          'img_ijasah'  => $ijasah['file_name'],
          'img_ktp'     => $ktp['file_name'],
          'img_cv'      => $cv['file_name']
        ];
        $this->db->where('id_user', $id);
        $cek = $this->db->update('pelamar', $data_in);
        if($cek == true)
        {
            $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
            redirect(base_url('admin/pelamar'));
        }
    }


    public function riwayatpendidikan($id)
    {
        $data = [
          'judul' => "Riwayat Pendidikan",
          'side_row' => 2
        ];
        $this->load->view('pelamar/riwayatpendidikan',$data);
    }


    public function upFileKtp($post)
    {
        $_POST=$post;
        $config['upload_path']    = './res/ktp';
        $config['allowed_types']  = 'pdf|jpg|png';
        // $config['overwrite']     = TRUE;
        $config['file_name']    = 'admin'."_".$_FILES['ktp']['name'];
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->upload->do_upload('ktp');
        $detail_ktp = $this->upload->data();
        unset($config);
        return $detail_ktp;
    }
    public function upFileCv($post)
    {
        $_POST=$post;
        $config['upload_path']    = './res/cv';
        $config['allowed_types']  = 'pdf|jpg|png';
        // $config['overwrite']     = TRUE;
        $config['file_name']    = 'admin'."_".$_FILES['cv']['name'];
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->upload->do_upload('cv');
        $detail_cv = $this->upload->data();
        unset($config);
        return $detail_cv;
    }
    public function upFileIjasah($post)
    {
        $_POST=$post;
        $config['upload_path']    = './res/ijasah';
        $config['allowed_types']  = 'pdf|jpg|png';
        // $config['overwrite']     = TRUE;
        $config['file_name']    = "admin"."_".$_FILES['ijasah']['name'];
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->upload->do_upload('ijasah');
        $detail_ijasah = $this->upload->data();
        unset($config);
        return $detail_ijasah;
    }
    public function updateProfile($id)
    {
        $config['upload_path']    = './res/profile';
        $config['allowed_types']  = 'jpg|png';
        // $config['overwrite']     = TRUE;
        $config['file_name']    = 'admin'."_".$_FILES['profile']['name'];
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->upload->do_upload('profile');
        $detail_foto = $this->upload->data();
        unset($config);

        $data_in = [
          'foto' => $detail_foto['file_name']
        ];
        $this->db->where('id_user',$id);
        $cek = $this->db->update('pelamar',$data_in);
        if($cek == true)
        {
            $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
            redirect(base_url('admin/pelamar'));
        }
    }

    public function getFormEdit()
    {
        $this->db->where('id', $this->input->get('id'));
        echo json_encode($this->db->get('pendidikan')->row_array());
    }
    public function editRiwayatPendidikan($id)
    {
        $data = [
          'tingkat'   => $this->input->post('tingkat'),
          'nama'      => $this->input->post('nama'),
          'tahun'     => $this->input->post('tahun'),
          'jenis_pend'=> $this->input->post('jenis_pend')
        ];
        $this->db->where('id', $this->input->post('id'));
        $cek = $this->db->update('pendidikan',$data);
        if($cek == true)
        {
            $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
            redirect(base_url('admin/pelamar'));
        }
    }
    public function delPendidikan($id)
    {
        $this->db->where('id', $id);
        $cek = $this->db->delete('pendidikan');
        if($cek == true)
        {
            $this->session->set_flashdata('notif_1', 'Berhasil Menghapus!');
            redirect(base_url('admin/pelamar'));
        }
    }
    public function getFormEditKerja()
    {
        $this->db->where('id', $this->input->get('id'));
        echo json_encode($this->db->get('riwayat_kerja')->row_array());
    }
    public function delPekerjaan($id)
    {
        $this->db->where('id', $id);
        $cek = $this->db->delete('riwayat_kerja');
        if($cek == true)
        {
            $this->session->set_flashdata('notif_1', 'Berhasil Menghapus!');
            redirect(base_url('admin/pelamar'));
        }
    }
    public function editRiwayatPekerjaan($id)
    {
        $data = [
          'nama_perusahaan' => $this->input->post('nama_perusahaan'),
          'jabatan'         => $this->input->post('jabatan'),
          'tahun_mulai'     => $this->input->post('tahun_mulai'),
          'tahun_selesai'   => $this->input->post('tahun_selesai'),
          'gaji'            => $this->input->post('gaji')
        ];
        $this->db->where('id', $this->input->post('id'));
        $cek = $this->db->update('riwayat_kerja',$data);
        if($cek == true)
        {
            $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
            redirect(base_url('admin/pelamar'));
        }
    }


    public function insertNilai($id)
    {
        // var_dump($this->input->post('nilai_range')); die;
        $data = [
          'nilai' => $this->input->post('nilai'),
          'range_nilai' => $this->input->post('nilai_range')
        ];
        $id_user = $id;
        $this->db->where('id_user', $id_user);
        $cek = $this->db->update('pelamar',$data);
        if($cek == true)
        {
            $this->session->set_flashdata('notif_1', 'Berhasil Menyimpan!');
            redirect(base_url('admin/pelamar'));
        }
    }

}