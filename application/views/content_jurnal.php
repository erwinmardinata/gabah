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
		<h1 class="page-header">Input Jurnal</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="panel panel-default">	
	  <div class="panel-heading">
		<h3 class="panel-title">Tabel Input Jurnal</h3>
	  </div>
	  <div class="panel-body">
	  <div class="col-md-8">
		<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('gudanggabah/prosesInputJurnal'); ?>">
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Tanggal</label>
			<div class="col-sm-2">
				<select class="form-control" name="tgl" required>
					<option value=""> - Tgl - </option>
				<?php for($x=1; $x<=31; $x++) { ?>
					<option <?php echo $tgl==$x?'selected':''; ?> value="<?php echo $x; ?>"><?php echo $x; ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class="form-control" name="bln" required>
					<option value=""> - Bulan - </option>
					<option <?php echo $bln==1?'selected':''; ?> value="1">Januari</option>
					<option <?php echo $bln==2?'selected':''; ?> value="2">Februari</option>
					<option <?php echo $bln==3?'selected':''; ?> value="3">Maret</option>
					<option <?php echo $bln==4?'selected':''; ?> value="4">April</option>
					<option <?php echo $bln==5?'selected':''; ?> value="5">Mei</option>
					<option <?php echo $bln==6?'selected':''; ?> value="6">Juni</option>
					<option <?php echo $bln==7?'selected':''; ?> value="7">Juli</option>
					<option <?php echo $bln==8?'selected':''; ?> value="8">Agustus</option>
					<option <?php echo $bln==9?'selected':''; ?> value="9">September</option>
					<option <?php echo $bln==10?'selected':''; ?> value="10">Oktober</option>
					<option <?php echo $bln==11?'selected':''; ?> value="11">November</option>
					<option <?php echo $bln==12?'selected':''; ?> value="12">Desember</option>
				</select>
			</div>
			<div class="col-sm-3">
				<select class="form-control" name="thn" required>
					<option value=""> - Tahun - </option>
				<?php for($x=2016; $x<=2018; $x++) { ?>
					<option <?php echo $thn==$x?'selected':''; ?> value="<?php echo $x; ?>"><?php echo $x; ?></option>
				<?php } ?>
				</select>
			</div>

			</div>
		  <div class="form-group">
			<label class="col-sm-3 control-label">Nomor Bukti</label>
			<div class="col-sm-9">
				<input type="text" value="<?php echo $nomor_bukti; ?>" name="nomor_bukti" class="form-control">
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Keterangan</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="keterangan"><?php echo $keterangan; ?></textarea>
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
				<input type="hidden" value="<?php echo $id; ?>" name="id" class="form-control">
				<input type="hidden" value="<?php echo $aksi; ?>" name="aksi" class="form-control">
				<input type="text" id="nilai" value="<?php echo $nominal; ?>" name="nominal" class="form-control">
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