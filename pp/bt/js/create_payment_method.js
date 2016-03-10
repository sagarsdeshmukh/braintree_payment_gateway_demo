(function() {
    
    var BTFn = {};

    BTFn.sendJSON = function() {

        $.ajax({
            dataType: "text",
            type: "POST",
            data: {},
            url: "../server/",
            success: function (req) {
                BTFn.initBT(req);
            },
            error: function() {
            }
        });
    };

    BTFn.initBT = function(req) {

        braintree.setup(
            req,
            'dropin', {
                container: 'dropin',
                onReady:function(){
                    $('.dropin-page').removeClass('invisible');
                    $('.loader_img.loader').remove();
                },
                onPaymentMethodReceived:function(obj){
                    $('#checkout').append($('<input />', {
                        'type' : 'hidden',
                        'name' : 'payment_method_nonce',
                        'value' : obj.nonce
                    }));
                    document.forms.checkout.submit();
                }
        });
    };

    $(document).ready(function() {

        BTFn.sendJSON();
        $btn_submit = $('#checkout input[type="submit"]');
        $btn_submit.on('click', function() {
            $(this).hide().closest('.btn_container').find('.loader_img').css('display', 'inline-block');
        });
    });
})();