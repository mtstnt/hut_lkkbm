<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-4">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">LK</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">LK</li>
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

			<a href="<?= base_url() ?>admin/lk/create" class="btn btn-primary my-2">Add New</a>

			<div class="card">
				<div class="card-body table-responsive-lg">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th style="width: 3%">No</th>
							<th>Nama LK</th>
							<th>Logo</th>
                            <th>Total Donasi</th>
							<th></th>
						</thead>
						<tbody>
							<?php foreach ($lk as $l) : ?>
								<tr>
									<td class="align-middle"><?= $counter++ ?></td>
									<td class="align-middle"><?= $l->name ?></td>
                                    <td><img style="max-width: 150px" src="<?= base_url('assets/uploads/logo/' . $l->logo) ?>" alt=""></td>
									<td class="align-middle format-money" data-value="<?= $l->total_donasi ?>"></td>
									<td>
										<a href="<?= base_url() ?>admin/lk/edit/<?= $l->id ?>" class="btn btn-warning">Edit</a>
										<a href="<?= base_url() ?>admin/lk/delete/<?= $l->id ?>" class="btn btn-danger">Delete</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- /.row (main row) -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
	$('#table').DataTable({
		'responsive': true,
		'autoWidth': true,
	});
</script>