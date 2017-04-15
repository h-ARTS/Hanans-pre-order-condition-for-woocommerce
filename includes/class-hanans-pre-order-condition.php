<?php

if( ! class_exists('Hanans_Pre_Order_Condition') ) {
    
    class Hanans_Pre_Order_Condition {

        protected $loader;
 
        protected $plugin_slug;
    
        protected $version;
    
        public function __construct() {
    
            $this->plugin_slug = 'hanans-pre-order-condition-woocommerce';
            $this->version = '0.1.0';

            $this->load_dependencies();
            $this->define_admin_hooks();
    
        }
    
        private function load_dependencies() {

            require_once plugin_dir_path( dirname(__FILE__) ) . 'admin/class-hanans-pre-order-condition-admin.php';

            require_once plugin_dir_path( __FILE__ ) . 'class-hanans-pre-order-condition-loader.php';

            $this->loader = new Hanans_Pre_Order_Condition_Loader();
    
        }
    
        private function define_admin_hooks() {
    
            $admin = new Hanans_Pre_Order_Condition_Admin( $this->version, $this->plugin_slug );
            $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );
            $this->loader->add_action( 'woocommerce_after_order_notes', $this, 'hanans_pre_order_timepicker' );
            $this->loader->add_action( 'woocommerce_checkout_update_order_meta', $this, 'hanans_pre_order_timepicker_update' );

        }

        public function hanans_pre_order_timepicker( $checkout ) {

            $this->loader->woocommerce_form_field( 'preorder_checkbox', array(
                
                'type'  =>  'checkbox',
                'class' => array( 'preorder-checkbox form-row-wide' ),
                'label' => __( 'Yes', 'hanans-pre-order-condition-woo' )

            ), $checkout->get_value('preorder_checkbox' ) );

            $this->loader->woocommerce_form_field( 'preorder_timepicker', array(
                
                'type'  => 'text',
                'class' => array( 'preorder-timepicker form-row-wide' ),
                'label' => __( 'When would you like to receive your delivery?', 'hanans-pre-order-condition-woo' ),
 
            ), $checkout->get_value( 'preorder_timepicker' ) );

        }

        public function hanans_pre_order_timepicker_update( $order_id ) {

            //check if $_POST has our custom fields
            if ( $_POST[ 'preorder_checkbox' ] ) {
            //It does: update post meta for this order
            update_post_meta( $order_id, 'Pre-order checkbox', esc_attr( $_POST[ 'preorder_checkbox' ] ) );
            }
            if ( $_POST[ 'preorder-timepicker' ] ) {
            update_post_meta( $order_id, 'Pre-order timepicker', esc_attr( $_POST[ 'preorder-timepicker' ] ) );
            }

        }
    
        public function run() {
            
            $this->loader->run();

        }
    
        public function get_version() {
            return $this->version;
        }
 
    }
 
}

?>