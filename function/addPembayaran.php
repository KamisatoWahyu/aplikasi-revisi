<?php
    if(isset($_POST['addnewbayar'])){
        //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
        $querypembayaran = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
        $datapembayaran = mysqli_fetch_array($querypembayaran);
        $kodepembayaran = $datapembayaran['id_terbesar'];
        $urutan = (int) substr($kodepembayaran, 2, 4);
        $urutan++;  
        $hurufpembayaran = "T";
        $idpembayaran = $hurufpembayaran. sprintf("%03s", $urutan);
        $idpenyewa = $_POST['penyewanya'];
        $tanggalbayar = $_POST['tanggalbayar'];
    
        $emailadmin = $_SESSION['username'];
        $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
        $idadmin = mysqli_fetch_array($ambiladmin);
        $ambilidadmin = $idadmin['idadmin'];
        
        $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (ID_Pembayaran, ID_Admin, ID_Penyewa, Tanggal_Bayar, Keterangan) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$tanggalbayar', 'Belum Bayar')");
    }
?>