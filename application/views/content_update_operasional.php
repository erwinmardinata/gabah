<script>
	$(document).ready(function() {
		$('#induk').change(function() {
			var id = $('#induk').val();
			if(id == 2) {
				$('#value').html("<div class='form-group'> " +
									"<label class='col-sm-4 control-label'>Rekening Induk</label>" +
									"<div class='col-sm-8'>" +
										"<select class='form-control' name='lr'>" +
											"<option value=''></option>" +
											"<option value='3'>Penjualan</option>" +
											"<option value='2'>HPP</option>" +
											"<option value='1'>Biaya</option>" +
										"</select>" +
									"</div>" +
								  "</div>");
			} else {
				$('#value').html("<div class='form-group'> " +
									"<label class='col-sm-4 control-label'>Rekening Induk</label>" +
									"<div class='col-sm-8'>" +
										"<select class='form-control' name='lr'>" +
											"<option value=''></option>" +
											"<option value='5'>Aset</option>" +
											"<option value='4'>Kewajiban</option>" +
										"</select>" +
									"</div>" +
								  "</div>");				
			} 
		});
	});
</script>
<div class="modal-content">
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('gudanggabah/prosesUpdateRekening'); ?>">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel">Modal title</h4>
  </div>
  <div class="modal-body">
	  <div class="form-group">
		<label class="col-sm-4 control-label">Rekening Induk</label>
		<div class="col-sm-8">
			<select class="form-control" name="induk" id="induk">
				<option value=""> -pilih Rekening Induk- </option>
				<?php foreach($induk as $row){ ?>
					<option value="<?php echo $row->id; ?>"><?php echo $row->nama; ?></option>
				<?php } ?>
			</select>
		</div>
	  </div>
	  <div id="value">
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label">Kode Rekening</label>
		<div class="col-sm-8">
		  <input type="hidden" name="aksi" value="<?php echo $aksi; ?>">
		  <input type="text" name="kode" value="<?php echo $kode; ?>" readonly class="form-control" placeholder="Kode">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label">Nama Rekening</label>
		<div class="col-sm-8">
		  <input type="text" name="nama" value="<?php echo $nama; ?>" class="form-control" placeholder="Nama">
		</div>
	  </div>
  </div>
  <div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary">Save changes</button>
  </div>
</form>
</div>