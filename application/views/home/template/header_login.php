<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>SIMONE</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/login/icons/logoPN.ico" />
    <link rel="icon" type="image/png" href="<?= base_url('home') ?>assets/img/login/icons/logoPN.ico" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/home/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/home/home.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/home/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="<?= base_url() ?>assets/img/home/fevicon.png" type="image/gif" />
    <link href="<?= base_url('assets/') ?>js/admin/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/js/admin/jquery/jquery-v3.6.0.min.js"></script>
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/home/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
    <!-- end loader -->
    <div class="wrapper">
        <!-- end loader -->
        <div class="sidebar">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div id="dismiss">
                    <i class="fa fa-arrow-left"></i>
                </div>
                <ul class="list-unstyled components">
                    <li class="text-center mb-4"><img class="border border-2 rounded-circle img-thumbnail" src="<?= base_url('assets/data/peserta/pas_foto/' . $foto) ?>" alt="foto-profil" style="height:150px; width:150px;"></li>
                    <li class="text-center text-secondary mb-1" style="font-size: 20px;"><b><?= $nama ?></b></li>
                    <li class="text-center text-secondary mb-1"><?php
                                                                if ($peserta['is_active'] == 1) {
                                                                    echo '<b><span class="badge badge-success" style="font-size:15px;"><b>Status : Aktif</b></span>';
                                                                } else {
                                                                    echo '<span class="badge badge-danger" style="background-color:danger;"><b>Status : Mangkir</b></span>';
                                                                }
                                                                ?></li>
                    <li class="text-center text-secondary mb-4" style="font-size: 15px;"><span class="badge badge-secondary"><b><?= $peserta['divisi'] ?></b></span></li>
                    <hr>
                    <li><a href="<?= base_url('home/edit_profil/' . $peserta['kode_magang']) ?>">Edit Profil</a> </li>
                    <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Log Out</a> </li>
                </ul>
            </nav>
        </div>
        <div id="content">
            <!-- header -->
            <header>
                <!-- header inner -->
                <div class="header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                                <div class="full">
                                    <div class="center-desk">
                                        <div class="logo">
                                            <a href="<?= base_url('home') ?>"><img src="<?= base_url(); ?>assets/img/home/logo-simone.png" alt="#" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                                <ul class="btn">
                                    <li><button type="button" id="sidebarCollapse">
                                            <img src="<?= base_url(); ?>assets/img/home/menu_icon.png" alt="#" />
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- end header inner -->
            <!-- end header -->
            <!-- banner -->