<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Jenis
 *
 * @author RAMPA
 */
class Jenis extends BaseController {
    
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
            $data['kri'] = $this->model->getAll("kapal");
            
            echo view('head', $data);
            echo view('menu');
            echo view('jenis/index');
            echo view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if(session()->get("logged_in")){
            $data = array();
            $list = $this->model->getAllQ("select b.*, a.nama_kapal from kapal a, jenisbarang b where a.idkapal = b.idkapal order by a.nama_kapal;");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $row->nama_kapal;
                $val[] = $row->nama_jenis;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$row->idjenisbarang."'".')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus('."'".$row->idjenisbarang."'".','."'".$row->nama_jenis."'".')">Hapus</button>'
                        . '</div>';
                
                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajaxlistby() {
        if(session()->get("logged_in")){
            $idkapal = $this->request->uri->getSegment(3);
            
            if($idkapal == "-"){
                $str = "select b.*, a.nama_kapal from kapal a, jenisbarang b where a.idkapal = b.idkapal order by a.nama_kapal;";
            }else{
                $str = "select b.*, a.nama_kapal from kapal a, jenisbarang b where a.idkapal = b.idkapal and a.idkapal = '".$idkapal."' order by a.nama_kapal;";
            }
            // load data
            $data = array();
            $list = $this->model->getAllQ($str);
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $row->nama_kapal;
                $val[] = $row->nama_jenis;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$row->idjenisbarang."'".')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus('."'".$row->idjenisbarang."'".','."'".$row->nama_jenis."'".')">Hapus</button>'
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
            $data = array(
                'idjenisbarang' => $this->model->autokode("J","idjenisbarang","jenisbarang", 2, 7),
                'nama_jenis' => $this->request->getVar('nama'),
                'idkapal' => $this->request->getVar('kri')
            );
            $simpan = $this->model->add("jenisbarang",$data);
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
            $kondisi['idjenisbarang'] = $this->request->uri->getSegment(3);
            $data = $this->model->get_by_id("jenisbarang", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if(session()->get("logged_in")){
            $data = array(
                'nama_jenis' => $this->request->getVar('nama'),
                'idkapal' => $this->request->getVar('kri')
            );
            $kond['idjenisbarang'] = $this->request->getVar('kode');
            $update = $this->model->update("jenisbarang",$data, $kond);
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
            $kondisi['idjenisbarang'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("jenisbarang",$kondisi);
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
