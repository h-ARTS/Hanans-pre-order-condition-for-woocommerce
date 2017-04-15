<?php

if( ! class_exists( 'Hanans_Pre_Order_Condition_Admin' ) ) {

    class Hanans_Pre_Order_Condition_Admin {

        private $version;

        protected $plugin_slug;

        public function __construct( $version, $plugin_slug ) {
            
            $this->version = $version;
            $this->plugin_slug = $plugin_slug;

        }

        public function enqueue_styles() {
     
            wp_enqueue_style(
                $this->plugin_slug,
                plugin_dir_url( dirname(__FILE__) . 'includes/css/hanans-preorder.css' ),
                array(),
                $this->version,
                FALSE
            );

            wp_enqueue_script( 
                $this->plugin_slug . '_js', 
                plugin_dir_path( dirname(__FILE__) . 'includes/js/hanans_preorder.js' ), 
                array(), 
                $this->version, 
                true 
            );
     
        }

    }

}

?>
