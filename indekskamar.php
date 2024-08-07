<?php
    include 'lib/header.php';

    include 'function/addKamar.php';
    include 'function/editKamar.php';
    include 'function/deleteKamar.php';
?>

<main>
    <div class="container-fluid">
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
        <div class="card mb-4">
            <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Tambah Kamar
            </button>
            <a href = "export/exportKamar.php" class="btn btn-info" target="_blank">
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
                            $idkamar= $data['idKamar'];
                            $nomorkamar = $data['noKamar'];
                            $jeniskamar = $data['jenisKamar'];
                            $jumlahfasilitas = $data['jumlahFasilitas'];
                            $biaya = $data['biaya'];
                            $status = $data['status'];
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
                                            <input type="text" name="biaya" value="<?=$biaya;?>" class="form-control" <?php if($lvladmin=='owner') { ?> required <?php }else{ ?> readonly <?php } ?>>
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

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
    </div>
    </div>
</div>
            

<?php
    include 'lib/footer.php';
?>
