<?php
    include 'lib/header.php';
?>

<?php
    $emailadmin = $_SESSION['username'];
    $ambiladmin = mysqli_query($conn, "SELECT lvl, Nama_Admin as namaadmin FROM login Where Email = '$emailadmin'");
    $namaadmin = mysqli_fetch_array($ambiladmin);
    $ambilnamanya = $namaadmin['namaadmin'];
    $lvladmin = $namaadmin['lvl'];
?>

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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#buattagihansemua">
                        Buat tagihan bulan ini
                </button>
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
                          
                        </tbody>
                    </table>
                </div>
            </div>
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
