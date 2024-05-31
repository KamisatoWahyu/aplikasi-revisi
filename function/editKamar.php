<?php
//update atau edit info kamar
if(isset($_POST['updatekamar'])){
    $idkamar = $_POST['idkamar'];
    $nomorkamar = $_POST['nomorkamar'];
    $jeniskamar = $_POST['jeniskamar'];
    $jumlahfasilitas = $_POST['jumlahfasilitas'];
    $biaya = $_POST['biaya'];

    
    $update = mysqli_query($conn, "update data_kamar set No_Kamar = '$nomorkamar', Jenis_Kamar = '$jeniskamar', Jumlah_Fasilitas = '$jumlahfasilitas', biaya = '$biaya' where ID_Kamar = '$idkamar'");
}
?>