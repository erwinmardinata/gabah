<script>
$(document).ready(function(){
	$('#kat').change(function(){
		var kode = $('#kat').val();

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('gudanggabah/getSubkategori'); ?>",
			data: {'kode':kode},
			success: function(data) {
				$("#subkat").html(data);
			}
		});
	});

  $('#submit').click(function(){
    var kode = $('#subkat').val();
    if(kode == '') {
      return alert('Pilih Sub kategori dulu');
    }
    document.location.href="<?php echo site_url('gudanggabah/laporan'); ?>" + "/" + kode;
  });
});
</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title; ?></h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-12">
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
        <select class="form-control" id="kat" required>
          <option value=""> - Pilih Operasional - </option>
          <?php
            foreach($kategori as $row){
              echo "<option value=".$row->kode_operasional.">".$row->nama_operasional."</option>";
            }
          ?>
        </select>
        <select class="form-control" id="subkat" required>
          <option value=""> - Pilih Operasi dulu - </option>
          <?php
            foreach($prodi as $row){
              echo "<option value=".$row->id_prodi.">".$row->nama_prodi."</option>";
            }
          ?>
        </select>
        <button class="btn btn-default" id="submit">Cari</button>
        </div>
				<div class="navbar-form navbar-right">
					<button class="btn btn-default" id="submit">Neraca</button>
					<button class="btn btn-default" id="submit">Laba Rugi</button>					
				</div>
      </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
