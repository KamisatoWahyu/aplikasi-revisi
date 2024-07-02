<?php
    if(isset($_POST['updateadmin'])){
        $idadmin=$_POST['idadmin'];
        $namaadmin=$_POST['namaadmin'];
        $passwordadmin=$_POST['password'];
        $lvladmin=$_POST['statusadmin'];
        
        $updateadmin = mysqli_query($conn, "update login set username = '$namaadmin', password = '$passwordadmin', lvl = '$lvladmin' where idAdmin = '$idadmin'");
    }
?>