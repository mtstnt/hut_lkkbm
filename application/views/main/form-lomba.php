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

	<?php if (isset($success)) : ?>
		<div class="modal fade" id="successModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content p-3">
					<button type="button" class="btn-close" id="successModalClose" data-bs-dismiss="modal" aria-label="Close"></button>
					<h2 class="text-center p-3 my-3 my-0 fw-bold">Pendaftaran berhasil!</h2>
					<h3 class="text-center p-3 my-0 fw-bold">Jangan lupa isi wishlist juga yaa!</h3>
					<a href="<?= base_url("wishlist") ?>" class="btn btn-primary x-bg-primary">Klik di sini untuk buat wishlist!</a>
				</div>
			</div>
		</div>

		<script>
			var successModal = new bootstrap.Modal(document.getElementById('successModal'));
			successModal.show();
		</script>
	<?php endif; ?>

	<section id="speakers-details">
		<div class="section-header">
			<h2>Form Pendaftaran Lomba</h2>
			<p>Harap mengisi form di bawah ini untuk <br>
				mendaftar lomba</p>
			<p><i>Please fill in this form to register for our competitions</i></p>
		</div>

		<div class="container mb-5">
			<div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
				<h5 class="text-center">Menuju penutupan pendaftaran (15 November 2021)</h5>
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
	
		<form class="col-sm-10 col-11 shadow-lg rounded-3 mx-auto" onsubmit="return checkCaptcha(event)" action="<?= base_url('competition/submit') ?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="card py-5 px-4">
	
					<div class="card-body p-2">
						<div class="mb-5">
							<h5 class="fw-bold mb-3">Data Peserta Lomba</h5>
							<div class="form-group row mb-3">
								<label for="nama_lengkap" class="col-sm-3 py-1">Nama Peserta*</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" value="<?= set_value('nama_lengkap') ?>" required>
								</div>
							</div>
	
							<div class="form-group row mb-3">
								<label for="nrp" class="col-sm-3 py-1">NRP*</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" name="nrp" id="nrp" pattern="[a-zA-Z][0-9]{8}" value="<?= set_value('nrp') ?>" required>
								</div>
							</div>
	
							<div class="form-group row mb-3">
								<label for="email" class="col-sm-3 py-1">Email*</label>
								<div class="col-sm-9">
									<input class="form-control" type="email" name="email" id="email" value="<?= set_value('email') ?>" required>
								</div>
							</div>
	
							<div class="form-group row mb-3">
								<label for="cp" class="col-sm-3 py-1">Contact Person*</label>
								<div class="col-sm-9">
									<input class="form-control" type="tel" name="cp" id="cp" value="<?= set_value('cp') ?>" required>
								</div>
							</div>
	
							<div class="form-group row mb-3">
								<label for="lomba" class="col-sm-3 py-1">Lomba yang Diikuti*</label>
								<div class="col-sm-9">
									<select class="form-select" name="lomba" id="lomba" required>
										<option value="">Pilih...</option>
										<?php foreach ($lomba as $l) : ?>
											<option value="<?= $l->id ?>"><?= $l->nama ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
	
							<div class="form-group row mb-3">
								<label for="" class="col-sm-3 py-1">Anggota (Kosongkan apabila tunggal)</label>
								<div class="col-sm-9 py-3">
									<div class="w-100 table-responsive-lg">
										<button type="button" class="btn btn-primary x-bg-primary px-4 my-2" id="add_button">Add</button>
										<table class="table table-hover">
											<thead>
												<th>No</th>
												<th>Nama</th>
												<th>NRP</th>
												<th>&nbsp;</th>
											</thead>
											<tbody id="table_anggota"></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
	
						<div class="mb-5">
							<h5 class="fw-bold">Administrasi</h5>

							<p id="text-biaya"></p>
							<div class="col-sm-3 my-3">
								<img id="rek-lomba" src="<?= base_url("assets/main/img/rek-lomba.jpg") ?>" style="max-width: 100%" alt="" class="d-none">
							</div>

	
							<div class="form-group row mb-3">
								<label for="bukti_transfer" class="col-sm-3 py-1">Bukti Transfer*</label>
								<div class="col-sm-9">
									<input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required>
								</div>
							</div>
						</div>
	
						<div class="row mb-3">
							<div class="g-recaptcha" data-sitekey="6LcMKLwcAAAAAIdwAmrKnKf289n_x4ic5klDbzPC"></div>
						</div>
	
						<div class="row">
							<div class="d-sm-none d-block">
								<button id="submit-desktop" class="btn btn-primary d-block w-100 p-2 x-bg-primary">Submit</button>
							</div>
	
							<div class="d-none d-sm-block">
								<button id="submit-mobile" class="btn btn-primary d-block px-2 py-3 w-25 x-bg-primary" style="float: right">Submit</button>
							</div>
						</div>
					</div>
	
				</div>
			</div>
		</form>

	</section>

</main><!-- End #main -->

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="<?= base_url("assets/admin/functions.js") ?>"></script>

<script>
	var lomba = document.getElementById('lomba');
	var addButton = document.getElementById('add_button');
	var tableAnggota = document.getElementById('table_anggota');
	var form = document.querySelector('form');
	var biaya = document.getElementById('biaya');
	var textBiaya = document.getElementById('text-biaya');
	var rekening = document.getElementById('rek-lomba');

	// Input khusus lomba tertentu: 

	function setDisplay(selector, type) {
		var element = document.querySelector(selector);
		element.style.display = type;
	}

	function setDisplayAll(selector, type) {
		var element = document.querySelectorAll(selector);
		element.forEach(el => el.style.display = type);
	}

	function checkCaptcha(event) {
		var captcha = grecaptcha.getResponse();
		if (captcha.length == 0) {
			alert("Captcha belum diisi");
			return false;
		}
		if (!confirm("Apakah semua data yang dikirimkan sudah benar?")) {
			return false;
		}
		return true;
	}

	addButton.addEventListener('click', function(event) {
		var tmpl = number => `<td class="align-middle">${number}</td>
					<td>
						<input type="text" name="anggota[]" class="form-control anggota">
					</td>
					<td>
						<input type="text" name="anggota_nrp[]" class="form-control anggota_nrp" pattern="[a-zA-Z][0-9]{8}">
					</td>
					<td>
						<button type="button" onclick="deleteRow(this)" class="btn btn-primary x-bg-primary">-</button>
					</td>`;

		var allRows = tableAnggota.querySelectorAll('tr');

		var tr = document.createElement('tr');
		tr.innerHTML = tmpl(allRows.length + 1);
		tableAnggota.appendChild(tr);
	});

	function deleteRow(element) {
		var tr = element.parentNode.parentNode;
		tableAnggota.removeChild(tr);

		updateNumbering();
	}

	function updateNumbering() {
		var allRows = tableAnggota.querySelectorAll('tr>td:first-child');
		var counter = 1;
		allRows.forEach(el => {
			el.innerText = counter++;
		});
	}

	function updateBiaya(event) {
		var text = `
			Biaya pendaftaran adalah <b id="biaya" class="format-money" data-value="0"></b> yang akan digunakan untuk honor juri.
			<br>
			Biaya pendaftaran dapat ditransferkan ke rekening berikut: 
			<br>
			<b>BCA 5065283775 - Kezia Clarisa</b>
			<br>
			Tambahkan kode unik pada nominal dgn '006' menjadi <div class="format-money" id="nominal-bayar" data-value=""></div>
			`;

		var noChoose = `<span class='text-danger'>Tolong pilih salah satu jenis lomba</span>`;

		if (lomba.value == 7) {
			// Find your Fire
			textBiaya.innerHTML = text;
			rekening.classList.remove("d-none");
			document.getElementById('biaya').setAttribute('data-value', 30000);
			document.getElementById('nominal-bayar').setAttribute('data-value', 30000 + 6);
			document.getElementById('nominal-bayar').innerText = 30000 + 6;
		} else if (lomba.value == 8) {
			// Show your Spirit
			textBiaya.innerHTML = text;
			rekening.classList.remove("d-none");
			document.getElementById('biaya').setAttribute('data-value', 20000);
			document.getElementById('nominal-bayar').setAttribute('data-value', 20000 + 6);
			document.getElementById('nominal-bayar').innerText = 20000 + 6;
		} else {
			textBiaya.innerHTML = noChoose;
			rekening.classList.add("d-none");
		}

		formatMoney();
	}

	lomba.addEventListener('change', updateBiaya);
	updateBiaya();

	// Set the date we're counting down to
	var countDownDate = new Date("<?= date('Y/m/d H:i:s', strtotime($end_date)) ?> GMT+0700").getTime();

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
			document.getElementById("countdown-over-sign").innerHTML = "<h1 style='text-align: center; color: white'>Pendaftaran sudah ditutup.</h1>";
			document.getElementById('submit-mobile').disabled = true;
			document.getElementById('submit-desktop').disabled = true;
		}
	}, 1000);
</script>