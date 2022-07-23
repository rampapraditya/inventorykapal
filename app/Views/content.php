<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <h4 class="font-weight-bold"><?php echo "Welcome, ".$nama; ?></h4>
            <marquee>
                <img src="<?php echo base_url(); ?>/images/kapal.png" alt="logo" style="height: 60px;">
            </marquee>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <h3>SISTEM INVENTORY KAPAL KOARMADA II TNI AL</h3>
                    <img src="<?php echo $logo; ?>" style="width: 150px; height: auto; margin-top: 20px;">
                    <p style="margin-top: 50px;"><?php echo $alamat . ' - '; ?><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></p>
                    <p style="margin-top: 5px;"><?php echo "Telp : " . $tlp; if(strlen($fax) > 0){ echo ', Fax : ' . $fax; } ?></p>
                </div>
            </div>
        </div>
    </div>
</div>