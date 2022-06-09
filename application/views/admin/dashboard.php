<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">General Info</h3>
				</div>
				<div class="card-body">
					<div class="row">

						<div class="col-6">
							<div class="small-box bg-info">
								<div class="inner">
									<h3 class="format-money" data-value="<?= $total ?>"></h3>
									<p>Total Donasi</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-6">
							<div class="small-box bg-success">
								<div class="inner">
									<h3 class="format-money" data-value="<?= $total_today ?>"></h3>
									<p>Donasi Hari Ini</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-6">
							<div class="small-box bg-warning">
								<div class="inner">
									<h3><?= ($total / $informasi->target_donasi) * 100 ?>%</h3>
									<p>Persentase ke Target</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-6">
							<div class="small-box bg-danger">
								<div class="inner">
									<h3 class="format-money" data-value="<?= $informasi->target_donasi ?>"></h3>
									<p>Target Donasi</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->