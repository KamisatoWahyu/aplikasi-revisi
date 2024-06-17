<?php
    //menambah data admin
if(isset($_POST['addnewadmin'])){
    //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
    $queryadmin= mysqli_query($conn, "SELECT max(idAdmin) as id_terbesar FROM login");
    $dataadmin = mysqli_fetch_array($queryadmin);
    $kodeadmin = $dataadmin['id_terbesar'];
    $urutan = (int) substr($kodeadmin, 2, 4);
    $urutan++;  
    $hurufadmin = "A";
    $idadmin = $hurufadmin. sprintf("%03s", $urutan);
    
    $namaadmin=$_POST['namadmin'];
    $emailadmin=$_POST['emailadmin'];
    $passwordadmin=$_POST['password'];
    $lvladmin=$_POST['statusadmin'];
    $addtotableadmin = mysqli_query($conn, "insert into login (idAdmin, namaAdmin, email, password, lvl) values('$idadmin', '$namaadmin', '$emailadmin', '$passwordadmin', '$lvladmin')");
}
?>