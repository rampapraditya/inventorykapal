<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>INVENTORY</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/feather/feather.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/vertical-layout-light/style.css">
    </head>
    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto" >
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="background-color: #fff; background-color: rgba(255,255,255, 0.9);">
                                <div class="brand-logo">
                                    <img src="<?php echo $logo; ?>" alt="logo" style="width: 70px;">
                                    <img src="<?php echo base_url(); ?>/images/kapal.png" alt="logo" style="height: 60px; float: right;">
                                </div>
                                <h4>INVENTORY</h4>
                                <h6 class="font-weight-light">Login untuk melanjutkan.</h6>
                                <div class="pt-3">
                                    <form id="form">
                                        <?php csrf_field(); ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg" id="nrp" name="nrp" placeholder="Username" autocomplete="off" autofocus="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg" id="pass" name="pass" placeholder="Password">
                                        </div>
                                    </form>
                                    <div class="mt-3">
                                        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="login();">SIGN IN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/js/vendor.bundle.base.js"></script>
        <script src="<?php echo base_url(); ?>/js/off-canvas.js"></script>
        <script src="<?php echo base_url(); ?>/js/hoverable-collapse.js"></script>
        <script src="<?php echo base_url(); ?>/js/template.js"></script>
        <script src="<?php echo base_url(); ?>/js/settings.js"></script>
        <script src="<?php echo base_url(); ?>/js/todolist.js"></script>
        
        <script type="text/javascript">
            
            $(document).ready(function (){
                $('#nrp').keypress(function (e){
                    var key = e.which;
                    if(key === 13){
                        $('#pass').focus();
                        $('#pass').select();
                    }
                });
                
                $('#pass').keypress(function (e){
                    var key = e.which;
                    if(key === 13){
                        login();
                    }
                });
            });

            function login() {
                var nrp = document.getElementById('nrp').value;
                var pass = document.getElementById('pass').value;
                if (nrp === '') {
                    alert("NRP tidak boleh kosong");
                } else if (pass === '') {
                    alert("Password tidak boleh kosong");
                } else {
                    $.ajax({
                        url: "<?php echo base_url(); ?>/login/proses",
                        type: "POST",
                        data: $('#form').serialize(),
                        dataType: "JSON",
                        success: function (data) {
                            if (data.status === "ok") {
                                window.location.href = "<?php echo base_url(); ?>/home";
                            }else if(data.status === "ok_no_admin"){
                                window.location.href = "<?php echo base_url(); ?>/homenoadmin";
                            } else {
                                alert(data.status);
                            }
                        }, error: function (jqXHR, textStatus, errorThrown) {
                            alert("Error json " + errorThrown);
                        }
                    });
                }
            }

        </script>
        
    </body>
</html>
