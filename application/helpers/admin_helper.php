<?php

if (!function_exists('load_admin')) {
	function load_admin($loader, $view)
	{
		$loader->view('layout/admin/header');
		$loader->view('layout/admin/navbar');
		$loader->view('layout/admin/sidebar');

		$loader->view($view);

		$loader->view('layout/admin/footer');
	}
}
