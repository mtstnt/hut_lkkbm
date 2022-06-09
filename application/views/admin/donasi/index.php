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

			<div class="row col-sm-6 mb-2">
				<label class="col-sm-3 py-2"><b>Total</b></label>
				<input type="text" id="total-donasi" data-value="<?= $total ?>" disabled class="form-control col-sm-9 format-money">
			</div>

			<div class="form-group row col-sm-6">
				<label for="filter-user" class="col-sm-3 py-2">User</label>
				<select name="filter-user" id="filter-user" class="form-control col-sm-9">
					<option value="-1" selected>All</option>
					<?php foreach ($tipe_user as $t) : ?>
						<option value="<?= $t->id ?>"><?= $t->name ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<button class="btn btn-primary mb-3">Simpan Perubahan</button>
			<div class="card">
				<div class="card-body table-responsive-lg">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>Tanggal</th>
							<th>NRP</th>
							<th>Nama</th>
							<th>Dari</th>
							<th>Metode</th>
							<th>Jumlah</th>
							<th>Bukti Transfer</th>
							<th>Konfirmasi</th>
						</thead>
						<tbody id="content">
							<?php foreach ($donasi as $d) : ?>
								<tr data-user="<?= $d->tipe_user_id ?>">
									<td class="align-middle"><?= $counter++ ?></td>
									<td class="align-middle"><?= date('d M Y', strtotime($d->time_stamp)) ?></td>
									<td class="align-middle"><?= is_null($d->nrp) ? "" : $d->nrp ?></td>
									<td class="align-middle"><?= $d->nama ?></td>
									<td class="align-middle"><?= $d->detail_user ?></td>
									<td class="align-middle"><?= $d->metode_pembayaran ?></td>
									<td class="align-middle">Rp<?= $d->jumlah ?></td>
									<td class="align-middle"><img width="50" height="50" src="<?= base_url('assets/uploads/bukti-transfer/' . $d->file) ?>" alt=""></td>
									<td class="align-middle">
										<label for="confirm">
											<input type="checkbox" class="confirm mr-2" name="confirm[]" id="confirm-<?= $d->id ?>" <?= $d->confirmed ? "checked" : "" ?> value="<?= $d->id ?>">
											<a onclick="return confirm('Are you sure?')" href="<?= base_url('admin/donasi/delete/' . $d->id) ?>" class="link text-danger">Delete</a>
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

<script>
	var url = "<?= base_url() ?>";
	$('#table').DataTable({
		lengthMenu: [[100, -1], [100, "All"]],
		iDisplayLength: -1,
	});

	$('#filter-user').on('change', function(event) {
		var id = $(this).val();

		$('#content').children('tr').each(function(index, element) {
			$(element).show();
			if (id == -1) {
				$(element).show();
			} else if (element.getAttribute('data-user') != id) {
				$(element).hide();
			}
		});
	});

	$('.confirm').on('change', function(event) {
		var checked = this.checked;
		var id = Number(this.value);

		$.ajax({
			method: 'POST',
			url: url + '/admin/donasi/simpan',
			headers: {
				'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest',
				'Content-Type': 'application/json'
			},
			data: JSON.stringify({
				id: id,
				value: checked
			}),
			success: function(data, status, xhr) {
				var j = JSON.parse(data);
				if (j['error'] != null) {
					alert("Error: " + j['error']);
					return;
				}

				$('#total-donasi').attr('data-value', j['total']);
				formatMoney();
			},
			error: function(xhr) {
				alert("Error: " + xhr.responseText);
			}
		});
	});
</script>