<script type="text/javascript">

    $(document).ready(function () {
        
    });

    function reload(){
        var kapal = document.getElementById('kri').value;
        var form_data = new FormData();
        form_data.append('kapal', kapal);
        $.ajax({
            url: "<?php echo base_url(); ?>/laporan/display_tab",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (data) {
                $('#wadah_tab').html(data.hasil);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert("Error json " + errorThrown);
            }
        });
    }
    
</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">LAPORAN STOK</h4>
                </div>
                <div class="card-body">
                    <div class="forms-sample">
                        <div class="form-group">
                            <select id="kri" name="kri" class="form-control" onchange="reload()">
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
                </div>
                <div class="card-body">
                    <div id="wadah_tab" class="col-md-12">
                        <!-- wadah -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>