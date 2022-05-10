<?php

/*
█████████████████████████████████████████████████████

				User form controller

		@ JavaScript user form controller
		@ -- handles submitting details
		@ -- to login script and updates
		@ -- the page on return. 

█████████████████████████████████████████████████████
*/
?>
    <script type="text/javascript">
    //When loginfrom is submitted (live event)
    $(document).on("submit", "#loginform", function() {
        var randNum = Math.floor(Math.random() * 1000000000);

        $.ajax({
            url: "/mng/mng_user.php?rand=" + randNum,
            dataType: 'text',
            type: 'POST',
            data: {
                "l_uname": $("[name='l_uname']").val(),
                "l_pword": $("[name='l_pword']").val(),
                "mode": "login"
            },
            beforeSend: function() {
                $('#loginload').show();
            },
            complete: function() {
                $('#loginload').hide();
            },
            success: function(result) {


                this.response = JSON.parse(result);

                if (this.response['success']) {

                    $('#login-body-container')[0].innerHTML = this.response['message'] + "<br> <small class='text-info'>Click outside of this box to close</small>";


                } else {

                    $('#login-error')[0].innerHTML = this.response['message'];
                    $('#login-error').show();

                };

                updateUserHeader();
                cartDisplayUpdate();
            }
        });
        return false; //stops the from submitting normally
    });
    </script>