# Important_notes
#Add Refunds Return And Privacy Policy :- Code
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

 
