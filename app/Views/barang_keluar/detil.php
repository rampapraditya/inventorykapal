<script type="text/javascript">

    var save_method = "";
    var table;
    var tb_platform, tb_sewaco, tb_komaliwan, tb_br_umum;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajaxdetil/<?php echo $kode; ?>",
            ordering: false
        });
    });

    function reload() {
        table.ajax.reload(null, false);
    }

    function add() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Barang Keluar');
    }
    
    function closemodal(){
        $('#modal_form').modal('hide');
    }
    
    function closemodal_barang(){
        $('#modal_barang').modal('hide');
    }
    
    function load_tb_platform(){
        tb_platform = $('#tb_platform').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajax_platform/<?php echo $kode; ?>",
            ordering: false,
            retrieve:true
        });
        tb_platform.destroy();
        tb_platform = $('#tb_platform').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajax_platform/<?php echo $kode; ?>",
            ordering: false,
            retrieve:true
        });
    }
    
    function load_tb_sewaco(){
        tb_sewaco = $('#tb_sewaco').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajax_sewaco/<?php echo $kode; ?>",
            ordering: false,
            retrieve:true
        });
        tb_sewaco.destroy();
        tb_sewaco = $('#tb_sewaco').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajax_sewaco/<?php echo $kode; ?>",
            ordering: false,
            retrieve:true
        });
    }
    
    function load_tb_komaliwan(){
        tb_komaliwan = $('#tb_komaliwan').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajax_komaliwan/<?php echo $kode; ?>",
            ordering: false,
            retrieve:true
        });
        tb_komaliwan.destroy();
        tb_komaliwan = $('#tb_komaliwan').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajax_komaliwan/<?php echo $kode; ?>",
            ordering: false,
            retrieve:true
        });
    }
    
    function load_tb_br_umum(){
        tb_br_umum = $('#tb_br_umum').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajax_br_umum/<?php echo $kode; ?>",
            ordering: false,
            retrieve:true
        });
        tb_br_umum.destroy();
        tb_br_umum = $('#tb_br_umum').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajax_br_umum/<?php echo $kode; ?>",
            ordering: false,
            retrieve:true
        });
    }
    
    function showBarang(){
        $('#modal_barang').modal('show');
        
        load_tb_platform();
        load_tb_sewaco();
        load_tb_komaliwan();
        load_tb_br_umum();
    }
    
    function pilih_platform(kode, nama, jenis){
        $('[name="kode_barang"]').val(kode);
        $('[name="jenis_barang"]').val(jenis);
        $('[name="nama"]').val(nama);
        
        $('#modal_barang').modal('hide');
    }
    
    function pilih_sewaco(kode, nama, jenis){
        $('[name="kode_barang"]').val(kode);
        $('[name="jenis_barang"]').val(jenis);
        $('[name="nama"]').val(nama);
        
        $('#modal_barang').modal('hide');
    }
    
    function pilih_komaliwan(kode, nama, jenis){
        $('[name="kode_barang"]').val(kode);
        $('[name="jenis_barang"]').val(jenis);
        $('[name="nama"]').val(nama);
        
        $('#modal_barang').modal('hide');
    }
    
    function pilih_umum(kode, nama, jenis){
        $('[name="kode_barang"]').val(kode);
        $('[name="jenis_barang"]').val(jenis);
        $('[name="nama"]').val(nama);
        
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
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>/brgmasuk/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>/brgmasuk/ajax_edit";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('tgl', tgl);
            form_data.append('kri', kri);
            form_data.append('kode_detil', kode_detil);
            form_data.append('kode_barang', kode_barang);
            form_data.append('jumlah', jumlah);
            form_data.append('satuan', satuan);
            
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
                url: "<?php echo base_url(); ?>/brgmasuk/hapusdetil/" + id,
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
        $('.modal-title').text('Ganti gudang');
        $.ajax({
            url: "<?php echo base_url(); ?>/brgmasuk/gantidetil/" + id,
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

</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TRANSAKSI BARANG KELUAR</h4>
                    <p class="card-description"><?php echo $ket; ?></p>
                </div>
                <div class="card-body">
                    <input type="hidden" id="kode" name="kode" value="<?php echo $kode; ?>">
                    <div class="forms-sample">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>TANGGAL</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl" autofocus="" autocomplete="off" value="<?php echo $tgl_def; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>KRI</label>
                                    <select id="kri" name="kri" class="form-control">
                                        <option value="-">- PILIH KRI -</option>
                                        <?php
                                        foreach ($kri->getResult() as $row) {
                                            ?>
                                        <option <?php if($row->idkapal == $kri_tersimpan){ echo 'selected'; } ?> value="<?php echo $row->idkapal; ?>"><?php echo $row->nama_kapal; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
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
                    <button type="button" class="btn btn-primary" onclick="add();">Tambah</button>
                    <button type="button" class="btn btn-secondary" onclick="reload();">Reload</button>
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
                            <input type="hidden" id="kode_barang" name="kode_barang">
                            <input type="hidden" id="jenis_barang" name="jenis_barang">
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
                <button id="btnSave" type="button" class="btn btn-primary" onclick="save();">Save</button>
                <button type="button" class="btn btn-secondary" onclick="closemodal();">Close</button>
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
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="head_nav_platform" data-toggle="tab" href="#nav_platform" role="tab" aria-controls="nav_platform" aria-selected="true">Platform</a>
                        <a class="nav-item nav-link" id="head_nav_sewaco" data-toggle="tab" href="#nav_sewaco" role="tab" aria-controls="nav_sewaco" aria-selected="false">Sewaco</a>
                        <a class="nav-item nav-link" id="head_nav_komaliwan" data-toggle="tab" href="#nav_komaliwan" role="tab" aria-controls="nav_komaliwan" aria-selected="false">Komaliwan</a>
                        <a class="nav-item nav-link" id="head_nav_nav_barangumum" data-toggle="tab" href="#nav_barangumum" role="tab" aria-controls="nav_barangumum" aria-selected="false">Barang Umum</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav_platform" role="tabpanel" aria-labelledby="nav_platform">
                        <div class="table-responsive">
                            <table id="tb_platform" class="table table-bordered" style="width: 100%; font-size: 10px;">
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
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav_sewaco" role="tabpanel" aria-labelledby="nav_sewaco">
                        <div class="table-responsive">
                            <table id="tb_sewaco" class="table table-bordered" style="width: 100%; font-size: 10px;">
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
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav_komaliwan" role="tabpanel" aria-labelledby="nav_komaliwan">
                        <div class="table-responsive">
                            <table id="tb_komaliwan" class="table table-bordered" style="width: 100%; font-size: 10px;">
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
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav_barangumum" role="tabpanel" aria-labelledby="nav_barangumum">
                        <div class="table-responsive">
                            <table id="tb_br_umum" class="table table-bordered" style="width: 100%; font-size: 10px;">
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
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>