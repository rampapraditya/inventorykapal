<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Login
 *
 * @author RAMPA
 */
class Login extends BaseController {
    
    private $model;
    private $modul;
    
    public function __construct() {
        $this->model = new Mcustom();
        $this->modul= new Modul();
    }
    
    public function index(){
        // membaca logo
        $def_logo = base_url().'/images/noimg.jpg';
        $logo = $this->model->getAllQR("select logo from identitas;")->logo;
        if (strlen($logo) > 0) {
            if (file_exists($this->modul->getPathApp().$logo)) {
                $def_logo = base_url().'/uploads/'.$logo;
            }
        }
        $data['logo'] = $def_logo;
            
        echo view('login', $data);
    }
    
    public function proses() {
        clearstatcache();
        
        $user = strtolower(trim($this->request->getVar('nrp')));
        $pass = trim($this->request->getVar('pass'));
        
        $enkrip_pass = $this->modul->enkrip_pass($pass);
        $jml = $this->model->getAllQR("SELECT count(*) as jml FROM users where username = '".$user."';")->jml;
        if($jml > 0){
            $jml1 = $this->model->getAllQR("select count(*) as jml from users where username = '".$user."' and pass = '".$enkrip_pass."';")->jml;
            if($jml1 > 0){
                $data = $this->model->getAllQR("select idusers, username, nama, idrole from users where username = '".$user."';");
                if($data->idrole == "R00001"){
                    session()->set([
                        'username' => $data->idusers,
                        'nrp' => $data->username,
                        'nama' => $data->nama,
                        'role' => $data->idrole,
                        'logged_in' => TRUE
                    ]);
                    $status = "ok";
                }else{
                    session()->set([
                        'username' => $data->idusers,
                        'nrp' => $data->username,
                        'nama' => $data->nama,
                        'role' => $data->idrole,
                        'logged_no_admin' => TRUE
                    ]);
                    $status = "ok_no_admin";
                }
            }else{
                $status = "Anda tidak berhak mengakses !";
            }
        }else{
            $status = "Maaf, user tidak ditemukan !";
        }
        echo json_encode(array("status" => $status));   
    }
    
    public function logout(){
        session()->destroy();
        clearstatcache();
        
        $this->modul->halaman('login');
    }
    
}
