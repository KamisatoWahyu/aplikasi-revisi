<?php
//menambah penyewa  baru
if(isset($_POST['addnewpenyewa'])){
    $emailadmin = $_SESSION['username'];
    $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
    $idadmin = mysqli_fetch_array($ambiladmin);
    $ambilidadmin = $idadmin['idadmin'];
    //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
    $querypenyewa = mysqli_query($conn, "SELECT max(ID_Penyewa) as id_terbesar FROM data_penyewa");
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
    $addtotable = mysqli_query($conn, "insert into data_penyewa (ID_Penyewa, ID_Kamar, Nama_Penyewa, Nomor_Handphone, Alamat_Rumah, NIK, Tanggal_Masuk) 
    values('$idpenyewa', '$idkamar', '$nama_penyewa', '$nomor_handphone','$alamat_rumah', '$nik', '$tanggal_masuk')");

    //mengubah status kamar menjadi penuh
    $updatestatuskamar = mysqli_query($conn, "update data_kamar set Status= 'Penuh' where ID_Kamar = '$idkamar'");
    $querytagihan = mysqli_query($conn, "SELECT max(ID_Tagihan) as id_terbesar FROM tagihan");
    
    //menambah langsung tagihan baru
    $datatagihan = mysqli_fetch_array($querytagihan);
    $kodetagihan = $datatagihan['id_terbesar'];
    $urutan = (int) substr($kodetagihan, 3, 7);
    $urutan++; 
    $huruftagihan = "TG";
    $idtagihan = $huruftagihan . sprintf("%05s", $urutan);
    $jatuhtempo = $tanggal_masuk;
    date_default_timezone_set('Asia/Jakarta');
    $tgltagih = date("Y-m-d H:i:s");
    $addtagihanpertama = mysqli_query($conn, "insert into tagihan (ID_Tagihan, ID_Admin, ID_Penyewa, ID_Kamar, tanggaltagih, jatuh_tempo) 
    values('$idtagihan', '$ambilidadmin', '$idpenyewa', '$idkamar', '$tgltagih', '$jatuhtempo')");

    //menambah transaksi baru
    $querypembayaran = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
    $datapembayaran = mysqli_fetch_array($querypembayaran);
    $kodepembayaran = $datapembayaran['id_terbesar'];
    $urutan = (int) substr($kodepembayaran, 2, 4);
    $urutan++;  
    $hurufpembayaran = "T";
    $idpembayaran = $hurufpembayaran. sprintf("%03s", $urutan);
    
    $cekbiaya = mysqli_query($conn, " SELECT * from data_kamar where ID_Kamar = '$idkamar'");
    $ambilbiaya = mysqli_fetch_array($cekbiaya);
    $biaya = $ambilbiaya['Biaya'];
    $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (ID_Pembayaran, ID_Admin, ID_Penyewa, ID_Tagihan, sisatagihan, Keterangan) 
    values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$idtagihan', '$biaya', 'Belum Bayar')");
}
?>