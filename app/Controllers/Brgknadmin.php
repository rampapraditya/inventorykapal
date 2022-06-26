<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Brgknadmin
 *
 * @author RAMPA
 */
class Brgknadmin extends BaseController {
    
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

            echo view('head', $data);
            echo view('menu_no_admin');
            echo view('brg_keluar_non_admin/index');
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
            $list = $this->model->getAllQ("SELECT a.idbrg_keluar, date_format(tgl, '%d %M %Y') as tglf, b.nama_kapal FROM brg_keluar a, kapal b where a.idkapal = b.idkapal and a.idkapal = '".$kri."' order by tgl desc;");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->tglf;
                $val[] = $row->nama_kapal;
                $detil = '<table class="table table-hover" style="width: 100%; font-size: 9px;">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>';
                $list_detil = $this->model->getAllQ("SELECT b.deskripsi, a.jumlah, a.satuan FROM brg_keluar_detil a, barang b where a.idbarang = b.idbarang and a.idbrg_keluar = '".$row->idbrg_keluar."';");
                foreach ($list_detil->getResult() as $row1) {
                    $detil .= '<tr>';
                    $detil .= '<td>'.$row1->deskripsi.'</td>';
                    $detil .= '<td>'.$row1->jumlah.'</td>';
                    $detil .= '<td>'.$row1->satuan.'</td>';
                    $detil .= '</tr>';
                }
                $detil .= '</tbody></table>';
                $val[] = $detil;
                $val[] = '<div style="text-align: center;">'
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
    
    public function detil() {
        if (session()->get("logged_no_admin")) {
            $data['username'] = session()->get("username");
            $data['nrp'] = session()->get('nrp');
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("role");

            // membaca foto profile
            $def_foto = base_url().'/images/noimg.jpg';
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
                if (file_exists($this->modul->getPathApp(). $logo)) {
                    $def_logo = base_url().'/uploads/'.$logo;
                }
            }
            $data['logo'] = $def_logo;
            
            // mengetahui kri default
            $data['kri'] = $this->model->getAllQR("select idkapal from users where idusers = '".$data['username']."';")->idkapal;
            
            $temp = $this->request->uri->getSegment(3);
            if(strlen($temp) > 0){
                $kode = $this->modul->dekrip_url($temp);
                $jml = $this->model->getAllQR("select count(*) as jml from brg_keluar where idbrg_keluar = '".$kode."';")->jml;
                if($jml > 0){
                    $kondisi['idbrg_keluar'] = $kode;
                    $tersimpan = $this->model->get_by_id("brg_keluar", $kondisi);
                            
                    $data['kode'] = $kode;
                    $data['tgl_def'] = $tersimpan->tgl;
                    $data['ket'] = "GANTI";

                    echo view('head', $data);
                    echo view('menu_no_admin');
                    echo view('brg_keluar_non_admin/detil');
                    echo view('foot');
                
                }else{
                    $this->modul->halaman('brgkeluar');
                }
            }else{
                $data['kode'] = $this->model->autokode('K','idbrg_keluar', 'brg_keluar', 2, 7);
                $data['tgl_def'] = $this->modul->TanggalSekarang();
                $data['ket'] = "TAMBAH";

                echo view('head', $data);
                echo view('menu_no_admin');
                echo view('brg_keluar_non_admin/detil');
                echo view('foot');
            }
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajaxdetil() {
        if (session()->get("logged_no_admin")) {
            $kode = $this->request->uri->getSegment(3);
            // load data
            $no = 1;
            $data = array();
            $list = $this->model->getAllQ("select a.idbrg_k_detil, b.deskripsi, a.jumlah, a.satuan from brg_keluar_detil a, barang b, brg_keluar c where a.idbarang = b.idbarang and a.idbrg_keluar = c.idbrg_keluar and a.idbrg_keluar = '".$kode."';");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->deskripsi;
                $val[] = $row->jumlah;
                $val[] = $row->satuan;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti(' . "'" . $row->idbrg_k_detil . "'" . ')">Ganti</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-danger btn-fw" onclick="hapus(' . "'" . $row->idbrg_k_detil . "'" . ',' . "'" . $no . "'" . ')">Hapus</button>'
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
    
    public function load_table() {
        if (session()->get("logged_no_admin")) {
            $username = session()->get("username");
            $idkapal = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;
            
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
                                        <th>Stok</th>
                                        <th style="text-align: center;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // menampilkan isi table
                    $list_brg = $this->model->getAllQ("select * from barang a, jenisbarang b where a.idjenisbarang = b.idjenisbarang and b.idjenisbarang = '".$row->idjenisbarang."' and b.idkapal = '".$idkapal."';");
                    foreach ($list_brg->getResult() as $row1) {
                        $str .= '<tr>';
                            $def_foto = base_url().'/images/noimg.jpg';
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
                            $stok = $this->getStok($row1->idbarang, $idkapal);
                            $str .= '<td>'.$stok.'</td>';
                            $str .= '<td><div style="text-align: center;">'
                                    . '<button type="button" class="btn btn-xs btn-outline-primary btn-fw" onclick="pilih('."'".$row1->idbarang."'".','."'".$row1->deskripsi."'".','."'".$stok."'".','."'".$row1->uoi."'".')">Pilih</button>'
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
                                        <th>Stok</th>
                                        <th style="text-align: center;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // menampilkan isi table
                    $list_brg = $this->model->getAllQ("select * from barang a, jenisbarang b where a.idjenisbarang = b.idjenisbarang and b.idjenisbarang = '".$row->idjenisbarang."' and b.idkapal = '".$idkapal."';");
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
                            $stok = $this->getStok($row1->idbarang, $idkapal);
                            $str .= '<td>'.$stok.'</td>';
                            $str .= '<td><div style="text-align: center;">'
                                    . '<button type="button" class="btn btn-xs btn-outline-primary btn-fw" onclick="pilih('."'".$row1->idbarang."'".','."'".$row1->deskripsi."'".','."'".$stok."'".','."'".$row1->uoi."'".')">Pilih</button>'
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
        if(session()->get("logged_no_admin")){
            $username = session()->get("username");
            
            // cek head ada apa endak
            $jml = $this->model->getAllQR("SELECT count(*) as jml FROM brg_keluar where idbrg_keluar = '".$this->request->getVar('kode')."';")->jml;
            if($jml > 0){
                $hasil3 = $this->simpan_detil();
                if($hasil3 == 1){
                    $status = "Data tersimpan";
                }else{
                    $status = "Data gagal tersimpan";
                }
            }else{
                $hasil1 = $this->simpan_head($username);
                if($hasil1 == 1){
                    $hasil2 = $this->simpan_detil();
                    if($hasil2 == 1){
                        $status = "Data tersimpan";
                    }else{
                        $status = "Data gagal tersimpan";
                    }
                }else{
                    $status = "Data gagal tersimpan";
                }
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpan_head($username) {
        $cek = $this->model->getAllQR("SELECT count(*) as jml FROM brg_keluar where idbrg_keluar = '".$this->request->getVar('kode')."' and idusers = '".$username."';")->jml;
        if($cek < 1){
            $data = array(
                'idbrg_keluar' => $this->request->getVar('kode'),
                'idkapal' => $this->request->getVar('kri'),
                'tgl' => $this->request->getVar('tgl'),
                'idusers' => $username
            );
            $simpan = $this->model->add("brg_keluar",$data);
        }else{
            $simpan = 1;
        }
        return  $simpan;
    }
    
    private function simpan_detil() {
        $data = array(
            'idbrg_k_detil' => $this->model->autokode("KD","idbrg_k_detil","brg_keluar_detil", 3, 9),
            'idbarang' => $this->request->getVar('kode_barang'),
            'jumlah' => $this->request->getVar('jumlah'),
            'satuan' => $this->request->getVar('satuan'),
            'idbrg_keluar' => $this->request->getVar('kode')
        );
        $simpan = $this->model->add("brg_keluar_detil",$data);
        return  $simpan;
    }
    
    public function hapusdetil() {
        if(session()->get("logged_no_admin")){
            $kond['idbrg_k_detil'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("brg_keluar_detil",$kond);
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
    
    public function gantidetil(){
        if(session()->get("logged_no_admin")){
            $kode_detil = $this->request->uri->getSegment(3);
            $data = $this->model->getAllQR("SELECT a.idbrg_k_detil, a.idbarang, b.deskripsi, a.jumlah, a.satuan, a.idbrg_keluar FROM brg_keluar_detil a, barang b where a.idbarang = b.idbarang and a.idbrg_k_detil = '".$kode_detil."';");
            // mencari kri
            $kri = $this->model->getAllQR("select idkapal from brg_keluar where idbrg_keluar = '".$data->idbrg_keluar."';")->idkapal;
            // mencari stok
            $stok = $this->getStok($data->idbarang, $kri) + $data->jumlah;
            
            echo json_encode(array(
                "idbrg_k_detil" => $data->idbrg_k_detil,
                "idbarang" => $data->idbarang,
                "deskripsi" => $data->deskripsi,
                "jumlah" => $data->jumlah,
                "satuan" => $data->satuan,
                "stok" => $stok
            ));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if(session()->get("logged_no_admin")){
            $data = array(
                'idkapal' => $this->request->getVar('kri'),
                'tgl' => $this->request->getVar('tgl')
            );
            $kond1['idbrg_keluar'] = $this->request->getVar('kode');
            $update = $this->model->update("brg_keluar",$data, $kond1);
            if($update == 1){
                $data_detil = array(
                    'idbarang' => $this->request->getVar('kode_barang'),
                    'jumlah' => $this->request->getVar('jumlah'),
                    'satuan' => $this->request->getVar('satuan')
                );
                $kond2['idbrg_k_detil'] = $this->request->getVar('kode_detil');
                $update2 = $this->model->update("brg_keluar_detil",$data_detil, $kond2);
                if($update2 == 1){
                    $status = "Data terupdate";
                }else{
                    $status = "Data gagal terupdate";
                }
            }else{
                $status = "Data terupdate";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function hapus() {
        if(session()->get("logged_no_admin")){
            $kond['idbrg_keluar'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("brg_keluar",$kond);
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
    
    private function getStok($idbarang, $kri) {
        $masuk = $this->model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as masuk FROM brg_masuk a, brg_masuk_detil b where a.idbrg_masuk = b.idbrg_masuk and a.idkapal = '".$kri."' and b.idbarang = '".$idbarang."';")->masuk;
        $keluar = $this->model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as keluar FROM brg_keluar a, brg_keluar_detil b where a.idbrg_keluar = b.idbrg_keluar and a.idkapal = '".$kri."' and b.idbarang = '".$idbarang."';")->keluar;
        $stok = $masuk - $keluar;
        return $stok;
    }
    
    public function uploadkeluar() {
        if(session()->get("logged_no_admin")){
            $username = session()->get("username");
            
            if (isset($_FILES['file']['name'])) {
                if (0 < $_FILES['file']['error']) {
                    $status = "Error during file upload " . $_FILES['file']['error'];
                } else {
                    $status = $this->simpan_dengan_file($username);
                }
            } else {
                $status = "File tidak ditemukan";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpan_dengan_file($username) {
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $info_file = $this->modul->info_file($file);

        if (file_exists($this->modul->getPathApp().$fileName)) {
            $status = "Gunakan nama file lain";
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
                $status_upload = $file->move($this->modul->getPathApp(), $fileName);
                if ($status_upload) {
                    // upload header terlebih dahulu
                    $this->simpan_head($username);
                    $kri = $this->request->getVar('kri');
                    
                    // extrak kulit manggis
                    $path = $this->modul->getPathApp().$fileName;
                    $spreadsheet = $render->load($path);
                    $data = $spreadsheet->getActiveSheet()->toArray();
                    foreach ($data as $x => $row) {
                        // masukkan ke database
                        $nama_brg = trim(addslashes($row[0]));
                        $jumlah = trim(addslashes($row[7]));
                        
                        if (strlen($nama_brg) > 0 && strlen($jumlah) > 0) {
                            // cek barang ini sudah masuk master apa belum
                            $jml = $this->model->getAllQR("select count(*) as jml from barang where idkapal = '".$kri."' and deskripsi = '".$nama_brg."';")->jml;
                            if($jml > 0){
                                $idbrg = $this->model->getAllQR("select idbarang from barang where idkapal = '".$kri."' and deskripsi = '".$nama_brg."';")->idbarang;
                                // klo barangnya sudah ada baru di masukkan ke stok
                                $data_detil = array(
                                    'idbrg_k_detil' => $this->model->autokode("KD","idbrg_k_detil","brg_keluar_detil", 3, 9),
                                    'idbarang' => $idbrg,
                                    'jumlah' => $jumlah,
                                    'satuan' => trim(addslashes($row[8])),
                                    'idbrg_keluar' => $this->request->getVar('kode')
                                );
                                $this->model->add("brg_keluar_detil",$data_detil);
                            }
                        }                   
                    }
                    
                    unlink($this->modul->getPathApp().$fileName);
                    
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
