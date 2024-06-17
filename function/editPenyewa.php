<?php
//update atau edit info penyewa
if(isset($_POST['updatepenyewa'])){
    $idpenyewa = $_POST['idpenyewa'];
    $namapenyewa = $_POST['nama_penyewa'];
    $nomorhandphone = $_POST['nomor_handphone'];
    $alamatrumah = $_POST['alamat_rumah'];
    $tanggalmasuk = $_POST['tanggal_masuk'];
    $jatuhtempo = date('y/m/d', strtotime('+1 months', strtotime($tanggalmasuk)));

    $update = mysqli_query($conn, "update data_penyewa set namaPenyewa = '$namapenyewa', nomorHandphone = '$nomorhandphone', alamatRumah = '$alamatrumah', tanggalMasuk = '$tanggalmasuk' where idPenyewa = '$idpenyewa'");
    $updatejatuhtempo = mysqli_query($conn, "update tagihan set jatuhTempo = '$jatuhtempo' where idPenyewa = '$idpenyewa'");
}
?>