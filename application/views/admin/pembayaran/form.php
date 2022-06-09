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

			<div class="card card-primary">
				<form action="<?= isset($edit) ? base_url('admin/Pembayaran/update/' . $pembayaran->id) : base_url('admin/Pembayaran/store') ?>" method="POST">
					<div class="card-header">
						<h3 class="card-title"><?= isset($edit) ? "Edit metode" : "Buat Metode" ?></h3>
					</div>
					<div class="card-body col-sm-6">
						<div class="form-group row">
							<label for="username" class="col-sm-3">Metode Pembayaran</label>
							<input type="text" class="form-control col-sm-9" name="method" id="metode" value="<?= isset($edit) ? $pembayaran->nama : "" ?>" placeholder="Masukkan metode pembayaran......">
						</div>
                        <div class="form-group row">
							<label for="name" class="col-sm-3">Deskripsi</label>
							<textarea class="form-control col-sm-9" name="deskripsi" id="deskripsi"><?= isset($edit) ? $pembayaran->deskripsi : "" ?></textarea>
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