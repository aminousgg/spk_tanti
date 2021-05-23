<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Uang_saku extends REST_Controller {
                
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        $this->load->model('Model_uangsaku', 'uangsaku');
    }
    public function list_post(){
        $token = $this->post('token');
        $valid = $this->uangsaku->validasi($token);
        if($valid->num_rows()>0){
            $kode_reg = $valid->row_array()['kode_register'];
            $list = $this->uangsaku->get_list($kode_reg);
            if($list->num_rows()>0){
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Success load',
                    ],
                    'response'      => $list->result(),
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_NOT_FOUND,
                        'message'       => 'Data tidak ditemukan',
                    ],
                    'response'      => ''
                ], REST_Controller::HTTP_OK);
            }
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Token invalid',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_OK);
        }
    }

    public function perbulan_post(){
        // var_dump($this->post());
        $id = $this->post('id');
        $get = $this->uangsaku->by_bulan($id);
        if($get->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Success load',
                ],
                'response'      => $get->row_array()
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Data Tidak ditemukan',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_OK);
        }
    }
}
