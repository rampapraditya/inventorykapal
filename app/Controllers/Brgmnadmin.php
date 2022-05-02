<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Brgmnadmin
 *
 * @author RAMPA
 */
class Brgmnadmin extends BaseController {
    
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
            echo view('menu_no_admin');
            echo view('brg_masuk_non_admin/index');
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
            $list = $this->model->getAllQ("SELECT a.idbrg_masuk, date_format(tgl, '%d %M %Y') as tglf, b.nama_kapal FROM brg_masuk a, kapal b where a.idkapal = b.idkapal and b.idkapal = '".$kri."' order by tgl desc;");
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
                $list_detil = $this->model->getAllQ("SELECT b.deskripsi, a.jumlah, a.satuan FROM brg_masuk_detil a, barang b where a.idbarang = b.idbarang and a.idbrg_masuk = '".$row->idbrg_masuk."';");
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
                $kode = $this->modul->dekrip_url($temp);
                $jml = $this->model->getAllQR("select count(*) as jml from brg_masuk where idbrg_masuk = '".$kode."';")->jml;
                if($jml > 0){
                    $kondisi['idbrg_masuk'] = $kode;
                    $tersimpan = $this->model->get_by_id("brg_masuk", $kondisi);
                            
                    $data['kode'] = $kode;
                    $data['kri'] = $this->model->getAll("kapal");
                    $data['kri_tersimpan'] = $tersimpan->idkapal;
                    $data['tgl_def'] = $tersimpan->tgl;
                    $data['ket'] = "Ganti barang datang";

                    echo view('head', $data);
                    echo view('menu_no_admin');
                    echo view('brg_masuk_non_admin/detil');
                    echo view('foot');
                
                }else{
                    $this->modul->halaman('brgmasuk');
                }
            }else{
                $data['kode'] = $this->model->autokode('M','idbrg_masuk', 'brg_masuk', 2, 7);
                $data['kri'] = $this->model->getAll("kapal");
                $data['kri_tersimpan'] = "";
                $data['tgl_def'] = $this->modul->TanggalSekarang();
                $data['ket'] = "Tambah barang datang";

                echo view('head', $data);
                echo view('menu_no_admin');
                echo view('brg_masuk_non_admin/detil');
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
    
    public function ajax_platform() {
        if (session()->get("logged_no_admin")) {
            $kode_trans = $this->request->uri->getSegment(3);
            // load data
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00001' and idbarang not in(select idbarang from brg_masuk_detil where idbrg_masuk = '".$kode_trans."');");
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
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="pilih_platform('."'".$row->idbarang."'".','."'".$row->deskripsi."'".','."'Platform'".')">Pilih</button>'
                        . '</div>';

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_sewaco() {
        if (session()->get("logged_no_admin")) {
            $kode_trans = $this->request->uri->getSegment(3);
            // load data
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00002' and idbarang not in(select idbarang from brg_masuk_detil where idbrg_masuk = '".$kode_trans."');");
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
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="pilih_sewaco('."'".$row->idbarang."'".','."'".$row->deskripsi."'".','."'Sewaco'".')">Pilih</button>'
                        . '</div>';

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_komaliwan() {
        if (session()->get("logged_no_admin")) {
            $kode_trans = $this->request->uri->getSegment(3);
            // load data
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00003' and idbarang not in(select idbarang from brg_masuk_detil where idbrg_masuk = '".$kode_trans."');");
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
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="pilih_komaliwan('."'".$row->idbarang."'".','."'".$row->deskripsi."'".','."'Komaliwan'".')">Pilih</button>'
                        . '</div>';

                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_br_umum() {
        if (session()->get("logged_no_admin")) {
            $kode_trans = $this->request->uri->getSegment(3);
            // load data
            $data = array();
            $list = $this->model->getAllQ("select * from barang where idjenisbarang = 'J00004' and idbarang not in(select idbarang from brg_masuk_detil where idbrg_masuk = '".$kode_trans."');");
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
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="pilih_umum('."'".$row->idbarang."'".','."'".$row->deskripsi."'".','."'Umum'".')">Pilih</button>'
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
        if(session()->get("logged_no_admin")){
            $username = session()->get("username");
            
            // cek head ada apa endak
            $jml = $this->model->getAllQR("SELECT count(*) as jml FROM brg_masuk where idbrg_masuk = '".$this->request->getVar('kode')."';")->jml;
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
        $data = array(
            'idbrg_masuk' => $this->request->getVar('kode'),
            'idkapal' => $this->request->getVar('kri'),
            'tgl' => $this->request->getVar('tgl'),
            'idusers' => $username
        );
        $simpan = $this->model->add("brg_masuk",$data);
        return  $simpan;
    }
    
    private function simpan_detil() {
        $data = array(
            'idbrg_m_detil' => $this->model->autokode("MD","idbrg_m_detil","brg_masuk_detil", 3, 9),
            'idbarang' => $this->request->getVar('kode_barang'),
            'jumlah' => $this->request->getVar('jumlah'),
            'satuan' => $this->request->getVar('satuan'),
            'idbrg_masuk' => $this->request->getVar('kode')
        );
        $simpan = $this->model->add("brg_masuk_detil",$data);
        return  $simpan;
    }
    
    public function hapusdetil() {
        if(session()->get("logged_no_admin")){
            $kond['idbrg_m_detil'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("brg_masuk_detil",$kond);
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
            $data = $this->model->getAllQR("SELECT a.idbrg_m_detil, a.idbarang, b.deskripsi, a.jumlah, a.satuan FROM brg_masuk_detil a, barang b where a.idbarang = b.idbarang and a.idbrg_m_detil = '".$kode_detil."';");
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
            $update = $this->model->update("brg_masuk",$data, $kond1);
            if($update == 1){
                $data_detil = array(
                    'idbrg_m_detil' => $this->model->autokode("MD","idbrg_m_detil","brg_masuk_detil", 3, 9),
                    'idbarang' => $this->request->getVar('kode_barang'),
                    'jumlah' => $this->request->getVar('jumlah'),
                    'satuan' => $this->request->getVar('satuan')
                );
                $kond2['idbrg_m_detil'] = $this->request->getVar('kode_detil');
                $update2 = $this->model->update("brg_masuk_detil",$data_detil, $kond2);
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
            $kond['idbrg_masuk'] = $this->request->uri->getSegment(3);
            $hapus = $this->model->delete("brg_masuk",$kond);
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
