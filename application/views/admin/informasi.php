<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-4">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">General</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">General</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<?php $this->view('layout/admin/flash') ?>

			<form action="<?= base_url('admin/informasi/update') ?>" method="POST">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Edit Form</h3>
					</div>
					<div class="card-body col-sm-6">
						<div class="form-group row">
							<label for="tanggal_acara" class="col-sm-3">Event Date</label>
							<input type="datetime-local" class="form-control col-sm-9" name="tanggal_acara" id="tanggal_acara" value="<?= date('Y-m-d\TH:i:s', strtotime($informasi->tanggal_acara)); ?>" placeholder="">
						</div>
						<div class="form-group row">
							<label for="target_donasi" class="col-sm-3 py-1">Target Donasi</label>
							<input type="number" class="form-control col-sm-9" name="target_donasi" id="target_donasi" value="<?= $informasi->target_donasi ?>">
						</div>
					</div>
				</div>

				<div class="card card-primary">
					<div class="card-body col-sm-6">
						<div class="form-group row">
							<label for="start_pendaftaran" class="col-sm-3">Start Pendaftaran</label>
							<input type="datetime-local" class="form-control col-sm-9" name="start_pendaftaran" id="start_pendaftaran" value="<?= !is_null($informasi->start_pendaftaran) ? date('Y-m-d\TH:i:s', strtotime($informasi->start_pendaftaran)) : "" ?>" placeholder="">
						</div>
						<div class="form-group row">
							<label for="end_pendaftaran" class="col-sm-3">Tutup Pendaftaran</label>
							<input type="datetime-local" class="form-control col-sm-9" name="end_pendaftaran" id="end_pendaftaran" value="<?= !is_null($informasi->end_pendaftaran) ? date('Y-m-d\TH:i:s', strtotime($informasi->end_pendaftaran)) : "" ?>" placeholder="">
						</div>
						<div class="form-group row">
							<label for="open_registration" class="col-sm-3">Kondisi Lomba</label>
							<div class="col-sm-9">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="open_registration" id="inlineRadio1" value="1" <?= $informasi->open_registration == 1 ? "checked" : "" ?>>
									<label class="form-check-label" for="inlineRadio1">Ikuti Tanggal</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="open_registration" id="inlineRadio2" value="2" <?= $informasi->open_registration == 2 ? "checked" : "" ?>>
									<label class="form-check-label" for="inlineRadio2">Paksa Buka</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="open_registration" id="inlineRadio3" value="3" <?= $informasi->open_registration == 3 ? "checked" : "" ?>>
									<label class="form-check-label" for="inlineRadio3">Paksa Tutup</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card card-primary">
					<div class="card-body">
						<button class="btn btn-primary float-right">Submit</button>
					</div>
				</div>
			</form>

			<!-- /.row (main row) -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->