(function() {
    
    var BTFn = {};

    BTFn.sendJSON = function($pay_btn) {

        $.ajax({
            dataType: "text",
            type: "POST",
            data: {},
            url: "../server/",
            success: function (req) {
                BTFn.initBT(req, $pay_btn);
            },
            error: function() {
            }
        });
    };

    BTFn.initBT = function(req, $pay_btn) {

        braintree.setup(
            req,
            'dropin', {
                container: 'dropin',
                onPaymentMethodReceived:function(obj){

                    BTFn.appendTo(document.forms.checkout, 'input', {name: 'payment_method_nonce', type: 'hidden', value: obj.nonce});
                    document.forms.checkout.submit();
                },
                onReady:function(){
                    $('.loader_container').remove();
                },
                onError: function(error) {
                    $pay_btn.show().closest('.btn_container').find('.loader_img').hide();
                }
        });
    };

    BTFn.formValidate = function($form, $submit, $terms, $amount, $pay_btn, $recurring, $checks) {

        var THIS = this;

        $submit.on('click', function(e) {

            $('.input-label .invalid-bottom-bar').removeClass('invalid');
            if(!$terms.prop('checked')) {
                alert('Please accept our terms and conditions.');
                return false;
            }
            if(!$('.one_off_amount').hasClass('hide') && ($amount.val() === '' || $amount.val() < 0)) {
                $('.input-label .invalid-bottom-bar').addClass('invalid');
                return false;
            }
            $(this).hide().closest('.btn_container').find('.loader_img').css('display', 'inline-block');
        });

        $checks.on('click', function() {

            $(this).toggleClass('checked');
            var $checkbox = $(this).closest('.check_cont').find('input[type="checkbox"]');
            $(this).hasClass('checked') ? THIS.changeChecks($checkbox, true, $recurring, $form) : THIS.changeChecks($checkbox, false, $recurring, $form);
        });
    };

    BTFn.changeChecks = function($checkbox, isChecked, $recurring, $form) {

        $checkbox.prop('checked', isChecked);
        if($checkbox.attr('name').toLowerCase() === 'recurring') {
            $recurring.prop('checked') ? this.updateForm($form, '../checkout/recurring.php') : this.updateForm($form, '../checkout/');
        } 
    };

    BTFn.updateForm = function($form, link) {
        
        $form.attr('action', link);
        $('.one_off_amount, .monthly_amount').toggleClass('hide');
    };

    BTFn.appendTo = function($cont, childSelector, options) {

        var input = document.createElement(childSelector);
        input.type = options.type;
        input.name = options.name;
        input.value = options.value;
        $cont.appendChild(input);
    };

    $(document).ready(function() {

        var $form = $('#checkout'), $submit = $('#checkout input[type="submit"]'), $terms = $('input[name="termsAndConditions"]'), $amount = $('input[name="amount"]'), $pay_btn = $('.pay-btn'), $recurring = $('input[name="recurring"]'), $checks = $('.icon.check');

        BTFn.sendJSON($pay_btn);
        BTFn.formValidate($form, $submit, $terms, $amount, $pay_btn, $recurring, $checks);
    });
})();