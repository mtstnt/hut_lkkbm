<style>
	#successModalClose {
		position: absolute;
		top: 0;
		right: 0;
		width: 2em;
		height: 2em;
		transform: scale(1.5);
	}

	.time {
		font-size: 2.5rem;
		font-weight: bold;
		color: black;
	}

	.time-text {
		font-size: 1.5rem;
		color: #9c0e0e;
	}

	@media (max-width: 768px) {
		.time {
			font-size: 2rem;
		}

		.time-text {
			font-size: 1rem;
		}
	}
</style>

<main id="main" class="main-page">
	<section id="speakers-details">
		<div class="container">
			<div class="section-header">
				<h2>Form Donasi</h2>
				<p>Harap mengisi form di bawah ini untuk mengirimkan donasi</p>
				<p><i>Please fill in this form to send donation</i></p>
			</div>

			<div class="container mb-5">
				<div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
					<h5 class="text-center">Menuju penutupan donasi (20 Desember 2021)</h5>
					<div id="countdown" class="mx-auto col-sm-6 d-flex justify-content-center align-items-center text-white p-1 rounded" style="font-size: 3rem;">
						<div class="col-3 p-2" style="text-align: center">
							<div class="time" id="days"></div>
							<div class="time-text">Days</div>
						</div>
						<div style="color: black">:</div>
						<div class="col-3 p-2" style="text-align: center">
							<div class="time" id="hours"></div>
							<div class="time-text">Hours</div>
						</div>
						<div style="color: black">:</div>
						<div class="col-3 p-2" style="text-align: center">
							<div class="time" id="minutes"></div>
							<div class="time-text">Minutes</div>
						</div>
						<div style="color: black">:</div>
						<div class="col-3 p-2" style="text-align: center">
							<div class="time" id="seconds"></div>
							<div class="time-text">Seconds</div>
						</div>
					</div>
				</div>
			</div>

			<?php $this->view('layout/main/flash') ?>

			<?php if (isset($success)) : ?>
				<div class="modal fade" id="successModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<button type="button" class="btn-close" id="successModalClose" data-bs-dismiss="modal" aria-label="Close"></button>
							<img id="successModalImg" src="<?= base_url('assets/main/img/' . $success_img) ?>" alt="Thankyou Card">
							<h3 class="text-center p-3 my-0 f fw-bold">Jangan lupa isi wishlist juga!</h3>
							<a href="<?= base_url("wishlist") ?>" class="btn btn-primary x-bg-primary">Klik di sini untuk buat wishlist!</a>
						</div>
					</div>
				</div>

				<script>
					var successModal = new bootstrap.Modal(document.getElementById('successModal'));
					successModal.show();
				</script>
			<?php endif; ?>

			<form class="col-sm-10 col-11 shadow-lg rounded-3 mx-auto" action="<?= base_url('donation/submit') ?>" onsubmit="return checkCaptcha(event)" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="card py-5 px-4">

						<?php if (isset($success)) : ?>
							<h3 class="text-center fw-bold">Thank you for the donation, <?= $nama ?>!</h3>
						<?php endif; ?>

						<div class="card-body p-2">
							<h5 class="ps-0 fw-bold">Data Pribadi</h5>

							<div class="mb-5">
								<div class="form-group row mb-3">
									<label for="nama_lengkap" class="col-sm-3 py-1">Nama Lengkap*</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" value="<?= set_value('nama_lengkap') ?>" required>
									</div>
								</div>

								<div class="form-group row mb-3">
									<label for="tipe" class="col-sm-3 py-1">Asal*</label>
									<div class="col-sm-9">
										<select class="form-select" name="tipe" id="tipe" required>
											<option value="">Pilih...</option>
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
									<label for="nrp" class="col-sm-3 py-1">NRP*</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="nrp" id="nrp" pattern="[a-zA-Z][0-9]{8}" value="<?= set_value('nrp') ?>">
									</div>
								</div>

								<div class="form-group row mb-3 mahasiswa dosen alumni">
									<label for="program_studi" class="col-sm-3 py-1">Program Studi*</label>
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
											<option value="" selected>Tidak mewakili</option>
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
								<h5 class="fw-bold">Data Donasi</h5>

								<div class="form-group row mb-3">
									<label for="nominal" class="col-sm-3 py-1">Nominal*</label>
									<div class="col-sm-9">
										<input class="form-control" type="number" min="20000" placeholder="Min. Rp20.000 (Wajib diisi)" name="nominal" id="nominal" required>
									</div>
								</div>

								<div class="form-group row mb-3">
									<label for="metode_pembayaran" class="col-sm-3 py-1">Metode Pembayaran*</label>
									<div class="col-sm-9">
										<select class="form-select" name="metode_pembayaran" id="metode_pembayaran" required>
											<option value="">Pilih...</option>
											<?php foreach ($metode as $m) : ?>
												<option value="<?= $m->id ?>"><?= $m->nama ?></option>
											<?php endforeach; ?>
										</select>
										<?php foreach ($metode as $m) : ?>
											<div id="instruksi-<?= $m->id ?>" class="d-none"><?= $m->deskripsi ?></div>
										<?php endforeach; ?>
									</div>
								</div>

								<div class="form-group row mb-sm-5 mb-3">
									<label for="" class="col-sm-3 py-2">Langkah Pembayaran</label>
									<div class="mx-auto col-12">
										<textarea id="instruksi_pembayaran" class="form-control" rows="5" disabled></textarea>
									</div>
								</div>

								<div class="form-group row mb-3">
									<label for="bukti_transfer" class="col-sm-3 py-1">Bukti Transfer*</label>
									<div class="col-sm-9">
										<input class="form-control" size="10M" type="file" name="bukti_transfer" id="bukti_transfer" required>
									</div>
								</div>

							</div>

							<div class="row mb-3">
								<div class="g-recaptcha" data-sitekey="6LcMKLwcAAAAAIdwAmrKnKf289n_x4ic5klDbzPC"></div>
							</div>

							<div class="row">
								<div class="d-sm-none d-block">
									<button id="submit-desktop" <?= isset($success) ? "disabled" : "" ?> class="btn btn-primary d-block w-100 p-2 x-bg-primary">Submit</button>
								</div>

								<div class="d-none d-sm-block">
									<button id="submit-mobile" <?= isset($success) ? "disabled" : "" ?> class="btn btn-primary d-block px-2 py-3 w-25 x-bg-primary" style="float: right">Submit</button>
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

	// Set the date we're counting down to
	var countDownDate = new Date("2021/12/20 23:59:59 GMT+0700").getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

		// Get todays date and time
		var now = new Date().getTime();

		// Find the distance between now an the count down date
		var distance = countDownDate - now;

		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		if (days < 10) days = "0" + days;
		if (hours < 10) hours = "0" + hours;
		if (minutes < 10) minutes = "0" + minutes;
		if (seconds < 10) seconds = "0" + seconds;

		// Display the result in an element with id="demo"
		// document.getElementById("demo").innerHTML = days + "Days " + hours + "Hours "
		// + minutes + "Minutes " + seconds + "Seconds ";

		// Display the result in an element with id="demo"
		document.getElementById("days").innerHTML = days;
		document.getElementById("hours").innerHTML = hours;
		document.getElementById("minutes").innerHTML = minutes;
		document.getElementById("seconds").innerHTML = seconds;

		// If the count down is finished, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("countdown-over-sign").innerHTML = "<h1 style='text-align: center; color: white'>Donasi sudah ditutup.</h1>";
			document.getElementById('submit-mobile').disabled = true;
			document.getElementById('submit-desktop').disabled = true;
		}
	}, 1000);
</script>