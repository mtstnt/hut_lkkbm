<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
		<span class="brand-text font-weight-light">Admin HUT LKKBM 2021</span>
	</a>

	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="info text-white">
				Logged in as <b><?= $this->session->user['username'] ?></b>&nbsp;&nbsp;&nbsp;<a class="text-danger" href="<?= base_url('admin/auth/logout') ?>"><b>Logout</b></a>
			</div>
		</div>

		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<li class="nav-item">
					<a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>

				<li class="nav-header">Manage Access</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/access') ?>" class="nav-link <?= $page == 'access' ? 'active' : '' ?>">
						<i class="nav-icon far fa-address-card"></i>
						<p>
							Admin Manager
						</p>
					</a>
				</li>

				<li class="nav-header">General Information</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/informasi') ?>" class="nav-link <?= $page == 'informasi' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Informasi
						</p>
					</a>
				</li>

				<li class="nav-header">Data Kategori</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/jurusan') ?>" class="nav-link <?= $page == 'jurusan' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-university"></i>
						<p>
							Jurusan
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/lk') ?>" class="nav-link <?= $page == 'lk' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-users"></i>
						<p>
							LK, Hima
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/pembayaran') ?>" class="nav-link <?= $page == 'pembayaran' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-wallet"></i>
						<p>
							Metode Pembayaran
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/tipelomba') ?>" class="nav-link <?= $page == 'tipelomba' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Jenis Lomba
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/vendor') ?>" class="nav-link <?= $page == 'vendor' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-building"></i>
						<p>
							Vendor
						</p>
					</a>
				</li>

				<li class="nav-header">Data Submisi User</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/donasi') ?>" class="nav-link <?= $page == 'donasi' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-money-check-alt"></i>
						<p>
							Donasi
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/lomba') ?>" class="nav-link <?= $page == 'lomba' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-flag-checkered"></i>
						<p>
							Lomba
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/wishlist') ?>" class="nav-link <?= $page == 'wishlist' ? 'active' : '' ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text-fill" viewBox="0 0 16 16">
  							<path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
						</svg>
						<i class="bi bi-chat-square-text-fill" style = "padding-right:5px;padding-left:3px"> </i>
						<p>
							Wishlist
						</p>
					</a>
				</li>
				<br>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>