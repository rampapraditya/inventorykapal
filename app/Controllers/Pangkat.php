<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Pangkat
 *
 * @author rampa
 */
class Pangkat extends BaseController {
    
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
            echo view('pangkat/index');
            echo view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if(session()->get("logged_in")){
            $data = array();
            $list = $this->model->getAll("pangkat");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $row->nama_pangkat;
                if($row->idpangkat == "P00001"){
                    $val[] = '<div style="text-align: center;"></div>';
                }else{
                    $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$row->idpangkat."'".')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus('."'".$row->idpangkat."'".','."'".$row->nama_pangkat."'".')">Hapus</button>'
                        . '</div>';
                }
                
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
            $data = array(
                'idpangkat' => $this->model->autokode("P","idpangkat","pangkat", 2, 7),
                'nama_pangkat' => $this->request->getVar('nama')
            );
            $simpan = $this->model->add("pangkat",$data);
            if($simpan == 1){
                $status = "Data tersimpan";
            }else{
                $status = "Data gagal tersimpan";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ganti(){
        if(session()->get("logged_in")){
            $kondisi['idpangkat'] = $this->request->uri->getSegment(3);
            $data = $this->model->get_by_id("pangkat", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if(session()->get("logged_in")){
            $data = array(
                'nama_pangkat' => $this->request->getVar('nama')
            );
            $kond['idpangkat'] = $this->request->getVar('kode');
            $update = $this->model->update("pangkat",$data, $kond);
            if($update == 1){
                $status = "Data terupdate";
            }else{
                $status = "Data gagal terupdate";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function hapus() {
        if(session()->get("logged_in")){
            $kondisi['idpangkat'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("pangkat",$kondisi);
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
