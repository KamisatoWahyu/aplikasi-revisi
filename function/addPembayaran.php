<?php
    if(isset($_POST['addnewbayar'])){
        //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
        $querypembayaran = mysqli_query($conn, "SELECT max(idPembayaran) as id_terbesar FROM data_transaksi");
        $datapembayaran = mysqli_fetch_array($querypembayaran);
        $kodepembayaran = $datapembayaran['id_terbesar'];
        $urutan = (int) substr($kodepembayaran, 2, 4);
        $urutan++;  
        $hurufpembayaran = "T";
        $idpembayaran = $hurufpembayaran. sprintf("%03s", $urutan);
        $idpenyewa = $_POST['penyewanya'];
        $tanggalbayar = $_POST['tanggalbayar'];
    
        $username = $_SESSION['username'];
        $ambiladmin = mysqli_query($conn, "SELECT idAdmin as idadmin FROM login Where namaAdmin = '$username'");
        $idadmin = mysqli_fetch_array($ambiladmin);
        $ambilidadmin = $idadmin['idadmin'];
        
        $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (idPembayaran, idAdmin, idPenyewa, keterangan) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', 'Belum Bayar')");
    }
?>