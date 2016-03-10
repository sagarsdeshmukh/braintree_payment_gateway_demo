(function() {
    
    var BTFn = {};

    BTFn.sendJSON = function(ajaxUrl) {

        $.ajax({
            dataType: "text",
            type: "POST",
            data: {},
            url: ajaxUrl,
            success: function (req) {

                req = JSON.parse(req);
                BTFn.findPaymentMethods(req, ajaxUrl);
            },
            error: function() {
            }
        });
    };

    BTFn.findPaymentMethods = function(req, ajaxUrl) {
        var i, $div = $('.payment-methods-list');

        $div.html('<h4>Payment methods for ' + req.name.first + ' ' + req.name.last + '.</h4>');

        // get credit card payment methods
        for(i=0; i<req.creditCards.length;i++) {
            
            switch(req.creditCards[i]._attributes.cardType.toLowerCase()){
                case 'mastercard' :
                req.creditCards[i]._attributes.className = 'master-card';
                break;
                case 'american express' :
                req.creditCards[i]._attributes.className = 'american-express';
                break;
                default :
                req.creditCards[i]._attributes.className = req.creditCards[i]._attributes.cardType;
                break;
            }
            req.creditCards[i]._attributes.matrix = i;
            var insert = '<div><div class="payment-method-item card-label"><span class="payment-method-icon stick-left ' + req.creditCards[i]._attributes.className.toLowerCase() + '"></span><span class="payment-method-type">' + req.creditCards[i]._attributes.cardType + '</span><span class="payment-method-description">ending in ' + req.creditCards[i]._attributes.last4.substr(2) + '</span></div><div class="confirm-delete"><span class="yes">Delete</span>Are you sure?<span class="no">Cancel</span><input type="hidden" name="matrix" value="' + i + '" /></div></div>';
            $div.append(insert);
        }

        // get paypal mapyment methods
        for(i=0; i<req.ppAccounts.length;i++) {

            req.ppAccounts[i]._attributes.matrix = i;
            var insert = '<div><div class="payment-method-item card-label"><span class="payment-method-icon stick-left paypal"></span><span class="payment-method-type">PayPal</span><span class="payment-method-description">' + req.ppAccounts[i]._attributes.email + '</span></div><div class="confirm-delete"><span class="yes">Delete</span>Are you sure?<span class="no">Cancel</span><input type="hidden" name="matrix" value="' + i + '" /><input type="hidden" name="qq" value="" /></div></div>';
            $div.append(insert);
        }
        BTFn.deletePaymentMethod(req, ajaxUrl);
    };

    BTFn.deletePaymentMethod = function(req, ajaxUrl){

        var $paymentMethod = $('.payment-method-item'), $confirmDelete = $('.confirm-delete'), $yesDelete = $('.confirm-delete .yes'), $noDelete = $('.confirm-delete .no');

        $paymentMethod.add($noDelete).on('click', function(){
            $obj = $(this);
            $confirmDelete.removeClass('enter');
            $paymentMethod.removeClass('exit');
            if(!$obj.hasClass('no')){
                $obj.addClass('exit');
                $obj.next('.confirm-delete').addClass('enter');
            }
        });

        $yesDelete.on('click', function(){
            var $obj = $(this), $parent = $obj.closest('.confirm-delete'), matrixVal = parseInt($parent.find('input[name="matrix"]').val()), accessor, i;
            $obj.hide();
            $parent.append($('<span />', {
                'class' : 'loader_img'
            }));
            if($parent.find('input[name="qq"]').length < 1){
                accessor = 'creditCards';
            }else{
                accessor = 'ppAccounts';
            }

            for(i=0;i<req[accessor].length;i++){
                if(req[accessor][i]._attributes.matrix === matrixVal){
                    BTFn.deleteTokenisedPayment(req[accessor][i]._attributes.token, ajaxUrl);
                }
            }
        });
    };

    BTFn.deleteTokenisedPayment = function(tok, ajaxUrl){

        $.ajax({
            dataType: "json",
            type: "POST",
            data: { tokenValue : tok},
            url: "../server/delete/",
            success: function (req) {
                BTFn.sendJSON(ajaxUrl);
            },
            error: function() {
            }
        });
    };

    $(document).ready(function() {

        var cId, ajaxUrl;

        if($('input[name="cId"]').length > 0){

            cId = $('input[name="cId"]').val();

            ajaxUrl = '../server/find/?id=' + cId;
        }else{

            ajaxUrl = '../server/find/';
        }
        BTFn.sendJSON(ajaxUrl);
    });
})();