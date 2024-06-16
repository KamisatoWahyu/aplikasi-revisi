<?php
    if(isset($_POST['updatelaporan'])){
        $emailadmin = $_SESSION['username'];
        $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
        $idadmin = mysqli_fetch_array($ambiladmin);
        $ambilidadmin = $idadmin['idadmin'];
        $idpembayaran = $_POST['idpembayaran'];
        $tanggaltransaksi = $_POST['tanggaltransaksi'];
        $totaltagihan = $_POST['tagih'];
        $dibayar = $_POST['bayar'];
        
        date_default_timezone_set('Asia/Jakarta');
        $wkttransaksi = date("Y-m-d H:i:s");
        $sisatagihan = $totaltagihan - $dibayar;
        if($sisatagihan>0){
            $keterangan = "Cicil";
        }else{
            $keterangan = "Lunas";
        }
    
        $update = mysqli_query($conn, "update data_transaksi set ID_Pembayaran = '$idpembayaran', sisatagihan = '$sisatagihan', Keterangan = '$keterangan' where ID_Pembayaran = '$idpembayaran'");
        $insertrekaman = mysqli_query($conn, "insert into data_rekaman(IdPembayaran, waktuTransaksi, ketTransaksi) values('$idpembayaran', '$wkttransaksi', '$keterangan')");
    }
?>