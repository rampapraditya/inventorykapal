<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;


/**
 * Description of Profilenoadmin
 *
 * @author RAMPA
 */
class Profilenoadmin extends BaseController {
    
    
    private $model;
    private $modul;
    
    public function __construct() {
        $this->model = new Mcustom();
        $this->modul= new Modul();
    }
    
    public function index(){
        if(session()->get("logged_no_admin")){
            $data['username'] = session()->get("username");
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
            
            $kondisi['idusers'] = $data['username'];
            $data['tersimpan'] = $this->model->get_by_id("users", $kondisi);
            
            echo view('head', $data);
            echo view('menu_no_admin');
            echo view('profile/no_admin');
            echo view('foot');
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function proses() {
        if(session()->get("logged_no_admin")){
            $idusers = session()->get("username");
            
            $data = array(
                'nrp' => $this->request->getVar('nrp'),
                'nama' => $this->request->getVar('nama'),
                'tgl_lahir' => $this->request->getVar('tgllahir'),
                'agama' => $this->request->getVar('agama'),
                'kota_asal' => $this->request->getVar('kota'),
                'satuan_kerja' => $this->request->getVar('satker')
            );
            $kond['idusers'] = $idusers;
            $update = $this->model->update("users",$data,$kond);
            if($update == 1){
                $status = "Profile tersimpan";
            }else{
                $status = "Profile gagal tersimpan";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
}
