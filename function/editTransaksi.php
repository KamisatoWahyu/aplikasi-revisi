<?php
    if(isset($_POST['updatelaporan'])){
        $username = $_SESSION['username'];
        $ambiladmin = mysqli_query($conn, "SELECT idAdmin FROM login Where namaAdmin = '$username'");
        $idadmin = mysqli_fetch_array($ambiladmin);
        $ambilidadmin = $idadmin['idAdmin'];
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
    
        $update = mysqli_query($conn, "update data_transaksi set idPembayaran = '$idpembayaran', sisaTagihan = '$sisatagihan', keterangan = '$keterangan' where idPembayaran = '$idpembayaran'");
        $insertrekaman = mysqli_query($conn, "insert into data_rekaman(idPembayaran, waktuTransaksi, ketTransaksi) values('$idpembayaran', '$wkttransaksi', '$keterangan')");
    }
?>