<script>
$(document).ready(function(){
	$('#nama').change(function(){
		var kode = $('#nama').val();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('gudanggabah/getKodeRekening'); ?>",
			data: {'kode':kode},
			success: function(data) {
				$("#nomor").html(data);
			}
		});
	});
	$('#nilai').maskMoney();
});

</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Input Saldo Awal</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="panel panel-default">	
	  <div class="panel-heading">
		<h3 class="panel-title">Tabel Input Saldo Awal</h3>
	  </div>
	  <div class="panel-body">
	  <div class="col-md-8">
		<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('gudanggabah/prosesSaldoAwal'); ?>">
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Periode</label>
			<div class="col-sm-9">
				<select class="form-control" name="periode">
					<option value=""></option>
 					<option <?php echo $periode=='2016'?'selected':''; ?> value="2016">2016</option>
					<option <?php echo $periode=='2017'?'selected':''; ?> value="2017">2017</option>
					<option <?php echo $periode=='2018'?'selected':''; ?> value="2018">2018</option>
				</select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Nama Rekening</label>
			<div class="col-sm-9">
				<select class="form-control" name="nama" id="nama">
					<option value=""></option>
					<?php foreach($nomor as $row){ ?>
						<option <?php echo $nama==$row->kode?'selected':''; ?> value="<?php echo $row->kode; ?>"><?php echo $row->nama; ?></option>
					<?php } ?>
				</select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Nomor Rekening</label>
			<div class="col-sm-9">
				<select class="form-control" name="kode" id="nomor">
				<?php if($kode == null) { ?> 
					<option value=""></option>
				<?php } else { ?>
					<option><?php echo $nama; ?></option>
				<?php } ?>
				</select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Nominal</label>
			<div class="col-sm-9">
				<input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control">
				<input type="hidden" name="aksi" value="<?php echo $aksi; ?>" class="form-control">
				<input type="text" name="nominal" id="nilai" class="form-control">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
			  <button type="submit" name="submit" value="tambah" class="btn btn-default">Tambah</button>
			  <button type="submit" name="submit" value="kurang" class="btn btn-default">Kurang</button>
			</div>
		  </div>
		</form>		
	  </div>
	  </div>
	</div>
</div>
<!-- /.row -->