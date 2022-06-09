<main id="main" class="main-page">
	<section id="speakers-details">
		<div class="container">
			<div class="section-header">
				<h2>Form Wishlist</h2>
			</div>

			<?php $this->view('layout/main/flash') ?>

			<form class="col-sm-10 col-11 shadow-lg rounded-3 mx-auto" action="<?= base_url('wishlist/submit') ?>" onsubmit="return checkCaptcha(event)" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="card py-5 px-4">

						<div class="card-body p-2">
							<h5 class="ps-0 fw-bold">Data Pribadi</h5>

							<div class="mb-5">
								<div class="form-group row mb-3">
									<label for="nama_lengkap" class="col-sm-3 py-1">Nama Lengkap</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" value="<?= set_value('nama_lengkap') ?>" required>
									</div>
								</div>

								<div class="form-group row mb-3">
									<label for="tipe" class="col-sm-3 py-1">Asal</label>
									<div class="col-sm-9">
										<select class="form-select" name="tipe" id="tipe" required>
											<option value="" selected>Pilih...</option>
											<?php foreach ($tipe_user as $t) : ?>
												<option value="<?= $t->id ?>"><?= $t->name ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-5">

								<h5 class="fw-bold mahasiswa">Mahasiswa</h5>
								<h5 class="fw-bold dosen">Dosen</h5>
								<h5 class="fw-bold alumni">Alumni</h5>
								<h5 class="fw-bold umum">Umum</h5>

								<div class="form-group row mb-3 mahasiswa">
									<label for="nrp" class="col-sm-3 py-1">NRP</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="nrp" id="nrp" pattern="[a-zA-Z][0-9]{8}" value="<?= set_value('nrp') ?>">
									</div>
								</div>

								<div class="form-group row mb-3 mahasiswa dosen alumni">
									<label for="program_studi" class="col-sm-3 py-1">Program Studi</label>
									<div class="col-sm-9">
										<select class="form-select" name="program_studi" id="program_studi">
											<option value="" selected>Pilih...</option>
											<?php foreach ($jurusan as $j) : ?>
												<option <?= (set_value('program_studi') == $j->id) ? "selected" : "" ?> value="<?= $j->id ?>">
													<?= $j->nama ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="form-group row mb-3 mahasiswa">
									<label for="lk" class="col-sm-3 py-1">Himpunan Mahasiswa</label>
									<div class="col-sm-9">
										<select class="form-select" name="lk" id="lk">
											<option value="" selected>Pilih...</option>
											<?php foreach ($lk as $l) : ?>
												<option <?= (set_value('lk') == $l->id) ? "selected" : "" ?> value="<?= $l->id ?>">
													<?= $l->name ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

							</div>

							<div class="mb-5">
								<h5 class="fw-bold">Isi Wish</h5>
								<div class="form-group row">
									<label for="note" class="col-sm-3">Note</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="note" id="note" cols="30" rows="10" maxlength="512"></textarea>
									</div>
								</div>
							</div>

							<div class="row mb-3">
								<div class="g-recaptcha" data-sitekey="6LcMKLwcAAAAAIdwAmrKnKf289n_x4ic5klDbzPC"></div>
							</div>

							<div class="row">
								<div class="d-sm-none d-block">
									<button class="btn btn-primary d-block w-100 p-2 x-bg-primary">Submit</button>
								</div>

								<div class="d-none d-sm-block">
									<button class="btn btn-primary d-block px-2 py-3 w-25 x-bg-primary" style="float: right">Submit</button>
								</div>
							</div>

						</div>

					</div>

				</div>
			</form>
		</div>

	</section>

</main><!-- End #main -->

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script>
	var tipe = document.getElementById('tipe');
	var metodePembayaran = document.getElementById('metode_pembayaran');
	var instruksi = document.getElementById('instruksi_pembayaran');

	setDisplayAll('.dosen, .mahasiswa, .umum, .alumni', 'none');

	function setDisplay(selector, type) {
		var element = document.querySelector(selector);
		element.style.display = type;
	}

	function setDisplayAll(selector, type) {
		var element = document.querySelectorAll(selector);
		element.forEach(el => el.style.display = type);
	}

	tipe.addEventListener('change', function(event) {
		setDisplayAll('.dosen, .mahasiswa, .umum, .alumni', 'none');
		switch (tipe.value) {
			case '1':
				setDisplayAll('.mahasiswa', 'flex');
				break;
			case '2':
				setDisplayAll('.dosen', 'flex');
				break;
			case '3':
				setDisplayAll('.alumni', 'flex');
				break;
			default:
				break;
		}
	});

	metodePembayaran.addEventListener('change', function(event) {
		var value = event.target.value;

		var instruksiContent = document.getElementById('instruksi-' + value.toString());
		if (!instruksiContent) {
			instruksi.innerHTML = "Ada error..";
			return;
		}

		instruksi.innerHTML = instruksiContent.innerHTML;
	});

	function checkCaptcha(event) {
		var captcha = grecaptcha.getResponse();
		if (captcha.length == 0) {
			alert("Captcha belum diisi");
			return false;
		}
		return true;
	}
</script>