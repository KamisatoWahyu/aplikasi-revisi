<?php
    if(isset($_POST['updateadmin'])){
        $idadmin=$_POST['idadmin'];
        $namaadmin=$_POST['namaadmin'];
        $emailadmin=$_POST['emailadmin'];
        $passwordadmin=$_POST['password'];
        $lvladmin=$_POST['statusadmin'];
        
        $updateadmin = mysqli_query($conn, "update login set namaAdmin = '$namaadmin', email = '$emailadmin', password = '$passwordadmin', lvl = '$lvladmin' where idAdmin = '$idadmin'");
    }
?>