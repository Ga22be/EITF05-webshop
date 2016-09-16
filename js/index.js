$('#btn-login').click(() => {
	console.log('Login clicked');

	$.ajax({
		type: 'POST',
		url: '../php/login.php',
		data: $('#form-logreg').serialize(),
		dataType: 'json',
		success: (data) => {
			if (data.error == true) {
				console.log('invalid credentials');
				console.log(data.msg);
			} else {
				console.log('valid credentials');
				console.log(data.msg);
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
});

$('#btn-register').click(() => {
	console.log('Register clicked');
	$.ajax({
		type: 'POST',
		url: '../php/register.php',
		data: $('#form-logreg').serialize(),
		dataType: 'json',
		success: (data) => {
			if (data.error == true) {
				console.log('invalid credentials');
				console.log(data.msg);
			} else {
				console.log('valid credentials');
				console.log(data.msg);
			}
		},
		beforeSend: () => {
			$('#btn-register').html('Loading...');
		},
		complete: () => {
			console.log('ajax completed');
			$('#btn-register').html('Login');
		},
		error: (e) => {
			console.error(e);
		}
	});

	return false;
});
