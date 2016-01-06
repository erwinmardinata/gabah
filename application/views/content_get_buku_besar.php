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
					<th>Tanggal</th>
					<th>No. Bukti</th>
					<th>Keterangan</th>
					<th>No. Rekening</th>
					<th>Nama Rekening</th>
					<th>Bertambah</th>
					<th>Berkurang</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
			<?php if(empty($saldo)) {?>
			<tr>
				<td colspan="9" align="center">- Data tidak ada -</td>
			</tr>
			
			<?php } else {?>
			<tr>
				<td colspan="8">Saldo awal tahun : <?php echo $saldo->periode; ?></td>
				<td><?php echo 'Rp. '.number_format($saldo->saldo, 0, '',',').',-'; ?></td>
			</tr>
			<?php 
			if($query == null) {
			?>
			<tr>
				<td colspan="9" align="center"> - Data Kosong - </td>
			</tr>
			<?php
			} else {
				$x=1; $total = $saldo->saldo;
				foreach($query as $row): 
				$total = $total + $row->bertambah - $row->berkurang;
			?>
				<tr>
					<td><?php echo $x; ?></td>
					<td><?php echo $row->tanggal; ?></td>
					<td><?php echo $row->nomor_bukti; ?></td>
					<td><?php echo $row->keterangan; ?></td>
					<td><?php echo $row->kode; ?></td>
					<td><?php echo $row->nama; ?></td>
					<td><?php echo 'Rp. '.number_format($row->bertambah, 0, '',',').',-'; ?></td>
					<td><?php echo 'Rp. '.number_format($row->berkurang, 0, '',',').',-'; ?></td>
					<td><?php echo 'Rp. '.number_format($total, 0, '',',').',-'; ?></td>
				</tr>
			<?php $x++; endforeach; } } ?>
			</tbody>
		</table>
	  </div>
  </div>
</div>
