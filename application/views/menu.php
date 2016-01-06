<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Sistem Informasi Gudang Gabah</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<?php echo $this->session->userdata('nama'); ?> <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="<?php echo site_url('gudanggabah/setting'); ?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
				</li>
				<li class="divider"></li>
				<li><a href="<?php echo site_url('gudanggabah/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li>
					<a <?php echo $menu=='a'?'class="active"':''; ?> href="<?php echo site_url('gudanggabah/index'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
				</li>
				<li>
					<a <?php echo $menu=='b'?'class="active"':''; ?> href="<?php echo site_url('gudanggabah/dataRekening'); ?>"><i class="fa fa-dashboard fa-fw"></i> Rekening</a>
				</li>
				<li>
					<a <?php echo $menu=='c'?'class="active"':''; ?> href="<?php echo site_url('gudanggabah/saldoAwal'); ?>"><i class="fa fa-dashboard fa-fw"></i> Saldo Awal</a>
				</li>
				<li>
					<a <?php echo $menu=='d'?'class="active"':''; ?> href="<?php echo site_url('gudanggabah/Jurnal'); ?>"><i class="fa fa-dashboard fa-fw"></i> Jurnal</a>
				</li>
				<li>
					<a <?php echo $menu=='e'?'class="active"':''; ?> href="<?php echo site_url('gudanggabah/bukuBesar'); ?>"><i class="fa fa-dashboard fa-fw"></i> Buku Besar</a>
				</li>
				<li>
					<a <?php echo $menu=='f'?'class="active"':''; ?> href="<?php echo site_url('gudanggabah/neraca'); ?>"><i class="fa fa-dashboard fa-fw"></i> Neraca</a>
				</li>
				<li>
					<a <?php echo $menu=='g'?'class="active"':''; ?> href="<?php echo site_url('gudanggabah/labaRugi'); ?>"><i class="fa fa-dashboard fa-fw"></i> Laba Rugi</a>
				</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>

<div id="page-wrapper">
