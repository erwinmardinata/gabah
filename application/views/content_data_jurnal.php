<link href="<?php echo base_url('assets/css/jquery-ui.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
<script>
$(document).ready(function() {
	$('#cari').click(function() {
		var tgl1 = $('#tgl1').val();
		var tgl2 = $('#tgl2').val();
		if(tgl1 == '' || tgl2 == '') {
			return alert('mohon diisi dulu');
		}
		
		document.location.href = "<?php echo site_url('gudanggabah/jurnal/'); ?>" + "/" + tgl1 + "/" + tgl2;
	});
	$('#tgl1').datepicker({
		dateFormat: 'yy-mm-dd',
		inline: true
	});
	$('#tgl2').datepicker({
		dateFormat: 'yy-mm-dd',
		inline: true
	});
});
</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Data Jurnal</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
	    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <div class="navbar-form navbar-left">
			<input type="text" class="form-control" id="tgl1" placeholder="Masukkan Tanggal ke-1">	
			<input type="text" class="form-control" id="tgl2" placeholder="Masukkan Tanggal ke-2">	
			<button class="btn btn-default" id="cari">Cari</button>
			| <button onclick="location.href='<?php echo site_url("gudanggabah/inputJurnal"); ?>'" class="btn btn-default" id="submit">Tambah Data</button>
		</div>
      </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

	<div class="panel panel-default">	
	  <div class="panel-heading">
		<h3 class="panel-title">Jurnal</h3>
	  </div>
	  <div class="panel-body">
		  <div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>No. Bukti</th>
						<th>No. Rekening</th>
						<th>Nama Rekening</th>
						<th>Bertambah</th>
						<th>Berkurang</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php if($query == null) { ?>
					<tr>
						<td colspan="8" align="center"> - data kosong - </td>
					</tr>
				<?php } else {
					$x=1; $t=0; $k=0; 
					foreach($query as $row): 
				?>
					<tr>
						<td><?php echo $x; ?></td>
						<td><?php echo $row->tanggal; ?></td>
						<td><?php echo $row->nomor_bukti; ?></td>
						<td><?php echo $row->kode; ?></td>
						<td><?php echo $row->nama; ?></td>
						<td><?php echo 'Rp. '.number_format($row->bertambah, 0, '',',').',-'; ?></td>
						<td><?php echo 'Rp. '.number_format($row->berkurang, 0, '',',').',-'; ?></td>
						<td>
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								Aksi <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo site_url('gudanggabah/updateJurnal/'.$row->id); ?>">Edit</a></li>
								<li><a onclick="return confirm('anda yakin ?')" href="<?php echo site_url('gudanggabah/hapusJurnal/'.$row->kode); ?>">Hapus</a></li>
							  </ul>
							</div>						
						</td>
					</tr>
				<?php 
					$x++; $t = $t + $row->bertambah; $k = $k + $row->berkurang;
					endforeach; 
				?>
					<tr>
						<td colspan="5">Jumlah</td>
						<td><?php echo 'Rp. '.number_format($t, 0, '',',').',-'; ?></td>
						<td><?php echo 'Rp. '.number_format($k, 0, '',',').',-'; ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		  </div>
	  </div>
	</div>
</div>
<!-- /.row -->