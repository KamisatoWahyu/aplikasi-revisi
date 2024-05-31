<?php
//update atau edit info penyewa
if(isset($_POST['updatepenyewa'])){
    $idpenyewa = $_POST['idpenyewa'];
    $namapenyewa = $_POST['nama_penyewa'];
    $nomorhandphone = $_POST['nomor_handphone'];
    $alamatrumah = $_POST['alamat_rumah'];
    $tanggalmasuk = $_POST['tanggal_masuk'];
    $jatuhtempo = date('y/m/d', strtotime('+1 months', strtotime($tanggalmasuk)));

    $update = mysqli_query($conn, "update data_penyewa set Nama_Penyewa = '$namapenyewa', Nomor_Handphone = '$nomorhandphone', Alamat_Rumah = '$alamatrumah', Tanggal_Masuk = '$tanggalmasuk' where ID_Penyewa = '$idpenyewa'");
    $updatejatuhtempo = mysqli_query($conn, "update tagihan set jatuh_tempo = '$jatuhtempo' where ID_Penyewa = '$idpenyewa'");
}
?>