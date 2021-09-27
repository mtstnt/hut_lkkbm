<?php if ($this->session->flashdata('err')) : ?>
	<div class="alert alert-danger">
		<?= $this->session->flashdata('err') ?>
	</div>
<?php endif; ?>
<?php if ($this->session->flashdata('ok')) : ?>
	<div class="alert alert-success">
		<?= $this->session->flashdata('ok') ?>
	</div>
<?php endif; ?>