<div class="col-md-4"></div>
<div class="col-md-4" style="padding-top: 77px">
<div class="panel panel-default">
  <div class="panel-body">
	<h3 class="page-header"><?php echo $title; ?></h3>
	<?php echo $info; ?>
		<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('gudanggabah/prosesLogin'); ?>">
		  <div class="form-group">
			<label class="col-sm-3 control-label">Username</label>
			<div class="col-sm-9">
			  <input type="text" name="username" class="form-control" placeholder="Username">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-3 control-label">Password</label>
			<div class="col-sm-9">
			  <input type="password" name="password" class="form-control" placeholder="Password">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
			  <button type="submit" class="btn btn-default">Sign in</button>
			</div>
		  </div>
		</form>

  </div>
</div>

</div>
<div class="col-md-4"></div>