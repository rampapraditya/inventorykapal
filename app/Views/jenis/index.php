<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/jenis/ajaxlist",
            ordering: false
        });
    });

    function reload() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    function add() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah gudang');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var nama = document.getElementById('nama').value;
        var kri = document.getElementById('kri').value;
        
        if (nama === '') {
            alert("Gudang tidak boleh kosong");
        }else if(kri === '-'){
            alert("KRI tidak boleh kosong");
        } else {
            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>/jenis/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>/jenis/ajax_edit";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('nama', nama);
            form_data.append('kri', kri);
            
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
        if (confirm("Apakah anda yakin menghapus gudang " + nama + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>/jenis/hapus/" + id,
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
            url: "<?php echo base_url(); ?>/jenis/ganti/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idjenisbarang);
                $('[name="nama"]').val(data.nama_jenis);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data');
            }
        });
    }
    
    function closemodal(){
        $('#modal_form').modal('hide');
    }
    
    function showbykri(){
        var kri_head = document.getElementById('kri_head').value;
        
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/jenis/ajaxlistby/" + kri_head,
            ordering: false,
            retrieve:true
        });
        table.destroy();
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/jenis/ajaxlistby/" + kri_head,
            ordering: false,
            retrieve:true
        });
    }

</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">MASTER GUDANG</h4>
                            <p class="card-description">Maintenance data gudang</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-sm" onclick="add();">Tambah</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="reload();">Reload</button>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <select class="form-control" id="kri_head" name="kri_head" onchange="showbykri();">
                                <option value="-">- PILIH KRI -</option>
                                <?php
                                foreach ($kri->getResult() as $row) {
                                    ?>
                                <option value="<?php echo $row->idkapal; ?>"><?php echo $row->nama_kapal; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="tb" class="table table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>KRI</th>
                                            <th>GUDANG</th>
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
                        <label>KRI</label>
                        <select class="form-control" id="kri" name="kri">
                            <option value="-">- PILIH KRI -</option>
                            <?php
                            foreach ($kri->getResult() as $row) {
                                ?>
                            <option value="<?php echo $row->idkapal; ?>"><?php echo $row->nama_kapal; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gudang</label>
                        <input id="nama" name="nama" class="form-control" type="text" autocomplete="off">
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