<?php 

$active = 'hostedLi';
include '../includes/header_generic.php';
include '../includes/header_close.php';
?>
    <h1 class="bt_title">Braintree Hosted Fields</h1>
    <form id="bt_custom_form" name="bt_custom_form" method="post" action="../checkout/">
        <div class="loader_container">
            <div class="loader_img loader"></div>
        </div>
        <div class="bt_form_wrap hide invisible">
            <fieldset>
                    <p class="amountDeclare">Amount to be paid 10.00 ($)</p>
                    <input type="hidden" name="amount" id="amount" value="10" />
            </fieldset>
            <fieldset>
                <label for="bt_card_number">Card number</label>
                <div id="bt_card_number" class="inputFields"></div>
            </fieldset>
            <fieldset>
                <label for="bt_cvv">CVV</label>
                <div id="bt_cvv" class="inputFields"></div>
            </fieldset>
            <fieldset>
                <label for="bt_exp_date">Expiration date (MM/YY)</label>
                <div id="bt_exp_date" class="inputFields"></div>
            </fieldset>
            <div id="bt_paypal_container"></div>
            <div class="btn_container">
                <button class="pay-btn">Pay</button>
                <span class="loader_img"></span>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="https://js.braintreegateway.com/js/beta/braintree-hosted-fields-beta.18.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/hosted_fields.js"></script>

<?php include '../includes/footer.php'; ?>