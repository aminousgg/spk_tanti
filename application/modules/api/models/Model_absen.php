<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_absen extends CI_Model {

    public function validasi_token($token){
        return $this->db->get_where('akun_mobile',array('token'=>$token));
    }
    public function ip_cek($kode_reg, $ip){
        // echo $ip;
        return $this->db->query('
            SELECT du.`kode_register`, ic.`ip_address`
            FROM datauser du JOIN ipcabang ic ON du.`kode_cabang`=ic.`kode_cabang`
            WHERE du.`kode_register` = "'.$kode_reg.'" AND ic.`ip_address` LIKE "'.$ip.'%"
        ');
    }
    public function kuis($jenis){
        $this->db->where('jenis', $jenis);
        $this->db->group_by('pertanyaan');
        return $this->db->get('pertanyaan');
    }
    public function set_absen_pagi($kode_register,$barcode){
        $absen = array(
            'kode_register' => $kode_register,
            'pagi'          => date('Y-m-d H:i:s'),
            'barcode'       => $barcode,
            'status'        => 'waiting'
        );
        if($this->db->insert('absen',$absen)){
            $this->db->select('id, kode_register, DATE(pagi) AS tgl');
            $in = $this->db->get_where('absen',array('barcode'=>$barcode))->row_array();
            $this->db->reset_query();
            $arr_nilai = array(
                'kode_register' => $in['kode_register'],
                'tgl'           => $in['tgl'],
                'id_absen'      => $in['id']
            );
            if($this->db->insert('nilai', $arr_nilai)){
                return $in['id'];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function set_kuis($kunci,$jwb,$kode_register,$id_absen){
        $key = rand(10000,99999);
        $check =0;
        for($i=0; $i<count($jwb); $i++){
            $this->db->select('id');
            $data = $this->db->get_where( 'pertanyaan', array('kunci'=>$kunci[$i],'jawaban'=>$jwb[$i]) );
            if($data->num_rows()>0){
                $set = array(
                    'key_kuis'      => $key,
                    'kode_register' => $kode_register,
                    'id_pert'       => $data->row_array()['id'],
                    'id_absen'      => $id_absen
                );
                if(!$this->db->insert('kuis_pagi',$set)){
                    $check = $check+1;
                }
            }else{
                $check = $check+1;
            }
        }
        if($check==0){
            return $key;
        }else{
            return false;
        }
    }

    public function set_kuis_diabasen($key_kuis,$barcode){
        $this->db->where('barcode',$barcode);
        $key = (string)rand(100,999);
        $up = array(
            'key_kuis' => $key_kuis,
            'key_trans'=> $barcode."-".$key
        );
        if($this->db->update('absen',$up)){
            $in = array(
                'key_transaksi' => $barcode."-".$key,
                'barcode'       => $barcode,
                'tgl'           => date('Y-m-d'),
                'total_nilai'   => 0,
                'jml_rat'       => 0
            );
            return $this->db->insert('transaksi',$in);
        }
    }

    public function cek_absen_pagi($kode_reg){
        $today = date('Y-m-d');
        $cek = $this->db->query('
            SELECT *
            FROM absen
            WHERE kode_register = "'.$kode_reg.'" AND pagi LIKE "%'.$today.'%"
        ');
        if($cek->num_rows()>0){
            return $cek->row_array()['barcode'];
        }else{
            return false;
        }
    }

    public function cek_absen_sore($kode_reg){
        $today = date('Y-m-d');
        $cek = $this->db->query('
            SELECT *
            FROM absen
            WHERE kode_register = "'.$kode_reg.'" AND pagi LIKE "%'.$today.'%"
        ');
        if($cek->num_rows()>0){
            if($cek->row_array()['sore']!="0000-00-00 00:00:00"){
                return 200; //kode sudah absen
            }else{
                return $cek->row_array()['key_trans']; //kode belum absen sore
            }
        }else{
            return 404; //kode absen tidak ditemukan
        }
    }

    public function set_absen_sore($kode_reg){
        // ambil key trans
        $today = date('Y-m-d');
        $key = $this->db->query('
            SELECT *
            FROM absen
            WHERE kode_register = "'.$kode_reg.'" AND pagi LIKE "%'.$today.'%"
        ');
        if($key->num_rows()>0){
            //var_dump($key->row_array()['key_trans']);
            $this->db->where('key_transaksi', $key->row_array()['key_trans']);
            $trans = $this->db->get('transaksi');
            // var_dump();
            if($trans->row_array()['jml_rat']!=0){
                // set rate
                $rate = $trans->row_array()['total_nilai']/$trans->row_array()['jml_rat'];
                $up = array(
                    'rate' => $rate
                );
                $this->db->where('key_trans', $key->row_array()['key_trans']);
                if($this->db->update('absen',$up)){
                    return $rate;
                }else{
                    return -1;
                }
            }else{
                return -2;
            }
            
        }else{
            return -1;
        }
    }
    public function set_jam_sore($kode_reg){
        $today = date('Y-m-d');
        $absen = $this->db->query('
            SELECT *
            FROM absen
            WHERE kode_register = "'.$kode_reg.'" AND pagi LIKE "%'.$today.'%"
        ');
        if($absen->num_rows()>0){
            $this->db->where('key_trans', $absen->row_array()['key_trans']);
            // update jam sore
            $up = array(
                'sore' => date('Y-m-d H:i:s'),
                'status'=> 'waiting'
            );
            if( $this->db->update('absen',$up) ){
                $this->db->where('key_transaksi', $absen->row_array()['key_trans']);
                $trans = $this->db->get('transaksi');
                if($trans->num_rows()>0){
                    $this->db->select('pagi, sore, key_trans');
                    $this->db->where('key_trans', $absen->row_array()['key_trans']);
                    return $this->db->get('absen')->row_array();
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    public function sudah_absen($kode_reg){
        $today = date('Y-m-d');
        $absen = $this->db->query('
            SELECT *
            FROM absen
            WHERE kode_register = "'.$kode_reg.'" AND pagi LIKE "%'.$today.'%"
        ');
        if($absen->num_rows()>0){
            $this->db->where('key_trans', $absen->row_array()['key_trans']);
            $data = $this->db->get('absen')->row_array();
            $pagi = explode(" ",$data['pagi']);
            $sore = explode(" ",$data['sore']);
            if($data['status']=="waiting"){
                $res = "kosong"."-".$pagi[1]."-".$sore[1];
                return $res;
            }else{
                $res = (string)$data['rate']."-".$pagi[1]."-".$sore[1];
                return $res;
            }

        }else{
            return 0;
        }
    }

    public function getpertsore(){
        $this->db->select('kunci, pertanyaan, jwb');
        $this->db->from('pert_sore');
        $this->db->group_by('kunci');
        return $this->db->get();
    }
    public function set_kuissore($kunci, $jwb, $key_trans){
        $cek = 0;
        for($i=0; $i<count($jwb);$i++){
            $w = array(
                'kunci' => $kunci[$i],
                'jwb'   => $jwb[$i] 
            );
            $this->db->select('id');
            $this->db->where($w);
            $id_pert = $this->db->get('pert_sore')->row_array()['id'];
            $in = array(
                'key'   => $key_trans,
                'id_pert_sore' => $id_pert
            );
            if(!$this->db->insert('kuis_sore',$in)){
                $cek++;
            }
        }

        if($cek==0){
            return true;
        }else{
            return false;
        }
    }
}
