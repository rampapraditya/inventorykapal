<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Logmasukcair
 *
 * @author RAMPA
 */
class Logmasukcair extends BaseController {
    
    private $model;
    private $modul;

    public function __construct() {
        $this->model = new Mcustom();
        $this->modul = new Modul();
    }

    public function index() {
        if (session()->get("logged_no_admin")) {
            $data['username'] = session()->get("username");
            $data['nrp'] = session()->get('nrp');
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("role");

            // membaca foto profile
            $def_foto = base_url() . '/images/noimg.jpg';
            $foto = $this->model->getAllQR("select foto from users where idusers = '" . session()->get("username") . "';")->foto;
            if (strlen($foto) > 0) {
                if (file_exists($this->modul->getPathApp().$foto)) {
                    $def_foto = base_url().'/uploads/'.$foto;
                }
            }
            $data['foto_profile'] = $def_foto;

            // membaca logo
            $def_logo = base_url() . '/images/noimg.jpg';
            $logo = $this->model->getAllQR("select logo from identitas;")->logo;
            if (strlen($logo) > 0) {
                if (file_exists($this->modul->getPathApp().$logo)) {
                    $def_logo = base_url().'/uploads/'.$logo;
                }
            }
            $data['logo'] = $def_logo;
            // mengetahui ini kapal apa
            $idkapal = $this->model->getAllQR("select idkapal from users where idusers = '".$data['username']."';")->idkapal;
            $data['gudang'] = $this->model->getAllQ("select idjenisbarang, nama_jenis from jenisbarang where idkapal = '".$idkapal."';");
            $data['deftgl'] = $this->modul->TanggalSekarang();

            echo view('head', $data);
            echo view('menu_no_admin');
            echo view('cair_masuk/index');
            echo view('foot');
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlist() {
        if (session()->get("logged_no_admin")) {
            // load yang hanya miliknya dia
            $username = session()->get("username");
            $kri = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;
            // load data
            $no = 1;
            $data = array();
            $list = $this->model->getAllQ("SELECT a.idbrg_keluar, date_format(tgl, '%d %M %Y') as tglf, b.nama_kapal, a.alasan FROM brg_keluar a, kapal b where a.idkapal = b.idkapal and a.idkapal = '".$kri."' order by tgl desc;");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->tglf;
                $val[] = $row->nama_kapal;
                $val[] = $row->alasan;
                $val[] = $this->model->getAllQR("SELECT count(*) as jml FROM brg_keluar_detil where idbrg_keluar = '".$row->idbrg_keluar."';")->jml.' ITEM';
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-secondary btn-fw" onclick="showitem('."'".$row->idbrg_keluar."'".')">Detail Item</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$this->modul->enkrip_url($row->idbrg_keluar)."'".')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row->idbrg_keluar . "'" . ',' . "'" . $no . "'" . ')">Hapus</button>'
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
