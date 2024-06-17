<?php 
//menghapus penyewa 
if(isset($_POST['hapuspenyewa'])){
    $idpenyewa = $_POST['idpenyewa'];
    $nomorkamar = $_POST['nomorkamar'];
    
    $updatestatuskamar = mysqli_query($conn, "update data_kamar set status = 'Kosong' where noKamar = '$nomorkamar'");
    $hapustransaksi = mysqli_query($conn, "delete from data_transaksi where idPenyewa = '$idpenyewa'");
    $hapus = mysqli_query($conn, "delete from data_penyewa where idPenyewa = '$idpenyewa'");
}
?>