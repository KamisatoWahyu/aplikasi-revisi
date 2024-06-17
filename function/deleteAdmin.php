<?php
    if(isset($_POST['hapusadmin'])){
        $idAdmin = $_POST['idadmin'];
        $hapusAdmin = mysqli_query($conn, "DELETE FROM login where idAdmin = '$idAdmin'");

    }
?>