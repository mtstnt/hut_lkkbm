<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-4">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Donasi</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Donasi</li>
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

			<button class="btn btn-primary mb-3">Simpan Perubahan</button>

			<div class="card">
				<div class="card-body">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>Tanggal</th>
							<th>Nama</th>
							<th>Dari</th>
							<th>Metode</th>
							<th>Jumlah</th>
							<th>Bukti Transfer</th>
							<th>Konfirmasi</th>
						</thead>
						<tbody>
							<?php foreach ($donasi as $d) : ?>
								<tr>
									<td><?= $counter++ ?></td>
									<td><?= date('d-m-Y', strtotime($d->time_stamp)) ?></td>
									<td><?= $d->nama ?></td>
									<td><?= $d->detail_user ?></td>
									<td><?= $d->metode_pembayaran ?></td>
									<td><?= $d->jumlah ?></td>
									<td>FILE</td>
									<td>
										<label for="confirm">
											<input type="checkbox" class="confirm" name="confirm[]" id="confirm-<?= $d->id ?>" <?= $d->confirmed ? "checked" : "" ?>>
										</label>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<!-- /.row (main row) -->
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script defer>
	$('#table').DataTable();
</script>