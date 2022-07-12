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
                if (file_exists($this->modul->getPathApp().$logo)) {
                    $def_logo = base_url().'/uploads/'.$logo;
                }
            }
            $data['logo'] = $def_logo;
            $data['gudang'] = $this->model->getAll("jenisbarang");
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
            $username = session()->get("username");
            $kri = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;
            // load data
            $no = 1;
            $data = array();
            $list = $this->model->getAllQ("SELECT a.idbrg_masuk, date_format(tgl, '%d %M %Y') as tglf, b.nama_kapal FROM brg_masuk_cair a, kapal b where a.idkapal = b.idkapal and b.idkapal = '".$kri."' order by tgl desc;");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->tglf;
                $val[] = $row->nama_kapal;
                // menampilkan jumlah itemnya saja
                $val[] = $this->model->getAllQR("select count(*) as jml from brg_masuk_detil_cair where idbrg_masuk = '".$row->idbrg_masuk."';")->jml;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-secondary btn-fw" onclick="showitem('."'".$row->idbrg_masuk."'".')">Detail Item</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$this->modul->enkrip_url($row->idbrg_masuk)."'".')">Ganti</button>&nbsp;'
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
    
    public function ajaxlistcari() {
        if (session()->get("logged_no_admin")) {
            $username = session()->get("username");
            $kri = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;
            // load data
            $tgl1 = $this->request->uri->getSegment(3);
            $tgl2 = $this->request->uri->getSegment(4);
            $deskripsi = str_replace("%20", " ", $this->request->uri->getSegment(5));
            
            $no = 1;
            $data = array();
            $list = $this->model->getAllQ("SELECT distinct a.idbrg_masuk, date_format(tgl, '%d %M %Y') as tglf, b.nama_kapal FROM brg_masuk_cair a, kapal b, brg_masuk_detil_cair c, barang d "
                    . "where a.idkapal = b.idkapal and a.idbrg_masuk = c.idbrg_masuk and c.idbarang = d.idbarang and b.idkapal = '".$kri."' and (a.tgl between '".$tgl1."' and '".$tgl2."') and d.deskripsi like '%".$deskripsi."%' order by tgl desc;");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->tglf;
                $val[] = $row->nama_kapal;
                // menampilkan jumlah itemnya saja
                $val[] = $this->model->getAllQR("select count(*) as jml from brg_masuk_detil where idbrg_masuk = '".$row->idbrg_masuk."';")->jml;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-secondary btn-fw" onclick="showitem('."'".$row->idbrg_masuk."'".')">Detail Item</button>&nbsp;'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="ganti('."'".$this->modul->enkrip_url($row->idbrg_masuk)."'".')">Ganti</button>&nbsp;'
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
    
    public function ajax_item_detil() {
        if (session()->get("logged_no_admin")) {
            $idbrg_masuk = $this->request->uri->getSegment(3);
            // load data
            $data = array();
            $list = $this->model->getAllQ("SELECT b.deskripsi, a.jumlah_minta, a.jumlah_datang, a.satuan FROM brg_masuk_detil_cair a, barang b where a.idbarang = b.idbarang and a.idbrg_masuk = '".$idbrg_masuk."';");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $row->deskripsi;
                $val[] = $row->jumlah_minta;
                $val[] = $row->jumlah_datang;
                $val[] = $row->satuan;
                $data[] = $val;
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
            // mengetahui kri default
            $data['kri'] = $this->model->getAllQR("select idkapal from users where idusers = '".$data['username']."';")->idkapal;
            $data['gudang'] = $this->model->getAllQ("select idjenisbarang, nama_jenis from jenisbarang where idkapal = '".$data['kri']."';");
            
            $temp = $this->request->uri->getSegment(3);
            if(strlen($temp) > 0){
                $kode = $this->modul->dekrip_url($temp);
                $jml = $this->model->getAllQR("select count(*) as jml from brg_masuk_cair where idbrg_masuk = '".$kode."';")->jml;
                if($jml > 0){
                    $kondisi['idbrg_masuk'] = $kode;
                    $tersimpan = $this->model->get_by_id("brg_masuk_cair", $kondisi);
                            
                    $data['kode'] = $kode;
                    $data['tgl_def'] = $tersimpan->tgl;
                    $data['ket'] = "GANTI";

                    echo view('head', $data);
                    echo view('menu_no_admin');
                    echo view('cair_masuk/detil');
                    echo view('foot');
                
                }else{
                    $this->modul->halaman('brgmasuk');
                }
            }else{
                $data['kode'] = $this->model->autokode('M','idbrg_masuk', 'brg_masuk_cair', 2, 7);
                $data['tgl_def'] = $this->modul->TanggalSekarang();
                $data['ket'] = "TAMBAH";

                echo view('head', $data);
                echo view('menu_no_admin');
                echo view('cair_masuk/detil');
                echo view('foot');
            }
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function loadtable() {
        if (session()->get("logged_no_admin")) {
            $username = session()->get("username");
            // mengetahui kapal
            $idkapal = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;
            $kode_trans = $this->request->uri->getSegment(3);
            
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
                                        <th style="text-align: center;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // menampilkan isi table
                    $list_brg = $this->model->getAllQ("select * from barang where idjenisbarang = '".$row->idjenisbarang."' and idkapal = '".$idkapal."' and idbarang not in(select idbarang from brg_masuk_detil_cair where idbrg_masuk = '".$kode_trans."');");
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
                            $str .= '<td><div style="text-align: center;">'
                                        . '<button type="button" class="btn btn-xs btn-outline-primary btn-fw" onclick="pilih_barang('."'".$row1->idbarang."'".','."'".$row1->deskripsi."'".','."'".$row->nama_jenis."'".')">Pilih</button>'
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
                                        <th style="text-align: center;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // menampilkan isi table
                    $list_brg = $this->model->getAllQ("select * from barang where idjenisbarang = '".$row->idjenisbarang."' and idkapal = '".$idkapal."' and idbarang not in(select idbarang from brg_masuk_detil_cair where idbrg_masuk = '".$kode_trans."');");
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
                            $str .= '<td><div style="text-align: center;">'
                                        . '<button type="button" class="btn btn-xs btn-outline-primary btn-fw" onclick="pilih_barang('."'".$row1->idbarang."'".','."'".$row1->deskripsi."'".','."'".$row->nama_jenis."'".')">Pilih</button>'
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
    
    public function ajaxdetil() {
        if (session()->get("logged_no_admin")) {
            $kode = $this->request->uri->getSegment(3);
            // load data
            $no = 1;
            $data = array();
            $list = $this->model->getAllQ("select a.idbrg_m_detil, b.deskripsi, a.jumlah_minta, a.jumlah_datang, a.satuan from brg_masuk_detil_cair a, barang b, brg_masuk_cair c where a.idbarang = b.idbarang and a.idbrg_masuk = c.idbrg_masuk and a.idbrg_masuk = '".$kode."';");
            foreach ($list->getResult() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->deskripsi;
                $val[] = $row->jumlah_minta;
                $val[] = $row->jumlah_datang;
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
    
    public function ajax_add() {
        if(session()->get("logged_no_admin")){
            $username = session()->get("username");
            
            // cek head ada apa endak
            $jml = $this->model->getAllQR("SELECT count(*) as jml FROM brg_masuk_cair where idbrg_masuk = '".$this->request->getVar('kode')."';")->jml;
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
        // cek apa sudah masuk apa belum
        $cek = $this->model->getAllQR("select count(*) as jml from brg_masuk_cair where idbrg_masuk = '".$this->request->getVar('kode')."' and idusers = '".$username."';")->jml;
        if($cek < 1){
            $data = array(
                'idbrg_masuk' => $this->request->getVar('kode'),
                'idkapal' => $this->request->getVar('kri'),
                'tgl' => $this->request->getVar('tgl'),
                'idusers' => $username
            );
            $simpan = $this->model->add("brg_masuk_cair",$data);
        }else{
            $simpan = 1;
        }
        return $simpan;
    }
    
    private function simpan_detil() {
        $username = session()->get("username");
        $idkapal = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;
        
        // cek nama barang klo belum ada masukkan dulu ke master barang
        $cek = $this->model->getAllQR("SELECT count(*) as jml FROM barang where deskripsi = '".$this->request->getVar('nm_barang')."' and idkapal = '".$idkapal."';")->jml;
        if($cek > 0){
            $kodebarang = $this->model->getAllQR("SELECT idbarang FROM barang where deskripsi = '".$this->request->getVar('nm_barang')."' and idkapal = '".$idkapal."';")->idbarang;
        }else{
            // masukkan ke master barang
            $kodebarang = $this->model->autokode("B", "idbarang", "barang", 2, 7);
            $data = array(
                'idbarang' => $kodebarang,
                'foto' => '',
                'deskripsi' => $this->request->getVar('nm_barang'),
                'pn_nsn' => '',
                'ds_number' => '',
                'holding' => '',
                'equipment_desc' => '',
                'store_location' => '',
                'supplementary_location' => '',
                'qty' => 0,
                'uoi' => $this->request->getVar('satuan'),
                'verwendung' => '',
                'idjenisbarang' => $this->request->getVar('gudang'),
                'idkapal' => $idkapal
            );
            $simpan = $this->model->add("barang", $data);
        }
        $data = array(
            'idbrg_m_detil' => $this->model->autokode("MD","idbrg_m_detil","brg_masuk_detil_cair", 3, 9),
            'idbarang' => $kodebarang,
            'jumlah_minta' => $this->request->getVar('jumlah_minta'),
            'jumlah_datang' => $this->request->getVar('jumlah_datang'),
            'satuan' => $this->request->getVar('satuan'),
            'idbrg_masuk' => $this->request->getVar('kode')
        );
        $simpan = $this->model->add("brg_masuk_detil_cair",$data);
        return  $simpan;
    }
    
    public function hapusdetil() {
        if(session()->get("logged_no_admin")){
            $kond['idbrg_m_detil'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("brg_masuk_detil_cair",$kond);
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
            $data = $this->model->getAllQR("SELECT a.idbrg_m_detil, a.idbarang, b.deskripsi, a.jumlah_minta, a.jumlah_datang, a.satuan, b.idjenisbarang FROM brg_masuk_detil_cair a, barang b where a.idbarang = b.idbarang and a.idbrg_m_detil = '".$kode_detil."';");
            echo json_encode($data);
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
            $kond1['idbrg_masuk'] = $this->request->getVar('kode');
            $update = $this->model->update("brg_masuk_cair",$data, $kond1);
            if($update == 1){
                $data_detil = array(
                    'idbarang' => $this->request->getVar('kode_barang'),
                    'jumlah_minta' => $this->request->getVar('jumlah_minta'),
                    'jumlah_datang' => $this->request->getVar('jumlah_datang'),
                    'satuan' => $this->request->getVar('satuan')
                );
                $kond2['idbrg_m_detil'] = $this->request->getVar('kode_detil');
                $update2 = $this->model->update("brg_masuk_detil_cair",$data_detil, $kond2);
                if($update2 == 1){
                    // ubah juga posisi gudangnya
                    $data_gudang = array(
                        'idjenisbarang' => $this->request->getVar('gudang')
                    );
                    $kond3['idbarang'] = $this->request->getVar('kode_barang');
                    $this->model->update("barang",$data_gudang, $kond3);

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
            $kond['idbrg_masuk'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("brg_masuk_cair",$kond);
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
    
    public function uploadmasuk() {
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
                                    'idbrg_m_detil' => $this->model->autokode("MD","idbrg_m_detil","brg_masuk_detil", 3, 9),
                                    'idbarang' => $idbrg,
                                    'jumlah' => $jumlah,
                                    'satuan' => trim(addslashes($row[8])),
                                    'idbrg_masuk' => $this->request->getVar('kode')
                                );
                                $this->model->add("brg_masuk_detil",$data_detil);
                            }else{
                                // masukkan master
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
                                    'idkapal' => $kri
                                );
                                $this->model->add("barang", $data);
                                
                                // setelah masukin barang mestinya masukin jumlah
                                $idbrg = $this->model->getAllQR("select idbarang from barang where idkapal = '".$kri."' and deskripsi = '".$nama_brg."';")->idbarang;
                                // klo barangnya sudah ada baru di masukkan ke stok
                                $data_detil = array(
                                    'idbrg_m_detil' => $this->model->autokode("MD","idbrg_m_detil","brg_masuk_detil", 3, 9),
                                    'idbarang' => $idbrg,
                                    'jumlah' => $jumlah,
                                    'satuan' => trim(addslashes($row[8])),
                                    'idbrg_masuk' => $this->request->getVar('kode')
                                );
                                $this->model->add("brg_masuk_detil",$data_detil);
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
