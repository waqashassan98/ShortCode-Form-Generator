jQuery( document ).ready(function() {
    
    jQuery("#wh_optin_form_1 input[name='date_time']").val(moment().format('MMMM Do YYYY, h:mm:ss a'));

    jQuery('#wh_optin_form_1 .button').on('click', function(e) {
	    e.preventDefault();
	    e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too

	    var myid = "wh_optin_form_1";
	    
	    var name = jQuery("#"+myid+ " input[name='full_name']").val();
	    var phone = jQuery("#"+myid+ " input[name='phone_num']").val();
	    var email = jQuery("#"+myid+ " input[name='email']").val();
	    var budget = jQuery("#"+myid+ " input[name='budget']").val();
	    var message = jQuery("#"+myid+ " textarea[name='message']").val();
	    var dt = jQuery("#"+myid+ " input[name='date_time']").val();

	    console.log(name +" "+ phone + " " +email +" "+ budget+" "+ message);
	    jQuery('#wh_optin_form_1 .success').toggle(false);
	    jQuery('#wh_optin_form_1 .error').toggle(false);
	    jQuery('#wh_optin_form_1 .button').prop('disabled', true);
	    jQuery.ajax({ 
	         data: {action: 'form_submission_handler', full_name:name, phone_num:phone, u_email:email, budget:budget, u_message:message, dt:dt, nonce:ajax_submit_obj.nonce},
	         type: 'post',
	         url: ajax_submit_obj.ajaxurl,
            method:"post",
	         success: function(data) {
	         	jQuery('#'+myid+ ' .success').html("Thankyou for contacting us. We will be in touch shortly.");
	         	jQuery('#'+myid+ ' .success').toggle(true);
	            console.log(data); 
	            jQuery('#'+myid).trigger("reset");
	            jQuery('#'+myid+ ' .button').prop('disabled', false);


	        },
	        error : function(error){ 
	        	jQuery('#'+myid+ ' .error').html("Error: "+ error.responseJSON.msg);
	         	jQuery('#'+myid+ ' .error').toggle(true);
	        	console.log(error.responseJSON.msg)
	        	jQuery('#'+myid+ ' .button').prop('disabled', false);
	        }
	    });
	});

  

});
