<script type="text/javascript">

    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>/brgkeluar/ajaxlist",
            ordering: false
        });
    });

    function reload() {
        table.ajax.reload(null, false);
    }

    function add() {
        window.location.href = "<?php echo base_url(); ?>/brgkeluar/detil";
    }
    
    function ganti(id) {
        window.location.href = "<?php echo base_url(); ?>/brgkeluar/detil/"+id;
    }
    
    function hapus(id, nama) {
        if (confirm("Apakah anda yakin menghapus barang nomor " + nama + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>/brgkeluar/hapus/" + id,
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

</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TRANSAKSI BARANG KELUAR</h4>
                    <button type="button" class="btn btn-primary btn-sm" onclick="add();">Tambah</button>
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
                                    <th style="text-align: center;">DETIL</th>
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