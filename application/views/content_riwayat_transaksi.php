<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Riwayat Transaksi</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-12">
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title"><?php echo $title; ?></h3>
	  </div>
	  <div class="panel-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="50px">No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Nama sub</th>
					<th>Nominal</th>
				</tr>
			</thead>
			<tbody>
			<?php if($query == null) { ?>
				<tr>
					<td colspan="4" align="center"> - Data Kosong - </td>
				</tr>
			<?php 
				} else { 
				$x=1; $jumlah=0; foreach($query as $row):
			?>
				<tr>
					<td><?php echo $x; ?></td>
					<td><?php echo $row->kode_operasional; ?></td>
					<td><?php echo $row->nama_operasional; ?></td>
					<td><?php echo $row->nama_sub_operasional; ?></td>
					<td><?php echo $row->nominal; ?></td>
				</tr>
			<?php $x++; $jumlah = $jumlah+$row->nominal; endforeach; } ?>
				<tr>
					<td colspan="4" align="center" ><strong>Jumlah</strong></td>
					<td><?php echo $jumlah; ?></td>
				</tr>
			</tbody>
		</table>
	  </div>
	</div>
	</div>
</div>
<!-- /.row -->