<?php 

$active = 'dropinLi';
include '../includes/header_generic.php';
include '../includes/header_close.php';
?>
    <div class="dropin-page">
        <form id="checkout" method="post" action="../checkout/">
            <div id="dropin">
                <div class="loader_container">
                    <div>Loading...</div>
                </div>
            </div>
            <fieldset class="one_off_amount">
            <?php
                if(isset($_GET['amt'])) {
                    $amt = number_format((float)$_GET['amt'], 2, '.', '');
            ?>
                <h3>Your bill is for an amount of $ <?php echo $amt; ?></h3>
                <input type="hidden" name="amount" step="any" id="amount" value="<?php echo $amt; ?>" />
            <?php
                }else{
            ?>
                <label class="input-label" for="amount">
                    <span class="field-name">Amount</span>
                    <input id="amount" name="amount" class="input-field card-field" type="number" inputmode="numeric" placeholder="Amount" autocomplete="off" step="any">
                    <div class="invalid-bottom-bar"></div>
                </label>
            <?php
                }
            ?>
            </fieldset>
            <fieldset class="monthly_amount fieldset-label hide">
                <h4>Your subscription is for an amount of $10/month for a period of 6 months</h4>
            </fieldset>
            <fieldset>
                <div class="check_cont">
                    <input type="checkbox" name="recurring" value="1" />
                    <span class="icon check"></span>
                    <label for="recurring">Make this a monthly payment?</label>
                </div>
                <br/>
                <div class="check_cont">
                    <input type="checkbox" name="termsAndConditions" value="1" id="termsAndConditions" />
                     <span class="icon check"></span>
                    <label for="termsAndConditions">I accept the terms and conditions</label>
                </div>
            </fieldset>
            <div class="btn_container">
                <input type="submit" value="Pay" class="pay-btn">
                <span class="loader_img"></span>
            </div>
        </form>
        <section class="deletePaymentMethod">
            <h3><a href="../find_customer_from_vault">Delete Payment Method</a></h3>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script src="../js/dropin.js"></script>
    
<?php include '../includes/footer.php'; ?>