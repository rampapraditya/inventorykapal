<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\Mcustom;
use App\Libraries\Modul;

/**
 * Description of Api
 *
 * @author RAMPA
 */
class Api extends BaseController {

    private $model;
    private $modul;

    use ResponseTrait;

    public function __construct() {
        $this->model = new Mcustom();
        $this->modul = new Modul();
    }

    public function index() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $response["kode"] = 1;
            $response["pesan"] = "Bukan hak akses anda";
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }

    public function login() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            if ($security == "Pr4medi4InvTorITNIAL") {
                // mengakses database
                $enkrip_pass = $this->modul->enkrip_pass($password);
                $jml = $this->model->getAllQR("SELECT count(*) as jml FROM users where nrp = '" . $username . "';")->jml;
                if ($jml > 0) {
                    $jml1 = $this->model->getAllQR("select count(*) as jml from users where nrp = '" . $username . "' and pass = '" . $enkrip_pass . "';")->jml;
                    if ($jml1 > 0) {
                        $data = $this->model->getAllQR("select idusers, nrp, nama, idrole from users where nrp = '" . $username . "';");

                        $response["kode"] = 1;
                        $response["pesan"] = "Login sukses";
                        $response["idusers"] = $data->idusers;
                        $response["nrp"] = $data->nrp;
                        $response["nama"] = $data->nama;
                        $response["role"] = $data->idrole;
                    } else {
                        $response["kode"] = 0;
                        $response["pesan"] = "Akses ditolak";
                    }
                } else {
                    $response["kode"] = 0;
                    $response["pesan"] = "Pengguna tidak ditemukan";
                }
            } else {
                $response["kode"] = 0;
                $response["pesan"] = "Token ditolak";
            }
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }

    public function load_profile() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');
            $idusers = $this->request->getPost('idusers');
            if ($security == "Pr4medi4InvTorITNIAL") {
                $cek = $this->model->getAllQR("select count(*) as jml from users where idusers = '" . $idusers . "';")->jml;
                if ($cek > 0) {
                    $data = $this->model->getAllQR("select *, b.nama_role from users a, role b where a.idrole = b.idrole and a.idusers = '" . $idusers . "';");
                    $def_foto = base_url() . '/images/noimg.jpg';
                    if (strlen($data->foto) > 0) {
                        if (file_exists($this->modul->getPathApp() . $data->foto)) {
                            $def_foto = base_url() . '/uploads/' . $foto;
                        }
                    }
                    $response["kode"] = 1;
                    $response["pesan"] = "User ditemukan";

                    $response["nrp"] = $data->nrp;
                    $response["nama"] = $data->nama;
                    $response["agama"] = $data->agama;
                    $response["tgl_lahir"] = $data->tgl_lahir;
                    $response["kota_asal"] = $data->kota_asal;
                    $response["foto"] = $def_foto;
                    $response["satuan_kerja"] = $data->satuan_kerja;
                    $response["idkapal"] = $data->idkapal;
                    $response["role"] = $data->nama_role;
                } else {
                    $response["kode"] = 0;
                    $response["pesan"] = "User tidak ditemukan";
                }
            } else {
                $response["kode"] = 0;
                $response["pesan"] = "Token ditolak";
            }
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }

    public function proses_profile() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');

            if ($security == "Pr4medi4InvTorITNIAL") {
                $data = array(
                    'nrp' => $this->request->getPost('nrp'),
                    'nama' => $this->request->getPost('nama'),
                    'tgl_lahir' => $this->request->getPost('tgllahir'),
                    'agama' => $this->request->getPost('agama'),
                    'kota_asal' => $this->request->getPost('kota'),
                    'satuan_kerja' => $this->request->getPost('satker')
                );
                $kond['idusers'] = $this->request->getPost('idusers');
                $update = $this->model->update("users", $data, $kond);
                if ($update == 1) {
                    $response["kode"] = 1;
                    $response["pesan"] = "Profile tersimpan";
                } else {
                    $response["kode"] = 1;
                    $response["pesan"] = "Profile gagal tersimpan";
                }
            } else {
                $response["kode"] = 0;
                $response["pesan"] = "Token ditolak";
            }
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }

    public function proses_password() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');

            if ($security == "Pr4medi4InvTorITNIAL") {
                $idusers = $this->request->getPost('idusers');
                $lama = $this->modul->enkrip_pass($this->request->getPost('lama'));
                $lama_db = $this->model->getAllQR("select pass from users where idusers = '" . $idusers . "';")->pass;

                if ($lama == $lama_db) {
                    $data = array(
                        'pass' => $this->modul->enkrip_pass($this->request->getPost('baru'))
                    );
                    $kond['idusers'] = $idusers;
                    $update = $this->model->update("users", $data, $kond);
                    if ($update == 1) {
                        $response["kode"] = 1;
                        $response["pesan"] = "Password tersimpan";
                    } else {
                        $response["kode"] = 1;
                        $response["pesan"] = "Password gagal tersimpan";
                    }
                } else {
                    $response["kode"] = 1;
                    $response["pesan"] = "Passsword lama tidak sesuai";
                }
            } else {
                $response["kode"] = 0;
                $response["pesan"] = "Token ditolak";
            }
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }

    public function load_gudang() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');
            $idusers = $this->request->getPost('idusers');
            $nama_jenis = $this->request->getPost('nama_jenis');

            if ($security == "Pr4medi4InvTorITNIAL") {
            
                $response["kode"] = 1;
                $response["pesan"] = "Display Data";
                $response["data"] = array();

                $idkapal = $this->model->getAllQR("select idkapal from users where idusers = '" . $idusers . "';")->idkapal;
                $list = $this->model->getAllQ("select idjenisbarang, nama_jenis from jenisbarang where idkapal = '" . $idkapal . "' and nama_jenis like '%".$nama_jenis."%';");
                foreach ($list->getResult() as $row) {
                    $temp["id_jenis"] = $row->idjenisbarang;
                    $temp["nama_jenis"] = $row->nama_jenis;

                    array_push($response["data"], $temp);
                }
                
            } else {
                $response["kode"] = 0;
                $response["pesan"] = "Token ditolak";
            }
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }

    private function getStok($idbarang, $kri) {
        $masuk = $this->model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as masuk FROM brg_masuk a, brg_masuk_detil b where a.idbrg_masuk = b.idbrg_masuk and a.idkapal = '" . $kri . "' and b.idbarang = '" . $idbarang . "';")->masuk;
        $keluar = $this->model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as keluar FROM brg_keluar a, brg_keluar_detil b where a.idbrg_keluar = b.idbrg_keluar and a.idkapal = '" . $kri . "' and b.idbarang = '" . $idbarang . "';")->keluar;
        $stok = $masuk - $keluar;
        return $stok;
    }

}
