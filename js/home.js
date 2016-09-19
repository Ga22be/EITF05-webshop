let addFunc = function(e) {
  console.log('Add clicked');
  console.log(e.parentNode);
  //alert(e.parentNode.id);


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

//$(document).ready(function() {
  //$('#btn-add').on('click', addFunc);
//});
