<?php
error_reporting( 0 );
/**
 * Plugin Name:       Brac for WooCommerce
 * Plugin URI:        https://hassanmahmudkabir.github.io/
 * Description:       A brac bank payment gateway plugin for WooCommerce.
 * Version:           1.0.0
 * Author:            Hassan Mahmud Kabir
 * Author URI:        https://hassanmahmudkabir.github.io/
 * Requires at least: 4.0
 * Tested up to:      4.0
 * Network:           false
 *
 * THIS PLUGIN SUPPORTS WooCommerce 3.0.0 ONWARDS
 *
 * This WooCommerce Payment Gateway (Brac for WooCommerce) is distributed in the hope that it will be
 * useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package  brac-for-woocommerce
 * @author   Hassan Mahmud Kabir
 * @category Payment
 **/

    if ( !defined( 'ABSPATH' ) ) {
        exit;
    }

    // Check if WP_DEBUG is enabled
    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                                   // Check if $show_notification is true
        $show_notification = true; // You may set this variable based on your logic

        if ( $show_notification ) {
            add_action( 'admin_notices', 'show_warning_admin_notice' );

            function show_warning_admin_notice() {
            ?>
    <style>
        .notice.notice-warning {
            position: relative;
            padding: 10px;
            margin-top: 20px;
            background-color: #fff7db;
            border-left: 4px solid #ffb900;
            border-radius: 3px;
        }
        .notice.notice-warning p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
    <div class="notice notice-warning">
        <p>Please Consider Disabling WP_DEBUG, To Avoid Any Potential Issue With <strong>Brac for WooCommerce</strong>.</p>
    </div>
    <?php
        }
            }
        }
        define( 'BRAC_BASE_PATH', plugin_dir_path( __FILE__ ) );

        // error_log( BRAC_BASE_PATH . 'API-brac-for-woocommerce.php' );
        require_once 'API-brac-for-woocommercee.php';

        /**
         * 'Settings' link on plugin page
         **/
        add_filter( 'plugin_action_links', 'brac_add_action_plugin', 10, 5 );
        function brac_add_action_plugin(
            $actions,
            $plugin_file
        ) {
            static $plugin;

            if ( !isset( $plugin ) ) {
                $plugin = plugin_basename( __FILE__ );
            }

            if ( $plugin == $plugin_file ) {
                $settings = array( 'settings' => '<a href="admin.php?page=wc-settings&tab=checkout&section=wc_gateway_brac">Settings</a>' );

                $actions = array_merge( $settings, $actions );
            }

            return $actions;
        }
