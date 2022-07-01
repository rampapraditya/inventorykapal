<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Gantipassnoadmin
 *
 * @author RAMPA
 */
class Gantipassnoadmin extends BaseController {
    
    private $model;
    private $modul;
    
    public function __construct() {
        $this->model = new Mcustom();
        $this->modul= new Modul();
    }
    
    public function index(){
        if(session()->get("logged_no_admin")){
            $data['username'] = session()->get("username");
            $data['nrp'] = session()->get('nrp');
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("role");
            
            // membaca foto profile
            $def_foto = base_url().'/images/noimg.jpg';
            $foto = $this->model->getAllQR("select foto from users where idusers = '".session()->get("username")."';")->foto;
            if(strlen($foto) > 0){
                if(file_exists($this->modul->getPathApp().$foto)){
                    $def_foto = base_url().'/uploads/'.$foto;
                }
            }
            $data['foto_profile'] = $def_foto;
            
            
            // membaca logo
            $def_logo = base_url().'/images/noimg.jpg';
            $logo = $this->model->getAllQR("select logo from identitas;")->logo;
            if(strlen($logo) > 0){
                if(file_exists($this->modul->getPathApp().$logo)){
                    $def_logo = base_url().'/uploads/'.$logo;
                }
            }
            $data['logo'] = $def_logo;
            
            echo view('head', $data);
            echo view('menu_no_admin');
            echo view('gantipass/no_admin');
            echo view('foot');
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function proses() {
        if(session()->get("logged_no_admin")){
            $idusers = session()->get("username");
            
            $lama = $this->modul->enkrip_pass($this->request->getVar('lama'));
            $lama_db = $this->model->getAllQR("select pass from users where idusers = '".$idusers."';")->pass;
            
            if($lama == $lama_db){
                $data = array(
                    'pass' => $this->modul->enkrip_pass($this->request->getVar('baru'))
                );
                $kond['idusers'] = $idusers;
                $update = $this->model->update("users",$data,$kond);
                if($update == 1){
                    $status = "Password tersimpan";
                }else{
                    $status = "Password gagal tersimpan";
                }
            }else{
                $status = "Passsword lama tidak sesuai";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
}
