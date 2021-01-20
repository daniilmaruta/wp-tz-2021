jQuery(document).ready(function($) {

    let body = $('body');
    let tz_form = $('js-tz_add_realty_form');

    body.on( 'click', '.js-tz_add_realty', function(e) {
        e.preventDefault();
        var data = {
            action: 'tz_add_realty',
            nonce: tz_realty_ajax.nonce,
            form_data: tz_form.serialize()
        };
        $.ajax({
            type: 'POST',
            url: tz_realty_ajax.url,
            data: data,
            beforeSend: function() {
            },
            success: function(response){
                if ( response.error !== false ) {
                    let response_wrap = $('.js-tz_add_realty_response');
                    response_wrap.html( response.html );
                }
            }
        });
    });

});
