<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Setting</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
		  <div class="panel-body">
			<h3>Ganti Password</h3><hr>
			<?php echo $info; ?>
			<form method="post" action="<?php echo site_url('gudanggabah/prosesGantiPassword'); ?>">
			 <label>Password Lama :</label>
				<input type="password" name="password" class="form-control" />
				<label>Password Baru :  </label>
				<input type="password" name="password1" class="form-control" />
				<label>Ulangi Password Baru :  </label>
				<input type="password" name="password2" class="form-control" />
				<hr />
				<button type="submit" class="btn btn-info btn-block"><span class="glyphicon glyphicon-user"></span> &nbsp;Simpan </button>&nbsp;
			</form>

		  </div>
		</div>					
	</div>
</div>
<!-- /.row -->