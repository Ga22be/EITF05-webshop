let loginFunc = () => {
	if ($('#form-login').hasClass('hide')) {
		$('#form-register').addClass('hide');
		$('#form-login').removeClass('hide');

		return false;
	}

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
				window.location.href = '../pages/home.php';
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

let registerFunc = () => {
	if ($('#form-register').hasClass('hide')) {
		$('#form-login').addClass('hide');
		$('#form-register').removeClass('hide');

		return false;
	}

	$.ajax({
		type: 'POST',
		url: '../php/register.php',
		data: $('#form-register').serialize(),
		dataType: 'json',
		success: (data) => {
			if (data.error == true) {
				$('#resp').addClass('err');
				$('#resp').removeClass('succ');
			} else {
				$('#resp').addClass('succ');
				$('#resp').removeClass('err');
			}
			$('#resp').html(data.msg);
		},
		beforeSend: () => {
			$('#btn-register').html('Loading...');
		},
		complete: () => {
			console.log('ajax completed');
			$('#btn-register').html('Register');
		},
		error: (e) => {
			console.error(e);
		}
	});

	return false;
};

$(document).ready(() => {
	$('#btn-toRegister').on('click', registerFunc);
	$('#btn-register').on('click', registerFunc);
	$('#btn-toLogin').on('click', loginFunc);
	$('#btn-login').on('click', loginFunc);
});
