<?php
    //menghapus laporan
if(isset($_POST['hapuslaporan'])){
    $idpembayaran = $_POST['idpembayaran'];
    $hapus = mysqli_query($conn, "delete from data_transaksi where ID_Pembayaran = '$idpembayaran'");
}
?>