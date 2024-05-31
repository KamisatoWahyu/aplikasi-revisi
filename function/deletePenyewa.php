<?php 
//menghapus penyewa 
if(isset($_POST['hapuspenyewa'])){
    $idpenyewa = $_POST['idpenyewa'];
    $nomorkamar = $_POST['nomorkamar'];
    
    $updatestatuskamar = mysqli_query($conn, "update data_kamar set Status = 'Kosong' where No_Kamar = '$nomorkamar'");
    $hapustransaksi = mysqli_query($conn, "delete from data_transaksi where ID_Penyewa = '$idpenyewa'");
    $hapus = mysqli_query($conn, "delete from data_penyewa where ID_Penyewa = '$idpenyewa'");
}
?>