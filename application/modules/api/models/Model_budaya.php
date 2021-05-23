<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_budaya extends CI_Model {

    public function get(){
        return $this->db->query('
            SELECT esl.`id_evaluasi`, esl.`keterangan`, esld.`deskripsi`, eslp.`pernyataan`, esl.`bobot`
            FROM evaluasi_std_layanan esl
            JOIN evaluasi_std_layanan_detail esld ON esl.`id_evaluasi`=esld.`id_evaluasi`
            JOIN evaluasi_std_layanan_pernyataan eslp ON esld.`id_evaluasi_detail`=eslp.`id_evaluasi_detail`
        ');
    }
    public function get_head(){
        return $this->db->get('evaluasi_std_layanan');
    }
    public function get_detail($id){
        return $this->db->get_where('evaluasi_std_layanan_detail',array('id_evaluasi'=>$id));
    }
    public function get_pernyataan(){
        return $this->db->get('evaluasi_std_layanan_pernyataan');
    }
    public function all_in(){
        $all = $this->db->query('
            SELECT esl.`id_evaluasi`, esl.`keterangan`, esld.`id_evaluasi_detail`, esld.`deskripsi`, eslp.`id_pernyataan`, eslp.`pernyataan`, esl.`bobot`
            FROM evaluasi_std_layanan esl
            JOIN evaluasi_std_layanan_detail esld ON esl.`id_evaluasi`=esld.`id_evaluasi`
            JOIN evaluasi_std_layanan_pernyataan eslp ON esld.`id_evaluasi_detail`=eslp.`id_evaluasi_detail`
        ')->result();
        $data = array();
        for ($i=0; $i < count($all) ; $i++){
            if($i==0){
                $data[] = array(
                    'id_evaluasi_layanan' => $all[$i]->id_evaluasi,
                    'layanan' => $all[$i]->keterangan,
                    'bobot' => $all[$i]->bobot,
                    'detail_layanan' => $this->db->get_where('evaluasi_std_layanan_detail', array('id_evaluasi'=>$all[$i]->id_evaluasi))->result_array()
                );
            }
            if($i>0 && $all[$i]->id_evaluasi!=$all[$i-1]->id_evaluasi){
                $data[] = array(
                    'id_evaluasi_layanan' => $all[$i]->id_evaluasi,
                    'layanan' => $all[$i]->keterangan,
                    'bobot' => $all[$i]->bobot,
                    'detail_layanan' => $this->db->get_where('evaluasi_std_layanan_detail', array('id_evaluasi'=>$all[$i]->id_evaluasi))->result_array()
                );
            }
        }
        return $data;
    }
    public function get_rinci($id){
        $where = array(
            'id_evaluasi_detail' => $id,
            'status_pernyataan'  => 'Aktif'
        );
        return $this->db->get_where('evaluasi_std_layanan_pernyataan',$where);
    }
}
