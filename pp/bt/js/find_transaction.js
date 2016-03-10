(function() {
    
    var BTFn = {};

    BTFn.sendJSON = function(txn_id, $obj) {

        $.ajax({
            dataType: "text",
            type: "POST",
            data: { txn_id: txn_id },
            url: "../server/find_transaction/",
            success: function (req) {
                BTFn.insertTxnDetails(req, $obj);
            },
            error: function() {
            }
        });
    };

    BTFn.insertTxnDetails = function(req, $obj) {

        var $tList = $('.transaction-list').html(''), $h2 = $('<h2 />'), $pCl = $('<p />'), THIS = this;

        function appendHtml($cont, $insert, label, html) {
            THIS.append($cont, $insert.clone().html('<strong class="label">' + label + ':</strong> ' + html));
        }

        if(req == 'false') {
            $tList.html($('<p />', {
                'class': 'error',
                'text': 'Sorry, no transaction matches this ID'
            }));
        }else{
            req = JSON.parse(req);
            this.append($tList, $h2.clone().text('Information for txn ' + req.id));
            appendHtml($tList, $pCl, 'Amount', req.amount);
            appendHtml($tList, $pCl, 'Currency', req.currencyIsoCode);
            appendHtml($tList, $pCl, 'Transaction type', req.type);
            appendHtml($tList, $pCl, 'Payment status', req.status);
            appendHtml($tList, $pCl, 'Transaction date', req.createdAt.date);
            appendHtml($tList, $pCl, 'Customer ID', req.customer.id);
            appendHtml($tList, $pCl, 'Customer company', req.customer.company);
            appendHtml($tList, $pCl, 'Customer email', req.customer.email);
            appendHtml($tList, $pCl, 'Customer firstname', req.customer.firstName);
            appendHtml($tList, $pCl, 'Customer lastname', req.customer.lastName);
            appendHtml($tList, $pCl, 'Customer phone number', req.customer.phone);
            appendHtml($tList, $pCl, 'Payment instrument', req.paymentInstrumentType);
            if(req.paymentInstrumentType == 'credit_card') {
                this.append($tList, $pCl.clone().html('<strong class="label">Credit card type:</strong> ' + req.creditCard.cardType));
                this.append($tList, $pCl.clone().html('<strong class="label">Cardholder name:</strong> ' + req.creditCard.cardHolderName));
                this.append($tList, $pCl.clone().html('<strong class="label">Credit card number:</strong> ' + req.creditCard.bin + '*** **** ' + req.creditCard.last4));
                this.append($tList, $pCl.clone().html('<strong class="label">Expiration:</strong> ' + req.creditCard.expirationMonth + '/' + req.creditCard.expirationYear));
                this.append($tList, $pCl.clone().html('<strong class="label">CVV response:</strong> ' + req.cvvResponseCode));
                this.append($tList, $pCl.clone().html('<strong class="label">AVS street address response:</strong> ' + req.avsStreetAddressResponseCode));
                this.append($tList, $pCl.clone().html('<strong class="label">AVS postal code response:</strong> ' + req.avsPostalCodeResponseCode));
                this.append($tList, $pCl.clone().html('<strong class="label">Payment token:</strong> ' + req.creditCard.token));
            }else{
                this.append($tList, $pCl.clone().html('<strong class="label">PayPal merchant account ID:</strong> ' + req.merchantAccountId));
                this.append($tList, $pCl.clone().html('<strong class="label">Payer email:</strong> ' + req.paypal.payerEmail));
                this.append($tList, $pCl.clone().html('<strong class="label">Payee email:</strong> ' + req.paypal.payeeEmail));
                this.append($tList, $pCl.clone().html('<strong class="label">Payer firstname:</strong> ' + req.paypal.payerFirstName));
                this.append($tList, $pCl.clone().html('<strong class="label">Payer lastname:</strong> ' + req.paypal.payerLastName));
                this.append($tList, $pCl.clone().html('<strong class="label">Authorization ID:</strong> ' + req.paypal.authorizationId));
                this.append($tList, $pCl.clone().html('<strong class="label">Payment ID:</strong> ' + req.paypal.paymentId));
                this.append($tList, $pCl.clone().html('<strong class="label">Payment token:</strong> ' + req.paypal.token));
                this.append($tList, $pCl.clone().html('<strong class="label">Seller protection status:</strong> ' + req.paypal.sellerProtectionStatus));
            }
        }
        $obj.show().closest('.btn_container').find('.loader_img').hide();
    };

    BTFn.append = function($target, $insert) {
        $target.append($insert);
    };

    $(document).ready(function() {

        var $search_id = $('.search_id'), $inputField = $('#txn_id');
        $search_id.on('click', function() {
            searchTerms($(this));
        });
        $inputField.on('keyup', function(e) {
            if(e.keyCode == '13') {
                searchTerms($search_id);
            }
        });
        function searchTerms($obj) {
            var txn_id = $('input[name="txn_id"]').val();
            $obj.hide().closest('.btn_container').find('.loader_img').css('display', 'inline-block');
            BTFn.sendJSON(txn_id, $obj);
        }
    });
})();