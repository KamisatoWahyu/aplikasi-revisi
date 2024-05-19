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
        <title>Data Kamar</title>
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
                                    <a class="nav-link" href="indekstagihan.php">Laporan Tagihan</a>
                                    <a class="nav-link" href="indekslaporan.php">Laporan Transaksi</a>
                                    <a class="nav-link" href="indeksrekaman.php">Rekaman Transaksi</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Lainnya</div>
                            <?php 
                                if($lvladmin == 'owner'){
                            ?>
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
                    <br>
                        <?php
                            $ambillaporan=mysqli_query($conn,"SELECT * from data_kamar where status='Kosong'");
                            $ceklaporan=mysqli_num_rows($ambillaporan);
                            if($ceklaporan==0){
                        ?>
                        <div class="alert alert-success" role="alert">
                        Seluruh kamar telah terisi!
                        </div>
                        <?php } ?>
                        <h1 class="mt-4">Data Kamar</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                 Tambah Kamar
                            </button>
                            <a href = "exportkamar.php" class="btn btn-info" target="_blank">
                                 Export data
                            </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID Kamar</th>
                                                <th>Nomor Kamar</th>
                                                <th>Jenis Kamar</th>
                                                <th>Jumlah Fasilitas</th>
                                                <th>Biaya</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>                                            
                                        </thead>
                                       
                                        <tbody>
                                        <?php
                                        $ambilsemuadatapenyewa = mysqli_query($conn, "select * from data_kamar");
                                        while($data=mysqli_fetch_array($ambilsemuadatapenyewa)){
                                            $idkamar= $data['ID_Kamar'];
                                            $nomorkamar = $data['No_Kamar'];
                                            $jeniskamar = $data['Jenis_Kamar'];
                                            $jumlahfasilitas = $data['Jumlah_Fasilitas'];
                                            $biaya = $data['Biaya'];
                                            $status = $data['Status'];
                                        ?>
                                            <tr>
                                                <td><?=$idkamar?></td>
                                                <td><?=$nomorkamar?></td>
                                                <td><?=$jeniskamar?></td>
                                                <td><?=$jumlahfasilitas?></td>
                                                <td><?="Rp".$biaya?></td>
                                                <td><?=$status?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idkamar;?>">
                                                        Edit
                                                    </button>
                                                        <input type="hidden" name="idkamaryangmaudihapus" value="<?=$idkamar;?>">
                                                        <?php if($lvladmin=='owner') { ?>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idkamar;?>">
                                                        Hapus
                                                    </button>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            
                                                    <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$idkamar;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Edit data kamar</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="nomorkamar" value="<?=$nomorkamar;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="jeniskamar" value="<?=$jeniskamar;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="jumlahfasilitas" value="<?=$jumlahfasilitas;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="biaya" value="<?=$biaya;?>" class="form-control" <?php if($lvladmin=='
                                                                ') { ?> required <?php }else{ ?> readonly <?php } ?>>
                                                                <br>
                                                                <input type="hidden" name="idkamar" value="<?=$idkamar;?>">
                                                                <button type="submit" class="btn btn-warning" name="updatekamar">Edit</button>
                                                            </div>
                                                        </form> 
                                                                                            
                                                    </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idkamar;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Hapus data kamar</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus kamar dengan nomor <b><?=$nomorkamar;?></b>?
                                                                <input type="hidden" name="idkamar" value="<?=$idkamar;?>">
                                                            <br>
                                                            <br>
                                                                <button type="submit" class="btn btn-danger" name="hapuskamar">Hapus</button>
                                                            </div>
                                                        </form> 
                                                                                            
                                                    </div>
                                                    </div>
                                                </div>
                                            
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

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Tambah Kamar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <form method="post">
                            <div class="modal-body">
                                <input type="text" name="nomor_kamar" placeholder="Nomor Kamar" class="form-control" required>
                                <br>
                                <input type="text" name="jenis_kamar" placeholder="Jenis Kamar" class="form-control"required>
                                <br>
                                <input type="text" name="jumlah_fasilitas" placeholder="Jumlah Fasilitas" class="form-control" required>
                                <br>
                                <input type="text" name="biaya" placeholder="Biaya" class="form-control" required>
                                <br>
                                <button type="submit" class="btn btn-primary" name="addnewkamar">Submit</button>
                            </div>
                        </form> 

</html>
