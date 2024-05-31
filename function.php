<?php
require 'config.php';

// //menambah penyewa  baru
// if(isset($_POST['addnewpenyewa'])){
//     $emailadmin = $_SESSION['username'];
//     $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
//     $idadmin = mysqli_fetch_array($ambiladmin);
//     $ambilidadmin = $idadmin['idadmin'];
//     //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
//     $querypenyewa = mysqli_query($conn, "SELECT max(ID_Penyewa) as id_terbesar FROM data_penyewa");
//     $datapenyewa = mysqli_fetch_array($querypenyewa);
//     $kodepenyewa = $datapenyewa['id_terbesar'];
 
//     // mengambil angka dari kode id terbesar, menggunakan fungsi substr
//     // dan diubah ke integer dengan (int)
//     $urutan = (int) substr($kodepenyewa, 2, 4);
 
//     // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
//     $urutan++; 
//     // membentuk kode barang baru
//     // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
//     // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
//     // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
//     $hurufpenyewa = "P";
//     $idpenyewa = $hurufpenyewa . sprintf("%03s", $urutan);

//     $nama_penyewa = $_POST['nama_penyewa'];
//     $nomor_handphone = $_POST['nomor_handphone'];
//     $alamat_rumah = $_POST['alamat_rumah'];
//     $nik = $_POST['nik'];
//     $tanggal_masuk = $_POST['tanggal_masuk'];
//     $idkamar = $_POST['kamarnya'];

//     //menambah data ke data_penyewa
//     $addtotable = mysqli_query($conn, "insert into data_penyewa (ID_Penyewa, ID_Kamar, Nama_Penyewa, Nomor_Handphone, Alamat_Rumah, NIK, Tanggal_Masuk) 
//     values('$idpenyewa', '$idkamar', '$nama_penyewa', '$nomor_handphone','$alamat_rumah', '$nik', '$tanggal_masuk')");
    
//     //mengubah status kamar menjadi penuh
//     $updatestatuskamar = mysqli_query($conn, "update data_kamar set Status= 'Penuh' where ID_Kamar = '$idkamar'");
//     $querytagihan = mysqli_query($conn, "SELECT max(ID_Tagihan) as id_terbesar FROM tagihan");
    
//     //menambah langsung tagihan baru
//     $datatagihan = mysqli_fetch_array($querytagihan);
//     $kodetagihan = $datatagihan['id_terbesar'];
//     $urutan = (int) substr($kodetagihan, 3, 7);
//     $urutan++; 
//     $huruftagihan = "TG";
//     $idtagihan = $huruftagihan . sprintf("%05s", $urutan);
//     $jatuhtempo = $tanggal_masuk;
//     date_default_timezone_set('Asia/Jakarta');
//     $tgltagih = date("Y-m-d H:i:s");
//     $addtagihanpertama = mysqli_query($conn, "insert into tagihan (ID_Tagihan, ID_Admin, ID_Penyewa, ID_Kamar, tanggaltagih, jatuh_tempo) 
//     values('$idtagihan', '$ambilidadmin', '$idpenyewa', '$idkamar', '$tgltagih', '$jatuhtempo')");

//     //menambah transaksi baru
//     $querypembayaran = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
//     $datapembayaran = mysqli_fetch_array($querypembayaran);
//     $kodepembayaran = $datapembayaran['id_terbesar'];
//     $urutan = (int) substr($kodepembayaran, 2, 4);
//     $urutan++;  
//     $hurufpembayaran = "T";
//     $idpembayaran = $hurufpembayaran. sprintf("%03s", $urutan);
    
//     $cekbiaya = mysqli_query($conn, " SELECT * from data_kamar where ID_Kamar = '$idkamar'");
//     $ambilbiaya = mysqli_fetch_array($cekbiaya);
//     $biaya = $ambilbiaya['Biaya'];
//     $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (ID_Pembayaran, ID_Admin, ID_Penyewa, ID_Tagihan, sisatagihan, Keterangan) 
//     values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$idtagihan', '$biaya', 'Belum Bayar')");
// }

// //menambah data kamar baru
// if(isset($_POST['addnewkamar'])){
    
//     $querykamar = mysqli_query($conn, "SELECT max(ID_Kamar) as id_terbesar FROM data_kamar");
//     $datakamar = mysqli_fetch_array($querykamar);
//     $kodekamar = $datakamar['id_terbesar'];
//     $urutan = (int) substr($kodekamar, 2, 4);
//     $urutan++; 
//     // membentuk kode barang baru
//     // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
//     // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
//     // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
//     $hurufkamar = "K";
//     $idkamar = $hurufkamar. sprintf("%03s", $urutan);

//     $nomor_kamar = $_POST['nomor_kamar'];
//     $jenis_kamar = $_POST['jenis_kamar'];
//     $jumlah_fasilitas = $_POST['jumlah_fasilitas'];
//     $biaya = $_POST['biaya'];

//     $addtotable = mysqli_query($conn, "insert into data_kamar (ID_Kamar, No_Kamar, Jenis_Kamar, Jumlah_Fasilitas, Biaya, Status) values('$idkamar', '$nomor_kamar', '$jenis_kamar', '$jumlah_fasilitas', '$biaya', 'Kosong')");
// }

//menambah data pembayaran baru
// if(isset($_POST['addnewbayar'])){
//     //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
//     $querypembayaran = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
//     $datapembayaran = mysqli_fetch_array($querypembayaran);
//     $kodepembayaran = $datapembayaran['id_terbesar'];
//     $urutan = (int) substr($kodepembayaran, 2, 4);
//     $urutan++;  
//     $hurufpembayaran = "T";
//     $idpembayaran = $hurufpembayaran. sprintf("%03s", $urutan);
//     $idpenyewa = $_POST['penyewanya'];
//     $tanggalbayar = $_POST['tanggalbayar'];

//     $emailadmin = $_SESSION['username'];
//     $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
//     $idadmin = mysqli_fetch_array($ambiladmin);
//     $ambilidadmin = $idadmin['idadmin'];
    
//     $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (ID_Pembayaran, ID_Admin, ID_Penyewa, Tanggal_Bayar, Keterangan) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$tanggalbayar', 'Belum Bayar')");
// }

// if(isset($_POST['addnewtagihan'])){     

//     //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
//     $tabeltagihan = mysqli_query($conn, "SELECT * from tagihan");
//     $cektabeltagihan = mysqli_num_rows($tabeltagihan);

//     $emailadmin = $_SESSION['username'];
//     $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
//     $idadmin = mysqli_fetch_array($ambiladmin);
//     $ambilidadmin = $idadmin['idadmin'];
//     if($cektabeltagihan <= 1){
//         $ambildata = mysqli_query($conn, "SELECT k.ID_Kamar, k.No_Kamar, p.ID_Penyewa, p.Tanggal_Masuk, k.Biaya  
//         from data_penyewa p left join data_kamar k on p.ID_Kamar = k.ID_Kamar");
//         while($fetcharray = mysqli_fetch_array($ambildata)){

//             $querytagihan = mysqli_query($conn, "SELECT max(ID_Tagihan) as id_terbesar FROM tagihan");
//             $datatagihan = mysqli_fetch_array($querytagihan);
//             $kodetagihan = $datatagihan['id_terbesar'];
//             $urutan = (int) substr($kodetagihan, 3, 7);
//             $urutan++; 
//             $huruftagihan = "TG";
//             $idtagihan = $huruftagihan . sprintf("%05s", $urutan);

//             $querypembayaran = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
//             $datapembayaran = mysqli_fetch_array($querypembayaran);
//             $kodepembayaran = $datapembayaran['id_terbesar'];
//             $urutan = (int) substr($kodepembayaran, 2, 4);
//             $urutan++;  
//             $hurufpembayaran = "T";
//             $idpembayaran = $hurufpembayaran. sprintf("%03s", $urutan);
        
//             $idkamar = $fetcharray['ID_Kamar'];
//             $idpenyewa = $fetcharray['ID_Penyewa'];
//             $jatuhtempo = $fetcharray['Tanggal_Masuk'];
//             $biaya = $fetcharray['Biaya'];
//             date_default_timezone_set('Asia/Jakarta');
//             $tgltagih = date("Y-m-d H:i:s");
//             $emailadmin = $_SESSION['username'];
//             $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
//             $idadmin = mysqli_fetch_array($ambiladmin);
//             $ambilidadmin = $idadmin['idadmin'];
            
//             $addtotable = mysqli_query($conn, "insert into tagihan(ID_Tagihan, ID_Admin, ID_Penyewa, ID_Kamar, tanggaltagih, jatuh_tempo) values('$idtagihan', '$ambilidadmin', '$idpenyewa', '$idkamar', '$tgltagih', '$jatuhtempo')");
//             $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (ID_Pembayaran, ID_Admin, ID_Penyewa, ID_Tagihan, sisatagihan, Keterangan) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$idtagihan', '$biaya', 'Belum Bayar')");

//             }}elseif($cektabeltagihan > 1){
//             $tgl_skr = date('Y/m/d');
//             $ambildata = mysqli_query($conn, "SELECT t.ID_Penyewa, k.ID_Kamar, k.Biaya, MAX(t.jatuh_tempo) as jatuhtempo from tagihan t, data_kamar k where t.ID_Kamar=k.ID_Kamar group by ID_Penyewa");
//             while($fetcharray = mysqli_fetch_array($ambildata)){
//             $querytagihan = mysqli_query($conn, "SELECT max(ID_Tagihan) as id_terbesar FROM tagihan");
//             $datatagihan = mysqli_fetch_array($querytagihan);
//             $kodetagihan = $datatagihan['id_terbesar'];
//             $urutan = (int) substr($kodetagihan, 3, 7);
//             $urutan++; 
//             $huruftagihan = "TG";
//             $idtagihan = $huruftagihan . sprintf("%05s", $urutan);

//             $querypembayaran = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
//             $datapembayaran = mysqli_fetch_array($querypembayaran);
//             $kodepembayaran = $datapembayaran['id_terbesar'];
//             $urutan = (int) substr($kodepembayaran, 2, 4);
//             $urutan++;  
//             $hurufpembayaran = "T";
//             $idpembayaran = $hurufpembayaran. sprintf("%03s", $urutan);

//             $idkamar = $fetcharray['ID_Kamar'];
//             $idpenyewa = $fetcharray['ID_Penyewa'];
//             $jatuhtempokemarin = $fetcharray['jatuhtempo'];
//             $jatuhtemposelanjutnya = date('Y/m/d', strtotime('+1 Months', strtotime($jatuhtempokemarin)));
//             $biaya = $fetcharray['Biaya'];
//             $angkajatuhtempo = date('m', strtotime($jatuhtempokemarin));
//             $angkatgl_skr = date('m', strtotime($tgl_skr));
//             date_default_timezone_set('Asia/Jakarta');
//             $tgltagih = date("Y-m-d H:i:s");
//             if($angkajatuhtempo!=$angkatgl_skr){
//             $addtotable = mysqli_query($conn, "insert into tagihan(ID_Tagihan, ID_Admin, ID_Penyewa, ID_Kamar, tanggaltagih, jatuh_tempo) values('$idtagihan', '$ambilidadmin', '$idpenyewa', '$idkamar', '$tgltagih', '$jatuhtemposelanjutnya')");
//             $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (ID_Pembayaran, ID_Admin, ID_Penyewa, ID_Tagihan, sisatagihan, Keterangan) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$idtagihan', '$biaya', 'Belum Bayar')");
//             }
//     }
//     }
// }

// //menambah data admin
// if(isset($_POST['addnewadmin'])){
//     //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
//     $queryadmin= mysqli_query($conn, "SELECT max(ID_Admin) as id_terbesar FROM login");
//     $dataadmin = mysqli_fetch_array($queryadmin);
//     $kodeadmin = $dataadmin['id_terbesar'];
//     $urutan = (int) substr($kodeadmin, 2, 4);
//     $urutan++;  
//     $hurufadmin = "A";
//     $idadmin = $hurufadmin. sprintf("%03s", $urutan);
    
//     $namaadmin=$_POST['namaadmin'];
//     $emailadmin=$_POST['emailadmin'];
//     $passwordadmin=$_POST['password'];
//     $lvladmin=$_POST['statusadmin'];
//     $addtotableadmin = mysqli_query($conn, "insert into login (ID_Admin, Nama_Admin, Email, Password, lvl) values('$idadmin', '$namaadmin', '$emailadmin', '$passwordadmin', '$lvladmin')");
// }

// //update atau edit info penyewa
// if(isset($_POST['updatepenyewa'])){
//     $idpenyewa = $_POST['idpenyewa'];
//     $namapenyewa = $_POST['nama_penyewa'];
//     $nomorhandphone = $_POST['nomor_handphone'];
//     $alamatrumah = $_POST['alamat_rumah'];
//     $tanggalmasuk = $_POST['tanggal_masuk'];
//     $jatuhtempo = date('y/m/d', strtotime('+1 months', strtotime($tanggalmasuk)));

//     $update = mysqli_query($conn, "update data_penyewa set Nama_Penyewa = '$namapenyewa', Nomor_Handphone = '$nomorhandphone', Alamat_Rumah = '$alamatrumah', Tanggal_Masuk = '$tanggalmasuk' where ID_Penyewa = '$idpenyewa'");
//     $updatejatuhtempo = mysqli_query($conn, "update tagihan set jatuh_tempo = '$jatuhtempo' where ID_Penyewa = '$idpenyewa'");
// }

// //menghapus penyewa 
// if(isset($_POST['hapuspenyewa'])){
//     $idpenyewa = $_POST['idpenyewa'];
//     $nomorkamar = $_POST['nomorkamar'];
//     $updatestatuskamar = mysqli_query($conn, "update data_kamar set Status = 'Kosong' where No_Kamar = '$nomorkamar'");
//     $hapustransaksi = mysqli_query($conn, "delete from data_transaksi where ID_Penyewa = '$idpenyewa'");
//     $hapus = mysqli_query($conn, "delete from data_penyewa where ID_Penyewa = '$idpenyewa'");
// }


// //update atau edit info kamar
// if(isset($_POST['updatekamar'])){
//     $idkamar = $_POST['idkamar'];
//     $nomorkamar = $_POST['nomorkamar'];
//     $jeniskamar = $_POST['jeniskamar'];
//     $jumlahfasilitas = $_POST['jumlahfasilitas'];
//     $biaya = $_POST['biaya'];

    
//     $update = mysqli_query($conn, "update data_kamar set No_Kamar = '$nomorkamar', Jenis_Kamar = '$jeniskamar', Jumlah_Fasilitas = '$jumlahfasilitas', biaya = '$biaya' where ID_Kamar = '$idkamar'");
// }

// //menghapus kamar
// if(isset($_POST['hapuskamar'])){
//     $idkamar = $_POST['idkamar'];
//     $hapus = mysqli_query($conn, "delete from data_kamar where ID_Kamar = '$idkamar'");
// }

//update atau edit info laporan
// if(isset($_POST['updatelaporan'])){
//     $emailadmin = $_SESSION['username'];
//     $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
//     $idadmin = mysqli_fetch_array($ambiladmin);
//     $ambilidadmin = $idadmin['idadmin'];
//     $idpembayaran = $_POST['idpembayaran'];
//     $tanggaltransaksi = $_POST['tanggaltransaksi'];
//     $totaltagihan = $_POST['tagih'];
//     $dibayar = $_POST['bayar'];
    
//     date_default_timezone_set('Asia/Jakarta');
//     $wkttransaksi = date("Y-m-d H:i:s");
//     $sisatagihan = $totaltagihan - $dibayar;
//     if($sisatagihan>0){
//         $keterangan = "Cicil";
//     }else{
//         $keterangan = "Lunas";
//     }

//     $update = mysqli_query($conn, "update data_transaksi set ID_Pembayaran = '$idpembayaran', ID_Admin = '$ambilidadmin', Tanggal_Bayar = '$tanggaltransaksi', sisatagihan = '$sisatagihan', Keterangan = '$keterangan' where ID_Pembayaran = '$idpembayaran'");
//     $insertrekaman = mysqli_query($conn, "insert into data_rekaman(ID_Pembayaran, waktutransaksi, keterangantransaksi) values('$idpembayaran', '$wkttransaksi', '$keterangan')");
// }

//menghapus laporan
if(isset($_POST['hapuslaporan'])){
    $idpembayaran = $_POST['idpembayaran'];
    $hapus = mysqli_query($conn, "delete from data_transaksi where ID_Pembayaran = '$idpembayaran'");
}

if(isset($_POST['updateadmin'])){
    $idadmin=$_POST['idadmin'];
    $namaadmin=$_POST['namaadmin'];
    $emailadmin=$_POST['emailadmin'];
    $passwordadmin=$_POST['password'];
    $lvladmin=$_POST['statusadmin'];
    
    $updateadmin = mysqli_query($conn, "update login set Nama_Admin = '$namaadmin', Email = '$emailadmin', Password = '$passwordadmin', lvl = '$lvladmin' where ID_Admin = '$idadmin'");
}
?>