<?php
    include 'lib/header.php';
?>

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

<?php
    include 'lib/footer.php';
?>

                                            