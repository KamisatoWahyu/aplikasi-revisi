<?php
    include 'lib/header.php';
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Utama</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat datang Admin <?=$ambilnamanya;?>!</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <?php 
                            $ambildata = mysqli_query($conn, "SELECT * from data_penyewa");
                            $cekpenyewa = mysqli_num_rows($ambildata);
                        ?>
                        <label>Jumlah penyewa saat ini..</label>
                        <h3><?=$cekpenyewa;?> Penyewa</h3>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="indekspenyewa.php">Ayo kita cek!</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                    <label>Kamar yang tersedia saat ini</label>
                        <?php
                        $ambilkosong=mysqli_query($conn, "SELECT * from data_kamar where status='Kosong'");
                        $cekkosong=mysqli_num_rows($ambilkosong);
                        
                        if($cekkosong>0){
                        ?>
                        <h3><?=$cekkosong;?> kamar kosong</h3>
                        <?php }else{ ?>
                        <h3>Penuh!</h3>
                        <?php } ?>
                        
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="indekskamar.php">Ayo kita cek!</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <?php
                        $tgl_skr = date('y/m/d');
                        $ambillunas=mysqli_query($conn, "SELECT * from data_transaksi where keterangan = 'Lunas' and month(jatuhTempo) = month('$tgl_skr')");
                        $ceklunas=mysqli_num_rows($ambillunas);
                        ?>
                        <label>Tagihan yang telah lunas bulan ini</label>
                        <h3><?=$ceklunas?> Lunas</h3>
                    </div>
                    <div class="card-footer d-flex align-items-end justify-content-between">
                        <a class="small text-white stretched-link" href="indekslaporan.php">Ayo kita cek!</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <?php
                        $tgl_skr = date('Y/m/d');
                        $ambilbb=mysqli_query($conn, "SELECT * from data_transaksi where keterangan != 'Lunas' And month(jatuhTempo) = month('$tgl_skr')");
                        $cekbb=mysqli_num_rows($ambilbb);
                        ?>
                        <label>Tagihan belum bayar dan cicil bulan ini</label>
                        <h3><?=$cekbb;?> Tagihan belum lunas</h3>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="indekslaporan.php" target="_blank">Ayo kita cek!</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</main>
                

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
    include 'lib/footer.php';
?>
