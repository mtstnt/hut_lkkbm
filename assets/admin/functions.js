
function formatMoney() {
	var formatMoney = document.querySelectorAll('.format-money');

	formatMoney.forEach((el, idx) => {
		var originalValue = el.getAttribute('data-value');
		if (el.tagName == "INPUT") {
			el.value = "Rp" + originalValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
		} else {
			el.innerHTML = "Rp" + originalValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
		}
	});
}

formatMoney();