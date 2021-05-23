<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Absen extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        // $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->load->model('Model_absen', 'absen');
        $this->load->library('ciqrcode');
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

    public function ip_post()
    {
        $token = $this->post('token');
        $ip    = $this->post('ip');
        $cek_token = $this->absen->validasi_token($token);
        if($cek_token->num_rows()==0){
            $this->response([
                'status'        => [
                    'code'          => 111,
                    'message'       => 'Token tidak Valid',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }else{
            $kode_reg = $cek_token->row_array()['kode_register'];
            $cek_ip=$this->absen->ip_cek($kode_reg,$ip)->num_rows();
            if($cek_ip>0){
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Ip Valid',
                    ],
                    'response'      => $ip,
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_NOT_FOUND,
                        'message'       => 'Anda Belum Terhubung Jaringan Kantor',
                    ],
                    'response'      => '',
                ], REST_Controller::HTTP_OK);
            }
        }
    }
    
    public function pertanyaanpagi_get(){
        $jenis_absen = $this->get('absen');
        $kuis = $this->absen->kuis($jenis_absen);
        if($kuis->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Ip Valid',
                ],
                'response'      => $kuis->result(),
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Not found',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function selfie_post(){
        // var_dump($_FILES['file']);
        $token = $this->post('token');
        $kode_reg = $this->absen->validasi_token($token)->row_array()['kode_register'];
        $upload = move_uploaded_file($_FILES['file']['tmp_name'], 'assets/selfie/' . $kode_reg.'_'.date('Ymd').'.png');
        if($upload){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Berhasil Upload',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Gagal Upload',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function pagi_post(){
        $token = $this->post('token');
        $jwb = $this->post('jwb');
        $kunci = $this->post('kunci');
        $cek_token = $this->absen->validasi_token($token);
        if($cek_token->num_rows()>0){
            $kode_reg = $cek_token->row_array()['kode_register'];
            // set kuis
            // set table absen
            $barcode = $this->barcode($kode_reg);
            $id_absen=$this->absen->set_absen_pagi($kode_reg,$barcode);
            if( $id_absen!=false ){
                $key_kuis = $this->absen->set_kuis($kunci, $jwb, $kode_reg, $id_absen);
                if( $key_kuis!=false ){
                    // update key_kuis
                    if($this->absen->set_kuis_diabasen($key_kuis,$barcode)){
                        $this->response([
                            'status'        => [
                                'code'          => REST_Controller::HTTP_OK,
                                'message'       => 'Presensi Telah direkam',
                            ],
                            'response'      => $barcode,
                        ], REST_Controller::HTTP_OK);
                    }else{
                        // gagal set kuis
                        $this->response([
                            'status'        => [
                                'code'          => REST_Controller::HTTP_NOT_FOUND,
                                'message'       => 'gagal set kuis',
                            ],
                            'response'      => '',
                        ], REST_Controller::HTTP_OK);
                    }
                }else{
                    // gagal set kuis
                    $this->response([
                        'status'        => [
                            'code'          => REST_Controller::HTTP_NOT_FOUND,
                            'message'       => 'gagal set kuis',
                        ],
                        'response'      => '',
                    ], REST_Controller::HTTP_OK);
                }
            }else{
                // gagal absen
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_NOT_FOUND,
                        'message'       => 'gagal absen',
                    ],
                    'response'      => '',
                ], REST_Controller::HTTP_OK);
            }
        }else{
            // invalid token
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Token Invalid',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
        // var_dump($this->post('jwb'));
    }

    public function cek_absenpagi_post(){
        // cek apakah sudah absen
        $token = $this->post('token');
        $cek_token = $this->absen->validasi_token($token);
        if($cek_token->num_rows()>0){
            $kode_reg = $cek_token->row_array()['kode_register'];
            $today_cek =$this->absen->cek_absen_pagi($kode_reg);
            if($today_cek!=false){ // jika sudah absen
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_OK,
                        'message'       => 'Anda Telah Absen Hari ini',
                    ],
                    'response'      => $today_cek,
                ], REST_Controller::HTTP_OK);
            }else{
                // belum absen
                $this->response([
                    'status'        => [
                        'code'          => 100,
                        'message'       => 'Belum Absen',
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

    public function cek_absensore_post(){
        // cek apakah sudah absen
        $token = $this->post('token');
        $cek_token = $this->absen->validasi_token($token);
        if($cek_token->num_rows()>0){
            $kode_reg = $cek_token->row_array()['kode_register'];
            $today = $this->absen->cek_absen_sore($kode_reg);
            if($today!=200&&$today!=404){
                $this->response([
                    'status'        => [
                        'code'          => 100,
                        'message'       => 'Belum Absen sore',
                    ],
                    'response'      => $today,
                ], REST_Controller::HTTP_OK);
            }elseif($today==200){
                $this->response([
                    'status'        => [
                        'code'          => $today,
                        'message'       => 'Sudah Absen Sore',
                    ],
                    'response'      => $this->absen->sudah_absen($kode_reg),
                ], REST_Controller::HTTP_OK);
            }elseif($today==404){
                $this->response([
                    'status'        => [
                        'code'          => $today,
                        'message'       => 'Anda belum presensi pagi',
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

    public function barcode($kode_reg){
        date_default_timezone_set('Asia/Jakarta');
        $time=date('Ymd');
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/barcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $kode = rand(1000,9999);
        $image_name=(string)$kode_reg.$time.$kode.'.png'; //buat name dari qr code sesuai dengan nim
        $params['data'] = "http://172.20.10.4/sikeren_web/ratting/main/index/".(string)$kode_reg.$time.$kode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        return (string)$kode_reg.$time.$kode;
    }

    public function sore_post(){
        $token = $this->post('token');
        $jwb   = $this->post('jwb');
        $kunci = $this->post('kunci');
        $cek_token = $this->absen->validasi_token($token);
        // ambil key hari absen hari ini
        if($cek_token->num_rows()>0){
            $kode_reg = $cek_token->row_array()['kode_register'];
            $hasil_absen = $this->absen->set_absen_sore($kode_reg);
            // var_dump($hasil_absen);
            if($hasil_absen != -1 && $hasil_absen != -2){
                //set absen sore
                $set_jam = $this->absen->set_jam_sore($kode_reg);
                if($set_jam){
                    $kuis_sore = $this->absen->set_kuissore($kunci, $jwb, $set_jam['key_trans']);
                    if($kuis_sore){
                        $this->response([
                            'status'        => [
                                'code'          => REST_Controller::HTTP_OK,
                                'message'       => 'Presensi Berhasil direkam',
                            ],
                            'response'      => array(
                                'value' => $hasil_absen,
                                'time'  => $set_jam
                            ),
                        ], REST_Controller::HTTP_OK);
                    }else{
                        $this->response([
                            'status'        => [
                                'code'          => REST_Controller::HTTP_NOT_FOUND,
                                'message'       => 'Gagal Set kuis',
                            ],
                            'response'      => '',
                        ], REST_Controller::HTTP_OK);
                    }
                        // 
                }else{
                    $this->response([
                        'status'        => [
                            'code'          => REST_Controller::HTTP_NOT_FOUND,
                            'message'       => 'Gagal Set absen sore',
                        ],
                        'response'      => '',
                    ], REST_Controller::HTTP_OK);
                }
            }elseif($hasil_absen== -2){
                $set_jam = $this->absen->set_jam_sore($kode_reg);
                $kuis_sore = $this->absen->set_kuissore($kunci, $jwb, $set_jam['key_trans']);
                if($kuis_sore){
                    $this->response([
                        'status'        => [
                            'code'          => 303,
                            'message'       => 'Presensi Berhasil',
                        ],
                        'response'      => array(
                                                'value' => 4,
                                                'time'  => $this->absen->set_jam_sore($kode_reg)
                                            ),
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->response([
                        'status'        => [
                            'code'          => REST_Controller::HTTP_NOT_FOUND,
                            'message'       => 'Presensi Gagal',
                        ],
                        'response'      => '',
                    ], REST_Controller::HTTP_OK);
                }
            }
            else{
                $this->response([
                    'status'        => [
                        'code'          => REST_Controller::HTTP_NOT_FOUND,
                        'message'       => 'Transaksi Tidak terdaftar',
                    ],
                    'response'      => '',
                ], REST_Controller::HTTP_OK);
            }
        }else{
            $this->response([
                'status'        => [
                    'code'          => 110,
                    'message'       => 'Token Invalid',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }

    public function pert_sore_get(){
        $res = $this->absen->getpertsore();
        if($res->num_rows()>0){
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_OK,
                    'message'       => 'Success load quis',
                ],
                'response'      => $res->result(),
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'        => [
                    'code'          => REST_Controller::HTTP_NOT_FOUND,
                    'message'       => 'Gagal memuat quisioner',
                ],
                'response'      => '',
            ], REST_Controller::HTTP_OK);
        }
    }
}
