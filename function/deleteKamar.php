<?php
//menghapus kamar
if(isset($_POST['hapuskamar'])){
    $idkamar = $_POST['idkamar'];
    $hapus = mysqli_query($conn, "delete from data_kamar where ID_Kamar = '$idkamar'");
}
?>