<script>
	$(document).ready(function() {
		$('#submit').click(function() {
			var thn = $('#thn').val();
			var bln = $('#bln').val();
			var kode = $('#kode').val();
			if(thn == "") {
				return alert("pilih dulu");
			} else if(bln == "") {
				return alert("pilih dulu");
			} else if(kode == "") {
				return alert("pilih dulu");
			}
			document.location.href="<?php echo site_url('gudanggabah/bukubesar/'); ?>" + "/" + thn + "/" + bln + "/" + kode;
		});
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Laporan Buku Besar</h1>
	</div>
</div>
<!-- /.row -->
<div class="row">
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
        <select class="form-control" id="thn" required>
          <option value=""> - Pilih Periode - </option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
          <option value="2018">2018</option>
        </select>
        <select class="form-control" id="bln" required>
          <option value=""> - Pilih Bulan - </option>
		  <?php
			for($x=1; $x<=12; $x++){
				echo "<option value=".$x.">".$x."</option>";
			}
		  ?>
        </select>
        <select class="form-control" id="kode" required>
          <option value="">No. Rekening</option>
		  <?php
			foreach($rekening as $row) {
				echo "<option value=".$row->kode.">".$row->kode." | ".$row->nama."</option>";
			}
		  ?>
        </select>
        <button class="btn btn-default" id="submit">Cari</button>
		</div>
      </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

</div>
<!-- /.row -->