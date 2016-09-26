let addFunc = function(e) {
	console.log('Add clicked');
	console.log(e.parentNode);

	let sendData = $('#' + e.parentNode.id).serializeArray();
	sendData.push({ name: 'id', value: e.parentNode.id });

	$.ajax({
		type: 'POST',
		url: '../php/addToCart.php',
		data: sendData,
		dataType: 'json',
		success: (data) => {
			if(data.error == true) {
				console.log('Invalid amount');
				console.log(data.msg);
			} else {
				console.log('Valid amount');
				console.log('id: ' + data.id);
				console.log('amount: ' + data.totalAmount);
				console.log(data.msg);
			}
		},
		beforeSend: () => {

		},
		complete: () => {
			console.log('Ajax completed');
		},
		error: (e) => {
			console.error(e);
		}
	});

	return false;

};

let postFunc = () => {
	$.ajax({
		type: 'POST',
		url: '../php/post.php',
		data: $('#form-post').serialize(),
		dataType: 'json',
		success: (data) => {
			if (data.error == true) {
				$('#post-field').css({border: '1px solid red'});
			}	else {
				$('#post-field').css({border: '1px solid green'});
			}

			console.log(data.msg);
		},
		beforeSend: () => {
			$('#btn-post').html('...');
		},
		complete: () => {
			$('#btn-post').html('Post');
		},
		error: (e) => {
			console.error(e);
		}
	});

	return false;
};

$(document).ready(function() {
	$('#btn-post').on('click', postFunc);
});


