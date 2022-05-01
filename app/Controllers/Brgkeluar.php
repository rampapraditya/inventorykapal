<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Brgmasuk
 *
 * @author RAMPA
 */
class Brgkeluar extends BaseController {
    
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
            echo view('barang_keluar/index');
            echo view('foot');
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlist() {
        if (session()->get("logged_in")) {
            $no = 1;
            $data = array();
            $list = $this->model->getAllQ("SELECT a.idbrg_keluar, date_format(tgl, '%d %M %Y') as tglf, b.nama_kapal FROM brg_keluar a, kapal b where a.idkapal = b.idkapal order by tgl desc;");
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
                $kode = $this->modul->dekrip_url($temp);
                $jml = $this->model->getAllQR("select count(*) as jml from brg_keluar where idbrg_keluar = '".$kode."';")->jml;
                if($jml > 0){
                    $kondisi['idbrg_keluar'] = $kode;
                    $tersimpan = $this->model->get_by_id("brg_keluar", $kondisi);
                            
                    $data['kode'] = $kode;
                    $data['kri'] = $this->model->getAll("kapal");
                    $data['kri_tersimpan'] = $tersimpan->idkapal;
                    $data['tgl_def'] = $tersimpan->tgl;
                    $data['ket'] = "Ganti barang keluar";

                    echo view('head', $data);
                    echo view('menu');
                    echo view('barang_keluar/detil');
                    echo view('foot');
                
                }else{
                    $this->modul->halaman('brgkeluar');
                }
            }else{
                $data['kode'] = $this->model->autokode('K','idbrg_keluar', 'brg_keluar', 2, 7);
                $data['kri'] = $this->model->getAll("kapal");
                $data['kri_tersimpan'] = "";
                $data['tgl_def'] = $this->modul->TanggalSekarang();
                $data['ket'] = "Tambah barang keluar";

                echo view('head', $data);
                echo view('menu');
                echo view('barang_keluar/detil');
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
    
    public function ajax_platform() {
        if (session()->get("logged_in")) {
            $kri = $this->request->uri->getSegment(4);
            // load data
            $data = array();
            $list = $this->model->getAllQ("select a.idbarang, b.foto, b.deskripsi, b.pn_nsn, b.ds_number, b.holding from brg_masuk_detil a, barang b, jenisbarang c, brg_masuk d where a.idbrg_masuk = d.idbrg_masuk and a.idbarang = b.idbarang and b.idjenisbarang = c.idjenisbarang and c.idjenisbarang = 'J00001' and d.idkapal = '".$kri."';");
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
                $stok = $this->getStok($row->idbarang, $kri);
                $val[] = $stok;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="pilih('."'".$row->idbarang."'".','."'".$row->deskripsi."'".','."'".$stok."'".')">Pilih</button>'
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
        if (session()->get("logged_in")) {
            $kri = $this->request->uri->getSegment(4);
            // load data
            $data = array();
            $list = $this->model->getAllQ("select a.idbarang, b.foto, b.deskripsi, b.pn_nsn, b.ds_number, b.holding from brg_masuk_detil a, barang b, jenisbarang c, brg_masuk d where a.idbrg_masuk = d.idbrg_masuk and a.idbarang = b.idbarang and b.idjenisbarang = c.idjenisbarang and c.idjenisbarang = 'J00002' and d.idkapal = '".$kri."';");
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
                $stok = $this->getStok($row->idbarang, $kri);
                $val[] = $stok;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="pilih('."'".$row->idbarang."'".','."'".$row->deskripsi."'".','."'".$stok."'".')">Pilih</button>'
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
        if (session()->get("logged_in")) {
            $kri = $this->request->uri->getSegment(4);
            // load data
            $data = array();
            $list = $this->model->getAllQ("select a.idbarang, b.foto, b.deskripsi, b.pn_nsn, b.ds_number, b.holding from brg_masuk_detil a, barang b, jenisbarang c, brg_masuk d where a.idbrg_masuk = d.idbrg_masuk and a.idbarang = b.idbarang and b.idjenisbarang = c.idjenisbarang and c.idjenisbarang = 'J00003' and d.idkapal = '".$kri."';");
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
                $stok = $this->getStok($row->idbarang, $kri);
                $val[] = $stok;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="pilih('."'".$row->idbarang."'".','."'".$row->deskripsi."'".','."'".$stok."'".')">Pilih</button>'
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
        if (session()->get("logged_in")) {
            $kri = $this->request->uri->getSegment(4);
            // load data
            $data = array();
            $list = $this->model->getAllQ("select a.idbarang, b.foto, b.deskripsi, b.pn_nsn, b.ds_number, b.holding from brg_masuk_detil a, barang b, jenisbarang c, brg_masuk d where a.idbrg_masuk = d.idbrg_masuk and a.idbarang = b.idbarang and b.idjenisbarang = c.idjenisbarang and c.idjenisbarang = 'J00004' and d.idkapal = '".$kri."';");
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
                $stok = $this->getStok($row->idbarang, $kri);
                $val[] = $stok;
                $val[] = '<div style="text-align: center;">'
                        . '<button type="button" class="btn btn-outline-primary btn-fw" onclick="pilih('."'".$row->idbarang."'".','."'".$row->deskripsi."'".','."'".$stok."'".')">Pilih</button>'
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
        if(session()->get("logged_in")){
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
        $data = array(
            'idbrg_keluar' => $this->request->getVar('kode'),
            'idkapal' => $this->request->getVar('kri'),
            'tgl' => $this->request->getVar('tgl'),
            'idusers' => $username
        );
        $simpan = $this->model->add("brg_keluar",$data);
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
        if(session()->get("logged_in")){
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
        if(session()->get("logged_in")){
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
        if(session()->get("logged_in")){
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
        if(session()->get("logged_in")){
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
}
