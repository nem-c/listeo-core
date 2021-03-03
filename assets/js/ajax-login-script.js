/* ----------------- Start Document ----------------- */
(function($){
"use strict";

$(document).ready(function(){ 
    

    // Perform AJAX login on form submit
    $('#sign-in-dialog form#login').on('submit', function(e){
        var redirecturl = $('input[name=_wp_http_referer]').val();
        var success;
        $('form#login .notification').removeClass('error').addClass('notice').show().text(listeo_login.loadingmessage);
        
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: listeo_login.ajaxurl,
                data: { 
                    'action': 'listeoajaxlogin', 
                    'username': $('form#login #user_login').val(), 
                    'password': $('form#login #user_pass').val(), 
                    'login_security': $('form#login #login_security').val()
                   },
             
                }).done( function( data ) {
                    if (data.loggedin == true){
                        $('form#login .notification').show().removeClass('error').removeClass('notice').addClass('success').text(data.message);
                        //document.location.href = redirecturl;
                        success = true;
                    } else {
                        $('form#login .notification').show().addClass('error').removeClass('notice').removeClass('success').text(data.message);
                    }
            } )
            .fail( function( reason ) {
                // Handles errors only
                console.debug( 'reason'+reason );
            } )
            
            .then( function( data, textStatus, response ) {
                if(success){
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: listeo_login.ajaxurl,
                        data: { 
                            'action': 'get_logged_header', 
                        },
                        success: function(new_data){
                            $('body').removeClass('user_not_logged_in');                        
                            $('.header-widget').html(new_data.data.output);
                            var magnificPopup = $.magnificPopup.instance; 
                              if(magnificPopup) {
                                  magnificPopup.close();   
                              }
                        }
                    });
                    var post_id = $('#form-booking').data('post_id');
                    var owner_widget_id = $('.widget_listing_owner').attr('id');
                    var freeplaces = $('.book-now-notloggedin').data('freeplaces');
                    
                    if(post_id) {
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: listeo_login.ajaxurl,
                            data: { 
                                'action': 'get_booking_button',
                                'post_id' : post_id,
                                'owner_widget_id' : owner_widget_id,
                                'freeplaces' : freeplaces

                            },
                            success: function(new_data){
                                var freeplaces = $('.book-now-notloggedin').data('freeplaces');
                                $('.book-now-notloggedin').replaceWith(new_data.data.booking_btn);
                                $('.like-button-notlogged').replaceWith(new_data.data.bookmark_btn);
                                $('#owner-widget-not-logged-in').replaceWith(new_data.data.owner_data);
                            }
                        });
                    }
                }
                
             
                // In case your working with a deferred.promise, use this method
                // Again, you'll have to manually separates success/error
            }) 
        e.preventDefault();
    });

    // Perform AJAX login on form submit
    $('#sign-in-dialog form#register').on('submit', function(e){

  		$('form#register .notification').removeClass('error').addClass('notice').show().text(listeo_login.loadingmessage);

        var form = $('form#register').serializeArray();
        var action_key = {
              name: "action",
              value: 'listeoajaxregister'
        }; 
        var privacy_key = {
              name: "privacy_policy",
              value: $('form#register #privacy_policy:checked').val()
        };   
      
        form.push(action_key);
        form.push(privacy_key);
   

   // 'g-recaptcha-response': $('form#register #g-recaptcha-response').val(),
   //              'token': $('form#register #token').val(),
   //              'g-recaptcha-action': $('form#register #action').val()

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: listeo_login.ajaxurl,
            data: form,
            // data: { 
            //     'action': 'listeoajaxregister', 
            //     'role': $('form#register .account-type-radio:checked').val(), 
            //     'username': $('form#register #username2').val(), 
            //     'email':    $('form#register #email').val(), 
            //     'password': $('form#register #password2').val(), 
            //     'first-name': $('form#register #first-name').val(), 
            //     'last-name': $('form#register #last-name').val(), 
            //     'password': $('form#register #password1').val(), 
            //     'privacy_policy': $('form#register #privacy_policy:checked').val(), 
            //     'register_security': $('form#register #register_security').val(),
            //     'g-recaptcha-response': $('form#register #g-recaptcha-response').val()
            // },
            success: function(data){

                if (data.registered == true){
				    $('form#register .notification').show().removeClass('error').removeClass('notice').addClass('success').text(data.message);
				    // $( 'body, html' ).animate({
        //                 scrollTop: $('#sign-in-dialog').offset().top
        //             }, 600 );
                    $('#register').find('input:text').val(''); 
                    $('#register input:checkbox').removeAttr('checked');
                    if(listeo_core.autologin){
                        setTimeout(function(){
                            window.location.reload(); // you can pass true to reload function to ignore the client cache and reload from the server
                        },2000);    
                    }
                    

				} else {
					$('form#register .notification').show().addClass('error').removeClass('notice').removeClass('success').text(data.message);
                      
                    if(listeo_core.recaptcha_status){
                        if(listeo_core.recaptcha_version == 'v3'){
                            getRecaptcha();        
                        }
                    }
				}

            }
        });
        e.preventDefault();
    });


});



})(this.jQuery);