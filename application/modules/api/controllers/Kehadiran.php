<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kehadiran extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        $this->load->model('Model_kehadiran', 'kehadiran');
    }
    public function list_post(){
        $token = $this->post('token');
        $valid = $this->kehadiran->validasi($token);
        if($valid->num_rows()>0){
            $kode_reg = $valid->row_array()['kode_register'];
            $get = $this->kehadiran->get_list($kode_reg);
            if($get->num_rows()>0){
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Success load list',
                    ],
                    'response'      => $get->result(),
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Success load list',
                    ],
                    'response'      => $get->result(),
                ], REST_Controller::HTTP_OK);
            }
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Token tdk valid',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_OK);
        }
    }

    public function detail_post(){
        $token = $this->post('token');
        $bulan = $this->post('bulan');
        $valid = $this->kehadiran->validasi($token);
        if($valid->num_rows()>0){
            $kode_reg = $valid->row_array()['kode_register'];
            $get = $this->kehadiran->get_detail($kode_reg, $bulan);
            if($get->num_rows()>0){
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Success load list',
                    ],
                    'response'      => $get->result(),
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Success load list',
                    ],
                    'response'      => $get->result(),
                ], REST_Controller::HTTP_OK);
            }
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Token tdk valid',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_OK);
        }
    }
}
