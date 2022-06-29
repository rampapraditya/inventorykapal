<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Api
 *
 * @author RAMPA
 */
class Api extends BaseController {
    
    private $model;
    private $modul;
    
    use ResponseTrait;

    public function __construct() {
        $this->model = new Mcustom();
        $this->modul= new Modul();
    }
    
    public function index() {
        $response = array();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $response["kode"] = 1;
            $response["pesan"] = "Bukan hak akses anda";
        }else{
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }
    
    public function login() {
        $response = array();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $security = $this->request->getPost('security');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            if($security == "Pr4medi4InvTorITNIAL"){
                // mengakses database
                $enkrip_pass = $this->modul->enkrip_pass($password);
                $jml = $this->model->getAllQR("SELECT count(*) as jml FROM users where nrp = '".$username."';")->jml;
                if($jml > 0){
                    $jml1 = $this->model->getAllQR("select count(*) as jml from users where nrp = '".$username."' and pass = '".$enkrip_pass."';")->jml;
                    if($jml1 > 0){
                        $data = $this->model->getAllQR("select idusers, nrp, nama, idrole from users where nrp = '".$username."';");
                        
                        $response["kode"] = 1;
                        $response["pesan"] = "Login sukses";
                        $response["idusers"] = $data->idusers;
                        $response["nrp"] = $data->nrp;
                        $response["nama"] = $data->nama;
                        $response["role"] = $data->idrole;
                    }else{
                        $response["kode"] = 0;
                        $response["pesan"] = "Akses ditolak";
                        $response["idusers"] = "";
                        $response["nrp"] = "";
                        $response["nama"] = "";
                        $response["role"] = "";
                    }
                }else{
                    $response["kode"] = 0;
                    $response["pesan"] = "Pengguna tidak ditemukan";
                    $response["idusers"] = "";
                    $response["nrp"] = "";
                    $response["nama"] = "";
                    $response["role"] = "";
                }
            }else{
                $response["kode"] = 0;
                $response["pesan"] = "Bukan hak akses anda";
                $response["idusers"] = "";
                $response["nrp"] = "";
                $response["nama"] = "";
                $response["role"] = "";
            }
        }else{
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
            $response["idusers"] = "";
            $response["nrp"] = "";
            $response["nama"] = "";
            $response["role"] = "";
        }
        return $this->respond($response);
    }
    
    public function load_profile() {
        $response = array();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $idusers = $this->request->getPost('idusers');
            // cek users
            $cek = $this->model->getAllQR("select count(*) as jml from users where idusers = '".$idusers."';")->jml;
            if($cek > 0){
                $response["kode"] = 1;
                $response["pesan"] = "User ditemukan";
                $data = $this->model->getAllQR("select * from users where idusers = '".$idusers."';");
                $def_foto = base_url().'/images/noimg.jpg';
                if(strlen($data->foto) > 0){
                    if(file_exists($this->modul->getPathApp().$data->foto)){
                        $def_foto = base_url().'/uploads/'.$foto;
                    }
                }
                $response['data'] = $data;
                $response['foto'] = $def_foto;
            
            }else{
                $response["kode"] = 0;
                $response["pesan"] = "User tidak ditemukan";
            }
        }else{
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }
    
}
