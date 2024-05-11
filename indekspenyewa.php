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
        <title>Data Penyewa</title>
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
                        <h1 class="mt-4">Data Penyewa</h1>

                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                 Tambah data
                                </button>
                                <a href = "exportpenyewa.php" class="btn btn-info" target="_blank">
                                 Export data
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID Penyewa</th>
                                                <th>Nama Penyewa</th>
                                                <th>Nomor Handphone</th>
                                                <th>Alamat Rumah</th>
                                                <th>Nomor Kamar</th>
                                                <th>Tanggal Masuk</th>
                                                <?php if($lvladmin=='owner') { ?>
                                                <th>Aksi</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        
                                        $ambilsemuadatapenyewa = mysqli_query($conn, "select * from data_penyewa, data_kamar where data_kamar.ID_Kamar = data_penyewa.ID_Kamar");
                                        while($data=mysqli_fetch_array($ambilsemuadatapenyewa)){
                                            $idpenyewa = $data['ID_Penyewa'];
                                            $namapenyewa = $data['Nama_Penyewa'];
                                            $nomorhandphone = $data['Nomor_Handphone'];
                                            $alamatrumah = $data['Alamat_Rumah'];
                                            $tanggalmasuk = $data['Tanggal_Masuk'];
                                            $nomorkamarnya = $data['No_Kamar'];
                                            
                                            
                                        ?>
                                            <tr>
                                                <td><?=$idpenyewa;?></td>
                                                <td><?=$namapenyewa;?></td>
                                                <td><?=$nomorhandphone;?></td>
                                                <td><?=$alamatrumah;?></td>
                                                <td><?="Kamar ".$nomorkamarnya;?></td>
                                                <td><?php echo date("d/M/Y", strtotime($tanggalmasuk))?></td>
                                                <?php if($lvladmin=='owner') { ?>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idpenyewa;?>">
                                                        Edit
                                                    </button>
                                                        <input type="hidden" name="idpenyewauangmaudihapus" value="<?=$idpenyewa;?>">
                                                    
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idpenyewa;?>">
                                                        Delete
                                                    </button>
                                                </td>
                                                <?php } ?>
                                            </tr>

                                            
                                                    <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$idpenyewa;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Edit data penyewa</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="nama_penyewa" value="<?=$namapenyewa;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="nomor_handphone" value="<?=$nomorhandphone;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="alamat_rumah" value="<?=$alamatrumah;?>" class="form-control" required>
                                                                <br>
                                                                <select name="kamarnya" class="form-control">
                                                                    <?php
                                                                        
                                                                        $ambildata = mysqli_query($conn, "SELECT * from data_kamar");
                                                                        while($fetcharray = mysqli_fetch_array($ambildata)){
                                                                            $nomorkamar = $fetcharray['No_Kamar'];
                                                                            $idkamar = $fetcharray['ID_Kamar'];
                                                                    ?>
                                                                        <option value = "<?=$idkamar;?>">Kamar <?=$nomorkamar;?></option>        
                                                                    <?php   
                                                                        }
                                                                    ?>
                                                                </select>
                                                                
                                                                
                                                                <br>
                                                                <input type="date" name="tanggal_masuk" value="<?=$tanggalmasuk;?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idpenyewa" value="<?=$idpenyewa;?>">
                                                                <button type="submit" class="btn btn-warning" name="updatepenyewa">Edit</button>
                                                            </div>
                                                        </form> 
                                                                                            
                                                    </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idpenyewa;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Hapus data penyewa</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus <b><?=$namapenyewa;?></b> dengan Id <b><?=$idpenyewa;?></b>?
                                                                <input type="hidden" name="idpenyewa" value="<?=$idpenyewa;?>">
                                                                <input type="hidden" name="nomorkamar" value="<?=$nomorkamarnya;?>">
                                                            <br>
                                                            <br>
                                                                <button type="submit" class="btn btn-danger" name="hapuspenyewa">Hapus</button>
                                                            </div>
                                                        </form> 
                                                                                            
                                                    </div>
                                                    </div>
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



                                        <?php
                                        }
                                        ?>
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
                    <h4 class="modal-title">Tambah data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <form method="post">
                        <div class="modal-body">
                            <?php
                                        $cekkamar = mysqli_query($conn, "SELECT * from data_kamar where status = 'Kosong'");
                                        $jumlahkamarkosong = mysqli_num_rows($cekkamar);
                                        if($jumlahkamarkosong>0){
                            ?>
                            <input type="text" name="nama_penyewa" placeholder="Nama Penyewa" class="form-control" required>
                            <br>
                            <input type="text" name="nomor_handphone" placeholder="Nomor Handphone" class="form-control" required>
                            <br>
                            <input type="text" name="alamat_rumah" placeholder="Alamat Rumah" class="form-control" required>
                            <br>
                            <input type="text" name="nik" placeholder="NIK KTP" class="form-control" required>
                            <br>
                            <select name="kamarnya" class="form-control">
                                    <?php
                                        
                                        $ambildata = mysqli_query($conn, "SELECT * from data_kamar where status = 'Kosong'");
                                        while($fetcharray = mysqli_fetch_array($ambildata)){
                                            $nomorkamar = $fetcharray['No_Kamar'];
                                            $idkamar = $fetcharray['ID_Kamar'];
                                    ?>
                                        <option value = "<?=$idkamar;?>">Kamar <?=$nomorkamar;?></option>        
                                    <?php   
                                        }
                                    ?>
                                </select>
                            <br>
                            <input type="date" name="tanggal_masuk" placeholder="tanggalmasuk" class="form-control" required>
                            <br>
                            <button type="submit" class="btn btn-primary" name="addnewpenyewa">Submit</button>
                            <?php
                                }else{
                            ?>
                            Tidak ada kamar yang kosong
                            <?php
                                }
                            ?>
                        </div>
                    </form> 
                                                          
                </div>
                </div>
            </div>
</html>
