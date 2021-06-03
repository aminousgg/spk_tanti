<?php
class MaxValue extends CI_Model {
    
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
            return 0.3;
        }
        elseif($pelamar['tingkat'] == "SMA")
        {
            return 0.7;
        }
        elseif($pelamar['tingkat'] == "S1")
        {
            return 1;
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
            return 0.1;
        }
        elseif($pelamar>1)
        {
            return 1;
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
            return 0.7;
        }
        elseif($selisih>1)
        {
            return 1;
        }
        elseif($selisih == 0)
        {
            return 0.1;
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
            // return $hasil;
            if($hasil<40)
            {
                return 0;
            }
            elseif($hasil>40 && $hasil<=55)
            {
                return 0.3;
            }
            elseif($hasil>55 && $hasil<=70)
            {
                return 0.5;
            }
            elseif($hasil>70 && $hasil<=85)
            {
                return 0.7;
            }
            elseif($hasil>85 && $hasil<=100)
            {
                return 1;
            }
        }
        if((int)$pelamar['range_nilai']==10)
        {
            if((int)$pelamar['nilai']<40)
            {
                return 0;
            }
            elseif((int)$pelamar['nilai']>40 && (int)$pelamar['nilai']<=55)
            {
                return 0.3;
            }
            elseif((int)$pelamar['nilai']>55 && (int)$pelamar['nilai']<=70)
            {
                return 0.5;
            }
            elseif((int)$pelamar['nilai']>70 && (int)$pelamar['nilai']<=85)
            {
                return 0.7;
            }
            elseif((int)$pelamar['nilai']>85 && (int)$pelamar['nilai']<=100)
            {
                return 1;
            }
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
            return 1;
        }
        elseif( (int)$pelamar['age'] > 28 && (int)$pelamar['age'] < 35)
        {
            return 0.7;
        }
        elseif((int)$pelamar['age'] >= 35)
        {
            return 0.3;
        }
        else
        {
            return 0;
        }

        
    }
    

}