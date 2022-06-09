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

			<?php $this->view('layout/admin/flash') ?>

			<a href="<?= base_url() ?>admin/access/create" class="btn btn-primary my-2">Add New</a>

			<div class="card">
				<div class="card-body table-responsive-lg">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th style="width: 3%">No</th>
							<th>Username</th>
							<th>Last Login</th>
							<th></th>
						</thead>
						<tbody>
							<?php foreach ($admins as $admin) : ?>
								<tr>
									<td class="align-middle"><?= $counter++ ?></td>
									<td class="align-middle"><?= $admin->username ?></td>
									<td class="align-middle"><?= $admin->last_login ?></td>
									<td>
										<a href="<?= base_url() ?>admin/access/edit/<?= $admin->id ?>" class="btn btn-warning">Edit</a>
										<a href="<?= base_url() ?>admin/access/delete/<?= $admin->id ?>" class="btn btn-danger">Delete</a>
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