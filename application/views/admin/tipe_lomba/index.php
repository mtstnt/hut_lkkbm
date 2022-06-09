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

			<?php $this->view('layout/admin/flash') ?>

			<div class="card">
				<div class="card-body">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>Poster</th>
							<th>Nama Lomba</th>
							<th>Deskripsi</th>
							<th></th>
						</thead>
						<tbody>
							<?php foreach ($tipe_lomba as $tipe_lomba) : ?>
								<tr>
									<td><?= $counter++ ?></td>
									<td><img width="50" src="<?= base_url('assets/uploads/logo/' . $tipe_lomba->file) ?>" alt=""></td>
									<td><?= $tipe_lomba->nama ?></td>
									<td><?= $tipe_lomba->deskripsi ?></td>
									<td>
										<a href="<?= base_url() ?>admin/tipelomba/edit/<?= $tipe_lomba->id ?>" class="btn btn-warning">Edit</a>
										<a href="<?= base_url() ?>admin/tipelomba/delete/<?= $tipe_lomba->id ?>" class="btn btn-danger">Delete</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
</div>

<script defer>
	$('#table').DataTable({
		'responsive': true,
		'autoWidth': true,
	});
</script>