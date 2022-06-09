<?php

if (!function_exists('load_admin')) {
	function load_admin($loader, $view, $data)
	{
		$loader->view('layout/admin/header', $data);
		$loader->view('layout/admin/navbar', $data);
		$loader->view('layout/admin/sidebar', $data);

		$loader->view($view, $data);

		$loader->view('layout/admin/footer', $data);
	}
}

if (!function_exists('load_main')) {
	function load_main($loader, $view, $data = [])
	{
		$loader->view('layout/main/header', $data);
		$loader->view('layout/main/navbar', $data);
		$loader->view($view, $data);
		$loader->view('layout/main/footer', $data);
	}
}
