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
                        // melakukan pengecekan deskripsi dan qty tidak boleh kosong
                        if ( (strlen(trim(addslashes($row[0]))) > 0) && (strlen(trim(addslashes($row[7]))) > 0) ){
                            // cek juga apakah barang sudah pernah di import
                            $cek_desc = $this->model->getAllQR("select count(*) as jml from barang where deskripsi = '".trim(addslashes($row[0]))."' and idkapal = '".$this->request->getVar('idkapal')."';")->jml;
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
                                    'qty' => 0,
                                    'uoi' => trim(addslashes($row[8])),
                                    'verwendung' => trim(addslashes($row[9])),
                                    'idjenisbarang' => $this->request->getVar('gudang'),
                                    'idkapal' => $this->request->getVar('idkapal')
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
   
    public function display_tab() {
        if (session()->get("logged_in")) {
            $idkapal = $this->request->getVar('kapal');
            //$idkapal = $this->request->uri->getSegment(3);
            
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
                                        <th>NAMA BARANG</th>
                                        <th>PN/NSN</th>
                                        <th>EQUIPMENT<br>DESC</th>
                                        <th>JUMLAH</th>
                                        <th>SATUAN</th>
                                        <th>KETERANGAN</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // menampilkan isi table
                    $list_brg = $this->model->getAllQ("select distinct b.idbarang from brg_masuk a, brg_masuk_detil b where a.idbrg_masuk = b.idbrg_masuk and a.idkapal = '".$idkapal."' and a.idjenisbarang = '".$row->idjenisbarang."';");
                    foreach ($list_brg->getResult() as $row1) {
                        $str .= '<tr>';
                            // mencari data barang
                            $brg = $this->model->getAllQR("select * from barang where idbarang = '".$row1->idbarang."'");
                            
                            $def_foto = base_url() . '/images/noimg.jpg';
                            if (strlen($brg->foto) > 0) {
                                if (file_exists($this->modul->getPathApp().$brg->foto)) {
                                    $def_foto = base_url().'/uploads/'.$brg->foto;
                                }
                            }
                            $str .= '<td><img src="'.$def_foto.'" style="width: 50px; height: auto;"></td>';
                            $str .= '<td>'.$brg->deskripsi.'</td>';
                            $str .= '<td>'.$brg->pn_nsn.'</td>';
                            $str .= '<td>'.$brg->equipment_desc.'</td>';
                            $str .= '<td>'.$this->getStok($brg->idbarang, $idkapal, $row->idjenisbarang).'</td>';
                            $str .= '<td>'.$brg->uoi.'</td>';
                            $str .= '<td>'.$brg->verwendung.'</td>';
                            
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
                                        <th>NAMA BARANG</th>
                                        <th>PN/NSN</th>
                                        <th>EQUIPMENT<br>DESC</th>
                                        <th>JUMLAH</th>
                                        <th>SATUAN</th>
                                        <th>KETERANGAN</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // menampilkan isi table
                    $list_brg = $this->model->getAllQ("select distinct b.idbarang from brg_masuk a, brg_masuk_detil b where a.idbrg_masuk = b.idbrg_masuk and a.idkapal = '".$idkapal."' and a.idjenisbarang = '".$row->idjenisbarang."';");
                    foreach ($list_brg->getResult() as $row1) {
                        $str .= '<tr>';
                            // mencari data barang
                            $brg = $this->model->getAllQR("select * from barang where idbarang = '".$row1->idbarang."'");
                            
                            $def_foto = base_url() . '/images/noimg.jpg';
                            if (strlen($brg->foto) > 0) {
                                if (file_exists($this->modul->getPathApp().$brg->foto)) {
                                    $def_foto = base_url().'/uploads/'.$brg->foto;
                                }
                            }
                            $str .= '<td><img src="'.$def_foto.'" style="width: 50px; height: auto;"></td>';
                            $str .= '<td>'.$brg->deskripsi.'</td>';
                            $str .= '<td>'.$brg->pn_nsn.'</td>';
                            $str .= '<td>'.$brg->equipment_desc.'</td>';
                            $str .= '<td>'.$this->getStok($brg->idbarang, $idkapal, $row->idjenisbarang).'</td>';
                            $str .= '<td>'.$brg->uoi.'</td>';
                            $str .= '<td>'.$brg->verwendung.'</td>';
                            
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
    
    private function getStok($idbarang, $kri, $gudang) {
        $masuk = $this->model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as masuk FROM brg_masuk a, brg_masuk_detil b where a.idbrg_masuk = b.idbrg_masuk and a.idkapal = '".$kri."' and b.idbarang = '".$idbarang."' and a.idjenisbarang = '".$gudang."';")->masuk;
        $keluar = $this->model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as keluar FROM brg_keluar a, brg_keluar_detil b where a.idbrg_keluar = b.idbrg_keluar and a.idkapal = '".$kri."' and b.idbarang = '".$idbarang."' and a.idjenisbarang = '".$gudang."';")->keluar;       
        $stok = $masuk - $keluar;
        
        return $stok;
    }
    
    public function display_gudang() {
        if (session()->get("logged_in")) {
            $idkapal = $this->request->getVar('kapal');
            
            // menampilkan gudang
            $str = '<option value="-">- PILIH GUDANG -</option>';
            $list = $this->model->getAllQ("select idjenisbarang, nama_jenis from jenisbarang where idkapal = '".$idkapal."';");
            foreach ($list->getResult() as $row) {
                $str .= '<option value="'.$row->idjenisbarang.'">'.$row->nama_jenis.'</option>';
            }
            
            $hasil = $str;
            echo json_encode(array("hasil" => $hasil));
        } else {
            $this->modul->halaman('login');
        }
    }

}
