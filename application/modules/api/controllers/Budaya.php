<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Budaya extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        // $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->load->model('Model_budaya', 'budaya');
    }

    public function index_get()
    {
        $res = $this->budaya->all_in();
        if(count($res)>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Success load',
                ],
                'response'      => $res,
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Gagal load budaya',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function head_get(){
        $res = $this->budaya->get_head();
        if($res->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Success load',
                ],
                'response'      => $res->result(),
            ], REST_Controller::HTTP_OK);
        }else{
           $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Gagal load budaya',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }
    public function detail_get(){
        $res = $this->budaya->get_detail($this->get('id'));
        if($res->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Success load',
                ],
                'response'      => $res->result(),
            ], REST_Controller::HTTP_OK);
        }else{
           $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Gagal load budaya',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }
    public function pernyataan_get(){
        $res = $this->budaya->get_pernyataan();
        if($res->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Success load',
                ],
                'response'      => $res->result(),
            ], REST_Controller::HTTP_OK);
        }else{
           $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Gagal load budaya',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function rinci_get(){
        $id = $this->get('id');
        $res = $this->budaya->get_rinci($id);
        if($res->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Success load',
                ],
                'response'      => $res->result(),
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Gagal load budaya',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_post()
    {

    }

    public function index_put()
    {
        
    }

    public function index_delete()
    {
        
    }
}
