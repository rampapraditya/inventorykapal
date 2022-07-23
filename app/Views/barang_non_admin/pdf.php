<?php
use App\Models\Mcustom;
?>
<html>
    <head>
        <title>INVENTORY</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 1cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 1cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1cm;

                /** Extra personal styles **/
                background-color: white;
                font-size: 9px;
                color: black;
                text-align: center;
                line-height: 1cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1cm;

                /** Extra personal styles **/
                background-color: white;
                font-size: 9px;
                color: black;
                text-align: center;
                line-height: 1cm;
            }
        </style>
    </head>
    <body>
        <!--
        <header>
            RAHASIA
        </header>
        <footer>
        </footer>
        -->
        <main style="font-size: 12px;">
            <table border="0">
                <tr>
                    <td>
                        <img src="<?php echo $logo; ?>" style="width: 150px; height: auto;">
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td style="vertical-align: top;">
                        <p style="font-size: 16px;"><b>SISTEM INVENTORY KAPAL</b></p>
                        <p><?php echo $ins; ?></p>
                        <p style="margin-top: -5px;"><?php echo $alamat; ?></p>
                        <p style="margin-top: -5px;"><?php echo "Telp : " . $tlp; if(strlen($fax) > 0){ echo ', Fax : ' . $fax; } ?></p>
                    </td>
                </tr>
            </table>
            <hr style="border: 0.5px solid gray;">
            <p style="text-align: center; font-size: 16px;">LAPORAN BARANG <?php echo $nm_kapal.' ' .$nm_gudang; ?></p>
            <table style="border-collapse: collapse; border: 1px solid gray; margin-top: 20px; width: 100%; font-size: 11px;">
                <tr>
                    <td style="text-align: center; border: 1px solid gray; padding: 3px;"><b>#</b></td>
                    <td style="text-align: center; border: 1px solid gray; padding: 3px;"><b>BARANG</b></td>
                    <td style="text-align: center; border: 1px solid gray; padding: 3px;"><b>PN/SN</b></td>
                    <td style="text-align: center; border: 1px solid gray; padding: 3px;"><b>EQUIPMENT DESC</b></td>
                    <td style="text-align: center; border: 1px solid gray; padding: 3px;"><b>JUMLAH</b></td>
                    <td style="text-align: center; border: 1px solid gray; padding: 3px;"><b>SATUAN</b></td>
                    <td style="text-align: center; border: 1px solid gray; padding: 3px;"><b>KETERANGAN</b></td>
                </tr>
                <?php
                $model = new Mcustom();
                $no = 1;
                foreach ($list->getResult() as $row) {
                    $brg = $model->getAllQR("select * from barang where idbarang = '".$row->idbarang."'");
                     ?>
                <tr>
                    <td style="border: 1px solid gray; padding: 2px;"><?php echo $no; ?></td>
                    <td style="border: 1px solid gray; padding: 2px;"><?php echo $brg->deskripsi; ?></td>
                    <td style="border: 1px solid gray; padding: 2px;"><?php echo $brg->pn_nsn; ?></td>
                    <td style="border: 1px solid gray; padding: 2px;"><?php echo $brg->equipment_desc; ?></td>
                    <td style="border: 1px solid gray; padding: 2px; text-align: center;">
                        <?php
                        $masuk = $model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as masuk FROM brg_masuk a, brg_masuk_detil b where a.idbrg_masuk = b.idbrg_masuk and a.idkapal = '".$id_kapal."' and b.idbarang = '".$brg->idbarang."' and a.idjenisbarang = '".$id_gudang."';")->masuk;
                        $keluar = $model->getAllQR("SELECT ifnull(sum(b.jumlah),0) as keluar FROM brg_keluar a, brg_keluar_detil b where a.idbrg_keluar = b.idbrg_keluar and a.idkapal = '".$id_kapal."' and b.idbarang = '".$brg->idbarang."' and a.idjenisbarang = '".$id_gudang."';")->keluar;
                        $stok = $masuk - $keluar;
                        echo $stok;
                        ?>
                    </td>
                    <td style="border: 1px solid gray; padding: 2px;"><?php echo $brg->uoi; ?></td>
                    <td style="border: 1px solid gray; padding: 2px;"><?php echo $brg->verwendung; ?></td>
                </tr>
                     <?php
                     $no++;
                }
                ?>
            </table>
            
            <table style="width: 100%; margin-top: 30px; font-size: 11px;" border="0">
                <tr>
                    <td style="width: 25%; text-align: center;"></td>
                    <td style="width: 50%;"></td>
                    <td style="width: 25%; text-align: center;">Surabaya , <?php echo date('d M Y'); ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;"></td>
                    <td></td>
                    <td style="text-align: center;"><?php echo $jabatan; ?>,</td>
                </tr>
                <tr>
                    <td style="text-align: center; height: 100px;"></td>
                    <td></td>
                    <td style="text-align: center; height: 100px;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;"></td>
                    <td></td>
                    <td style="text-align: center;"><?php echo $nama; ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;"></td>
                    <td></td>
                    <td style="text-align: center;"><?php echo $pangkat.' / NRP ' . $nrp; ?></td>
                </tr>
            </table>
        </main>
    </body>
</html>