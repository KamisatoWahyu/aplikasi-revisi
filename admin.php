<?php
$emailadmin = $_SESSION['username'];
$ambiladmin = mysqli_query($conn, "SELECT lvl, Nama_Admin as namaadmin FROM login Where Email = '$emailadmin'");
$namaadmin = mysqli_fetch_array($ambiladmin);
$ambilnamanya = $namaadmin['namaadmin'];
$lvladmin = $namaadmin['lvl'];

?>