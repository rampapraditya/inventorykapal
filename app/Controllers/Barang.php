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
                if (file_exists($this->modul->getPathApp().$foto)) {
                    $def_foto = base_url().'/uploads/'.$foto;
                }
            }
            $data['foto_profile'] = $def_foto;

            // membaca logo
            $def_logo = base_url() . '/images/noimg.jpg';
            $logo = $this->model->getAllQR("select logo from identitas;")->logo;
            if (strlen($logo) > 0) {
                if (file_exists($this->modul->getPathApp(). $logo)) {
                    $def_logo = base_url().'/uploads/'. $logo;
                }
            }
            $data['logo'] = $def_logo;
            $data['gudang'] = $this->model->getAll("jenisbarang");
            $data['kapal'] = $this->model->getAll("kapal");

            echo view('head', $data);
            echo view('menu');
            echo view('barang/index');
            echo view('foot');
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlistplatform() {
        if (session()->get("logged_in")) {
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00001';");
            foreach ($list->getResult() as $row) {
                $val = array();
                // mencari default foto
                $def_foto = base_url() . '/images/noimg.jpg';
                if (strlen($row->foto) > 0) {
                    if (file_exists($this->modul->getPathApp().$row->foto)) {
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
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row->idbarang . "'" . ')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row->idbarang . "'" . ',' . "'" . $row->deskripsi . "'" . ')">Hapus</button>'
                        . '</div>';

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist_sewaco() {
        if (session()->get("logged_in")) {
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00002';");
            foreach ($list->getResult() as $row) {
                $val = array();
                // mencari default foto
                $def_foto = base_url() . '/images/noimg.jpg';
                if (strlen($row->foto) > 0) {
                    if (file_exists($this->modul->getPathApp().$row->foto)) {
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
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row->idbarang . "'" . ')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row->idbarang . "'" . ',' . "'" . $row->deskripsi . "'" . ')">Hapus</button>'
                        . '</div>';

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist_komaliwan() {
        if (session()->get("logged_in")) {
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00003';");
            foreach ($list->getResult() as $row) {
                $val = array();
                
                $def_foto = base_url() . '/images/noimg.jpg';
                if (strlen($row->foto) > 0) {
                    if (file_exists($this->modul->getPathApp().$row->foto)) {
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
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row->idbarang . "'" . ')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row->idbarang . "'" . ',' . "'" . $row->deskripsi . "'" . ')">Hapus</button>'
                        . '</div>';

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist_br_umum() {
        if (session()->get("logged_in")) {
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00004';");
            foreach ($list->getResult() as $row) {
                $val = array();
                $def_foto = base_url() . '/images/noimg.jpg';
                if (strlen($row->foto) > 0) {
                    if (file_exists($this->modul->getPathApp().$row->foto)) {
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
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row->idbarang . "'" . ')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row->idbarang . "'" . ',' . "'" . $row->deskripsi . "'" . ')">Hapus</button>'
                        . '</div>';

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_add() {
        if (session()->get("logged_in")) {
            if (isset($_FILES['file']['name'])) {
                if (0 < $_FILES['file']['error']) {
                    $status = "Error during file upload " . $_FILES['file']['error'];
                } else {
                    $status = $this->simpan_dengan_foto();
                }
            } else {
                $status = $this->simpan_tanpa_foto();
            }
            echo json_encode(array("status" => $status));
        } else {
            $this->modul->halaman('login');
        }
    }

    private function simpan_dengan_foto() {
        $file = $this->request->getFile('file');
        $namaFile = $file->getRandomName();
        $info_file = $this->modul->info_file($file);

        if (file_exists($this->modul->getPathApp().$namaFile)) {
            $status = "Gunakan nama file lain";
        } else {
            $status_upload = $file->move($this->modul->getPathApp(), $namaFile);
            if ($status_upload) {
                $data = array(
                    'idbarang' => $this->model->autokode("B", "idbarang", "barang", 2, 7),
                    'foto' => $namaFile,
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
                    'idjenisbarang' => $this->request->getVar('gudang'),
                    'idkapal' => $this->request->getVar('idkapal')
                );
                $simpan = $this->model->add("barang", $data);
                if ($simpan == 1) {
                    $status = "Data tersimpan";
                } else {
                    $status = "Data gagal tersimpan";
                }
            } else {
                $status = "File gagal terupload";
            }
        }
        return $status;
    }

    private function simpan_tanpa_foto() {
        $data = array(
            'idbarang' => $this->model->autokode("B", "idbarang", "barang", 2, 7),
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
            'idjenisbarang' => $this->request->getVar('gudang'),
            'idkapal' => $this->request->getVar('idkapal')
        );
        $simpan = $this->model->add("barang", $data);
        if ($simpan == 1) {
            $status = "Data tersimpan";
        } else {
            $status = "Data gagal tersimpan";
        }
        return $status;
    }

    public function ganti() {
        if (session()->get("logged_in")) {
            $kondisi['idbarang'] = $this->request->uri->getSegment(3);
            $data = $this->model->get_by_id("barang", $kondisi);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit() {
        if (session()->get("logged_in")) {
            if (isset($_FILES['file']['name'])) {
                if (0 < $_FILES['file']['error']) {
                    $status = "Error during file upload " . $_FILES['file']['error'];
                } else {
                    $status = $this->update_dengan_foto();
                }
            } else {
                $status = $this->update_tanpa_foto();
            }


            echo json_encode(array("status" => $status));
        } else {
            $this->modul->halaman('login');
        }
    }

    private function update_dengan_foto() {
        $logo = $this->model->getAllQR("SELECT foto FROM barang where idbarang = '" . $this->request->getVar('kode') . "';")->foto;
        if (strlen($logo) > 0) {
            if (file_exists($this->modul->getPathApp().$logo)) {
                unlink($this->modul->getPathApp().$logo);
            }
        }

        $file = $this->request->getFile('file');
        $namaFile = $file->getRandomName();
        $info_file = $this->modul->info_file($file);

        if (file_exists($this->modul->getPathApp().$namaFile)) {
            $status = "Gunakan nama file lain";
        } else {
            $status_upload = $file->move($this->modul->getPathApp(), $namaFile);
            if ($status_upload) {
                $data = array(
                    'foto' => $namaFile,
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
                    'idjenisbarang' => $this->request->getVar('gudang'),
                    'idkapal' => $this->request->getVar('idkapal')
                );
                $kond['idbarang'] = $this->request->getVar('kode');
                $update = $this->model->update("barang", $data, $kond);
                if ($update == 1) {
                    $status = "Data terupdate";
                } else {
                    $status = "Data gagal terupdate";
                }
            } else {
                $status = "File gagal terupload";
            }
        }
        return $status;
    }

    private function update_tanpa_foto() {
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
            'idjenisbarang' => $this->request->getVar('gudang'),
            'idkapal' => $this->request->getVar('idkapal')
        );
        $kond['idbarang'] = $this->request->getVar('kode');
        $update = $this->model->update("barang", $data, $kond);
        if ($update == 1) {
            $status = "Data terupdate";
        } else {
            $status = "Data gagal terupdate";
        }
        return $status;
    }

    public function hapus() {
        if (session()->get("logged_in")) {
            $idbarang = $this->request->uri->getSegment(3);

            $logo = $this->model->getAllQR("SELECT foto FROM barang where idbarang = '" . $idbarang . "';")->foto;
            if (strlen($logo) > 0) {
                if (file_exists($this->modul->getPathApp(). $logo)) {
                    unlink($this->modul->getPathApp(). $logo);
                }
            }

            $kondisi['idbarang'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("barang", $kondisi);
            if ($hapus == 1) {
                $status = "Data terhapus";
            } else {
                $status = "Data gagal terhapus";
            }
            echo json_encode(array("status" => $status));
        } else {
            $this->modul->halaman('login');
        }
    }

    public function prosesfile() {
        if (session()->get("logged_in")) {
            if (isset($_FILES['file']['name'])) {
                if (0 < $_FILES['file']['error']) {
                    $status = "Error during file upload " . $_FILES['file']['error'];
                } else {
                    $status = $this->upload_file();
                }
            } else {
                $status = "File tidak ditemukan";
            }
            echo json_encode(array("status" => $status));
        } else {
            $this->modul->halaman('login');
        }
    }

    private function upload_file() {
        $file = $this->request->getFile('file');
        $namaFile = $file->getRandomName();
        $info_file = $this->modul->info_file($file);
        if (file_exists($this->modul->getPathApp().$namaFile)) {
            $hasil = "Gunakan nama file lain";
        } else {
            $status = false;
            // mengetahui ext
            if ($info_file['ext'] == "xls") {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                $status = true;
            } else if ($info_file['ext'] == "xlsx") {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $status = true;
            }else{
                $status = false;
            }

            if($status){
                $status_upload = $file->move($this->modul->getPathApp(), $namaFile);
                if ($status_upload) {
                    // extrak kulit manggis
                    $path = $this->modul->getPathApp().$namaFile;
                    $spreadsheet = $render->load($path);
                    $data = $spreadsheet->getActiveSheet()->toArray();
                    foreach ($data as $x => $row) {
                        // masukkan ke database
                        $data = array(
                            'idbarang' => $this->model->autokode("B", "idbarang", "barang", 2, 7),
                            'foto' => '',
                            'deskripsi' => addslashes($row[0]),
                            'pn_nsn' => addslashes($row[1]),
                            'ds_number' => addslashes($row[2]),
                            'holding' => addslashes($row[3]),
                            'equipment_desc' => addslashes($row[4]),
                            'store_location' => addslashes($row[5]),
                            'supplementary_location' => addslashes($row[6]),
                            'qty' => addslashes($row[7]),
                            'uoi' => addslashes($row[8]),
                            'verwendung' => addslashes($row[9]),
                            'idjenisbarang' => $this->request->getVar('gudang'),
                            'idkapal' => $this->request->getVar('idkapal')
                        );
                        $this->model->add("barang", $data);
                    }
                    unlink($this->modul->getPathApp().$namaFile);
                    
                    $hasil = "Terupload";
                } else {
                    $hasil = "File gagal terupload";
                }
            }else{
                $hasil = "Harus berupa file excel";
            }
        }
        return $hasil;
    }
   
    

}
