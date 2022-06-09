<style>
	#logo60 {
		height: 60px;

		@media screen and (max-width: 768px) {
			height: 40px;
		}
	}

	#logoacara {
		height: 90px;

		@media screen and (max-width: 768px) {
			height: 60px;
		}
	}
</style>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center <?= isset($use_navbar_bg) ? "header-inner" : "" ?>">
	<div class="container-fluid container-xxl d-flex align-items-center justify-content-center">

		<div class="me-auto ms-4 logo">
			<a href="<?= base_url() ?>" class="scrollto"><img src="<?= base_url() ?>assets/main/img/logopetrawhite.png" alt="Logo HUT LKKBM 2021" ></a>
			<!-- <a href="<?= base_url() ?>" class="scrollto"><img id="logoacara" src="<?= base_url("assets/main/img/logo3.png") ?>" alt="" style="max-height: 80px"></a> -->
			<!-- <a href="<?= base_url() ?>" class="scrollto"><img id="logo60" src="<?= base_url() ?>assets/main/img/logo60white.png" alt="Logo HUT LKKBM 2021" ></a> -->
		</div>

		<nav id="navbar" class="navbar order-lg-0 mx-auto d-flex justify-content-center me-sm-5">
			<ul>
				<li><a class="nav-link scrollto <?= (isset($page) and $page == 'home') ? "active" : "" ?>" href="<?= base_url() ?>">Home</a></li>
				<li><a class="nav-link scrollto <?= (isset($page) and $page == 'donasi') ? "active" : "" ?>" href="<?= base_url('donation') ?>">Donasi</a></li>
				<li><a class="nav-link scrollto <?= (isset($page) and $page == 'lomba') ? "active" : "" ?>" href="<?= base_url('competition') ?>">Lomba</a></li>
				<li><a class="nav-link scrollto <?= (isset($page) and $page == 'vendor') ? "active" : "" ?>" href="<?= base_url('home') ?>#supporters">Vendor</a></li>
				<li><a class="nav-link scrollto <?= (isset($page) and $page == 'wishlist') ? "active" : "" ?>" href="<?= base_url('wishlist') ?>">Wishlist</a></li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

		<div class="ms-auto me-4 logo">
			<!-- <a href="<?= base_url() ?>" class="scrollto"><img style="max-height: 80px" src="<?= base_url() ?>assets/main/img/logobemwhite1.png" alt="Logo HUT LKKBM 2021" ></a> -->
			<a href="<?= base_url() ?>" class="scrollto"><img id="logoacara" src="<?= base_url("assets/main/img/logo3.png") ?>" alt="" style="max-height: 80px"></a>
			<a class="buy-tickets scrollto d-sm-inline d-none" href="<//?= base_url('donation') ?>">Kirimkan Donasi</a>
		</div>

	</div>
</header><!-- End Header -->