<?php 

$active = 'deleteLi';
include '../includes/header_generic.php';
include '../includes/header_bt_ui.php';
include '../includes/header_close.php';
isset($_GET) && isset($_GET['customerId']) ? $customerId = $_GET['customerId'] : '';
?>
    <div class="modal">
        <div class="modal-body">
            <div class="modal-container">
                <div class="list-payment-methods-view modal-frame-view render-in-assemble">
                    <div class="modal-header">
                        <h3>Delete a payment method</h3>
                    </div>
                    <div class="modal-body-content">
                        <div class="payment-methods-list"><span class="loader_img"></span></div>
                        <div class="modal-footer">
                            <div class="cancel">
                                <a href="../dropin" class="cancel-button">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if(isset($customerId)){ ?>
            <input type="hidden" name="cId" value="<?php echo $customerId; ?>" />
        <?php
            }
        ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script src="../js/find.js"></script>

<?php include '../includes/footer.php'; ?>