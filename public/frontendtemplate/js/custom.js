$(document).ready(function () {
	// localStorage JS
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$('.checkout').click(function () {
		// alert('ok');
		var loStr = localStorage.getItem('cart');
		if (loStr) {
			$.post("/checkout",{data:loStr},function (res) {
				console.log(res);
			})
			localStorage.clear();
			window.location.href="/";
		}
	})
})