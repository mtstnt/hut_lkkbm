<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-4">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Vendor</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Vendor</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<div class="card card-primary">
				<form action="<?= isset($edit) ? base_url('admin/vendor/update/' . $vendor->id) : base_url('admin/vendor/store') ?>" method="POST" enctype="multipart/form-data">
					<div class="card-header">
						<h3 class="card-title"><?= isset($edit) ? "Edit Vendor" : "Create Vendor" ?></h3>
					</div>
					<div class="card-body col-sm-6">
						<div class="form-group row">
							<label for="name" class="col-sm-3">Nama Vendor</label>
							<input type="text" class="form-control col-sm-9" name="namaVendor" id="namaVendor" value="<?= isset($edit) ? $vendor->nama : "" ?>" placeholder="Enter name...">
						</div>
						<div class="form-group row">
							<label for="logo" class="col-sm-3">Logo</label>
							<input type="file" name="file" id="file" class="form-control col-sm-9">
						</div>
						<div class="form-group row">
							<label for="total_donasi" class="col-sm-3">Deskripsi</label>
							<textarea class="form-control col-sm-9" name="desVendor" id="desVendor" cols="30" rows="10"><?= isset($edit) ? $vendor->deskripsi : "" ?></textarea>
						</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary float-right">Submit</button>
					</div>
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