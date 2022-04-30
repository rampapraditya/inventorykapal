<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>INVENTORY</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/feather/feather.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/js/select.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/vertical-layout-light/style.css">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>/images/favicon.png" />
        <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.js"></script>
        
        <style>
            .tabbable-panel {
                border:1px solid #eee;
                padding: 10px;
            }

            /* Default mode */
            .tabbable-line > .nav-tabs {
                border: none;
                margin: 0px;
            }
            .tabbable-line > .nav-tabs > li {
                margin-right: 2px;
            }
            .tabbable-line > .nav-tabs > li > a {
                border: 0;
                margin-right: 0;
                color: #737373;
            }
            .tabbable-line > .nav-tabs > li > a > i {
                color: #a6a6a6;
            }
            .tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
                border-bottom: 4px solid #fbcdcf;
            }
            .tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {
                border: 0;
                background: none !important;
                color: #333333;
            }
            .tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
                color: #a6a6a6;
            }
            .tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
                margin-top: 0px;
            }
            .tabbable-line > .nav-tabs > li.active {
                border-bottom: 4px solid #f3565d;
                position: relative;
            }
            .tabbable-line > .nav-tabs > li.active > a {
                border: 0;
                color: #333333;
            }
            .tabbable-line > .nav-tabs > li.active > a > i {
                color: #404040;
            }
            .tabbable-line > .tab-content {
                margin-top: -3px;
                background-color: #fff;
                border: 0;
                border-top: 1px solid #eee;
                padding: 15px 0;
            }
            .portlet .tabbable-line > .tab-content {
                padding-bottom: 0;
            }

            /* Below tabs mode */

            .tabbable-line.tabs-below > .nav-tabs > li {
                border-top: 4px solid transparent;
            }
            .tabbable-line.tabs-below > .nav-tabs > li > a {
                margin-top: 0;
            }
            .tabbable-line.tabs-below > .nav-tabs > li:hover {
                border-bottom: 0;
                border-top: 4px solid #fbcdcf;
            }
            .tabbable-line.tabs-below > .nav-tabs > li.active {
                margin-bottom: -2px;
                border-bottom: 0;
                border-top: 4px solid #f3565d;
            }
            .tabbable-line.tabs-below > .tab-content {
                margin-top: -10px;
                border-top: 0;
                border-bottom: 1px solid #eee;
                padding-bottom: 15px;
            }
            
            .modal {
                overflow-y:auto;
            }
            
        </style>
        
        <script type="text/javascript">
            
            function back(){
                window.history.back();
            }
            
            function hanyaAngka(e, decimal) {
                var key;
                var keychar;
                if (window.event) {
                    key = window.event.keyCode;
                } else if (e) {
                    key = e.which;
                } else {
                    return true;
                }
                keychar = String.fromCharCode(key);
                if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
                    return true;
                } else if ((("0123456789").indexOf(keychar) > -1)) {
                    return true;
                } else if (decimal && (keychar == ".")) {
                    return true;
                } else {
                    return false;
                }
            }
            
            function batas_angka(input, batas) {
                if (input.value < 0){ input.value = 0;}
                if (input.value > batas) {input.value = batas;}
            }
        </script>
        
    </head>
    <body>
        <div class="container-scroller">
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo mr-5" href="<?php echo base_url(); ?>/home">
                        <img src="<?php echo $logo; ?>" class="mr-2" alt="logo"/> INVENTORY 
                    </a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                    <ul class="navbar-nav mr-lg-2">
                        <li class="nav-item nav-search d-none d-lg-block">
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                <img src="<?php echo $foto_profile; ?>" alt="profile"/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a href="<?php echo base_url(); ?>/profile" class="dropdown-item"><i class="ti-settings text-primary"></i>Profile</a>
                                <a href="<?php echo base_url(); ?>/login/logout" class="dropdown-item"><i class="ti-power-off text-primary"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                </div>
            </nav>