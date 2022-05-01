<script type="text/javascript">

    var tb_platform, tb_sewaco, tb_komaliwan, tb_br_umum;

    $(document).ready(function () {
        tb_platform = $('#tb_platform').DataTable();
        tb_sewaco = $('#tb_sewaco').DataTable();
        tb_komaliwan = $('#tb_komaliwan').DataTable();
        tb_br_umum = $('#tb_br_umum').DataTable();
    });

    function reload() {
        var kri = document.getElementById('kri').value;
        if(kri <> "-"){
            reload1(kri);
        }else{
           alert("Pilih KRI terlebih dahulu"); 
        }
    }
    
    function reload1(kri){
        tb_platform = $('#tb_platform').DataTable({
            ajax: "<?php echo base_url(); ?>/laporan/ajax_platform/" + kri,
            ordering: false,
            retrieve:true
        });
        tb_platform.destroy();
        tb_platform = $('#tb_platform').DataTable({
            ajax: "<?php echo base_url(); ?>/laporan/ajax_platform/" + kri,
            ordering: false,
            retrieve:true
        });
    }
    
    function reload2(){
        tb_sewaco = $('#tb_sewaco').DataTable({
            ajax: "<?php echo base_url(); ?>/laporan/ajax_sewaco",
            ordering: false
        });
    }
    
    function reload3(){
        tb_komaliwan = $('#tb_komaliwan').DataTable({
            ajax: "<?php echo base_url(); ?>/laporan/ajax_komaliwan",
            ordering: false
        });
    }
    
    function reload4(){
        tb_br_umum = $('#tb_br_umum').DataTable({
            ajax: "<?php echo base_url(); ?>/laporan/ajax_br_umum",
            ordering: false
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
                                <table id="tb_platform" class="table table-bordered" style="width: 100%; font-size: 11px;">
                                    <thead>
                                        <tr>
                                            <th>GAMBAR</th>
                                            <th>DESCRIPTION</th>
                                            <th>PN/NSN</th>
                                            <th>DS NUMBER</th>
                                            <th>Holding</th>
                                            <th style="text-align: center;">EQUIPMENT<br>DESCRIPTION</th>
                                            <th style="text-align: center;">STORE<br>LOCATION</th>
                                            <th style="text-align: center;">SUPPLEMENTARY<br>LOCATION</th>
                                            <th style="text-align: center;">UOI</th>
                                            <th style="text-align: center;">Verwendung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav_sewaco" role="tabpanel" aria-labelledby="nav_sewaco">
                            <div class="table-responsive">
                                <table id="tb_sewaco" class="table table-bordered" style="width: 100%; font-size: 11px;">
                                    <thead>
                                        <tr>
                                            <th>GAMBAR</th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav_komaliwan" role="tabpanel" aria-labelledby="nav_komaliwan">
                            <div class="table-responsive">
                                <table id="tb_komaliwan" class="table table-bordered" style="width: 100%; font-size: 11px;">
                                    <thead>
                                        <tr>
                                            <th>GAMBAR</th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav_barangumum" role="tabpanel" aria-labelledby="nav_barangumum">
                            <div class="table-responsive">
                                <table id="tb_br_umum" class="table table-bordered" style="width: 100%; font-size: 11px;">
                                    <thead>
                                        <tr>
                                            <th>GAMBAR</th>
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