<?php
require 'function.php';
require 'cek.php';
?>
<html>
<head>
  <title>Export data tagihan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
    <br>
    <br>
			<h1>Data Tagihan</h1>
            <br>
            <h8>Pilih bentuk data atau fitur yang ingin digunakan</h8>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                <thead>
                                            <tr>
                                                <th>Nama Admin</th>
                                                <th>Nama Penyewa</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Tagihan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $ambilsemuadatapenyewa = mysqli_query($conn, "select l.Nama_Admin, p.Nama_Penyewa, t.jatuh_tempo, k.Biaya 
                                        from login l, data_penyewa p, data_kamar k, tagihan t where t.ID_Admin = l.ID_Admin AND t.ID_Penyewa = p.ID_Penyewa AND t.ID_Kamar = k.ID_Kamar");
                                        while($data=mysqli_fetch_array($ambilsemuadatapenyewa)){
                                            $namaadmin = $data['Nama_Admin'];
                                            $namapenyewa = $data['Nama_Penyewa'];
                                            $jatuhtempo = $data['jatuh_tempo'];
                                            $biaya = $data['Biaya'];
                                        ?>
                                            <tr>
                                                <td><?php echo $namaadmin?></td>
                                                <td><?php echo $namapenyewa?></td>
                                                <td><?php echo date("d/M/Y", strtotime($jatuhtempo))?></td>
                                                <td><?php echo "Rp".$biaya?></td>    
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>