<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/assets/bootstrap/css/bootstrap.min.css') ?>"/>
		<link rel="stylesheet" href="<?php echo base_url('assets/assets/datatables/dataTables.bootstrap.css') ?>"/>
		<link rel="stylesheet" href="<?php echo base_url('assets/assets/datatables/dataTables.bootstrap.css') ?>"/>

		<link href="<?php echo base_url('') ?>assets/bs/css/bootstrap.min.css" rel='stylesheet' type='text/css' />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
			<div class="container">
				<h1>Pelanggan</h1>
				<table class="table table-bordered table-responsive table-hover" id="example">
			<thead>
				<th>No Sambungan</th>
				<th>Nama</th>
				<th>Alamat</th>
			</thead>
			<tbody>
			<?php
				foreach($data1->result() as $pelanggan){
				 echo "<tr>
				 <td>$pelanggan->nosamb</td>
				 <td>$pelanggan->nama</td>
				 <td>$pelanggan->alamat</td>
				</tr>";
				}
			?>
		</tbody>
		</table>
			</div>
		
		
		

		

		<!-- jQuery -->
		<script src="<?php echo base_url('') ?>assets/bs/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url('') ?>assets/bs/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="<?php echo base_url('') ?>assets/bs/js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->
   

		   <script src="<?php echo base_url('') ?>assets/bs/js/menu_jquery.js"></script>
 		<script>
 			<script type="text/javascript">
			  $(document).ready( function () {
			      $('#example').DataTable();
			  } ); 		
		</script>
	</body>
</html>