<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Brgmasuk
 *
 * @author RAMPA
 */
class Brgmasuk extends BaseController {
    
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
            $data['gudang'] = $this->model->getAll("jenisbarang");

            echo view('head', $data);
            echo view('menu');
            echo view('barang_masuk/index');
            echo view('foot');
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlist() {
        if (session()->get("logged_in")) {
            $no = 1;
            $data = array();
            $list = $this->model->getAllQ("SELECT a.idbrg_masuk, date_format(tgl, '%d %M %Y') as tglf, b.nama_kapal FROM brg_masuk a, kapal b where a.idkapal = b.idkapal order by tgl desc;");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->tglf;
                $val[] = $row->nama_kapal;
                $val[] = '';
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row->idbrg_masuk . "'" . ')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row->idbrg_masuk . "'" . ',' . "'" . $no . "'" . ')">Hapus</button>'
                        . '</div>';
                $data[] = $val;
                
                $no++;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function detil() {
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
            
            $temp = $this->request->uri->getSegment(3);
            if(strlen($temp) > 0){
                
            }else{
                $data['kode'] = $this->model->autokode('M','idbrg_masuk', 'brg_masuk', 2, 7);
                $data['kri'] = $this->model->getAll("kapal");
                $data['tgl_def'] = $this->modul->TanggalSekarang();
                $data['ket'] = "Tambah barang datang";

                echo view('head', $data);
                echo view('menu');
                echo view('barang_masuk/detil');
                echo view('foot');
            }
            
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajaxdetil() {
        if (session()->get("logged_in")) {
            $kode = $this->request->uri->getSegment(3);
            // load data
            $no = 1;
            $data = array();
            $list = $this->model->getAllQ("select a.idbrg_m_detil, b.deskripsi, a.jumlah, a.satuan from brg_masuk_detil a, barang b, brg_masuk c where a.idbarang = b.idbarang and a.idbrg_masuk = c.idbrg_masuk and a.idbrg_masuk = '".$kode."';");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->deskripsi;
                $val[] = $row->jumlah;
                $val[] = $row->satuan;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row->idbrg_m_detil . "'" . ')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row->idbrg_m_detil . "'" . ',' . "'" . $no . "'" . ')">Hapus</button>'
                        . '</div>';
                $data[] = $val;
                
                $no++;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
}
