<style>
	#progress {
		width: <?= isset($percentage) ? $percentage . "%" : "0%" ?>;
		float: left;
		border-radius: 6px;
		height: 40px;
		background: rgba(6, 12, 34, 0.98);
		/* For browsers that do not support gradients */
		background: -webkit-linear-gradient(-90deg, rgba(6, 12, 34, 0.76), rgba(6, 12, 34, 0.98));
		/* For Safari 5.1 to 6.0 */
		background: -moz-linear-gradient(-90deg, rgba(6, 12, 34, 0.76), rgba(6, 12, 34, 0.98));
		/* For Firefox 3.6 to 15 */
		background: linear-gradient(-90deg, rgba(6, 12, 34, 0.76), rgba(6, 12, 34, 0.98));
		/* Standard syntax */
		z-index: 333;
		-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
	}

	#countdown-wrap {
		width: 100%;
		height: 250px;
		padding: 20px;
		font-weight: 500;
	}

	#goal {
		font-size: 35px;
		text-align: right;
		width: 100%;
	}

	@media only screen and (max-width: 540px) {
		#goal {
			text-align: center;
		}
	}

	#glass {
		width: 100%;
		height: 40px;
		border-radius: 6px;
		background: #EE0E0E;
		float: left;
		overflow: hidden;
		background-color: #dee0e0;
		box-shadow: 0 2px 3px rgba(0, 0, 0, .5) inset;
	}

	.goal-stat {
		width: 20%;
		height: 30px;
		padding: 10px;
		margin: 0;
	}

	@media only screen and (max-width: 540px) {
		.goal-stat {
			width: 40%;
			text-align: center;
		}
	}

	.goal-number,
	.goal-label {
		font-size: 20px;
	}

	.goal-number {
		font-weight: bold;
	}

	#goal-words {
		float: right;
		width: 26%;
		font-size: 25px;
	}

	.time {
		font-size: 2rem;
		font-weight: bold;
	}

	.time-text {
		font-size: 1rem;
	}

	@media (max-width: 768px) {
		.time {
			font-size: 2rem;
		}

		.time-text {
			font-size: 1rem;
		}
	}

	#countdown {
		background-color: rgba(6, 12, 34, 0.6);
	}

	body {
		background:
			/* linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), */
			linear-gradient(rgba(18, 28, 38, 0.7), rgba(18, 28, 38, 0.7)),
			url(<?= base_url("assets/main/img/background-foto.jpg") ?>) top center;

		background-attachment: fixed;
	}

	.hotel {
		height: 100%;
	}

	.action-btn {
		background-color: var(--color3);
		width: 200px;
	}
	@media (max-width: 768px) {
		.action-btn {
			display: block;
			width: 80%;
			margin: 0 auto;
		}	
	}
	
	.action-btn:hover {
		background-color: var(--color5) !important;
		color: white !important;
		transition: 0.5s !important;
		border-color: var(--color5) !important;
	}

	.action-btn-2 {
		background-color: var(--color5);
	}

	.action-btn-2:hover {
		background-color: var(--color3) !important;
		color: white !important;
		transition: 0.5s !important;
	}

	.card-fit {
		height: 120px;
	}
</style>

<body>
	<div class="wrapper">
		<!-- The Modal -->
		<div class="modal fade" id="modalDeskripsi">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						<div id="gambar" class="text-center">
							<img src="" alt="" class="logo" style="max-width:100%">
						</div>
						<div id="description">
							<h4 class="p-3 text-center" id="nama"></h4>
							<p class="text-center m-0" id="deskripsi"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ======= Hero Section ======= -->
		<section id="hero">
			<div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
				<img class="py-3" src="<?= base_url("assets/main/img/logo3.png") ?>" alt="">

				<h1 class="py-2">HUT <span>LK-KBM</span> 2021</h1>

				<div id="countdown" class="mx-auto col-sm-6 d-flex justify-content-center align-items-center mb-3 text-white p-4 rounded" style="font-size: 3rem;">
					<div class="col-3 p-1">
						<div class="time" id="days"></div>
						<div class="time-text">Days</div>
					</div>
					:
					<div class="col-3 p-1">
						<div class="time" id="hours"></div>
						<div class="time-text">Hours</div>
					</div>
					:
					<div class="col-3 p-1">
						<div class="time" id="minutes"></div>
						<div class="time-text">Minutes</div>
					</div>
					:
					<div class="col-3 p-1">
						<div class="time" id="seconds"></div>
						<div class="time-text">Seconds</div>
					</div>
				</div>

				<div class="d-flex justify-content-center flex-wrap">
					<a href="<?= base_url('competition') ?>" class="about-btn scrollto action-btn">Daftar Lomba</a>
					<a href="<?= base_url('donation') ?>" class="about-btn scrollto action-btn">Donasi</a>
				</div>

			</div>
		</section><!-- End Hero Section -->

		<main id="main">
			<!-- ======= Speakers Section ======= -->
			<section id="donations" class="section-with-bg">
				<div class="container" data-aos="fade-up">
					<div class="section-header">
						<h2>Donations</h2>
					</div>

					<div class="row">
						<div>
							<div id="countdown-wrap">
								<div id="goals-wrap">
									<div id="goal" class="format-money" data-value="<?= $target ?>"></div>
									<div id="goal-words">GOAL</div>
								</div>
								<div id="glass">
									<div id="progress">
									</div>
								</div>
								<div class="goal-stat">
									<span class="goal-label">RAISED</span>
									<span class="goal-number format-money" data-value="<?= $current ?>"></span>
								</div>
							</div>
						</div>
						<a href="<?= base_url('donation') ?>" class="btn btn-primary d-block p-3 col-sm-6 col-10 mx-auto action-btn-2" style="background-color: rgba(6, 12, 34, 0.98);">Donasi Sekarang!</a>
					</div>
				</div>

			</section><!-- End Speakers Section -->

			<section id="ranking" class="section-with-bg py-4">
				<div class="container px-0 col-11 col-sm-8 mx-auto" data-aos="fade-up">
					<div class="section-header">
						<h2>Donation Ranking</h2>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<?php $loop = intval((count($rank_donasi) % 2 == 0) ? count($rank_donasi) / 2 : count($rank_donasi) / 2 + 1); ?>
							<?php for ($i = 0; $i < $loop; $i++) : ?>
								<?php $r = $rank_donasi[$i] ?>
								<div class="card card-fit mb-3 d-flex align-items-center flex-row" style="max-width: 540px;">
									<div class="card-body">
										<div class="row g-0">
											<div class="col-1 d-flex align-items-center text-center">
												<?= !isset($p) ? $p = 1 : ++$p ?>
											</div>
											<div class="col-4 text-center">
												<img width="80" src="<?= base_url('assets/uploads/logo/' . $r->logo) ?>" class="img-fluid text-center rounded-start" alt="...">
											</div>
											<div class="col-7 d-flex align-items-center">
												<h6 class="card-title col-6 m-0 text-center"><?= $r->name ?></h6>
												<p class="card-text format-money col-6 text-center" data-value="<?= $r->total ?>"><?= $r->total ?></p>
											</div>
										</div>
									</div>
								</div>
							<?php endfor ?>
						</div>
						<div class="col-sm-6">
							<?php for ($i = $loop; $i < count($rank_donasi); $i++) : ?>
								<?php $r = $rank_donasi[$i] ?>
								<div class="card card-fit mb-3 d-flex align-items-center flex-row" style="max-width: 540px;">
									<div class="card-body">
										<div class="row g-0">
											<div class="col-1 d-flex align-items-center text-center">
												<?= ++$p ?>
											</div>
											<div class="col-4 text-center">
												<img width="80" src="<?= base_url('assets/uploads/logo/' . $r->logo) ?>" class="img-fluid text-center rounded-start" alt="...">
											</div>
											<div class="col-7 d-flex align-items-center">
												<h6 class="card-title col-6 m-0 text-center"><?= $r->name ?></h6>
												<p class="card-text format-money col-6 text-center" data-value="<?= $r->total ?>"><?= $r->total ?></p>
											</div>
										</div>
									</div>
								</div>
							<?php endfor ?>
						</div>
					</div>
					<div class="col-sm-6 mx-auto">
						<div class="card card-fit mb-3 d-flex align-items-center flex-row" style="max-width: 540px;">
							<div class="card-body">
								<div class="row g-0">
									<div class="col-12 d-flex align-items-center">
										<h6 class="text-center card-title col-6 m-0">UMUM</h6>
										<p class="text-center card-text format-money col-6" data-value="<?= is_null($total_umum->total) ? 0 : $total_umum->total ?>"><?= $total_umum->total ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- ======= Supporters Section ======= -->
			<section id="supporters">

				<div class="container" data-aos="fade-up">
					<div class="section-header">
						<h2>Vendors</h2>
					</div>

					<div class="row no-gutters clearfix d-flex justify-content-center" data-aos="zoom-in" data-aos-delay="100">
						<?php foreach ($vendor as $vendors) : ?>
							<div class="col-lg-3 col-md-4 col-xs-6 vendors m-2 rounded" id="<?= $vendors->id ?>">
								<div style="background : rgba(255, 255, 255, 0.2);">
									<h5 class="p-2 nama" style="text-align : center; margin : 0 0 0 0;"><?= $vendors->nama ?></h5>
								</div>
								<p style="display : none" class="deskripsi"><?= $vendors->deskripsi ?></p>
								<div class="supporter-logo">
									<img src="<?= base_url() ?>assets/uploads/logo/<?= $vendors->logo ?>" class="img-fluid gambar" alt="">
								</div>
							</div>
						<?php endforeach; ?>
					</div>
			</section><!-- End Vendors Section -->

			<!-- ======= <?= base_url() ?>assets/main ======= -->
			<section id="hotels" class="section-with-bg">

				<div class="container" data-aos="fade-up">
					<div class="section-header">
						<h2>Events</h2>
					</div>

					<div class="row d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

						<div class="col-sm-4">
							<div class="hotel card p-3 shadow-lg">
								<div class="card-image-top">
									<img style="max-width: 100%;" src="<?= base_url('assets/uploads/logo/DONATE-AND-AFFECT-1.png') ?>" alt="">
								</div>
								<div class="card-body p-3 text-center">
									<div class="card-title">
										<h5 class="text-center"><a href="<?= base_url('competition') ?>">Donate and Affect</a></h5>
									</div>
									<p style="white-space: pre-line;">Donate N Affect adalah kegiatan donasi yang dilakukan untuk membantu mahasiswa aktif UKP yang membutuhkan finansial karena dari dampak COVID-19.  Donai ini terbuka untuk umum dan juga keluarga besar Universitas Kristen Petra  mahasiswa UKP dan juga umum.Hanya dengan Rp 20.000 anda sudah bisa berkontribusi dalam kegiatan donasi. Yuk salurkan kebaikan dan jadilah orang yang berpengaruh.</p>
								</div>
							</div>
						</div>
						<?php foreach ($tipe_lomba as $t) : ?>
							<div class="col-sm-4">
								<div class="hotel card p-3 shadow-lg">
									<div class="card-image-top">
										<img style="max-width: 100%;" src="<?= base_url('assets/uploads/logo/' . $t->file) ?>" alt="">
									</div>
									<div class="card-body p-3 text-center">
										<div class="card-title">
											<h5 class="text-center"><a href="<?= base_url('competition') ?>"><?= $t->nama ?></a></h5>
										</div>
										<p style="white-space: pre-line;"><?= $t->deskripsi ?></p>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				</div>

			</section><!-- End Hotels Section -->

		</main><!-- End #main -->
	</div>

	<script src="<?= base_url('assets/admin/functions.js') ?>"></script>
	<script>
		// Set the date we're counting down to
		var countDownDate = new Date("<?= date('Y/m/d H:i:s', strtotime($start_date)) ?> GMT+0700").getTime();

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
				document.getElementById("countdown-over-sign").innerHTML = "<h1 style='text-align: center; color: white'>The Wedding Ceremony is Over</h1>";
			}
		}, 1000);
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$(document).on('click', '.vendors', function() {
				id = $(this).attr("id")
				console.log($(this).find(".nama").text());
				$("#nama").text($(this).find(".nama").text())
				$("#deskripsi").text($(this).find(".deskripsi").text())
				url = $(this).find(".gambar").attr('src')
				$("#modalDeskripsi").find(".logo").attr("src", url)
				console.log(url)
				$("#modalDeskripsi").modal('show')
			});
		})
	</script>