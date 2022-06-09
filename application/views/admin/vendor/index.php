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

			<?php $this->view('layout/admin/flash') ?>

			<a href="<?= base_url() ?>admin/vendor/create" class="btn btn-primary my-2">Add New</a>

			<div class="card">
				<div class="card-body table-responsive-lg">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th style="width: 3%">No</th>
							<th>Nama Vendor</th>
							<th>Logo</th>
                            <th>Deskripsi</th>
							<th></th>
						</thead>
						<tbody>
							<?php foreach ($vendor as $v) : ?>
								<tr>
									<td class="align-middle"><?= $counter++ ?></td>
									<td class="align-middle"><?= $v->nama ?></td>
                                    <td><img style="max-width: 150px" src="<?= base_url('assets/uploads/logo/' . $v->logo) ?>" alt=""></td>
									<td class="align-middle" style="white-space: pre-line;"><?= $v->deskripsi ?></td>
									<td>
										<a href="<?= base_url() ?>admin/vendor/edit/<?= $v->id ?>" class="btn btn-warning">Edit</a>
										<a href="<?= base_url() ?>admin/vendor/delete/<?= $v->id ?>" class="btn btn-danger">Delete</a>
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