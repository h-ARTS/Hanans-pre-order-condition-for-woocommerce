<?php
/*
 * Plugin Name:       Hanan's Pre-Order condition for WooCommerce
 * Plugin URI:        https://github.com/h-ARTS/Hanans-pre-order-condition-for-woocommerce
 * Description:       This PlugIn will help your customers to specify their pre-order.
 * Version:           0.1.0
 * Author:            Hanan Mufti
 * Author URI:        N.A
 * Text Domain:       hanans-pre-order-condition-woo
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-hanans-pre-order-condition.php';

$hanans = new Hanans_Pre_Order_Condition();
$hanans->run();

?>