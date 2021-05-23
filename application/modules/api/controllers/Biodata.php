<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Biodata extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        // $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->load->model('Model_biodata', 'bio');
    }

    public function index_get()
    {
        
    }

    public function index_post()
    {
        $token = $this->input->post('token');
        $valid = $this->bio->validasi_token($token);
        if($valid->num_rows()>0){
            $kode_reg = $valid->row_array()['kode_register'];
            $biodata = $this->bio->get_bio($kode_reg);
            if($biodata->num_rows()>0){
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Success Load',
                    ],
                    'response'      => $biodata->row_array(),
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_NOT_FOUND,
                        'message'       => 'Missing Data',
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

    public function index_put()
    {
        
    }

    public function index_delete()
    {
        
    }
}
