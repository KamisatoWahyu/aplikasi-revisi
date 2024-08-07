<?php
    include 'lib/header.php';

    require 'function/addAdmin.php';
    require 'function/editAdmin.php';
    require 'function/deleteAdmin.php';
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Kelola User</h1>
        <div class="card mb-4">
            <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Tambah Admin
            </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Admin</th>
                                <th>Nama Admin</th>
                                <th>Password</th>
                                <th>Status Level</th>
                                <th>Aksi</th>
                            </tr>                                            
                        </thead>
                        
                        <tbody>
                        <?php
                        $ambilsemuadataadmin = mysqli_query($conn, "select * from login");
                        while($data=mysqli_fetch_array($ambilsemuadataadmin)){
                            $idadmin= $data['idAdmin'];
                            $nama_admin = $data['username'];
                            $password = $data['password'];
                            $lvl = $data['lvl'];
                        ?>
                            <tr>
                                <td><?=$idadmin?></td>
                                <td><?=$nama_admin?></td>
                                <td><?=$password?></td>
                                <td><?=$lvl?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idadmin;?>">
                                        Edit
                                    </button>
                                        <input type="hidden" name="idkamaryangmaudihapus" value="<?=$idadmin;?>">
                                    
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idadmin;?>">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            
                                    <!-- Edit Modal -->
                                <div class="modal fade" id="edit<?=$idadmin;?>">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Edit admin</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                            <label>Nama Admin</label>
                                            <input type="text" name="namaadmin" value="<?=$nama_admin;?>" class="form-control" required>
                                            <br>
                                            <br>
                                            <label>Password</label>
                                            <input type="text" name="password" value="<?=$password;?>" class="form-control" required>
                                            <br>
                                            <label>Status Admin</label>
                                            <select name="statusadmin" class="form-control">
                                                <option value="owner">owner</option>
                                                <option value="petugas">petugas</option>
                                            </select>
                                            <br>
                                                <input type="hidden" name="idadmin" value="<?=$idadmin;?>">
                                                <button type="submit" class="btn btn-warning" name="updateadmin">Edit</button>
                                            </div>
                                        </form> 
                                                                            
                                    </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete<?=$idadmin;?>">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Hapus admin</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus Admin <?=$nama_admin?></b>?
                                                <input type="hidden" name="idadmin" value="<?=$idadmin;?>">
                                            <br>
                                            <br>
                                                <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
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
        <h4 class="modal-title">Tambah Admin</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
            <div class="modal-body">
                <label>Nama Admin</label>
                <input type="text" name="namaadmin" placeholder="Nama Admin" class="form-control" required>
                <br>
                <br>
                <label>Password</label>
                <input type="text" name="password" placeholder="Password" class="form-control" required>
                <br>
                <label>Status Admin</label>
                <select name="statusadmin" class="form-control">
                    <option value="owner">owner</option>
                    <option value="petugas">petugas</option>
                </select>
                <br>
                <button type="submit" class="btn btn-primary" name="addnewadmin">Submit</button>
            </div>
        </form> 
    </div>
    </div>
</div>

<?php
    include 'lib/footer.php';
?>
