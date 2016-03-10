<?php 

$active = 'addLi';
include '../includes/header_generic.php';
include '../includes/header_close.php';
?>
    <span class="loader_img loader"></span>
    <div class="dropin-page invisible">
        <h2>Create a payment method for customer ID 60033487</h2>
        <form id="checkout" method="post" action="../checkout/create_payment_method.php">
            <div id="dropin"></div>
            <div class="btn_container">
                <input type="submit" value="Create">
                <span class="loader_img"></span>
            </div>
        </form>
        <section class="deletePaymentMethod">
            <h3><a href="../find_customer_from_vault/?customerId=60033487">Delete Payment Method for customer ID 60033487</a></h3>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script src="../js/create_payment_method.js"></script>

<?php include '../includes/footer.php'; ?>