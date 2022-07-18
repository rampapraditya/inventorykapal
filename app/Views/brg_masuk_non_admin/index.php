<script type="text/javascript">

    var table, tb_detil;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/brgmnadmin/ajaxlist",
            ordering: false
        });
    });

    function reload() {
        table.ajax.reload(null, false);
    }

    function add() {
        window.location.href = "<?php echo base_url(); ?>/brgmnadmin/detil";
    }
    
    function ganti(id) {
        window.location.href = "<?php echo base_url(); ?>/brgmnadmin/detil/"+id;
    }
    
    function hapus(id, nama) {
        if (confirm("Apakah anda yakin menghapus barang nomor " + nama + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>/brgmnadmin/hapus/" + id,
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
    
    function showitem(id) {
        $('#modal_item').modal('show');
        tb_detil = $('#tb_detil').DataTable({
            ajax: "<?php echo base_url(); ?>/brgmnadmin/ajax_item_detil/" + id,
            ordering: false,
            retrieve:true,
            scrollX: true
        });
        tb_detil.destroy();
        tb_detil = $('#tb_detil').DataTable({
            ajax: "<?php echo base_url(); ?>/brgmnadmin/ajax_item_detil/" + id,
            ordering: false,
            retrieve:true,
            scrollX: true
        });
    }
    
    function closemodal() {
        $('#modal_item').modal('hide');
    }
    
    function cari(){
        $('#form_cari')[0].reset();
        $('#modal_cari').modal('show');
    }
    
    function close_cari(){
        $('#modal_cari').modal('hide');
    }
    
    function proses_cari(){
        var tgl1 = document.getElementById('tgl1').value;
        var tgl2 = document.getElementById('tgl2').value;
        var deskripsi = document.getElementById('deskripsi').value;
        
        if (tgl1 === "") {
            alert("Range tanggal awal tidak boleh kosong");
        } else if (tgl2 === "-") {
            alert("Range tanggal akhir tidak boleh kosong");
        } else {
            $('#btnCari').text('Searching...');
            $('#btnCari').attr('disabled', true);
            
            table = $('#tb').DataTable({
                ajax: "<?php echo base_url(); ?>/brgmnadmin/ajaxlistcari/" + tgl1 + "/" + tgl2 + "/" + deskripsi,
                ordering: false,
                retrieve:true
            });
            table.destroy();
            table = $('#tb').DataTable({
                ajax: "<?php echo base_url(); ?>/brgmnadmin/ajaxlistcari/" + tgl1 + "/" + tgl2 + "/" + deskripsi,
                ordering: false,
                retrieve:true
            });
            

            $('#btnCari').text('Search');
            $('#btnCari').attr('disabled', false);
            
            $('#modal_cari').modal('hide');
        }
    }
    
</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TRANSAKSI MATERIAL BARANG MASUK</h4>
                    <button type="button" class="btn btn-primary btn-sm" onclick="add();">Tambah</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="cari();">Pencarian</button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="reload();">Reload</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb" class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TANGGAL</th>
                                    <th>KRI</th>
                                    <th>JML ITEM</th>
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

<div class="modal fade" id="modal_item" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>List Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closemodal();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tb_detil" class="table table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>BARANG</th>
                            <th>JUMLAH</th>
                            <th>SATUAN</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_cari" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Pencarian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_cari();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_cari" class="form-horizontal">
                    <div class="form-group">
                        <label>RANGE TGL AWAL</label>
                        <input id="tgl1" name="tgl1" class="form-control" type="date" autocomplete="off" value="<?php echo $deftgl; ?>">
                    </div>
                    <div class="form-group">
                        <label>RANGE TGL AWAL</label>
                        <input id="tgl2" name="tgl2" class="form-control" type="date" autocomplete="off" value="<?php echo $deftgl; ?>">
                    </div>
                    <div class="form-group">
                        <label>DESKRIPSI BARANG / ITEM</label>
                        <input id="deskripsi" name="deskripsi" class="form-control" type="text" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnCari" type="button" class="btn btn-primary" onclick="proses_cari();">Search</button>
                <button type="button" class="btn btn-secondary" onclick="close_cari();">Close</button>
            </div>
        </div>
    </div>
</div>