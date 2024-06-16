<?php
    include 'lib/header.php';

    require 'function/addPenyewa.php';
    require 'function/editPenyewa.php';
    require 'function/deletePenyewa.php';
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Data Penyewa</h1>

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