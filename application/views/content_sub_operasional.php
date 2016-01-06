<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Data Sub Operasional</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url('gudanggabah/dataOperasional'); ?>">Data Operasional</a></li>
  <li class="active">Data Sub Operasional</li>
</ol>

	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">Tabel Data Sub Operasional</h3>
	  </div>
	  <div class="panel-body">
		<?php echo $info; ?>
		<form method="post" action="<?php echo site_url('gudanggabah/proses_tambahSubOperasional'); ?>" class="form-horizontal" role="form">
		  <div class="form-group">
			<label class="col-sm-2 control-label">Nama</label>
			<div class="col-sm-5">
			  <input type="hidden" name="kode" value="<?php echo $kode; ?>" class="form-control" placeholder="">
			  <input type="text" name="nama" class="form-control" placeholder="">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-primary">Simpan</button>
			  <button type="reset" class="btn btn-default">Reset</button>
			</div>
		  </div>
		</form>				

		<div class="col-md-8">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="50px">No</th>
						<th>Nama</th>
						<th width="100px"></th>
					</tr>
				</thead>
				<tbody>
				<?php if($query == null) { ?>
					<tr>
						<td align="center" colspan="3"> - Data Tidak Ada - </td>
					</tr>
				<?php } else { 
					$x=1; foreach($query as $row): 
				?>
					<tr>
						<td><?php echo $x; ?></td>
						<td><?php echo $row->nama_sub_operasional; ?></td>
						<td>
							<a onclick="return confirm('anda yakin ?')" href="<?php echo site_url('gudanggabah/hapusSubOperasional/'.$row->kode_operasional.'/'.$row->id); ?>" class="btn btn-default">Hapus</button>
						</td>
					</tr>
				<?php $x++; endforeach; } ?>
				</tbody>
			</table>
		</div>

		
	  </div>
	</div>

</div>
<!-- /.row -->
