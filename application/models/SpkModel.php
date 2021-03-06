<?php
class SpkModel extends CI_Model {
    

    public function getAnalitc()
    {
        // var_dump($this->arrayOfMax()['maxPend']); die;
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
                'pendidikan'    => $this->valuePendidikan($row->id_user)."<p class='float-right text-success m-0'>(30%)</p>",
                'non_pend'      => $this->valuePendNonFormal($row->id_user)."<p class='float-right text-success m-0'>(5%)</p>",
                'pengalaman'    => $this->valueRiwayatPekerjaan($row->id_user)."<p class='float-right text-success m-0'>(30%)</p>",
                'nilai'         => $this->valueIPK($row->id_user)."<p class='float-right text-success m-0'>(30%)</p>",
                'umur'          => $this->valueUmur($row->id_user)."<p class='float-right text-success m-0'>(5%)</p>",
                'sum'           => $this->sum($row->id_user)
            ];
        }
        return $pelamar;
    }

    public function getProcessView()
    {
        // var_dump($this->arrayOfMax()['maxPend']); die;
        $this->load->model('MaxValue','val');
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
                'pendidikan'    => $this->val->valuePendidikan($row->id_user)." / ".$this->arrayOfMax()['maxPend']." = <p class='float-right text-success m-0'>".$this->valuePendidikan($row->id_user)."</p>",
                'non_pend'      => $this->val->valuePendNonFormal($row->id_user)." / ".$this->arrayOfMax()['maxnPend']." = <p class='float-right text-success m-0'>".$this->valuePendNonFormal($row->id_user)."</p>",
                'pengalaman'    => $this->val->valueRiwayatPekerjaan($row->id_user)." / ".$this->arrayOfMax()['maxKerja']." = <p class='float-right text-success m-0'>".$this->valueRiwayatPekerjaan($row->id_user)."</p>",
                'nilai'         => $this->val->valueIPK($row->id_user)." / ".$this->arrayOfMax()['maxIpk']." = <p class='float-right text-success m-0'>".$this->valueIPK($row->id_user)."</p>",
                'umur'          => $this->val->valueUmur($row->id_user)." / ".$this->arrayOfMax()['maxUmur']." = <p class='float-right text-success m-0'>".$this->valueUmur($row->id_user)."</p>",
                'sum'           => $this->sum($row->id_user)
            ];
        }
        return $pelamar;
    }

    public function acuracy()
    {
        $pelamar = $this->db->get('pelamar');
        $jml = $pelamar->num_rows();
        $data = $pelamar->result();
        $total = 0;
        foreach($data as $row)
        {
            $total = $total + $this->sum($row->id_user);
        }
        $rata2 = round($total/$jml, 4);
        $result = (100 - $rata2)/(int)$jml;
        return [
            'jml_pelamar'   => $jml,
            'total'         => $total,
            'rata'          => $rata2,
            'result'        => $result
        ];
    }

    public function arrayOfMax()
    {
        $this->load->model('MaxValue','val');
        $data = $this->db->select('id, id_user, nama')
                         ->where('nama is NOT NULL', NULL, FALSE)
                         ->get('pelamar')->result();
        $pend  = [];
        $nPend = [];
        $kerja = [];
        $ipk   = [];
        $umur  = [];
        foreach($data as $row)
        {
            $pend[]  = $this->val->valuePendidikan($row->id_user);
            $nPend[] = $this->val->valuePendNonFormal($row->id_user);
            $kerja[] = $this->val->valueRiwayatPekerjaan($row->id_user);
            $ipk[]   = $this->val->valueIPK($row->id_user);
            $umur[]  = $this->val->valueUmur($row->id_user);
        }
        return [
            'maxPend'   => max($pend),
            'maxnPend'  => max($nPend),
            'maxKerja'     => max($kerja),
            'maxIpk'       => max($ipk),
            'maxUmur'      => max($umur)
        ];
    }


    public function getMaxPendidikan()
    {
        $data = $this->db->select('id, id_user, nama')
                         ->where('nama is NOT NULL', NULL, FALSE)
                         ->get('pelamar')->result_array();
        $pelamar = [];
        $i= 0;
        $sum = 0;
        for($i = 0; $i>count($data); $i++)
        {
            if($this->sum($data[$i]['id_user']) > $this->sum($data[$i+1]['id_user']))
            {
                $pelamar[] = "";
            }
            else
            {

            }
        }
        
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
            return round(0/$this->arrayOfMax()['maxPend'], 4);
        }
        elseif($pelamar['tingkat'] == "SMP")
        {
            return round(0.3/$this->arrayOfMax()['maxPend'], 4);
        }
        elseif($pelamar['tingkat'] == "SMA")
        {
            return round(0.7/$this->arrayOfMax()['maxPend'], 4);
        }
        elseif($pelamar['tingkat'] == "S1")
        {
            return round(1/$this->arrayOfMax()['maxPend'], 4);
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
            return round(0.1/$this->arrayOfMax()['maxnPend'], 4);
        }
        elseif($pelamar>1)
        {
            return round(1/$this->arrayOfMax()['maxnPend'], 4);
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
                             ->get_where('riwayat_kerja',['id_user'=>$id_user])->row_array()['tahun_mulai'];
        $get_akhir = (int)$this->db->select('tahun_selesai')
                             ->order_by('tahun_selesai','desc')
                             ->limit(1)
                             ->get_where('riwayat_kerja',['id_user'=>$id_user])->row_array()['tahun_selesai'];
        $selisih = (int)$get_akhir - (int)$get_awal;
        // echo $selisih; die;
        if($selisih>0 && $selisih<=1)
        {
            return round(0.7/$this->arrayOfMax()['maxKerja'], 4);
        }
        elseif($selisih>1)
        {
            return round(1/$this->arrayOfMax()['maxKerja'], 4);
        }
        elseif($selisih == 0)
        {
            return round(0.2/$this->arrayOfMax()['maxKerja'], 4);
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
                return round(0.3/$this->arrayOfMax()['maxIpk'], 4);
            }
            elseif($hasil>55 && $hasil<=70)
            {
                return round(0.5/$this->arrayOfMax()['maxIpk'], 4);
            }
            elseif($hasil>70 && $hasil<=85)
            {
                return round(0.7/$this->arrayOfMax()['maxIpk'], 4);
            }
            elseif($hasil>85 && $hasil<=100)
            {
                return round(1/$this->arrayOfMax()['maxIpk'], 4);
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
                return round(0.3/$this->arrayOfMax()['maxIpk'], 4);
            }
            elseif((int)$pelamar['nilai']>55 && (int)$pelamar['nilai']<=70)
            {
                return round(0.5/$this->arrayOfMax()['maxIpk'], 4);
            }
            elseif((int)$pelamar['nilai']>70 && (int)$pelamar['nilai']<=85)
            {
                return round(0.7/$this->arrayOfMax()['maxIpk'], 4);
            }
            elseif((int)$pelamar['nilai']>85 && (int)$pelamar['nilai']<=100)
            {
                return round(1/$this->arrayOfMax()['maxIpk'], 4);
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
            return round(1/$this->arrayOfMax()['maxUmur'], 4);
        }
        elseif( (int)$pelamar['age'] > 28 && (int)$pelamar['age'] < 35)
        {
            return round(0.7/$this->arrayOfMax()['maxUmur'], 4);
        }
        elseif((int)$pelamar['age'] >= 35)
        {
            
            return round(0.3/$this->arrayOfMax()['maxUmur'], 4);
        }
        else
        {
            return round(0/$this->arrayOfMax()['maxUmur'], 4);
        }

        
    }

    public function sum($id_user)
    {
        // return $this->arrayOfMax()['maxUmur'];
        return round( ($this->valuePendidikan($id_user)*0.3) + ($this->valuePendNonFormal($id_user)*0.05) + ($this->valueRiwayatPekerjaan($id_user)*0.3) + ($this->valueIPK($id_user)*0.3) + ($this->valueUmur($id_user)*0.05), 4);
    }

}