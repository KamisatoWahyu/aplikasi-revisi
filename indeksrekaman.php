<?php
    include 'lib/header.php';
?>

<main>
    <div class="container-fluid">
        <br>       
        <h1 class="mt-4">Data Transaksi</h1>
         
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
                            $ambilsemuadatapenyewa = mysqli_query($conn, 
                            "select * from data_rekaman r
                            inner join data_transaksi tr
                            on r.idPembayaran = tr.idPembayaran
                            inner join login l
                            on tr.idAdmin = l.idAdmin
                            inner join data_penyewa p
                            on tr.idPenyewa = p.idPenyewa
                            inner join data_kamar k
                            on p.idKamar = k.idKamar
                            order by tr.Keterangan
                            ");
                        
                            while($data=mysqli_fetch_array($ambilsemuadatapenyewa)){
                            
                            $namapenyewa = $data['namaPenyewa'];
                            $nomorhandphone = $data['nomorHandphone'];
                            $biaya = $data['biaya'];
                            $sisatagihan = $data['sisaTagihan'];
                            $keterangan = $data['keterangan'];
                            $idpembayaran = $data['idPembayaran'];
                            $namaadmin = $data['namaAdmin'];
                            $tgl_transaksi = $data['waktuTransaksi'];
                            $jatuhtempo = $data['jatuhTempo'];
                            $ktr = $data['ketTransaksi'];
                            
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


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
                
<?php
    include 'lib/footer.php';
?>

