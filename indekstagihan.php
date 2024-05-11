<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Buat tagihan</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Catatan Kost</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <?php
                            $emailadmin = $_SESSION['username'];
                            $ambiladmin = mysqli_query($conn, "SELECT lvl, Nama_Admin as namaadmin FROM login Where Email = '$emailadmin'");
                            $namaadmin = mysqli_fetch_array($ambiladmin);
                            $ambilnamanya = $namaadmin['namaadmin'];
                            $lvladmin = $namaadmin['lvl'];
                            ?>
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Halaman Utama
                            </a>
                            <a class="nav-link" href="indekspenyewa.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Penyewa
                            </a>
                            <a class="nav-link" href="indekskamar.php">
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
                                    <a class="nav-link" href="indekstagihan.php">Buat Tagihan</a>
                                    <a class="nav-link" href="indekslaporan.php">Laporan Transaksi</a>
                                    <a class="nav-link" href="indeksrekaman.php">Rekaman Transaksi</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Lainnya</div>
                            <?php if($lvladmin == 'owner'){ ?>
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
                    

                        <div class="small">
                            Logged in as: 
                            <br><?=$ambilnamanya;?>
                        </div>
                        
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Tagihan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
       
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#buattagihansemua">
                                        Buat tagihan bulan ini
                                </button>
                                <a href = "exporttagihan.php" class="btn btn-info" target="_blank">
                                        Export data
                                </a>
                            </div>
                        
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Waktu Tagih</th>
                                                <th>Nama Admin</th>
                                                <th>Nama Penyewa</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Tagihan</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $ambilsemuadatapenyewa = mysqli_query($conn, "select l.Nama_Admin, p.Nama_Penyewa, t.jatuh_tempo, t.tanggaltagih, k.Biaya 
                                        from login l, data_penyewa p, data_kamar k, tagihan t where t.ID_Admin = l.ID_Admin AND t.ID_Penyewa = p.ID_Penyewa AND t.ID_Kamar = k.ID_Kamar");
                                        while($data=mysqli_fetch_array($ambilsemuadatapenyewa)){
                                            $namaadmin = $data['Nama_Admin'];
                                            $tanggaltagih = $data['tanggaltagih'];
                                            $namapenyewa = $data['Nama_Penyewa'];
                                            $jatuhtempo = $data['jatuh_tempo'];
                                            $biaya = $data['Biaya'];
                                        ?>
                                            <tr>
                                                <td><?php echo date('Y/M/d H:i:s', strtotime($tanggaltagih))?></td>
                                                <td><?=$namaadmin?></td>
                                                <td><?=$namapenyewa?></td>
                                                <td><?php echo date("d/M/Y", strtotime($jatuhtempo));?></td>
                                                <td><?="Rp".$biaya?></td>    
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                            
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Inovasi SI dan New Technology | Wahyu Hariyadi Nurdin | 11121286</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
                                    
    </body>

                                                <div class="modal fade" id="buattagihansemua">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Buat data tagihan</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <?php 
                                                                $tgl_skr = date('Y/m/d');
                                                                $angkatgl_skr = date('m', strtotime($tgl_skr));
                                                                $ambildatatagihan=mysqli_query($conn, "SELECT * from tagihan where month(jatuh_tempo) = $angkatgl_skr");
                                                                $cekbanyaktagihan=mysqli_num_rows($ambildatatagihan);
                                                                $ambildatapenyewa=mysqli_query($conn, "SELECT * from data_penyewa");
                                                                $cekbanyakpenyewa=mysqli_num_rows($ambildatapenyewa);
                                                                if($cekbanyaktagihan != $cekbanyakpenyewa){?>
                                                                Apakah anda yakin ingin membuat data tagihan bulan ini? 
                                                                <br>Tersisa <?=$cekbanyakpenyewa-$cekbanyaktagihan?> dari <?=$cekbanyakpenyewa?> penyewa
                                                            <br>
                                                            <br>
                                                                <button type="submit" class="btn btn-success" name="addnewtagihan">Buat Semua Tagihan</button>
                                                            </div>
                                                        </form> 
                                                            <?php }else{ ?>   
                                                            Semua penyewa sudah ditagih   <?=$cekbanyakpenyewa?> <?=$cekbanyaktagihan?> 
                                                            <?php } ?>                           
                                                    </div>
                                                    </div>
                                                </div>

                                            