<?php
    include 'lib/header.php';
?>

   $namaadmin = mysqli_fetch_array($ambiladmin);
    $ambilnamanya = $namaadmin['namaadmin'];
    $lvladmin = $namaadmin['lvl'];
?><?php
    $emailadmin = $_SESSION['username'];
    $ambiladmin = mysqli_query($conn, "SELECT lvl, Nama_Admin as namaadmin FROM login Where Email = '$emailadmin'");
 

<main>
    <div class="container-fluid">
        <br>
        
        <h1 class="mt-4">Data Transaksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
        </ol>
        
        
        <div class="card mb-4">
            <div class="card-header">
                <a href = "exportlaporan.php" class="btn btn-info" target="_blank">
                        Export data
            </a>
            </div>
            
        
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Admin</th>
                                <th>Nama Penyewa</th>
                                <th>Jatuh Tempo</th>
                                <th>Tanggal Transaksi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $ambilsemuadatapenyewa = mysqli_query($conn, "select * from data_penyewa p, data_kamar k, data_transaksi tr, login l, tagihan t, data_rekaman r where r.ID_Pembayaran = tr.ID_Pembayaran AND t.ID_Admin=l.ID_Admin AND p.ID_Penyewa = tr.ID_Penyewa AND t.ID_Tagihan = tr.ID_Tagihan AND p.ID_Kamar = k.ID_Kamar order by tr.keterangan");
                        
                            while($data=mysqli_fetch_array($ambilsemuadatapenyewa)){
                            
                            $namapenyewa = $data['Nama_Penyewa'];
                            $nomorhandphone = $data['Nomor_Handphone'];
                            $biaya = $data['Biaya'];
                            $sisatagihan = $data['sisatagihan'];
                            $keterangan = $data['Keterangan'];
                            $idpembayaran = $data['ID_Pembayaran'];
                            $namaadmin = $data['Nama_Admin'];
                            $tgl_transaksi = $data['waktutransaksi'];
                            $jatuhtempo = $data['jatuh_tempo'];
                            $ktr = $data['keterangantransaksi'];
                            
                        ?>
                            <tr>
                                <td><?=$namaadmin?></td>
                                <td><?=$namapenyewa?></td>
                                <td><?=$tgl_transaksi?></td>
                                <td><?=$jatuhtempo?></td>
                                <td><?=$ktr?>
                                    

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

<?php
    include 'lib/footer.php';
?>

