<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-4">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Admin Manager</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Admin Manager</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<div class="card p-3">
				<form action="<?= isset($edit) ? base_url('admin/access/update/' . $admin->id) : base_url('admin/access/store') ?>" method="POST">
					<div class="form-group row">
						<label for="username" class="col-sm-2">Username</label>
						<input type="text" class="form-control col-sm-6" name="username" id="username" value="<?= isset($edit) ? $admin->username : "" ?>">
					</div>
					<div class="form-group row">
						<label for="password" class="col-sm-2">Password</label>
						<input type="password" class="form-control col-sm-6" name="password" id="password">
					</div>
					<button class="btn btn-primary float-right">Submit</button>
				</form>
			</div>
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
	$('#table').DataTable();
</script>