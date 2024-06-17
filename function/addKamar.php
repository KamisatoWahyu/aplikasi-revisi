<?php
//menambah data kamar baru
if(isset($_POST['addnewkamar'])){
    
    $querykamar = mysqli_query($conn, "SELECT max(idKamar) as id_terbesar FROM data_kamar");
    $datakamar = mysqli_fetch_array($querykamar);
    $kodekamar = $datakamar['id_terbesar'];
    $urutan = (int) substr($kodekamar, 2, 4);
    $urutan++; 
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $hurufkamar = "K";
    $idkamar = $hurufkamar. sprintf("%03s", $urutan);

    $nomor_kamar = $_POST['nomor_kamar'];
    $jenis_kamar = $_POST['jenis_kamar'];
    $jumlah_fasilitas = $_POST['jumlah_fasilitas'];
    $biaya = $_POST['biaya'];

    $addtotable = mysqli_query($conn, "insert into data_kamar (idKamar, noKamar, jenisKamar, jumlahFasilitas, biaya, status) values('$idkamar', '$nomor_kamar', '$jenis_kamar', '$jumlah_fasilitas', '$biaya', 'Kosong')");
}
?>