<?php
    if(isset($_POST['updateadmin'])){
        $idadmin=$_POST['idadmin'];
        $namaadmin=$_POST['namaadmin'];
        $emailadmin=$_POST['emailadmin'];
        $passwordadmin=$_POST['password'];
        $lvladmin=$_POST['statusadmin'];
        
        $updateadmin = mysqli_query($conn, "update login set Nama_Admin = '$namaadmin', Email = '$emailadmin', Password = '$passwordadmin', lvl = '$lvladmin' where ID_Admin = '$idadmin'");
    }
?>