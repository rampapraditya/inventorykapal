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
        echo view('login');
    }
    
    public function proses() {
        clearstatcache();
        
        $user = strtolower(trim($this->request->getVar('nrp')));
        $pass = trim($this->request->getVar('pass'));
        
        $enkrip_pass = $this->modul->enkrip_pass($pass);
        $jml = $this->model->getAllQR("SELECT count(*) as jml FROM users where nrp = '".$user."';")->jml;
        if($jml > 0){
            $jml1 = $this->model->getAllQR("select count(*) as jml from users where nrp = '".$user."' and pass = '".$enkrip_pass."';")->jml;
            if($jml1 > 0){
                $data = $this->model->getAllQR("select idusers, nrp, nama, idrole from users where nrp = '".$user."';");
                
                session()->set([
                    'username' => $data->idusers,
                    'nama' => $data->nrp,
                    'role' => $data->idrole,
                    'logged_in' => TRUE
                ]);
                
                $status = "ok";
                
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
