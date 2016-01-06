<script>
	$(document).ready(function() {
		$('#submit').click(function() {
			var id = $('#periode').val();
			if(id == "") {
				return alert('pilih periode dulu');
			}
			document.location.href="<?php echo site_url('gudanggabah/saldoAwal/'); ?>" + "/periode/" + id;
		});
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Saldo Awal</h1>
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
        <select class="form-control" id="periode" required>
          <option value=""> - Pilih Periode - </option>
		  <option value="2016">2016</option>
		  <option value="2017">2017</option>
		  <option value="2018">2018</option>
        </select>
        <button class="btn btn-default" id="submit">Cari</button>
		<button onclick="location.href='<?php echo site_url("gudanggabah/inputSaldoAwal"); ?>'" class="btn btn-default" id="submit">Tambah Data</button>
		</div>
      </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

	<div class="panel panel-default">	
	  <div class="panel-heading">
		<h3 class="panel-title">Saldo Awal</h3>
	  </div>
	  <div class="panel-body">
		  <div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>No. Rekening</th>
						<th>Nama Rekening</th>
						<th>Saldo</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php if($query == null) { ?>
					<tr>
						<td colspan="5" align="center"> - Data Kosong - </td>
					</tr>					
				<?php 
				} else {
					$x=1; $s=0; 
					foreach($query as $row): 
				?>
					<tr>
						<td><?php echo $x; ?></td>
						<td><?php echo $row->kode; ?></td>
						<td><?php echo $row->nama; ?></td>
						<td><?php echo 'Rp. '.number_format($row->saldo, 0, '', '.').',-'; ?></td>
						<td>
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								Aksi <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo site_url('gudanggabah/updateSaldoAwal/'.$row->id); ?>">Edit</a></li>
								<li><a onclick="return confirm('anda yakin ?')" href="<?php echo site_url('gudanggabah/hapusSaldoAwal/'.$row->id); ?>">Hapus</a></li>
							  </ul>
							</div>						
						</td>
					</tr>
				<?php 
					$x++; $s = $s + $row->saldo;
					endforeach;
				?>
					<tr>
						<td colspan="3" align="center">Jumlah</td>
						<td><?php echo 'Rp. '.number_format($s, 0, '','.').',-'; ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		  </div>
	  </div>
	</div>
</div>
<!-- /.row -->