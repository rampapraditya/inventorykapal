<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/pengguna/ajaxlist",
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
        $('.modal-title').text('Tambah pengguna');
        $('[name="nrp"]').attr("readonly", false);
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var nrp = document.getElementById('nrp').value;
        var pass = document.getElementById('pass').value;
        var nama = document.getElementById('nama').value;
        var role = document.getElementById('role').value;
        var korps = document.getElementById('korps').value;
        var pangkat = document.getElementById('pangkat').value;
        var kapal = document.getElementById('kapal').value;
        
        if (nrp === "") {
            alert("NRP tidak boleh kosong");
        }else if(pass === ""){
            alert("Password tidak boleh kosong");
        }else if(nama === ""){
            alert("Nama tidak boleh kosong");
        }else if(role === "-"){
            alert("Pilih role terlebih dahulu");
        }else if(korps === "-"){
            alert("Pilih korps terlebih dahulu");
        }else if(pangkat === "-"){
            alert("Pilih pangkat terlebih dahulu");
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>/pengguna/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>/pengguna/ajax_edit";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('nrp', nrp);
            form_data.append('nama', nama);
            form_data.append('role', role);
            form_data.append('pass', pass);
            form_data.append('korps', korps);
            form_data.append('pangkat', pangkat);
            form_data.append('kapal', kapal);
            
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
        if (confirm("Apakah anda yakin menghapus pengguna " + nama + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>/pengguna/hapus/" + id,
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
        $('.modal-title').text('Ganti pengguna');
        $('[name="nrp"]').attr("readonly", true);
        $.ajax({
            url: "<?php echo base_url(); ?>/pengguna/ganti/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idusers);
                $('[name="nama"]').val(data.nama);
                $('[name="nrp"]').val(data.nrp);
                $('[name="pass"]').val(data.pass);
                $('[name="role"]').val(data.idrole);
                $('[name="korps"]').val(data.idkorps);
                $('[name="pangkat"]').val(data.idpangkat);
                $('[name="kapal"]').val(data.idkapal);
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
                    <h4 class="card-title">MASTER PENGGUNA</h4>
                    <p class="card-description">Maintenance data kapal</p>
                    <button type="button" class="btn btn-primary" onclick="add();">Tambah</button>
                    <button type="button" class="btn btn-secondary" onclick="reload();">Reload</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb" class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>NRP</th>
                                    <th>ROLE</th>
                                    <th>KORPS</th>
                                    <th>PANGKAT</th>
                                    <th>NAMA</th>
                                    <th>KAPAL</th>
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
                        <label>NRP</label>
                        <input id="nrp" name="nrp" class="form-control" type="text" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input id="pass" name="pass" class="form-control" type="password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nama Personil</label>
                        <input id="nama" name="nama" class="form-control" type="text" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="-">- Pilih Role -</option>
                            <?php
                            foreach ($role->getResult() as $row) {
                                ?>
                            <option value="<?php echo $row->idrole; ?>"><?php echo $row->nama_role; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Korps</label>
                        <select class="form-control" id="korps" name="korps">
                            <option value="-">- Pilih Korps -</option>
                            <?php
                            foreach ($korps->getResult() as $row) {
                                ?>
                            <option value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pangkat</label>
                        <select class="form-control" id="pangkat" name="pangkat">
                            <option value="-">- Pilih Pangkat -</option>
                            <?php
                            foreach ($pangkat->getResult() as $row) {
                                ?>
                            <option value="<?php echo $row->idpangkat; ?>"><?php echo $row->nama_pangkat; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kapal</label>
                        <select class="form-control" id="kapal" name="kapal">
                            <option value="-">- Pilih Kapal -</option>
                            <?php
                            foreach ($kapal->getResult() as $row) {
                                ?>
                            <option value="<?php echo $row->idkapal; ?>"><?php echo $row->nama_kapal; ?></option>
                                <?php
                            }
                            ?>
                        </select>
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