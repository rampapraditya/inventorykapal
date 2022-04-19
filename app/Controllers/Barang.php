<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Barang
 *
 * @author RAMPA
 */
class Barang extends BaseController {
    
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
            $data['gudang'] = $this->model->getAll("jenisbarang");
            
            echo view('head', $data);
            echo view('menu');
            echo view('barang/index');
            echo view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if(session()->get("logged_in")){
            $data = array();
            $list = $this->model->getAllQ("select a.*, b.nama_jenis from barang a, jenisbarang b where a.idjenisbarang = b.idjenisbarang;");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $row->nama_jenis;
                $val[] = $row->deskripsi;
                $val[] = $row->pn_nsn;
                $val[] = $row->ds_number;
                $val[] = $row->holding;
                $val[] = $row->equipment_desc;
                $val[] = $row->store_location;
                $val[] = $row->supplementary_location;
                $val[] = $row->qty;
                $val[] = $row->uoi;
                $val[] = $row->verwendung;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$row->idbarang."'".')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus('."'".$row->idbarang."'".','."'".$row->deskripsi."'".')">Hapus</button>'
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
                    $status = $this->simpan_dengan_foto();
                }
            }else{
                $status = $this->simpan_tanpa_foto();
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpan_dengan_foto() {
        $file = $this->request->getFile('file');
        $info_file = $this->modul->info_file($file);
        
        if(file_exists(ROOTPATH.'public/uploads/'.$info_file['name'])){
            $status = "Gunakan nama file lain";
        }else{
            $status_upload = $file->move(ROOTPATH.'public/uploads');
            if($status_upload){
                $data = array(
                    'idbarang' => $this->model->autokode("B","idbarang","barang", 2, 7),
                    'foto' => $info_file['name'],
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'pn_nsn' => $this->request->getVar('pn_nsn'),
                    'ds_number' => $this->request->getVar('ds_number'),
                    'holding' => $this->request->getVar('holding'),
                    'equipment_desc' => $this->request->getVar('equipment'),
                    'store_location' => $this->request->getVar('store'),
                    'supplementary_location' => $this->request->getVar('supplementary'),
                    'qty' => $this->request->getVar('quant'),
                    'uoi' => $this->request->getVar('uoi'),
                    'verwendung' => $this->request->getVar('verwendung'),
                    'idjenisbarang' => $this->request->getVar('gudang')
                );
                $simpan = $this->model->add("barang",$data);
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
    
    private function simpan_tanpa_foto() {
        $data = array(
            'idbarang' => $this->model->autokode("B","idbarang","barang", 2, 7),
            'foto' => '',
            'deskripsi' => $this->request->getVar('deskripsi'),
            'pn_nsn' => $this->request->getVar('pn_nsn'),
            'ds_number' => $this->request->getVar('ds_number'),
            'holding' => $this->request->getVar('holding'),
            'equipment_desc' => $this->request->getVar('equipment'),
            'store_location' => $this->request->getVar('store'),
            'supplementary_location' => $this->request->getVar('supplementary'),
            'qty' => $this->request->getVar('quant'),
            'uoi' => $this->request->getVar('uoi'),
            'verwendung' => $this->request->getVar('verwendung'),
            'idjenisbarang' => $this->request->getVar('gudang')
        );
        $simpan = $this->model->add("barang",$data);
        if($simpan == 1){
            $status = "Data tersimpan";
        }else{
            $status = "Data gagal tersimpan";
        }
        return $status;
    }

    public function ganti(){
        if(session()->get("logged_in")){
            $kondisi['idbarang'] = $this->request->uri->getSegment(3);
            $data = $this->model->get_by_id("barang", $kondisi);
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
                    $status = $this->update_dengan_foto();
                }
            }else{
                $status = $this->update_tanpa_foto();
            }
            
            
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function update_dengan_foto(){
        $logo = $this->model->getAllQR("SELECT foto FROM barang where idbarang = '".$this->request->getVar('kode')."';")->foto;
        if(strlen($logo) > 0){
            if(file_exists(ROOTPATH.'public/uploads/'.$logo)){
                unlink(ROOTPATH.'public/uploads/'.$logo); 
            }
        }
        
        $file = $this->request->getFile('file');
        $info_file = $this->modul->info_file($file);
        
        if(file_exists(ROOTPATH.'public/uploads/'.$info_file['name'])){
            $status = "Gunakan nama file lain";
        }else{
            $status_upload = $file->move(ROOTPATH.'public/uploads');
            if($status_upload){
                $data = array(
                    'foto' => $info_file['name'],
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'pn_nsn' => $this->request->getVar('pn_nsn'),
                    'ds_number' => $this->request->getVar('ds_number'),
                    'holding' => $this->request->getVar('holding'),
                    'equipment_desc' => $this->request->getVar('equipment'),
                    'store_location' => $this->request->getVar('store'),
                    'supplementary_location' => $this->request->getVar('supplementary'),
                    'qty' => $this->request->getVar('quant'),
                    'uoi' => $this->request->getVar('uoi'),
                    'verwendung' => $this->request->getVar('verwendung'),
                    'idjenisbarang' => $this->request->getVar('gudang')
                );
                $kond['idbarang'] = $this->request->getVar('kode');
                $update = $this->model->update("barang",$data, $kond);
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
    
    private function update_tanpa_foto(){
        $data = array(
            'deskripsi' => $this->request->getVar('deskripsi'),
            'pn_nsn' => $this->request->getVar('pn_nsn'),
            'ds_number' => $this->request->getVar('ds_number'),
            'holding' => $this->request->getVar('holding'),
            'equipment_desc' => $this->request->getVar('equipment'),
            'store_location' => $this->request->getVar('store'),
            'supplementary_location' => $this->request->getVar('supplementary'),
            'qty' => $this->request->getVar('quant'),
            'uoi' => $this->request->getVar('uoi'),
            'verwendung' => $this->request->getVar('verwendung'),
            'idjenisbarang' => $this->request->getVar('gudang')
        );
        $kond['idbarang'] = $this->request->getVar('kode');
        $update = $this->model->update("barang",$data, $kond);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }
    
    public function hapus() {
        if(session()->get("logged_in")){
            $idbarang = $this->request->uri->getSegment(3);
            
            $logo = $this->model->getAllQR("SELECT foto FROM barang where idbarang = '".$idbarang."';")->foto;
            if(strlen($logo) > 0){
                if(file_exists(ROOTPATH.'public/uploads/'.$logo)){
                    unlink(ROOTPATH.'public/uploads/'.$logo); 
                }
            }
            
            $kondisi['idbarang'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("barang",$kondisi);
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
