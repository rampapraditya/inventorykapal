<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Laporan
 *
 * @author RAMPA
 */
class Laporan extends BaseController {
    
    private $model;
    private $modul;

    public function __construct() {
        $this->model = new Mcustom();
        $this->modul = new Modul();
    }

    public function index() {
        if (session()->get("logged_in")) {
            $data['username'] = session()->get("username");
            $data['nrp'] = session()->get('nrp');
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("role");

            // membaca foto profile
            $def_foto = base_url() . '/images/noimg.jpg';
            $foto = $this->model->getAllQR("select foto from users where idusers = '" . session()->get("username") . "';")->foto;
            if (strlen($foto) > 0) {
                if (file_exists(ROOTPATH . 'public/uploads/' . $foto)) {
                    $def_foto = base_url() . '/uploads/' . $foto;
                }
            }
            $data['foto_profile'] = $def_foto;

            // membaca logo
            $def_logo = base_url() . '/images/noimg.jpg';
            $logo = $this->model->getAllQR("select logo from identitas;")->logo;
            if (strlen($logo) > 0) {
                if (file_exists(ROOTPATH . 'public/uploads/' . $logo)) {
                    $def_logo = base_url() . '/uploads/' . $logo;
                }
            }
            $data['logo'] = $def_logo;

            echo view('head', $data);
            echo view('menu');
            echo view('laporan/index');
            echo view('foot');
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_platform() {
        if (session()->get("logged_in")) {
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00001';");
            foreach ($list->getResult() as $row) {
                $val = array();
                // mencari default foto
                $def_foto = base_url() . '/images/noimg.jpg';
                if (strlen($row->foto) > 0) {
                    if (file_exists(ROOTPATH.'public/uploads/'.$row->foto)) {
                        $def_foto = base_url().'/uploads/'.$row->foto;
                    }
                }
                
                $val[] = '<img src="'.$def_foto.'" style="width: 50px; height: auto;">';
                $val[] = $row->deskripsi;
                $val[] = $row->pn_nsn;
                $val[] = $row->ds_number;
                $val[] = $row->holding;
                $val[] = $row->equipment_desc;
                $val[] = $row->store_location;
                $val[] = $row->supplementary_location;
                $val[] = $row->uoi;
                $val[] = $row->verwendung;

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_sewaco() {
        if (session()->get("logged_in")) {
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00002';");
            foreach ($list->getResult() as $row) {
                $val = array();
                // mencari default foto
                $def_foto = base_url() . '/images/noimg.jpg';
                if (strlen($row->foto) > 0) {
                    if (file_exists(ROOTPATH.'public/uploads/'.$row->foto)) {
                        $def_foto = base_url().'/uploads/'.$row->foto;
                    }
                }
                
                $val[] = '<img src="'.$def_foto.'" style="width: 50px; height: auto;">';
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

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_komaliwan() {
        if (session()->get("logged_in")) {
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00003';");
            foreach ($list->getResult() as $row) {
                $val = array();
                
                $def_foto = base_url() . '/images/noimg.jpg';
                if (strlen($row->foto) > 0) {
                    if (file_exists(ROOTPATH.'public/uploads/'.$row->foto)) {
                        $def_foto = base_url().'/uploads/'.$row->foto;
                    }
                }
                
                $val[] = '<img src="'.$def_foto.'" style="width: 50px; height: auto;">';
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

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_br_umum() {
        if (session()->get("logged_in")) {
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00004';");
            foreach ($list->getResult() as $row) {
                $val = array();
                $def_foto = base_url() . '/images/noimg.jpg';
                if (strlen($row->foto) > 0) {
                    if (file_exists(ROOTPATH.'public/uploads/'.$row->foto)) {
                        $def_foto = base_url().'/uploads/'.$row->foto;
                    }
                }
                
                $val[] = '<img src="'.$def_foto.'" style="width: 50px; height: auto;">';
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

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
}
