<link href="http://fonts.googleapis.com/css?family=Reenie+Beanie:regular" rel="stylesheet" type="text/css">
<style>
	* {
		margin: 0;
		padding: 0;
	}

	.wishlist-container {
		font-family: arial, sans-serif;
		font-size: 100%;
		margin: 1em;
		color: #fff;
	}

	.wishlist-container h2,
	.wishlist-container p {
		font-size: 100%;
		font-weight: normal;
	}

	.wishlist-container ul,
	.wishlist-container li {
		list-style: none;
	}

	.wishlist-container ul {
		overflow: hidden;
		padding: 2em;
	}

	.wishlist-container ul li a {
		text-decoration: none;
		color: #000;
		background: #ffc;
		display: block;
		height: 20em;
		width: 100%;
		padding: 2em;
		overflow-y: hidden;
		-moz-box-shadow: 5px 5px 7px rgba(33, 33, 33, 1);
		-webkit-box-shadow: 5px 5px 7px rgba(33, 33, 33, .7);
		box-shadow: 5px 5px 7px rgba(33, 33, 33, .7);
		-moz-transition: -moz-transform .15s linear;
		-o-transition: -o-transform .15s linear;
		-webkit-transition: -webkit-transform .15s linear;
		transition: -webkit-transform .15s linear;
	}


	.wishlist-container ul li {
		margin: 2em;
		float: left;
		width: 22%;
	}

	@media (max-width: 768px) {
		.wishlist-container ul li {
			width: 100%;
		}
	}

	.wishlist-container ul li h2 {
		font-size: 140%;
		font-weight: bold;
	}

	.wishlist-container ul li p {
		font-family: "Reenie Beanie", arial, sans-serif;
		font-size: 110%;
	}

	.wishlist-container ul li a {
		-webkit-transform: rotate(-6deg);
		-o-transform: rotate(-6deg);
		-moz-transform: rotate(-6deg);
		transform: rotate(-6deg);
	}

	.wishlist-container ul li:nth-child(even) a {
		-o-transform: rotate(4deg);
		-webkit-transform: rotate(4deg);
		-moz-transform: rotate(4deg);
		transform: rotate(4deg);
		position: relative;
		top: 5px;
		background: #cfc;
	}

	.wishlist-container ul li:nth-child(3n) a {
		-o-transform: rotate(-3deg);
		-webkit-transform: rotate(-3deg);
		-moz-transform: rotate(-3deg);
		transform: rotate(-3deg);
		position: relative;
		top: -5px;
		background: #ccf;
	}

	.wishlist-container ul li:nth-child(5n) a {
		-o-transform: rotate(5deg);
		-webkit-transform: rotate(5deg);
		-moz-transform: rotate(5deg);
		transform: rotate(5deg);
		position: relative;
		top: -10px;
	}

	.wishlist-container ul li a:hover,
	.wishlist-container ul li a:focus {
		box-shadow: 10px 10px 7px rgba(0, 0, 0, .7);
		-moz-box-shadow: 10px 10px 7px rgba(0, 0, 0, .7);
		-webkit-box-shadow: 10px 10px 7px rgba(0, 0, 0, .7);
		-webkit-transform: scale(1.25);
		-moz-transform: scale(1.25);
		-o-transform: scale(1.25);
		transform: scale(1.25);
		position: relative;
		z-index: 5;
	}

	.wishlist-container ol {
		text-align: center;
	}

	.wishlist-container ol li {
		display: inline;
		padding-right: 1em;
	}

	.wishlist-container ol li a {
		color: #fff;
	}

	.wishlist-card h5 {
		line-height: 1.2rem;
		margin-bottom: 10px;
	}

	#main {
		background: 
		linear-gradient(rgba(18, 28, 38, 0.5), rgba(18, 28, 38, 0.5)), 
		url(<?= base_url("assets/main/img/background-foto.jpg") ?>) top center;
		
		background-attachment: fixed;
	}

	.title {
		background-color: #fff
	}
</style>

<main id="main" class="main-page">
	<div class="p-3 title">
		<h1 class="text-center p-5 fw-bold" style="font-size: 4rem;">Apa Harapanmu?</h1>
		<div class="text-center mb-2">
			<a class="btn btn-primary px-5 py-3 x-bg-primary" href="<?= base_url('wishlist/form') ?>">Buat Wishlist</a>
		</div>
	</div>
	<div class="wishlist-container">
		<ul id="wishlist-cards" class="d-flex justify-content-center flex-wrap">
		</ul>
		<div class="w-100 d-flex justify-content-center">
			<div class="spinner-border text-dark my-3" id="loading"></div>
		</div>
	</div>
</main>

<template id="card">
	<li class="wishlist-card">
		<a href="#">
			<h4 class="name fw-bold px-1 py-0 my-0" style="font-family: Helvetica"></h4>
			<h6 class="asal px-1 py-0 my-0"></h6>
			<h6 class="prodi px-1 py-0 my-0"></h6>
			<p class="note p-1"></p>
		</a>
	</li>
</template>

<script>
	var offset = 0;
	const OFFSET_INCR = 9;

	var baseUrl = "<?= base_url() ?>";

	var loading = document.getElementById('loading');
	var cardTmpl = document.getElementById('card');
	var wishlistCards = document.getElementById('wishlist-cards');

	var isDelayed = false;
	var delayInterval = null;

	function getWishlists(data) {
		loading.style.display = "block";

		return fetch(baseUrl + "/wishlist/get_data", {
			method: "POST",
			body: JSON.stringify(data),
		});
	}

	function addPosts(data) {
		var cardNode = cardTmpl.content.cloneNode(true);
		cardNode.querySelector('.name').innerText = data['nama'] || "";
		
		var tipe_user = "";
		if (data['tipe_user'] != null) {
			switch (data['tipe_user']) {
				case "Mahasiswa": 
					tipe_user = "Mahasiswa UK Petra";
					break;
				case "Alumni":
					tipe_user = "Alumni UK Petra";
					break;
				default:
					tipe_user = data['tipe_user'];
			}
		}

		var jurusan = null;
		if (data['prodi'] != null) {
			jurusan = "Jurusan " + data['prodi'];
		}


		cardNode.querySelector('.asal').innerText = tipe_user || "";
		cardNode.querySelector('.prodi').innerText = jurusan || "";
		cardNode.querySelector('.note').innerText = data['content'] || "";

		wishlistCards.appendChild(cardNode);
	}

	function loadWishlists() {
		if (scrollY + innerHeight >= document.body.offsetHeight && !isDelayed) {
			isDelayed = true;
			var w = getWishlists({
					offset: offset
				})
				.then(res => {
					return res.json();
				})
				.then(json => {
					var data = json['data'];
					if (data.length > 0) {
						offset += OFFSET_INCR;
						console.log(offset);
					}
					for (let i of data) {
						addPosts(i);
					}
					loading.style.display = "none";
				});

			delay = setTimeout(() => {
				isDelayed = false;
				clearTimeout(delay);
			}, 3000);
		}
	}

	onscroll = loadWishlists;

	loadWishlists();
</script>