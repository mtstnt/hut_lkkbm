<div class="content-wrapper px-4">
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

			<div class="card">
				<div class="card-header pt-3">
					<h5>Data Peserta</h5>
				</div>
				<div class="card-body">
					<h5 class="mb-3"><?= $lomba->nama ?> - <?= $lomba->nrp ?></h5>
					<p class="mb-3">Lomba yang diikuti: <b><?= $lomba->tipe_lomba ?></b></p>

					<div class="datakel mb-3">
						<?php if (isset($lomba->kelompok)) : ?>
							<p style="font-weight: bold;">Anggota Kelompok</p>
							<div class="table-responsive col-sm-6 px-0">
								<table class="table table-hover">
									<thead>
										<th>No</th>
										<th>Nama</th>
										<th>NRP</th>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($lomba->kelompok as $k) : ?>
											<tr>
												<td class="align-middle"><?= $i++ ?></td>
												<td class="align-middle"><?= $k['nama'] ?></td>
												<td class="align-middle"><?= $k['nrp'] ?></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						<?php else : ?>
							<h5 class="fw-bold mb-3">Peserta tunggal</h5>
						<?php endif ?>
						<h5 class="fw-bold mb-3">Contact Person: <?= $lomba->contact_person ?>  </h5>
					</div>

				</div>
			</div>

		</div>
	</section>
</div>