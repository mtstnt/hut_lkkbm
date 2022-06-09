<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-4">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Peserta Lomba</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Peserta Lomba</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">

			<?php $this->view('layout/admin/flash') ?>

			<div class="form-group row col-sm-6">
				<label for="filter-lomba" class="col-sm-3 py-2">Jenis Lomba</label>
				<select name="filter-lomba" id="filter-lomba" class="form-control col-sm-9">
					<option value="-1" selected>All</option>
					<?php foreach ($tipe_lomba as $t) : ?>
						<option value="<?= $t->id ?>"><?= $t->nama ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="card">
				<div class="card-body table-responsive-lg">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th style="width: 3%">No</th>
							<th>Tanggal Submit</th>
							<th>Tipe Lomba</th>
							<th>Nama</th>
							<th>Bukti Pembayaran</th>
							<th></th>
						</thead>
						<tbody id="content">
							<?php foreach ($lomba as $l) : ?>
								<tr data-lomba="<?= $l->tipe_lomba_id ?>">
									<td class="align-middle"><?= $counter++ ?></td>
									<td class="align-middle"><?= date('d M Y H:i', strtotime($l->tanggal_submit)) ?></td>
									<td class="align-middle"><?= $l->tipe_lomba ?></td>
									<td class="align-middle"><?= $l->nama ?></td>
									<td class="align-middle"><img width="50" height="50" src="<?= base_url('assets/uploads/pengumpulan-karya/' . $l->bukti_trf) ?>"></td>
									<td>
										<a href="<?= base_url() ?>admin/lomba/show/<?= $l->id ?>" class="btn btn-primary">Show</a>
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

	$('#filter-lomba').on('change', function(event) {
		var id = $(this).val();

		$('#content').children('tr').each(function(index, element) {
			$(element).show();
			if (id == -1) {
				$(element).show();
			} else if (element.getAttribute('data-lomba') != id) {
				$(element).hide();
			}
		});
	});
</script>