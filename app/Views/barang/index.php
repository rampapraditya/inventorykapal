<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/barang/ajaxlist",
            ordering: false
        });
    });

    function reload() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    function add() {
//        save_method = 'add';
//        $('#form')[0].reset();
//        $('#modal_form').modal('show');
//        $('.modal-title').text('Tambah kapal');
        alert("Belum difungsikan");
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var nama = document.getElementById('nama').value;
        var foto = $('#gambar').prop('files')[0];
        var ket = document.getElementById('ket').value;
        
        if (nama === '') {
            alert("Nama divisi tidak boleh kosong");
        } else {
            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>/kapal/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>/kapal/ajax_edit";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('nama', nama);
            form_data.append('ket', ket);
            form_data.append('file', foto);
            
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

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 
                }, error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error json " + errorThrown);

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 
                }
            });
        }
    }

    function hapus(id, nama) {
        if (confirm("Apakah anda yakin menghapus kapal " + nama + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>/kapal/hapus/" + id,
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
        $('.modal-title').text('Ganti kapal');
        $.ajax({
            url: "<?php echo base_url(); ?>/kapal/ganti/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idkapal);
                $('[name="nama"]').val(data.nama_kapal);
                $('[name="ket"]').val(data.keterangan);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data');
            }
        });
    }
    
    function closemodal(){
        $('#modal_form').modal('hide');
    }

</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">MASTER BARANG</h4>
                    <p class="card-description">Maintenance data kapal</p>
                    <button type="button" class="btn btn-primary" onclick="add();">Tambah</button>
                    <button type="button" class="btn btn-secondary" onclick="reload();">Reload</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb" class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>JENIS</th>
                                    <th>DESCRIPTION</th>
                                    <th>PN/NSN</th>
                                    <th>DS NUMBER</th>
                                    <th>Holding</th>
                                    <th style="text-align: center;">EQUIPMENT<br>DESCRIPTION</th>
                                    <th style="text-align: center;">STORE<br>LOCATION</th>
                                    <th style="text-align: center;">SUPPLEMENTARY<br>LOCATION</th>
                                    <th style="text-align: center;">QUANT</th>
                                    <th style="text-align: center;">UOI</th>
                                    <th style="text-align: center;">Verwendung</th>
                                    <th style="text-align: center;">Aksi</th>
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
                    <input type="hidden" name="kode" id="kode">
                    <div class="form-group">
                        <label>Nama Kapal</label>
                        <input id="nama" name="nama" class="form-control" type="text" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input id="gambar" name="gambar" class="form-control" type="file" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input id="ket" name="ket" class="form-control" type="text" autocomplete="off">
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