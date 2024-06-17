<?php
//menambah penyewa  baru
if(isset($_POST['addnewpenyewa'])){
    $username = $_SESSION['username'];
    $ambiladmin = mysqli_query($conn, "SELECT idAdmin FROM login Where username = '$username'");
    $idadmin = mysqli_fetch_array($ambiladmin);
    $ambilidadmin = $idadmin['idAdmin'];
    //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
    $querypenyewa = mysqli_query($conn, "SELECT max(idPenyewa) as id_terbesar FROM data_penyewa");
    $datapenyewa = mysqli_fetch_array($querypenyewa);
    $kodepenyewa = $datapenyewa['id_terbesar'];
 
    // mengambil angka dari kode id terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodepenyewa, 2, 4);
 
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++; 
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $hurufpenyewa = "P";
    $idpenyewa = $hurufpenyewa . sprintf("%03s", $urutan);

    $nama_penyewa = $_POST['nama_penyewa'];
    $nomor_handphone = $_POST['nomor_handphone'];
    $alamat_rumah = $_POST['alamat_rumah'];
    $nik = $_POST['nik'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $idkamar = $_POST['kamarnya'];

    //menambah data ke data_penyewa
    $addtotable = mysqli_query($conn, "insert into data_penyewa (idPenyewa, idKamar, namaPenyewa, nomorHandphone,alamatRumah, NIK, tanggalMasuk) 
    values('$idpenyewa', '$idkamar', '$nama_penyewa', '$nomor_handphone','$alamat_rumah', '$nik', '$tanggal_masuk')");

    //mengubah status kamar menjadi penuh
    $updatestatuskamar = mysqli_query($conn, "update data_kamar set status= 'Penuh' where idKamar = '$idkamar'");
    
    // $querytagihan = mysqli_query($conn, "SELECT max(ID_Tagihan) as id_terbesar FROM tagihan");
    //menambah langsung tagihan baru
    // $datatagihan = mysqli_fetch_array($querytagihan);
    // $kodetagihan = $datatagihan['id_terbesar'];
    // $urutan = (int) substr($kodetagihan, 3, 7);
    // $urutan++; 
    // $huruftagihan = "TG";
    // $idtagihan = $huruftagihan . sprintf("%05s", $urutan);

    $jatuhtempo = $tanggal_masuk;
    date_default_timezone_set('Asia/Jakarta');
    $tgltagih = date("Y-m-d H:i:s");

    //menambah transaksi baru
    $querypembayaran = mysqli_query($conn, "SELECT max(idPembayaran) as id_terbesar FROM data_transaksi");
    $datapembayaran = mysqli_fetch_array($querypembayaran);
    $kodepembayaran = $datapembayaran['id_terbesar'];
    $urutan = (int) substr($kodepembayaran, 3, 7);
    $urutan++;  
    $hurufpembayaran = "TR";
    $idpembayaran = $hurufpembayaran. sprintf("%05s", $urutan);
    
    $cekbiaya = mysqli_query($conn, " SELECT * from data_kamar where idKamar = '$idkamar'");
    $ambilbiaya = mysqli_fetch_array($cekbiaya);
    $biaya = $ambilbiaya['biaya'];
    $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi(idPembayaran, idAdmin, idPenyewa, sisaTagihan, keterangan, tanggalTagih, jatuhTempo) 
    values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$biaya', 'Belum Bayar', '$tgltagih', '$jatuhtempo')");
}
?>