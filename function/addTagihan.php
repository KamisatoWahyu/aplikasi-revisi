<?php
if(isset($_POST['addnewtagihan'])){     
    //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
    $tabeltagihan = mysqli_query($conn, "SELECT * from data_transaksi");
    $cektabeltagihan = mysqli_num_rows($tabeltagihan);

    $username = $_SESSION['username'];
    $ambiladmin = mysqli_query($conn, "SELECT idAdmin as idadmin FROM login Where namaAdmin = '$username'");
    $idadmin = mysqli_fetch_array($ambiladmin);
    $ambilidadmin = $idadmin['idadmin'];

    if($cektabeltagihan < 1){
        $ambildata = mysqli_query($conn, "SELECT 
        k.idKamar, k.noKamar, p.idPenyewa, p.tanggalMasuk, k.biaya  
        from data_penyewa p inner join data_kamar k on p.idKamar = k.idKamar");
        
        while($fetcharray = mysqli_fetch_array($ambildata)){
            //Untuk mengatur id pembayaran
            $querypembayaran = mysqli_query($conn, "SELECT max(idPembayaran) as id_terbesar FROM data_transaksi");
            $datapembayaran = mysqli_fetch_array($querypembayaran);
            $kodepembayaran = $datapembayaran['id_terbesar'];
            $urutan = (int) substr($kodepembayaran, 3, 7);
            $urutan++;  
            $hurufpembayaran = "TR";
            $idpembayaran = $hurufpembayaran. sprintf("%05s", $urutan);
        
            $idkamar = $fetcharray['idKamar'];
            $idpenyewa = $fetcharray['idPenyewa'];
            $jatuhtempo = $fetcharray['tanggalMasuk'];
            $biaya = $fetcharray['biaya'];
            date_default_timezone_set('Asia/Jakarta');
            $tgltagih = date("Y-m-d H:i:s");
            $username = $_SESSION['username'];
            $ambiladmin = mysqli_query($conn, "SELECT idAdmin as idadmin FROM login Where namaAdmin = '$username'");
            $idadmin = mysqli_fetch_array($ambiladmin);
            $ambilidadmin = $idadmin['idAdmin'];
            
            $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (idPembayaran, idAdmin, idPenyewa, sisaTagihan, keterangan, tanggalTagih, jatuhTempo) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$biaya', 'Belum Bayar', '$tgltagih', '$jatuhtemposelanjutnya')");

            }}elseif($cektabeltagihan >= 1){
            $tgl_skr = date('Y/m/d');

            $ambildata = mysqli_query($conn, 
            "SELECT t.idPenyewa, 
            k.idKamar, 
            k.biaya, 
            MAX(t.jatuhtempo) as jatuhTempo 
            from data_transaksi t
            inner join data_penyewa p
            on t.idPenyewa = p.idPenyewa 
            inner join data_kamar k 
            on p.idKamar = k.idKamar 
            group by idPenyewa");

            while($fetcharray = mysqli_fetch_array($ambildata)){
            $queryTagihan = mysqli_query($conn, "SELECT max(idPembayaran) as id_terbesar FROM data_transaksi");
            $dataTagihan = mysqli_fetch_array($queryTagihan);
            $kodeTagihan = $dataTagihan['id_terbesar'];
            $urutan = (int) substr($kodeTagihan, 3, 7);
            $urutan++; 
            $hurufTagihan = "TR";
            $idpembayaran= $hurufTagihan . sprintf("%05s", $urutan);

            // $querypembayaran = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
            // $datapembayaran = mysqli_fetch_array($querypembayaran);
            // $kodepembayaran = $datapembayaran['id_terbesar'];
            // $urutan = (int) substr($kodepembayaran, 2, 4);
            // $urutan++;  
            // $hurufpembayaran = "T";
            // $idpembayaran = $hurufpembayaran. sprintf("%03s", $urutan);

            $idkamar = $fetcharray['idKamar'];
            $idpenyewa = $fetcharray['idPenyewa'];
            $jatuhtempokemarin = $fetcharray['jatuhTempo'];
            $jatuhtemposelanjutnya = date('Y/m/d', strtotime('+1 Months', strtotime($jatuhtempokemarin)));
            $biaya = $fetcharray['biaya'];
            $angkajatuhtempo = date('m', strtotime($jatuhtempokemarin));
            $angkatgl_skr = date('m', strtotime($tgl_skr));
            date_default_timezone_set('Asia/Jakarta');
            $tgltagih = date("Y-m-d H:i:s");
            if($angkajatuhtempo!=$angkatgl_skr){
        
            $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (idPembayaran, idAdmin, idPenyewa, sisaTagihan, keterangan, tanggalTagih, jatuhTempo) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$biaya', 'Belum Bayar', '$tgltagih', '$jatuhtemposelanjutnya')");
            }
    }
    }
}
?>