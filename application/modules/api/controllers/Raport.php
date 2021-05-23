<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Raport extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        $this->load->model('Model_raport', 'raport');
    }

    public function bulan_post(){
        $token = $this->post('token');
        $valid = $this->raport->validasi($token);
        if($valid->num_rows()>0){
            $kode_reg = $valid->row_array()['kode_register'];
            $res = $this->raport->list_bulan($kode_reg);
            if($res->num_rows()>0){
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'success',
                    ],
                    'response'      => $res->result(),
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_NOT_FOUND,
                        'message'       => 'Tidak ada record nilai',
                    ],
                    'response'      => '',
                ], REST_Controller::HTTP_OK);
            }
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Token Invalid',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_post(){
        $token = $this->post('token');
        $date  = $this->post('tgl');
        $valid = $this->raport->validasi($token);
        if($valid->num_rows()>0){
            $kode_reg = $valid->row_array()['kode_register'];
            $res = $this->raport->get($date, $kode_reg);
            if($res->num_rows()>0){
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'success',
                    ],
                    'response'      => $res->row_array(),
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_NOT_FOUND,
                        'message'       => 'Tidak ada record nilai',
                    ],
                    'response'      => '',
                ], REST_Controller::HTTP_OK);
            }
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Token Invalid',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }
}
