<?php
class SpkModel extends CI_Model {
    

    public function getAnalitc()
    {
        $data = $this->db->select('id, id_user, nama')
                         ->where('nama is NOT NULL', NULL, FALSE)
                         ->get('pelamar')->result();
        $pelamar = [];
        foreach($data as $row)
        {
            $pelamar[] = [
                'id'            => $row->id,
                'id_user'       => $row->id_user,
                'nama'          => $row->nama,
                'pendidikan'    => $this->valuePendidikan($row->id_user),
                'non_pend'      => $this->valuePendNonFormal($row->id_user),
                'pengalaman'    => $this->valueRiwayatPekerjaan($row->id_user),
                'nilai'         => $this->valueIPK($row->id_user),
                'umur'          => $this->valueUmur($row->id_user),
                'sum'           => $this->sum($row->id_user)
            ];
        }
        return $pelamar;
    }

    public function valuePendidikan($id_user)
    {   
        $w = [
            'id_user'=>$id_user,
            'jenis_pend'=>"Formal"
        ];
        $pelamar = $this->db->select('*')
                            ->from('pendidikan')
                            ->where($w)
                            ->order_by('tahun','desc')
                            ->limit(1)
                            ->get()->row_array();

        if($pelamar['tingkat'] == "SD")
        {
            return 0;
        }
        elseif($pelamar['tingkat'] == "SMP")
        {
            return 30;
        }
        elseif($pelamar['tingkat'] == "SMA")
        {
            return 70;
        }
        elseif($pelamar['tingkat'] == "S1")
        {
            return 100;
        }
        else
        {
            return 0;
        }
        
    }

    public function valuePendNonFormal($id_user)
    {
        $w = [
            'id_user'=>$id_user,
            'jenis_pend'=>"Non"
        ];
        $pelamar = $this->db->get_where('pendidikan',$w)->num_rows();
        if($pelamar>0)
        {
            return 10;
        }
        elseif($pelamar>1)
        {
            return 100;
        }
        else
        {
            return 0;
        }
    }

    public function valueRiwayatPekerjaan($id_user)
    {
        $get_awal = (int)$this->db->select('tahun_mulai')
                             ->order_by('tahun_mulai','asc')
                             ->limit(1)
                             ->get_where('riwayat_kerja')->row_array()['tahun_mulai'];
        $get_akhir = (int)$this->db->select('tahun_selesai')
                             ->order_by('tahun_selesai','desc')
                             ->limit(1)
                             ->get_where('riwayat_kerja')->row_array()['tahun_selesai'];
        $selisih = $get_akhir - $get_awal;
        if($selisih == 1)
        {
            return 70;
        }
        elseif($selisih>1)
        {
            return 100;
        }
        elseif($selisih == 0)
        {
            return 10;
        }
        else
        {
            return 0;
        }

    }

    public function valueIPK($id_user)
    {
        $w = [
            'id_user' => $id_user
        ];
        $pelamar = $this->db->select('*')
                            ->get_where('pelamar', $w)->row_array();
        // print_r($pelamar); die;
        if((int)$pelamar['range_nilai']==4)
        {
            $convert = (int)$pelamar['nilai'] * 2.5;
            $hasil = $convert * 10;
            return $hasil;
        }
        if((int)$pelamar['range_nilai']==10)
        {
            return (int)$pelamar['nilai'];
        }
        else
        {
            return 0;
        }
    }

    public function valueUmur($id_user)
    {
        $pelamar = $this->db->query("
            SELECT TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) AS age
            FROM pelamar
            WHERE id_user = '$id_user'
        ")->row_array();
        if((int)$pelamar['age'] <= 28 && (int)$pelamar['age'] >= 18){
            return 100;
        }
        elseif( (int)$pelamar['age'] > 28 && (int)$pelamar['age'] < 35)
        {
            return 70;
        }
        elseif((int)$pelamar['age'] >= 35)
        {
            return 30;
        }
        else
        {
            return 0;
        }

        
    }

    public function sum($id_user)
    {
        return ($this->valuePendidikan($id_user)*0.3) + ($this->valuePendNonFormal($id_user)*0.05) + ($this->valueRiwayatPekerjaan($id_user)*0.4) + ($this->valueIPK($id_user)*0.3) + ($this->valueUmur($id_user)*0.05);
    }

}