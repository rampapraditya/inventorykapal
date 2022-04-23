<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Kapal
 *
 * @author rampa
 */
class Kapal extends BaseController {
    
    private $model;
    private $modul;
    
    public function __construct() {
        $this->model = new Mcustom();
        $this->modul= new Modul();
    }
    
    public function index() {
        if(session()->get("logged_in")){
            $data['username'] = session()->get("username");
            $data['nrp'] = session()->get('nrp');
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("role");
            
            // membaca foto profile
            $def_foto = base_url().'/images/noimg.jpg';
            $foto = $this->model->getAllQR("select foto from users where idusers = '".session()->get("username")."';")->foto;
            if(strlen($foto) > 0){
                if(file_exists(ROOTPATH.'public/uploads/'.$foto)){
                    $def_foto = base_url().'/uploads/'.$foto;
                }
            }
            $data['foto_profile'] = $def_foto;
            
            
            // membaca logo
            $def_logo = base_url().'/images/noimg.jpg';
            $logo = $this->model->getAllQR("select logo from identitas;")->logo;
            if(strlen($logo) > 0){
                if(file_exists(ROOTPATH.'public/uploads/'.$logo)){
                    $def_logo = base_url().'/uploads/'.$logo;
                }
            }
            $data['logo'] = $def_logo;
            
            echo view('head', $data);
            echo view('menu');
            echo view('kapal/index');
            echo view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if(session()->get("logged_in")){
            $data = array();
            $list = $this->model->getAll("kapal");
            foreach ($list->getResult() as $row) {
                $val = array();
                // membaca gambar kapal
                $gambar = base_url().'/images/noimg.jpg';
                if(strlen($row->gambar) > 0){
                    if(file_exists(ROOTPATH.'public/uploads/'.$row->gambar)){
                        $gambar = base_url().'/uploads/'.$row->gambar;
                    }
                }
            
                $val[] = '<img src="'.$gambar.'"  class="img-thumbnail" style="width: 100px; height: auto;">';
                $val[] = $row->nama_kapal;
                $val[] = $row->keterangan;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$row->idkapal."'".')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus('."'".$row->idkapal."'".','."'".$row->nama_kapal."'".')">Hapus</button>'
                        . '</div>';
                
                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_add() {
        if(session()->get("logged_in")){
            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    $status = $this->simpandenganfoto();
                }
            }else{
                $status = $this->simpantanpafoto();
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpandenganfoto() {
        $file = $this->request->getFile('file');
        $info_file = $this->modul->info_file($file);
        
        if(file_exists(ROOTPATH.'public/uploads/'.$info_file['name'])){
            $status = "Gunakan nama file lain";
        }else{
            $status_upload = $file->move(ROOTPATH.'public/uploads');
            if($status_upload){
                $data = array(
                    'idkapal' => $this->model->autokode("K","idkapal","kapal", 2, 7),
                    'nama_kapal' => $this->request->getVar('nama'),
                    'keterangan' => $this->request->getVar('ket'),
                    'gambar' => $info_file['name']
                );
                $simpan = $this->model->add("kapal",$data);
                if($simpan == 1){
                    $status = "Data tersimpan";
                }else{
                    $status = "Data gagal tersimpan";
                }
            }else{
                $status = "File gagal terupload";
            }
        }
                
        return $status;
    }
    
    private function simpantanpafoto() {
        $data = array(
            'idkapal' => $this->model->autokode("K","idkapal","kapal", 2, 7),
            'nama_kapal' => $this->request->getVar('nama'),
            'keterangan' => $this->request->getVar('ket')
        );
        $simpan = $this->model->add("kapal",$data);
        if($simpan == 1){
            $status = "Data tersimpan";
        }else{
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
    
    public function ganti(){
        if(session()->get("logged_in")){
            $kondisi['idkapal'] = $this->request->uri->getSegment(3);
            $data = $this->model->get_by_id("kapal", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if(session()->get("logged_in")){
            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    $status = $this->updatedenganfoto();
                }
            }else{
                $status = $this->updatetanpafoto();
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function updatedenganfoto() {
        $file = $this->request->getFile('file');
        $info_file = $this->modul->info_file($file);
        
        if(file_exists(ROOTPATH.'public/uploads/'.$info_file['name'])){
            $status = "Gunakan nama file lain";
        }else{
            
            $kond['idkapal'] = $this->request->getVar('kode');
            $kapal = $this->model->get_by_id("kapal", $kond);
            if(strlen($kapal->gambar) > 0){
                if(file_exists(ROOTPATH.'public/uploads/'.$kapal->gambar)){
                    unlink(ROOTPATH.'public/uploads/'.$kapal->gambar);
                }
            }
        
            $status_upload = $file->move(ROOTPATH.'public/uploads');
            if($status_upload){
                $data = array(
                    'nama_kapal' => $this->request->getVar('nama'),
                    'keterangan' => $this->request->getVar('ket'),
                    'gambar' => $info_file['name']
                );
                $update = $this->model->update("kapal",$data, $kond);
                if($update == 1){
                    $status = "Data terupdate";
                }else{
                    $status = "Data gagal terupdate";
                }
            }else{
                $status = "File gagal terupload";
            }
        }
                
        return $status;
    }
    
    private function updatetanpafoto() {
        $data = array(
            'nama_kapal' => $this->request->getVar('nama'),
            'keterangan' => $this->request->getVar('ket')
        );
        $kond['idkapal'] = $this->request->getVar('kode');
        $update = $this->model->update("kapal",$data, $kond);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }
    
    public function hapus() {
        if(session()->get("logged_in")){
            $kondisi['idkapal'] = $this->request->uri->getSegment(3);
            // membaca data kapal
            $kapal = $this->model->get_by_id("kapal", $kondisi);
            if(strlen($kapal->gambar) > 0){
                if(file_exists(ROOTPATH.'public/uploads/'.$kapal->gambar)){
                    unlink(ROOTPATH.'public/uploads/'.$kapal->gambar);
                }
            }
            
            // menghapus data
            $hapus = $this->model->delete("kapal",$kondisi);
            if($hapus == 1){
                $status = "Data terhapus";
            }else{
                $status = "Data gagal terhapus";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
}
