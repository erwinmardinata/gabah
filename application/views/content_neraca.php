<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Neraca Saldo</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="panel panel-default">	
	  <div class="panel-heading">
		<h3 class="panel-title">Neraca</h3>
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
						<th>Kewajiban</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$x=1; $a=0; $k=0; 
					foreach($query as $row): 
				?>
					<tr>
						<td><?php echo $x; ?></td>
						<td><?php echo $row->kode; ?></td>
						<td><?php echo $row->nama; ?></td>
						<td><?php echo 'Rp. '.number_format($row->saldo_aset, 0, '',',').',-'; ?></td>
						<td><?php echo 'Rp. '.number_format($row->saldo_kewajiban, 0, '',',').',-'; ?></td>
					</tr>
				<?php 
					$x++; $a = $a + $row->saldo_aset; $k = $k + $row->saldo_kewajiban;
					endforeach; 
				?>
					<tr>
						<td colspan="3">Jumlah</td>
						<td><?php echo 'Rp. '.number_format($a, 0, '',',').',-'; ?></td>
						<td><?php echo 'Rp. '.number_format($k, 0, '',',').',-'; ?></td>
					</tr>
				<?php
					$p=0; $h=0; $b=0;
					foreach($labarugi as $row):
					$p = $p + $row->penjualan; 
					$h = $h + $row->hpp; 
					$b = $b + $row->biaya;
					endforeach;
				?>
					<tr>
						<td colspan="3">Laba Kotor</td>
						<td colspan="2"><?php $lk = $p-$h; echo 'Rp. '.number_format($lk, 0, '',',').',-'; ?></td>
					</tr>
					<tr>
						<td colspan="3">Laba Bersih</td>
						<td colspan="2"><?php $lb = $lk - $b; echo 'Rp. '.number_format($lb, 0, '',',').',-'; ?></td>
					</tr>
				</tbody>
				</tbody>
			</table>
		  </div>
	  </div>
	</div>
</div>
<!-- /.row -->