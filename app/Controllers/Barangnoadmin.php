<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Barangnoadmin
 *
 * @author RAMPA
 */
class Barangnoadmin extends BaseController {
    
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
            $def_logo = base_url().'/images/noimg.jpg';
            $logo = $this->model->getAllQR("select logo from identitas;")->logo;
            if (strlen($logo) > 0) {
                if (file_exists($this->modul->getPathApp().$logo)) {
                    $def_logo = base_url().'/uploads/'.$logo;
                }
            }
            $data['logo'] = $def_logo;
            $data['gudang'] = $this->model->getAllQ("select idjenisbarang, nama_jenis from jenisbarang where idkapal = '".$this->getKapal()."';");

            echo view('head', $data);
            echo view('menu_no_admin');
            echo view('barang_non_admin/index');
            echo view('foot');
        } else {
            $this->modul->halaman('login');
        }
    }

    private function getKapal() {
        $username = session()->get("username");
        $idkapal = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;
        return $idkapal;
    }
    
    public function display_tab() {
        if (session()->get("logged_no_admin")) {
            $idkapal = $this->getKapal();
            // set tab atas
            $counter = 1;
            $str = '<nav><div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">';
            $list1 = $this->model->getAllQ("select idjenisbarang, nama_jenis from jenisbarang where idkapal = '".$idkapal."';");
            foreach ($list1->getResult() as $row) {
                if($counter == 1){
                    $str .= '<a class="nav-item nav-link active" id="head_nav_'.$row->idjenisbarang.'" data-toggle="tab" href="#nav_'.$row->idjenisbarang.'" role="tab" aria-controls="nav_'.$row->idjenisbarang.'" aria-selected="true">'.$row->nama_jenis.'</a>';
                }else{
                    $str .= '<a class="nav-item nav-link" id="head_nav_'.$row->idjenisbarang.'" data-toggle="tab" href="#nav_'.$row->idjenisbarang.'" role="tab" aria-controls="nav_'.$row->idjenisbarang.'" aria-selected="false">'.$row->nama_jenis.'</a>';
                }
                $counter++;
                
            }
            $str .= '</div></nav>';
            
            // set tab bawah
            $counter = 1;
            $str .= '<div class="tab-content" id="nav-tabContent">';
            foreach ($list1->getResult() as $row) {
                if($counter == 1){
                    $str .= '<div class="tab-pane fade show active" id="nav_'.$row->idjenisbarang.'" role="tabpanel" aria-labelledby="nav_'.$row->idjenisbarang.'">';
                    $str .= '<div class="table-responsive">';
                    $str .= '<table class="table table-bordered" style="width: 100%; font-size: 11px;">
                                <thead>
                                    <tr>
                                        <th>GAMBAR</th>
                                        <th>DESCRIPTION</th>
                                        <th>PN/NSN</th>
                                        <th>DS NUMBER</th>
                                        <th>Holding</th>
                                        <th style="text-align: center;">EQUIPMENT<br>DESCRIPTION</th>
                                        <th style="text-align: center;">STORE<br>LOCATION</th>
                                        <th style="text-align: center;">SUPPLEMENTARY<br>LOCATION</th>
                                        <th style="text-align: center;">UOI</th>
                                        <th style="text-align: center;">Verwendung</th>
                                        <th style="text-align: center;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // menampilkan isi table
                    $list_brg = $this->model->getAllQ("select * from barang where idjenisbarang = '".$row->idjenisbarang."' and idkapal = '".$idkapal."';");
                    foreach ($list_brg->getResult() as $row1) {
                        $str .= '<tr>';
                            $def_foto = base_url() . '/images/noimg.jpg';
                            if (strlen($row1->foto) > 0) {
                                if (file_exists($this->modul->getPathApp().$row1->foto)) {
                                    $def_foto = base_url().'/uploads/'.$row1->foto;
                                }
                            }
                            $str .= '<td><img src="'.$def_foto.'" style="width: 50px; height: auto;"></td>';
                            $str .= '<td>'.$row1->deskripsi.'</td>';
                            $str .= '<td>'.$row1->pn_nsn.'</td>';
                            $str .= '<td>'.$row1->ds_number.'</td>';
                            $str .= '<td>'.$row1->holding.'</td>';
                            $str .= '<td>'.$row1->equipment_desc.'</td>';
                            $str .= '<td>'.$row1->store_location.'</td>';
                            $str .= '<td>'.$row1->supplementary_location.'</td>';
                            $str .= '<td>'.$row1->uoi.'</td>';
                            $str .= '<td>'.$row1->verwendung.'</td>';
                            $str .= '<td><div style="text-align: center;">'
                                    . '<button type="button" class="btn btn-xs btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row1->idbarang . "'" . ')">Ganti</button>&nbsp;'
                                    . '<button type="button" class="btn btn-xs btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row1->idbarang . "'" . ',' . "'" . $row1->deskripsi . "'" . ')">Hapus</button>'
                                    . '</div></td>';
                        $str .= '</tr>';
                    }
                    $str .= '</tbody></table>';
                    $str .= '</div>';
                    $str .= '</div>';
                }else{
                    $str .= '<div class="tab-pane fade" id="nav_'.$row->idjenisbarang.'" role="tabpanel" aria-labelledby="nav_'.$row->idjenisbarang.'">';
                    $str .= '<div class="table-responsive">';
                    $str .= '<table class="table table-bordered" style="width: 100%; font-size: 11px;">
                                <thead>
                                    <tr>
                                        <th>GAMBAR</th>
                                        <th>DESCRIPTION</th>
                                        <th>PN/NSN</th>
                                        <th>DS NUMBER</th>
                                        <th>Holding</th>
                                        <th style="text-align: center;">EQUIPMENT<br>DESCRIPTION</th>
                                        <th style="text-align: center;">STORE<br>LOCATION</th>
                                        <th style="text-align: center;">SUPPLEMENTARY<br>LOCATION</th>
                                        <th style="text-align: center;">UOI</th>
                                        <th style="text-align: center;">Verwendung</th>
                                        <th style="text-align: center;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // menampilkan isi table
                    $list_brg = $this->model->getAllQ("select * from barang where idjenisbarang = '".$row->idjenisbarang."' and idkapal = '".$idkapal."';");
                    foreach ($list_brg->getResult() as $row1) {
                        $str .= '<tr>';
                            $def_foto = base_url() . '/images/noimg.jpg';
                            if (strlen($row1->foto) > 0) {
                                if (file_exists($this->modul->getPathApp().$row1->foto)) {
                                    $def_foto = base_url().'/uploads/'.$row1->foto;
                                }
                            }
                            $str .= '<td><img src="'.$def_foto.'" style="width: 50px; height: auto;"></td>';
                            $str .= '<td>'.$row1->deskripsi.'</td>';
                            $str .= '<td>'.$row1->pn_nsn.'</td>';
                            $str .= '<td>'.$row1->ds_number.'</td>';
                            $str .= '<td>'.$row1->holding.'</td>';
                            $str .= '<td>'.$row1->equipment_desc.'</td>';
                            $str .= '<td>'.$row1->store_location.'</td>';
                            $str .= '<td>'.$row1->supplementary_location.'</td>';
                            $str .= '<td>'.$row1->uoi.'</td>';
                            $str .= '<td>'.$row1->verwendung.'</td>';
                            $str .= '<td><div style="text-align: center;">'
                                    . '<button type="button" class="btn btn-xs btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row1->idbarang . "'" . ')">Ganti</button>&nbsp;'
                                    . '<button type="button" class="btn btn-xs btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row1->idbarang . "'" . ',' . "'" . $row1->deskripsi . "'" . ')">Hapus</button>'
                                    . '</div></td>';
                        $str .= '</tr>';
                    }
                    $str .= '</tbody></table>';
                    $str .= '</div>';
                    $str .= '</div>';
                }
                $counter++;
                
            }
            $str .= '</div>';
            
            $hasil = $str;
            echo json_encode(array("hasil" => $hasil));
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_add() {
        if (session()->get("logged_no_admin")) {
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
            $status_upload = $file->move($this->modul->getPathApp(),$namaFile);
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
                    'idkapal' => $this->getKapal()
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
            'idkapal' => $this->getKapal()
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
        if (session()->get("logged_no_admin")) {
            $kondisi['idbarang'] = $this->request->uri->getSegment(3);
            $data = $this->model->get_by_id("barang", $kondisi);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit() {
        if (session()->get("logged_no_admin")) {
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
            $status_upload = $file->move($this->modul->getPathApp(),$namaFile);
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
                    'idkapal' => $this->getKapal()
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
            'idkapal' => $this->getKapal()
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
        if (session()->get("logged_no_admin")) {
            $idbarang = $this->request->uri->getSegment(3);

            $logo = $this->model->getAllQR("SELECT foto FROM barang where idbarang = '" . $idbarang . "';")->foto;
            if (strlen($logo) > 0) {
                if (file_exists($this->modul->getPathApp().$logo)) {
                    unlink($this->modul->getPathApp().$logo);
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
        if (session()->get("logged_no_admin")) {
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
                        if ( (strlen(trim(addslashes($row[0]))) > 0) && (strlen(trim(addslashes($row[7]))) > 0) ){
                            $cek_desc = $this->model->getAllQR("select count(*) as jml from barang where deskripsi = '".trim(addslashes($row[0]))."' and idkapal = '".$this->getKapal()."';")->jml;
                            if($cek_desc < 1){
                                $data = array(
                                    'idbarang' => $this->model->autokode("B", "idbarang", "barang", 2, 7),
                                    'foto' => '',
                                    'deskripsi' => trim(addslashes($row[0])),
                                    'pn_nsn' => trim(addslashes($row[1])),
                                    'ds_number' => trim(addslashes($row[2])),
                                    'holding' => trim(addslashes($row[3])),
                                    'equipment_desc' => trim(addslashes($row[4])),
                                    'store_location' => trim(addslashes($row[5])),
                                    'supplementary_location' => trim(addslashes($row[6])),
                                    'qty' => trim(addslashes($row[7])),
                                    'uoi' => trim(addslashes($row[8])),
                                    'verwendung' => trim(addslashes($row[9])),
                                    'idjenisbarang' => $this->request->getVar('gudang'),
                                    'idkapal' => $this->getKapal()
                                );
                                $this->model->add("barang", $data);
                            }
                        }
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
