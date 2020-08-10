// Shorthand for $( document ).ready()
$(function() {
  // console.log( "ready!" );
  $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

// --------------------------------------------------- localStorage

	// localStorage JS
	getData();
	shownoti();

  // change qty
  $('#tbody').on('change','.qty',function () {
    var id = $(this).data('id');
    var qty = $(this).val();

    var loItem = localStorage.getItem('items');
    var itemArr = JSON.parse(loItem);

    itemArr[id].qty = qty;

    if (qty == 0) {
      itemArr.splice(id,1);
    }

    localStorage.setItem('items',JSON.stringify(itemArr));
    getData();
		shownoti();
  })

  // remove item from ls
  $('#tbody').on('click','.remove',function () {
    var id = $(this).data('id'); // no

    var loItem = localStorage.getItem('items');
    var itemArr = JSON.parse(loItem);
    // delete
    itemArr.splice(id,1);

    localStorage.setItem('items',JSON.stringify(itemArr));
    getData();
		shownoti();
  })

  // data insert into ls
  $('.addtocart').click(function () {
  	// alert('ok');

    var id = $(this).data('id');
    var photo = $(this).data('photo');
    var name = $(this).data('name');
    var price = $(this).data('price');

    // alert(`id = ${id}, photo = ${photo}, name = ${name}, price = ${price}`);

    var item = {id:id,name:name,photo:photo,price:price,qty:1};

    var itemArr;

    var loItem = localStorage.getItem('items'); // string

    if (loItem == null) {
      itemArr = Array();
    }else{
      itemArr = JSON.parse(loItem);
    }

    var exist;

    $.each(itemArr,function (i,v) {
      if (id == v.id) {
        v.qty++;
        exist =1;
      }
    })

    if (!exist) {
      itemArr.push(item);
    }


    localStorage.setItem('items',JSON.stringify(itemArr));
    getData();
		shownoti();
  })

  // get data
  function getData() {
    var loItem = localStorage.getItem('items');
    var html="";
    var total=0;
    if (loItem != null) {
      itemArr = JSON.parse(loItem);
      $.each(itemArr,function (i,v) {
        var subtotal = v.qty * v.price;
        total+=subtotal;
        html+=`<tr>
                <td>
                	<p>${v.name}</p>
                	<img src="${v.photo}" width="100">
                </td>
                <td>${v.price}</td>
                <td><input type="number" value="${v.qty}" class="qty form-control w-50" data-id="${i}"></td>
                <td>${subtotal}</td>
                <td><button class="remove btn btn-outline-danger btn-sm px-3" data-id="${i}">x</button></td>
              </tr>`;
      })

      html+=`<tr>
              <td colspan="3">
                <center><strong>
                  Total :
                </strong></center>
              </td>
              <td colspan="2">
              	 ${total} MMK
              </td>
            </tr>`;

      $('#tbody').html(html);
    }else{
    	$('.cart-table').hide();
    	$('.cart-process').html('<h4 class="text-center">Your Cart is Empty!</h4>');
    }
  }

  // show noti
  function shownoti() {
  	var loItem = localStorage.getItem('items');
    var html="";
    var noti=0;
    if (loItem != null) {
      itemArr = JSON.parse(loItem);
      noti = itemArr.length;
      $('.noti-show').text(noti);
    }else{
    	$('.noti-show').text(noti);
    }
  }

// --------------------------------------------------- localStorage
});