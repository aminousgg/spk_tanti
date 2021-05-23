<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        $this->load->model('Mahasiswa_model', 'mahasiswa');
    }

    public function index_get()
    {
        $id         = $this->get('id');
        $response   = $this->mahasiswa->read()->result();
        if($id == NULL)
        {
            if($response)
            {
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Data Tersedia',
                    ],
                    'response'      => $response,
                ], REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_NOT_FOUND,
                        'message'       => 'Data Tidak Ditemukan',
                    ],
                    'response'      => ''
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        else
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Id Ditemukan',
                ],
                'response'      => $this->mahasiswa->read($id)->result(),
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $response   = $this->mahasiswa->create();
        if($response)
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Berhasil Menambahkan Data',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Gagal Menambahkan Data',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_put()
    {
        $id         = $this->put('id');
        $response   = $this->mahasiswa->update($id);
        if($response)
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Berhasil Mengubah Data',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Gagal Mengubah Data',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id     = $this->delete('id');
        if($id == NULL)
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Berhasil Menghapus Data',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        else
        {
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Gagal Menghapus Data',
                ],
                'response'      => ''
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
