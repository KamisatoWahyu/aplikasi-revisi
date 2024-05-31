<?php
require 'config.php';
require 'cek.php';

    $emailadmin = $_SESSION['username'];
    $ambiladmin = mysqli_query($conn, "SELECT lvl, Nama_Admin as namaadmin FROM login Where Email = '$emailadmin'");
    $namaadmin = mysqli_fetch_array($ambiladmin);
    $ambilnamanya = $namaadmin['namaadmin'];
    $lvladmin = $namaadmin['lvl'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kelola Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Administrasi Kos</a>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Halaman Utama
                            </a>
                            <a class="nav-link" href="indeksPenyewa.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Penyewa
                            </a>
                            <a class="nav-link" href="indeksKamar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Kamar
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Laporan Keuangan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="indeksTagihan.php">Laporan Tagihan</a>
                                    <a class="nav-link" href="indeksTransaksi.php">Laporan Transaksi</a>
                                    <a class="nav-link" href="indeksRekaman.php">Rekaman Transaksi</a>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Lainnya</div>
                            <?php if($lvladmin=='owner'){ ?>
                            <a class="nav-link" href="indeksadmin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Kelola Admin
                            </a>
                            <?php } ?>
                            <a class="nav-link" data-toggle="modal" data-target="#logoutmodal">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Logout
                            </a>
                            
                        </div>
                    </div>

                    <div class="sb-sidenav-footer">
                        <?php
                        $emailadmin = $_SESSION['username'];
                        $ambiladmin = mysqli_query($conn, "SELECT Nama_Admin as namaadmin FROM login Where Email = '$emailadmin'");
                        $namaadmin = mysqli_fetch_array($ambiladmin);
                        $ambilnamanya = $namaadmin['namaadmin'];
                        ?>

                        <div class="small">
                            Logged in as:
                            <br><?=$ambilnamanya;?>
                        </div>
                        
                    </div>
                </nav>
            </div>

            <!-- Logout Modal -->
        <div class="modal fade" id="logoutmodal">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Keluar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                                    
                        Apakah anda yakin ingin keluar dari aplikasi?
                    <br>
                    <br>
                        <a href = "logout.php" class="btn btn-danger" name="keluar">Keluar</a>
                    </div>
                </form> 
                                                    
            </div>
            </div>
        </div>

            <div id="layoutSidenav_content">