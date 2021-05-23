<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Global_ extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        // $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->load->model('Model_global', 'global');
    }

    public function index_get()
    {
        
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
        // $this->response([
        //     'status'        => [
        //         'code'          => REST_Controller::HTTP_NOT_FOUND,
        //         'message'       => 'Token tdk valid',
        //     ],
        //     'response'      => ''
        // ], REST_Controller::HTTP_OK);
    public function info_get(){
        $res = $this->global->show_info();
        if($res->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'informasi di temukan',
                ],
                'response'      => $res->result(),
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Tidak ada informasi',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_OK);
        }
    }
}
