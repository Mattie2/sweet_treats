$(window).on("load", function() {

    // Website finished loading 
    // Close the overlay
    $('#overlay').toggle();

    if ($('.cartdisplaydiv').length) {
        $.ajax({
            url: "/inc/inc_cartdisplay.inc.php",
            type: "get",
            success: function(data) {
                $('.cartdisplaydiv')[0].innerHTML = data;
            }
        })
    };

    //on page load, update the cart number
    updateCartNumber();
    updateHeaderCart();
});

function cartDisplayUpdate() {
    if ($('.cartdisplaydiv').length) {
        $.ajax({
            url: "/inc/inc_cartdisplay.inc.php",
            type: "get",
            success: function(data) {
                $('.cartdisplaydiv')[0].innerHTML = data;
            }
        })
    };
}


$(document).ready(function() {
    if ($('.quickAdd')) {
        $('.quickAdd').click(function(e) {

            var randNum = Math.floor(Math.random() * 1000000000);

            var id = e.target.attributes[1].nodeValue;
    
            $.ajax({
                url: "/mng/mng_cart.php?action=add&rand=" + randNum,
                dataType: 'text',
                type: 'POST',
                data: {
                    "productid": id
                },

                beforeSend: function() {
                    $('#cartload').html('Loading...');
                },
                complete: function() {
                    $('#cartload').html('');
                    cartDisplayUpdate();
                    updateHeaderCart()
                    updateCartNumber()
                },
                success: function(result) {

                    if (result === "Error") {
              
                        $('#login-modal').modal('show');
                    } else {

                        $('#headercart').html('').append(result);
                    }

                }
            })
        })
    };


    $('#header-cart-btn').click(function(){
    	$('.basket-drop').toggle();
    })
})


function updateUserHeader() {
    $.ajax({
        "url": "/inc/userHeader.inc.php",
        "method": "GET",
        success: function(data) {
            $('#header-user-control')[0].innerHTML = data;
            $('#mobile-header-user-control')[0].innerHTML = data;
        }
    })
};


function updateCartNumber() {
    $.ajax({
        "url": "/mng/mng_cart.php",
        "type": "GET",
        "data": {
            "action": "count"
        },
        success: function(data) {
            $('.mobile-basket-widget-items')[0].innerHTML = data;
            $('#headercart')[0].innerHTML = data;
            if($('#cart-ammount').length > 0){
                $('#cart-ammount')[0].innerHTML = data;
            }
       
        }
    })
}
updateCartNumber()


function updateHeaderCart(){
	$.ajax({
		"url": "/inc/cartDropdownList.php",
		"type": "GET",
		success: function(data){
			if(data.length > 0){
				this.data = JSON.parse(data);
				$('.basket-list')[0].innerHTML = this.data.list;
				$('.basket-price')[0].innerHTML = "£"+this.data.price.toFixed(2);

        
                $('.mobile-basket-widget-price')[0].innerHTML = "£"+this.data.price.toFixed(2);
			}else{
				$('.basket-list')[0].innerHTML = "Cart is empty";
				$('.basket-price')[0].innerHTML = "£0.00";
			}
			
		}
	})
};

/*
█████████████████████████████████████████████████████

Admin **Number Counter Function**
				
█████████████████████████████████████████████████████
*/


function charCounter(){
    this.details = $('#item-details').val();
    this.length = this.details.length;
    this.limit = 255;
    $('#details-counter')[0].innerHTML = this.length;
}
function charCounterShort(){
    this.details = $('#item-details-short').val();
    this.length = this.details.length;
    this.limit = 100;
    $('#details-counter-short')[0].innerHTML = this.length;
}


$(document).ready(function(){
    $('#item-details').on("keyup", function(){
        charCounter();
    })
    $('#item-details-short').on("keyup", function(){
        charCounterShort();
    })
})


/*
█████████████████████████████████████████████████████

    Mobile navigation Open / Close
                
█████████████████████████████████████████████████████
*/
var navigationTrack = false;
$(document).ready(function(){
    $('#mobile-nav-open').click(function(){
        if(navigationTrack){
            $('.global-container').animate({'right':'0'})
            navigationTrack = false;
        }else{
            $('.global-container').animate({'right':'50%'})
            navigationTrack = true;
        }
    })    
})



/*
█████████████████████████████████████████████████████

    Index image slider init
                
█████████████████████████████████████████████████████
*/
$(document).ready(function(){
    $('.header-slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        autoplay: true,
        arrows: false

    })
})
