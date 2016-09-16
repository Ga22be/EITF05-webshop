$('#btn-add').click(() => {
  console.log("Add clicked");

  $.ajax({
    type='POST',
    url='../php/addToCart.php',
    data: $('cartAdd').serialize(),
    dataType='json',
    success: (data) => {
      if(data.error == true) {
        console.log('Invalid amount');
        console.log(data.msg);
      } else {
        console.log('Valid amount');
        console.log(data.msg);
      }
    },
    beforeSend: () => {

    },
    complete: () => {
      .console.log('Ajax completed');
    },
    error: (e) => {
      console.error(e);
    }
  });

})
