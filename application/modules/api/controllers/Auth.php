<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        // $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->load->model('Model_auth', 'auth');
    }

    public function index_get()
    {
        
    }

    public function index_post()
    {
        $where = array(
            'kode_register' => $this->post('kode_register'),
            'password'      => md5($this->post('pass'))
        );
        $response   = $this->auth->login($where)->num_rows();
        if($response>0){
            $token = $this->auth->set_auth($where);
        }else{
            $token=false;
        }
        // 
        if($response>0 && $token!=false)
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Berhasil Login',
                ],
                'response'      => $token,
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'kode register dan password salah',
                ],
                'response'      => $response." ".$token,
            ], REST_Controller::HTTP_OK);
        }
    }

    public function token_post()
    {
        $token = $this->post('token');
        $response = $this->auth->get_auth($token);
        if($response->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Token Valid',
                ],
                'response'      => $response->row_array()['token'],
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Token tidak Valid',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function home_get(){
        $token = $this->get('token');
        $kode = $this->auth->kode_reg($token);
        $response = $this->auth->home($kode);
        if($response->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Token Valid',
                ],
                'response'      => array(
                                        'nama_user' => $response->row_array()['nama'],
                                        'photo'     => base_url('assets/profile')."/".$response->row_array()['foto']
                                    ),
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Token tidak Valid',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_put()
    {
        
    }

    public function index_delete()
    {
        
    }
}
