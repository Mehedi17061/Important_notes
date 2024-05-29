# Important_notes
# Add Refunds Return And Privacy Policy :- Code
// Add a checkbox to the WooCommerce checkout page
add_action('woocommerce_review_order_before_submit', 'add_privacy_policy_checkbox', 9);

function add_privacy_policy_checkbox() {
    echo '<div class="woocommerce-privacy-policy-checkbox">';
    echo '<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">';
    echo '<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="privacy_policy" id="privacy_policy" />';
    echo '<span>I have read and agree to the <a href="https://www.suncitypathfinder.com/privacy-policy/" class="woocommerce-privacy-policy-link" target="_blank">Privacy Policy</a> and <a href="https://www.suncitypathfinder.com/refund_returns/" class="woocommerce-privacy-policy-link" target="_blank">Refund and Returns Policy</a></span>';
    echo '</label>';
    echo '</div>';
}

// Validate the checkbox field
add_action('woocommerce_checkout_process', 'validate_privacy_policy_checkbox');

function validate_privacy_policy_checkbox() {
    if ( ! isset( $_POST['privacy_policy'] ) ) {
        wc_add_notice( __( 'Please read and accept the privacy policy and refund and returns policy to proceed.' ), 'error' );
    }
}

// Save the checkbox value to the order meta
add_action('woocommerce_checkout_update_order_meta', 'save_privacy_policy_checkbox_value');

function save_privacy_policy_checkbox_value( $order_id ) {
    if ( isset( $_POST['privacy_policy'] ) ) {
        update_post_meta( $order_id, '_privacy_policy_accepted', 'yes' );
    }
}


# Add Pay bill code 
 add_shortcode( 'custom_order_form1', 'custom_order_form_shortcode1' );

function custom_order_form_shortcode1() {
    ob_start(); ?>

    <form id="custom-order-form" method="post" class="container">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="purpose">Purpose of Payment:</label>
            <input type="text" id="purpose" name="purpose" class="form-control" required>
        </div>

				     <div class="form-group">
            <label for="advance_payment">Advance Payment Duration:</label>
            <select id="advance_payment" name="advance_payment" class="form-control" required>
				<option value="select_months">Select Months</option>
                <option value="1_month">1 Month</option>
                <option value="3_months">3 Months</option>
                <option value="6_months">6 Months</option>
                <option value="9_months">9 Months</option>
                <option value="12_months">12 Months</option>
                <option value="18_months">18 Months</option>
                <option value="24_months">24 Months</option>
            </select>
        </div>
        
				
				
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" class="form-control" required>
        </div>

   
        <input type="submit" name="pay_bill" value="Pay Bill" class="btn btn-info px-3">
    </form>

    <?php
    return ob_get_clean();
}

  add_action( 'init', 'process_custom_order_form1' );

   function process_custom_order_form1() {
      if( isset( $_POST['pay_bill'] ) ) {
           $email = sanitize_email( $_POST['email'] );
         $purpose = sanitize_text_field( $_POST['purpose'] );
          $amount = floatval( $_POST['amount'] );
           $advance_payment_duration = sanitize_text_field( $_POST['advance_payment'] );

        // Create a new WooCommerce order
        $order = wc_create_order();

        // Set customer billing details
        $order->set_billing_email( $email );
        $order->set_billing_address_2( $purpose ); // Store purpose in Address 2 field

        // Set advance payment duration as product name
        $product_name = 'Advance Payment: ' . $advance_payment_duration;
        
        // Add product to the order
        $order->add_product( wc_get_product(), 1, array(
            'name' => $product_name,
            'subtotal' => $amount,
            'total' => $amount,
        ) );

        // Set order total amount
        $order->set_total( $amount );

        // Save the order
        $order->save();

        // Redirect to checkout page with order ID
        $checkout_url = $order->get_checkout_payment_url();
        wp_redirect( $checkout_url );
        exit;
    }
}

# Order Auto Payment Option
add_action( 'woocommerce_order_status_processing', 'custom_autocomplete_order' );
function custom_autocomplete_order( $order_id ) {
if ( ! $order_id ) {
return;
}
$order = wc_get_order( $order_id );
$order->update_status( 'completed' );
}

