let loginFunc = () => {
	$.ajax({
		type: 'POST',
		url: '../php/login.php',
		data: $('#form-login').serialize(),
		dataType: 'json',
		success: (data) => {
			if (data.error == true) {
				$('#resp').html(data.msg);
				$('#resp').addClass('err');
				$('#resp').removeClass('succ');
			} else {
				window.location.href = '../pages/receipt.php';
			}
		},
		beforeSend: () => {
			$('#btn-login').html('Loading...');
		},
		complete: () => {
			console.log('ajax completed');
			$('#btn-login').html('Login');
		},
		error: (e) => {
			console.error(e);
		}
	});

	return false;
};

$(document).ready(() => {
	$('#btn-login').on('click', loginFunc);
});
