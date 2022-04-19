<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Pengguna
 *
 * @author RAMPA
 */
class Pengguna extends BaseController{
    
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
            
            $data['role'] = $this->model->getAll("role");
            $data['kapal'] = $this->model->getAll("kapal");
            
            echo view('head', $data);
            echo view('menu');
            echo view('pengguna/index');
            echo view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if(session()->get("logged_in")){
            $data = array();
            $list = $this->model->getAllQ("select a.idusers, a.nrp, b.nama_role, a.nama, a.idkapal from users a, role b where a.idrole = b.idrole;");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $row->nrp;
                $val[] = $row->nama_role;
                $val[] = $row->nama;
                if(strlen($row->idkapal)){
                    $val[] = $this->model->getAllQR("select nama_kapal from kapal where idkapal = '".$row->idkapal."';")->nama_kapal;
                }else{
                    $val[] = "";
                }
                
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$row->idusers."'".')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus('."'".$row->idusers."'".','."'".$row->nrp."'".','."'".$row->nama."'".')">Hapus</button>'
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
            $jml = $this->model->getAllQR("select count(*) as jml from users where nrp = '".$this->request->getVar('nrp')."';")->jml;
            if($jml > 0){
                $status = "NRP sudah ada";
            } else {
                $data = array(
                    'idusers' => $this->model->autokode("U","idusers","users", 2, 7),
                    'nrp' => $this->request->getVar('nrp'),
                    'pass' => $this->modul->enkrip_pass($this->request->getVar('pass')),
                    'nama' => $this->request->getVar('nama'),
                    'idrole' => $this->request->getVar('role'),
                    'idkapal' => $this->request->getVar('kapal'),
                );
                $simpan = $this->model->add("users",$data);
                if($simpan == 1){
                    $status = "Data tersimpan";
                }else{
                    $status = "Data gagal tersimpan";
                }
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ganti(){
        if(session()->get("logged_in")){
            $kondisi['idusers'] = $this->request->uri->getSegment(3);
            $data = $this->model->get_by_id("users", $kondisi);
            
            echo json_encode(array(
                "kode" => $data->idusers,
                "nrp" => $data->nrp,
                "nama" => $data->nama,
                "pass" => $this->modul->dekrip_pass($data->pass),
                "idrole" => $data->idrole,
                "idkapal" => $data->idkapal
            ));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if(session()->get("logged_in")){
            $data = array(
                'pass' => $this->modul->enkrip_pass($this->request->getVar('pass')),
                'nama' => $this->request->getVar('nama'),
                'idrole' => $this->request->getVar('role'),
                'idkapal' => $this->request->getVar('kapal'),
            );
            $kond['idusers'] = $this->request->getVar('kode');
            $update = $this->model->update("users",$data, $kond);
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
            $kondisi['idusers'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("users",$kondisi);
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
