<?php
if(isset($_POST['addnewtagihan'])){     
    //tutorial dari malasngoding.com__Membuat Kode Otomatis Dengan PHP dan MySQLi hehe akhirnya
    $tabeltagihan = mysqli_query($conn, "SELECT * from data_transaksi");
    $cektabeltagihan = mysqli_num_rows($tabeltagihan);

    $emailadmin = $_SESSION['username'];
    $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
    $idadmin = mysqli_fetch_array($ambiladmin);
    $ambilidadmin = $idadmin['idadmin'];

    if($cektabeltagihan < 1){
        $ambildata = mysqli_query($conn, "SELECT k.ID_Kamar, k.No_Kamar, p.ID_Penyewa, p.Tanggal_Masuk, k.Biaya  
        from data_penyewa p left join data_kamar k on p.ID_Kamar = k.ID_Kamar");
        while($fetcharray = mysqli_fetch_array($ambildata)){
            //Untuk mengatur id tagihan
            // $queryTagihan = mysqli_query($conn, "SELECT max(ID_Tagihan) as id_terbesar FROM tagihan");
            // $dataTagihan = mysqli_fetch_array($queryTagihan);
            // $kodeTagihan = $dataTagihan['id_terbesar'];
            // $urutan = (int) substr($kodeTagihan, 3, 7);
            // $urutan++; 
            // $hurufTagihan = "TG";
            // $idtagihan = $hurufTagihan . sprintf("%05s", $urutan);

            //Untuk mengatur id pembayaran
            $querypembayaran = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
            $datapembayaran = mysqli_fetch_array($querypembayaran);
            $kodepembayaran = $datapembayaran['id_terbesar'];
            $urutan = (int) substr($kodepembayaran, 3, 7);
            $urutan++;  
            $hurufpembayaran = "TR";
            $idpembayaran = $hurufpembayaran. sprintf("%05s", $urutan);
        
            $idkamar = $fetcharray['ID_Kamar'];
            $idpenyewa = $fetcharray['ID_Penyewa'];
            $jatuhtempo = $fetcharray['Tanggal_Masuk'];
            $biaya = $fetcharray['Biaya'];
            date_default_timezone_set('Asia/Jakarta');
            $tgltagih = date("Y-m-d H:i:s");
            $emailadmin = $_SESSION['username'];
            $ambiladmin = mysqli_query($conn, "SELECT ID_Admin as idadmin FROM login Where Email = '$emailadmin'");
            $idadmin = mysqli_fetch_array($ambiladmin);
            $ambilidadmin = $idadmin['idadmin'];
            
            $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (ID_Pembayaran, ID_Admin, ID_Penyewa, sisatagihan, Keterangan, tanggaltagih, jatuh_tempo) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$biaya', 'Belum Bayar', '$tgltagih', '$jatuhtemposelanjutnya')");

            }}elseif($cektabeltagihan >= 1){
            $tgl_skr = date('Y/m/d');

            $ambildata = mysqli_query($conn, 
            "SELECT t.ID_Penyewa, 
            k.ID_Kamar, 
            k.Biaya, 
            MAX(t.jatuh_tempo) as jatuhtempo 
            from data_transaksi t
            inner join data_penyewa p
            on t.ID_Penyewa = p.ID_Penyewa 
            inner join data_kamar k 
            on p.ID_Kamar = k.ID_Kamar 
            group by ID_Penyewa");

            while($fetcharray = mysqli_fetch_array($ambildata)){
            $queryTagihan = mysqli_query($conn, "SELECT max(ID_Pembayaran) as id_terbesar FROM data_transaksi");
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

            $idkamar = $fetcharray['ID_Kamar'];
            $idpenyewa = $fetcharray['ID_Penyewa'];
            $jatuhtempokemarin = $fetcharray['jatuhtempo'];
            $jatuhtemposelanjutnya = date('Y/m/d', strtotime('+1 Months', strtotime($jatuhtempokemarin)));
            $biaya = $fetcharray['Biaya'];
            $angkajatuhtempo = date('m', strtotime($jatuhtempokemarin));
            $angkatgl_skr = date('m', strtotime($tgl_skr));
            date_default_timezone_set('Asia/Jakarta');
            $tgltagih = date("Y-m-d H:i:s");
            if($angkajatuhtempo!=$angkatgl_skr){
        
            $addtotabletransaksi = mysqli_query($conn, "insert into data_transaksi (ID_Pembayaran, ID_Admin, ID_Penyewa, sisatagihan, Keterangan, tanggaltagih, jatuh_tempo) values('$idpembayaran', '$ambilidadmin', '$idpenyewa', '$biaya', 'Belum Bayar', '$tgltagih', '$jatuhtemposelanjutnya')");
            }
    }
    }
}
?>