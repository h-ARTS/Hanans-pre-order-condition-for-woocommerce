<?php

if( ! class_exists( 'Hanans_Pre_Order_Condition_Loader' ) ) {

    class Hanans_Pre_Order_Condition_Loader {

        protected $actions;

        public function __construct() {

            $this->actions = array();
            $this->form_fields = array();

        }

        public function add_action( $hook, $component, $callback ) {
            
            $this->actions = $this->add( $this->actions, $hook, $component, $callback );

        }

        public function add() {
            
            $hooks[] = array(
                'hook'      => $hook,
                'component' => $component,
                'callback'  => $callback
            );

            return $hooks;

        }

        public function woocommerce_form_field( $key, $args, $value ) {

            $this->form_fields = $this->add_woo_form_fields( $this->form_fields, $key, $args, $value );

        }

        public function add_woo_form_fields() {

            $fields[] = array(
                'key'   => $key,
                'args'  => $args,
                'value' => $value
            );

            return $fields;

        }

        public function run() {

            foreach( $this->action as $hook ) {

                add_action( $hook['hook'], $component['component'], $callback['callback'] );

            }

            foreach( $this->form_fields as $key ) {
                
                echo '<div id="pre_order_fields"><h3>' . __( 'Pre-order?', 'hanans-pre-order-condition-woo' ) . '</h3><p style="margin: 0 0 8px;">' . __( 'Would you like to pre-order your delivery?', 'hanans-pre-order-condition-woo' ) . '</p>';

                woocommerce_form_field( $key['key'], $args['args'], $value['value'] );

                echo '</div>';

            }

        }

    }

}

?>