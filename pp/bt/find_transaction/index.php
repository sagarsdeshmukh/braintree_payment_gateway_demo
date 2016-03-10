<?php

$active = 'findLi';
$txn_id = isset($_GET['id']) ? $_GET['id'] : '';
include '../includes/header_generic.php';
include '../includes/header_close.php';
?>
    <div class="modal"><div class="modal-body">
        <div class="modal-container">
            <div class="list-payment-methods-view modal-frame-view render-in-assemble">
                <div class="modal-header">
                    <h3>Find a transaction<h3>
                </div>
                <div class="modal-body-content">
                    <fieldset>
                        <label class="input-label" for="txn_id">
                            <span class="field-name">Transaction ID</span>
                            <input id="txn_id" name="txn_id" class="input-field" type="text" inputmode="numeric" placeholder="Transaction ID" autocomplete="off" value="<?php echo $txn_id; ?>">
                            <div class="invalid-bottom-bar"></div>
                        </label>
                    </fieldset>
                    <fieldset>
                        <div class="btn_container">
                            <button class="search_id">Search Txn</button>
                            <span class="loader_img"></span>
                        </div>
                    </fieldset>
                    <div class="transaction-list"></div>
                    <div class="modal-footer">
                        <h3 class="cancel">
                            <a href="../dropin" class="cancel-button">Cancel</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script src="../js/find_transaction.js"></script>

<?php include '../includes/footer.php'; ?>