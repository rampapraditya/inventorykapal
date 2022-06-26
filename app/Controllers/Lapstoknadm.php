<?php
namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Lapstoknadm
 *
 * @author RAMPA
 */
class Lapstoknadm extends BaseController {
    
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
            
            echo view('head', $data);
            echo view('menu_no_admin');
            echo view('laporan/non_admin');
            echo view('foot');
        } else {
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_load_table() {
        if (session()->get("logged_no_admin")) {
            $username = session()->get("username");
            // mengetahui kapal
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
                                        <th style="text-align: center;">EQUIPMENT<br>DESCRIPTION</th>
                                        <th style="text-align: center;">STORE<br>LOCATION</th>
                                        <th style="text-align: center;">SUPPLEMENTARY<br>LOCATION</th>
                                        <th style="text-align: center;">QTY</th>
                                        <th style="text-align: center;">UOI</th>
                                        <th style="text-align: center;">Verwendung</th>
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
                            $str .= '<td>'.$this->getStok($row1->idbarang, $idkapal).'</td>';
                            $str .= '<td>'.$row1->uoi.'</td>';
                            $str .= '<td>'.$row1->verwendung.'</td>';
                            
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
                                        <th style="text-align: center;">QTY</th>
                                        <th style="text-align: center;">UOI</th>
                                        <th style="text-align: center;">Verwendung</th>
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
                            $str .= '<td>'.$this->getStok($row1->idbarang, $idkapal).'</td>';
                            $str .= '<td>'.$row1->uoi.'</td>';
                            $str .= '<td>'.$row1->verwendung.'</td>';
                            
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

    private function getStok($idbarang, $kri) {
        $masuk = $this->model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as masuk FROM brg_masuk a, brg_masuk_detil b where a.idbrg_masuk = b.idbrg_masuk and a.idkapal = '".$kri."' and b.idbarang = '".$idbarang."';")->masuk;
        $keluar = $this->model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as keluar FROM brg_keluar a, brg_keluar_detil b where a.idbrg_keluar = b.idbrg_keluar and a.idkapal = '".$kri."' and b.idbarang = '".$idbarang."';")->keluar;
        $stok = $masuk - $keluar;
        return $stok;
    }
}
