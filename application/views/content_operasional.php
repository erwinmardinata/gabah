<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="body">
      </div>
  </div>
</div>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Rekening</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<?php echo $info; ?>
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">Tabel Rekening</h3>
	  </div>
	  <div class="panel-body">
		<table class="table table-bordered">
			<button style="float: right; margin-bottom: 12px" class="btn btn-primary" data-id="tambah" id="tambah" data-toggle="modal" data-target="#myModal">Tambah Data</button>
			<thead>
				<tr>
					<th width="50px">No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php if($query == null) { ?>
				<tr>
					<td colspan="4" align="center"> - Data Kosong - </td>
				</tr>
			<?php 
				} else { 
				$x=1; foreach($query as $row):
			?>
				<tr>
					<td><?php echo $x; ?></td>
					<td><?php echo $row->kode; ?></td>
					<td><?php echo $row->nama; ?></td>
					<td>
						<?php 
							$data = array('Biaya', 'HPP', 'Penjualan', 'Kewajiban', 'Aset');
							echo $data[$row->status-1];
						?>
					</td>
					<td>
						<div class="btn-group">
						  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							Aksi <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
							<li><a href="#" id="edit_data" data-id="<?php echo $row->kode; ?>">Edit</a></li>
							<li><a onclick="return confirm('Anda yakin ?')" href="<?php echo site_url('gudanggabah/deleteRekening/'.$row->kode); ?>">Hapus</a></li>
						  </ul>
						</div>
					</td>
				</tr>
			<?php $x++; endforeach; } ?>
			</tbody>
		</table>
	  </div>
	</div>
</div>
<!-- /.row -->

 <script>
	$(function(){
		$(document).on('click','#edit_data',function(e){
			e.preventDefault();
			$("#myModal").modal('show');
			$.post('<?php echo site_url('gudanggabah/editRekening'); ?>',
				{kode:$(this).attr('data-id')},
				function(html){
					$(".body").html(html);
				}   
			);
		});
		$(document).on('click','#tambah',function(e){
			e.preventDefault();
			$("#myModal").modal('show');
			$.post('<?php echo site_url('gudanggabah/tambahRekening'); ?>',
				{id:$(this).attr('')},
				function(html){
					$(".body").html(html);
				}   
			);
		});
	});
</script>
