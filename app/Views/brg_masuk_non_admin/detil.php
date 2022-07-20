<script type="text/javascript">

    var save_method = "";
    var table;
    
    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/brgmnadmin/ajaxdetil/<?php echo $kode; ?>",
            ordering: false
        });
    });

    function reload() {
        table.ajax.reload(null, false);
    }

    function add() {
        var kri = document.getElementById('kri').value;
        if(kri === "-"){
            alert("Pilih KRI terlebih dahulu");
        }else{
            save_method = 'add';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
            $('.modal-title').text('Tambah barang datang');
        }
    }
    
    function closemodal(){
        $('#modal_form').modal('hide');
    }
    
    function closemodal_barang(){
        $('#modal_barang').modal('hide');
    }
    
    function showBarang(){
        var kode = document.getElementById('kode').value;
        $('#modal_barang').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>/brgmnadmin/loadtable/" + kode,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('#wadah_tab').html(data.hasil);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('Error load data');
            }
        });
    }
    
    function pilih_barang(kode, nama, jenis, gudang){
        $('[name="kode_barang"]').val(kode);
        $('[name="jenis_barang"]').val(jenis);
        $('[name="nama"]').val(nama);
        $('[name="gudang_manual"]').val(gudang);
        
        $('#modal_barang').modal('hide');
    }
    
    function save() {
        var kode = document.getElementById('kode').value;
        var tgl = document.getElementById('tgl').value;
        var kri = document.getElementById('kri').value;
        var kode_detil = document.getElementById('kode_detil').value;
        var kode_barang = document.getElementById('kode_barang').value;
        var jumlah = document.getElementById('jumlah').value;
        var satuan = document.getElementById('satuan').value;
        var gudang = document.getElementById('gudang_manual').value;
        
        if (kode === "") {
            alert("Kode tidak boleh kosong");
        }else if(tgl === ""){
            alert("Tanggal tidak boleh kosong");
        }else if(kri === "-"){
            alert("Harap pilih KRI terlebih dahulu");
        }else if(kode_barang === ""){
            alert("Kode barang tidak boleh kosong");
        }else if(jumlah === ""){
            alert("Jumlah tidak boleh kosong");
        }else if(satuan === ""){
            alert("Satuan tidak boleh kosong");
        }else if(gudang === "-"){
            alert("Pilih gudang terlebih dahulu");
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>/brgmnadmin/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>/brgmnadmin/ajax_edit";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('tgl', tgl);
            form_data.append('kri', kri);
            form_data.append('kode_detil', kode_detil);
            form_data.append('kode_barang', kode_barang);
            form_data.append('jumlah', jumlah);
            form_data.append('satuan', satuan);
            form_data.append('gudang', gudang);
            
            // ajax adding data to database
            $.ajax({
                url: url,
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    alert(data.status);
                    $('#modal_form').modal('hide');
                    reload();

                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                }, error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error json " + errorThrown);

                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                }
            });
        }
    }

    function hapus(id, nama) {
        if (confirm("Apakah anda yakin menghapus barang nomor " + nama + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>/brgmnadmin/hapusdetil/" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    alert(data.status);
                    reload();
                }, error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error hapus data');
                }
            });
        }
    }

    function ganti(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Ganti barang datang');
        $.ajax({
            url: "<?php echo base_url(); ?>/brgmnadmin/gantidetil/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode_detil"]').val(data.idbrg_m_detil);
                $('[name="kode_barang"]').val(data.idbarang);
                $('[name="nama"]').val(data.deskripsi);
                $('[name="jumlah"]').val(data.jumlah);
                $('[name="satuan"]').val(data.satuan);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data');
            }
        });
    }
    
    function add_file(){
        $('#form_file')[0].reset();
        $('#modal_file').modal('show');
    }
    
    function save_file(){
        $('#btnSaveFile').text('Saving...');
        $('#btnSaveFile').attr('disabled',true);
        
        var kode = document.getElementById('kode').value;
        var tgl = document.getElementById('tgl').value;
        var kri = document.getElementById('kri').value;
        var gudang = document.getElementById('gudang').value;
        var file = $('#file_excel').prop('files')[0];
        
        var form_data = new FormData();
        form_data.append('kode', kode);
        form_data.append('tgl', tgl);
        form_data.append('kri', kri);
        form_data.append('gudang', gudang);
        form_data.append('file', file);

        $.ajax({
            url: "<?php echo base_url(); ?>/brgmnadmin/uploadmasuk",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (response) {
                alert(response.status);
                $('#btnSaveFile').text('Save');
                $('#btnSaveFile').attr('disabled',false);
                
                if(response.status === "Terupload"){
                    window.location.href = "<?php echo base_url(); ?>/brgmnadmin";
                }

            },error: function (response) {
                alert(response.status);

                $('#btnSaveFile').text('Save');
                $('#btnSaveFile').attr('disabled',false);
            }
        });
    }
    
    function closemodal_file(){
        $('#modal_file').modal('hide');
    }

</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TRANSAKSI MATERIAL BARANG MASUK (<?php echo $ket; ?>)</h4>
                </div>
                <div class="card-body">
                    <input type="hidden" id="kode" name="kode" value="<?php echo $kode; ?>">
                    <input type="hidden" id="kri" name="kri" value="<?php echo $kri; ?>">
                    <div class="forms-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>TANGGAL</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl" autofocus="" autocomplete="off" value="<?php echo $tgl_def; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm" onclick="add();">Tambah</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="add_file();">Tambah (File)</button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="reload();">Reload</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb" class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DESKRIPSI</th>
                                    <th>JUMLAH</th>
                                    <th>SATUAN</th>
                                    <th style="text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closemodal();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" class="form-horizontal">
                    <input type="hidden" name="kode_detil" id="kode_detil">
                    <div class="form-group">
                        <label>Barang</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_barang" name="kode_barang" readonly>
                            <input type="hidden" id="jenis_barang" name="jenis_barang" readonly>
                            <input type="hidden" id="gudang_manual" name="gudang_manual" readonly>
                            <input type="text" class="form-control" aria-describedby="btnShow" id="nama" name="nama" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btnShow" onclick="showBarang()">...</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input id="jumlah" name="jumlah" class="form-control" type="text" autocomplete="off" onkeypress="return hanyaAngka(event,false);">
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input id="satuan" name="satuan" class="form-control" type="text" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSave" type="button" class="btn btn-primary btn-sm" onclick="save();">Save</button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="closemodal();">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_barang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closemodal_barang();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="wadah_tab" class="col-md-12">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_file" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>File Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closemodal();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_file" class="form-horizontal">
                    <div class="form-group">
                        <label>File Excel</label>
                        <input id="file_excel" name="file_excel" class="form-control" type="file" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Gudang</label>
                        <select id="gudang" name="gudang" class="form-control">
                            <option value="-">- PILIH GUDANG -</option>
                            <?php
                            foreach ($gudang->getResult() as $row) {
                                ?>
                            <option value="<?php echo $row->idjenisbarang; ?>"><?php echo $row->nama_jenis; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveFile" type="button" class="btn btn-primary btn-sm" onclick="save_file();">Save</button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="closemodal_file();">Close</button>
            </div>
        </div>
    </div>
</div>