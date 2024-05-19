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
        <title>Laporan Transaksi</title>
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
                            <?php if($lvladmin=='owner'){?>
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
                            $ambillaporan=mysqli_query($conn,"SELECT * from tagihan t, data_transaksi tr where t.ID_Tagihan = tr.ID_Tagihan AND tr.Keterangan != 'Lunas' ");
                            $ceklaporan=mysqli_num_rows($ambillaporan);
                            if($ceklaporan!=0){
                        ?>
                        <div class="alert alert-danger" role="alert">
                        Terdapat <?=$ceklaporan;?> tagihan masih dalam status belum bayar atau cicil. Segera hubungi penyewa untuk melunasi tagihan!
                        </div>
                        <?php } ?>
                        <h1 class="mt-4">Data Transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href = "exportlaporan.php" class="btn btn-info" target="_blank">
                                        Export data
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#filter">
                                        Filter berdasarkan penyewa
                                </button>

                                <div class="modal fade" id="filter">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Filter berdasarkan penyewa</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                            <label>Pilih nama penyewa yang ingin ditampilkan</label>
                                            
                                            <br>
                                            <select name="filterid" class="form-control">
                                            <option value="pilih" selected>----PILIH PENYEWA----</option>
                                            <?php
                                            $cekpenyewa = mysqli_query($conn, "SELECT Nama_Penyewa, ID_Penyewa from data_penyewa");
                                            while($ambilpenyewa=mysqli_fetch_array($cekpenyewa)){
                                                $id_penyewa=$ambilpenyewa['ID_Penyewa'];
                                                $nama_penyewa=$ambilpenyewa['Nama_Penyewa'];
                                            ?>
                                            <option value="<?=$id_penyewa;?>"><?=$nama_penyewa;?></option>
                                                
                                                <?php   
                                                    }
                                                ?>
                                                </select>
                                            <br>
            
                                                <button type="submit" class="btn btn-danger" name="filter">Filter</button>
                                                <button type="submit" class="btn btn-danger" name="hapusfilter">Hapus Filter</button>
                                            </div>
                                        </form> 
                                                                            
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                        
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Admin</th>
                                                <th>Nama Penyewa</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Tagihan</th>
                                                <th>Sisa Tagihan</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(isset($_POST['filter'])){
                                        $filterid=$_POST['filterid'];
                                            $ambilsemuadatapenyewa = mysqli_query($conn, "select * from data_penyewa p, data_kamar k, data_transaksi tr, login l, tagihan t where t.ID_Admin=l.ID_Admin AND p.ID_Penyewa = tr.ID_Penyewa AND t.ID_Tagihan = tr.ID_Tagihan AND p.ID_Kamar = k.ID_Kamar AND t.ID_Penyewa = '$filterid'");
                                        }elseif(isset($_POST['hapusfilter'])){
                                            $ambilsemuadatapenyewa = mysqli_query($conn, "select * from data_penyewa p, data_kamar k, data_transaksi tr, login l, tagihan t where t.ID_Admin=l.ID_Admin AND p.ID_Penyewa = tr.ID_Penyewa AND t.ID_Tagihan = tr.ID_Tagihan AND p.ID_Kamar = k.ID_Kamar order by tr.keterangan");
                                        }else{
                                            $ambilsemuadatapenyewa = mysqli_query($conn, "select * from data_penyewa p, data_kamar k, data_transaksi tr, login l, tagihan t where t.ID_Admin=l.ID_Admin AND p.ID_Penyewa = tr.ID_Penyewa AND t.ID_Tagihan = tr.ID_Tagihan AND p.ID_Kamar = k.ID_Kamar order by tr.keterangan");
                                        }
                                        
                                        while($data=mysqli_fetch_array($ambilsemuadatapenyewa)){
        
                                            $namapenyewa = $data['Nama_Penyewa'];
                                            $nomorhandphone = $data['Nomor_Handphone'];
                                            $biaya = $data['Biaya'];
                                            $sisatagihan = $data['sisatagihan'];
                                            $keterangan = $data['Keterangan'];
                                            $idpembayaran = $data['ID_Pembayaran'];
                                            $namaadmin = $data['Nama_Admin'];
                                            $jatuhtempo = $data['jatuh_tempo'];
                                            


                                            $getnomor = substr($nomorhandphone, 2);
                                            $kodenomor = "628";
                                            $getnomorfix = $kodenomor. $getnomor;
                                        ?>
                                            <tr>
                                                <td><?=$namaadmin?></td>
                                                <td><?=$namapenyewa?></td>
                                                <td><?php echo date("d/M/Y", strtotime($jatuhtempo))?></td>
                                                <td><?="Rp".$biaya?></td>
                                                <td><?="Rp".$sisatagihan?></td>
                                                <td>
                                                <?php if($keterangan=='Lunas') : ?>
                                                    <span class="badge badge-pill badge-success"><?=$keterangan?></span>
                                                <?php elseif($keterangan=='Cicil') :?>
                                                    <span class="badge badge-pill badge-warning"><?=$keterangan?></span>
                                                <?php elseif($keterangan=='Belum Bayar') :?>
                                                    <span class="badge badge-pill badge-danger"><?=$keterangan?></span>
                                                <?php endif;?>    
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idpembayaran;?>">
                                                        Edit
                                                    </button>
                                                    <?php if($lvladmin=='owner') { ?>
                                                        <input type="hidden" name="idpembayaranyangmaudihapus" value="<?=$idpembayaran;?>">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idpembayaran;?>">
                                                        Hapus
                                                    </button>
                                                    <?php } ?>
                                                    <a href="https://wa.me/<?=$getnomorfix;?>?text=Yang terhormat sdr/i <?=$namapenyewa?>, terima kasih telah setia kepada kami. 
                                                    
                                                    Kami ingin mengingatkan bahwa sdr/i sudah jatuh tempo dan diharapkan untuk melakukan pembayaran sewa kost bulan ini sebesar <?="Rp".$biaya?>. 
                                                    Terima kasih!" class="btn btn-success" role="button" aria-disabled="true" data-toggle="tooltip" data-placement="bottom" title="Hubungi via Whatsapp" target="_blank">Whatsapp</a>
                                                </td>
                                            </tr>

                                            
                                                    <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$idpembayaran;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Edit data laporan</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <label>Nama Penyewa</label>
                                                                <input type="text" name="namapenyewa" value="<?=$namapenyewa?>" class="form-control" readonly/>
                                                                <?php if($keterangan=='Belum Bayar' || $keterangan == 'Cicil') { ?>
                                                                <br>
                                                                <label>Tanggal Transaksi</label>
                                                                <input type="date" name="tanggaltransaksi" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                                                                <br>
                                                                <br>
                                                                <div class="form-group">
                                                                    <label>Total Tagihan</label>
                                                                    <input type='text' class="form-control" name="tagih" id="tagih" value="<?=$sisatagihan?>" readonly/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Dibayar</label>
                                                                    <input type='number' min="1" max="<?=$sisatagihan;?>" class="form-control" name="bayar" id="bayar" placeholder="Uang pembayaran"/>
                                                                <?php }else{ ?>
                                                                    <br>
                                                                    Tagihan telah dibayar lunas.
                                                                    <?php } ?>
                                                                    <br>
                                                                <br>
                                                                 
                                                                <input type="hidden" name="idpembayaran" value="<?=$idpembayaran;?>">
                                                                <button type="submit" class="btn btn-warning" name="updatelaporan">Edit</button>
                                                            </div>
                                                        </form> 
                                                                                            
                                                    </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idpembayaran;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Hapus data laporan</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus data dengan nama <b><?=$namapenyewa;?></b>?
                                                                <input type="hidden" name="idpembayaran" value="<?=$idpembayaran;?>">
                                                            <br>
                                                            <br>
                                                                <button type="submit" class="btn btn-danger" name="hapuslaporan">Hapus</button>
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


<!-- Buat Modal -->
                                                <div class="modal fade" id="buattagihan">
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
                                                                Apakah anda yakin ingin membuat data tagihan bulan selanjutnya?
                                                            <br>
                                                            <br>
                                                                <button type="submit" class="btn btn-success" name="addnewtagihan">Buat Semua Tagihan</button>
                                                            
                                                            </div>
                                                        </form> 
                                                                                            
                                                    </div>
                                                    </div>
                                                </div>

