<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-4">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Tipe Lomba</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Tipe Lomba</li>
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
				<form action="<?= isset($edit) ? base_url('admin/Tipelomba/update/' . $tipe_lomba->id) : base_url('admin/Tipelomba/store') ?>" method="POST" enctype="multipart/form-data">
					<div class="card-header">
						<h3 class="card-title"><?= isset($edit) ? "Edit Tipe Lomba" : "Create Tipe Lomba" ?></h3>
					</div>
					<div class="form-group row">
						<label for="nama" class="col-sm-2">Nama Lomba</label>
						<input type="text" class="form-control col-sm-6" name="nama" id="nama" value="<?= isset($edit) ? $tipe_lomba->nama : "" ?>">
					</div>
					<div class="form-group row">
						<label for="file" class="col-sm-2">Poster</label>
						<input type="file" name="file" id="file" class="form-control-file col-sm-6" class="form-control">
					</div>
					<div class="form-group row">
						<label for="deskripsi" class="col-sm-2">Deskripsi</label>
						<textarea class="form-control col-sm-6" name="deskripsi" id="deskripsi" cols="30" rows="10"><?= isset($edit) ? $tipe_lomba->deskripsi : "" ?></textarea>
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