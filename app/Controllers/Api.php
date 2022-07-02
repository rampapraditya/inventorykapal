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
                $list = $this->model->getAllQ("select idjenisbarang, nama_jenis from jenisbarang where idkapal = '" . $idkapal . "' and nama_jenis like '%" . $nama_jenis . "%';");
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

    public function load_stok() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');
            $idusers = $this->request->getPost('idusers');
            $idkapal = $this->model->getAllQR("select idkapal from users where idusers = '" . $idusers . "';")->idkapal;
            $idjenisbarang = $this->request->getPost('idgudang');
            $deskripsi = $this->request->getPost('deskripsi');

            if ($security == "Pr4medi4InvTorITNIAL") {

                $response["kode"] = 1;
                $response["pesan"] = "Display Data";
                $response["data"] = array();

                $list = $this->model->getAllQ("select * from barang where idjenisbarang = '" . $idjenisbarang . "' and idkapal = '" . $idkapal . "' and deskripsi like '%" . $deskripsi . "%';");
                foreach ($list->getResult() as $row) {

                    $foto = base_url() . '/images/noimg.jpg';
                    if (strlen($row->foto) > 0) {
                        if (file_exists($this->modul->getPathApp() . $row->foto)) {
                            $foto = base_url() . '/uploads/' . $row->foto;
                        }
                    }

                    $temp["idbarang"] = $row->idbarang;
                    $temp["foto"] = $foto;
                    $temp["deskripsi"] = $row->deskripsi;
                    $temp["pn_nsn"] = $row->pn_nsn;
                    $temp["ds_number"] = $row->ds_number;
                    $temp["holding"] = $row->holding;
                    $temp["equipment_desc"] = $row->equipment_desc;
                    $temp["store_location"] = $row->store_location;
                    $temp["supplementary_location"] = $row->supplementary_location;
                    $temp["qty"] = $this->getStok($row->idbarang, $idkapal);
                    $temp["uoi"] = $row->uoi;
                    $temp["verwendung"] = $row->verwendung;

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

    public function load_barang_masuk() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');
            $idusers = $this->request->getPost('idusers');
            $tgl = $this->request->getPost('tgl');

            $idkapal = $this->model->getAllQR("select idkapal from users where idusers = '" . $idusers . "';")->idkapal;

            if ($security == "Pr4medi4InvTorITNIAL") {

                $response["kode"] = 1;
                $response["pesan"] = "Display Data";
                $response["data"] = array();

                $no = 1;
                $list = $this->model->getAllQ("SELECT a.idbrg_masuk, date_format(tgl, '%d %M %Y') as tglf, b.nama_kapal FROM brg_masuk a, kapal b where a.idkapal = b.idkapal and b.idkapal = '" . $idkapal . "' and tgl like '%" . $tgl . "%' order by tgl desc;");
                foreach ($list->getResult() as $row) {
                    $temp["no"] = $no;
                    $temp["idbrg_masuk"] = $row->idbrg_masuk;
                    $temp["tglf"] = $row->tglf;
                    $temp["nama_kapal"] = $row->nama_kapal;

                    array_push($response["data"], $temp);

                    $no++;
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

    public function generate_kode_barang_masuk() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');
            if ($security == "Pr4medi4InvTorITNIAL") {
                $idbarang_masuk = $this->model->autokode('M', 'idbrg_masuk', 'brg_masuk', 2, 7);

                $response["kode"] = 1;
                $response["pesan"] = "Display Data";
                $response["idbarang_masuk"] = $idbarang_masuk;
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

    public function load_barang_masuk_detil() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idbrg_masuk = $this->request->getPost('idbrg_masuk');

            $response["kode"] = 1;
            $response["pesan"] = "Display Data";
            $response["data"] = array();

            $list = $this->model->getAllQ("SELECT a.idbrg_m_detil, b.deskripsi, a.jumlah, a.satuan FROM brg_masuk_detil a, barang b where a.idbarang = b.idbarang and a.idbrg_masuk = '" . $idbrg_masuk . "';");
            foreach ($list->getResult() as $row) {
                $temp["idbrg_m_detil"] = $row->idbrg_m_detil;
                $temp["deskripsi"] = $row->deskripsi;
                $temp["jumlah"] = $row->jumlah;
                $temp["satuan"] = $row->satuan;

                array_push($response["data"], $temp);
            }
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Tidak Ada Post Data";
        }
        return $this->respond($response);
    }

    public function hapus_masuk() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');
            $idbrg_masuk = $this->request->getPost('idbrg_masuk');
            if ($security == "Pr4medi4InvTorITNIAL") {

                $kond['idbrg_masuk'] = $idbrg_masuk;
                $hapus = $this->model->delete("brg_masuk", $kond);
                if ($hapus == 1) {
                    $status = "Data terhapus";
                } else {
                    $status = "Data gagal terhapus";
                }

                $response["kode"] = 1;
                $response["pesan"] = $status;
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

    public function upload_barang_masuk() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $security = $this->request->getPost('security');
            if ($security == "Pr4medi4InvTorITNIAL") {
                $file = $this->request->getFile('file');
                $fileName = $file->getRandomName();
                $username = $this->request->getPost('username');
                
                if (file_exists($this->modul->getPathApp() . $fileName)) {
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
                    } else {
                        $status = false;
                    }

                    if ($status) {
                        $status_upload = $file->move($this->modul->getPathApp(), $fileName);
                        if ($status_upload) {
                            // upload header terlebih dahulu
                            $this->simpan_head($username);
                            // mengetahui kri dari username
                            $kri = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;

                            // extrak kulit manggis
                            $path = $this->modul->getPathApp() . $fileName;
                            $spreadsheet = $render->load($path);
                            $data = $spreadsheet->getActiveSheet()->toArray();
                            foreach ($data as $x => $row) {
                                // masukkan ke database
                                $nama_brg = trim(addslashes($row[0]));
                                $jumlah = trim(addslashes($row[7]));

                                if (strlen($nama_brg) > 0 && strlen($jumlah) > 0) {
                                    // cek barang ini sudah masuk master apa belum
                                    $jml = $this->model->getAllQR("select count(*) as jml from barang where idkapal = '" . $kri . "' and deskripsi = '" . $nama_brg . "';")->jml;
                                    if ($jml > 0) {
                                        $idbrg = $this->model->getAllQR("select idbarang from barang where idkapal = '" . $kri . "' and deskripsi = '" . $nama_brg . "';")->idbarang;
                                        // klo barangnya sudah ada baru di masukkan ke stok
                                        $data_detil = array(
                                            'idbrg_m_detil' => $this->model->autokode("MD", "idbrg_m_detil", "brg_masuk_detil", 3, 9),
                                            'idbarang' => $idbrg,
                                            'jumlah' => $jumlah,
                                            'satuan' => trim(addslashes($row[8])),
                                            'idbrg_masuk' => $this->request->getPost('kode')
                                        );
                                        $this->model->add("brg_masuk_detil", $data_detil);
                                    } else {
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
                                            'idjenisbarang' => $this->request->getPost('gudang'),
                                            'idkapal' => $kri
                                        );
                                        $this->model->add("barang", $data);

                                        // setelah masukin barang mestinya masukin jumlah
                                        $idbrg = $this->model->getAllQR("select idbarang from barang where idkapal = '" . $kri . "' and deskripsi = '" . $nama_brg . "';")->idbarang;
                                        // klo barangnya sudah ada baru di masukkan ke stok
                                        $data_detil = array(
                                            'idbrg_m_detil' => $this->model->autokode("MD", "idbrg_m_detil", "brg_masuk_detil", 3, 9),
                                            'idbarang' => $idbrg,
                                            'jumlah' => $jumlah,
                                            'satuan' => trim(addslashes($row[8])),
                                            'idbrg_masuk' => $this->request->getPost('kode')
                                        );
                                        $this->model->add("brg_masuk_detil", $data_detil);
                                    }
                                }
                            }
                            unlink($this->modul->getPathApp() . $fileName);

                            $hasil = "Terupload";
                        } else {
                            $hasil = "File gagal terupload";
                        }
                    } else {
                        $hasil = "Harus berupa file excel";
                    }
                }

                $response["kode"] = 1;
                $response["pesan"] = $hasil;
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

    private function simpan_head($username) {
        // mencari kri dari username
        $kri = $this->model->getAllQR("select idkapal from users where idusers = '".$username."';")->idkapal;
        // cek apa sudah masuk apa belum
        $cek = $this->model->getAllQR("select count(*) as jml from brg_masuk where idbrg_masuk = '" . $this->request->getPost('kode') . "' and idusers = '" . $username . "';")->jml;
        if ($cek < 1) {
            $data = array(
                'idbrg_masuk' => $this->request->getPost('kode'),
                'idkapal' => $kri,
                'tgl' => $this->request->getPost('tanggal'),
                'idusers' => $username
            );
            $simpan = $this->model->add("brg_masuk", $data);
        } else {
            $simpan = 1;
        }
        return $simpan;
    }

}
