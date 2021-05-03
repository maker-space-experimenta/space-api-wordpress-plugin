<?php


if (!defined('ABSPATH')) {
    die('-1');
}


if (!class_exists('SpaceAPI')) {


    class SpaceAPI
    {

        const VERSION = '1.0.0';

        /**
         * Static Singleton Holder
         * @var self
         */
        protected static $instance;

        /**
         * Get (and instantiate, if necessary) the instance of the class
         *
         * @return self
         */
        public static function instance()
        {
            if (!self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }


        function __construct()
        {
            
            add_action('admin_enqueue_scripts', array($this, 'load_styles'));

            add_action('rest_api_init', array($this, "register_api_route"));


            // require_once dirname(__FILE__) . '/_Debug/debug.controller.php';
            // $debugController = DebugController::instance();
            // $debugController->register();

            // add_action('init', array($this, 'save_forms'));
            // add_action('admin_enqueue_scripts', array($this, 'load_styles'));
            add_action('admin_menu', array($this, "registerAdminMenu"));
        }

        public function spaceApiEndpoint($data)
        {
            
        }
        public function register_api_route()
        {
            require dirname(__FILE__) . '/space-api-json.helper.php';
            register_rest_route('spaceapi/v14', '/hello', array(
                'methods' => 'GET',
                'callback' => array("SpaceApiJson", "Endpoint"),
                // 'permission_callback' => function () {
                //     return true;
                // }
            ));
        }


        public function renderSubmenuSettings()
        {
            require dirname(__FILE__) . '/partials/settings.partial.php';
        }
        public function registerAdminMenu()
        {
            $subpage_title = 'Space API';
            $submenu_title = 'Space API';
            $submenu_slug = 'space_api_settings';
            add_submenu_page(
                "options-general.php",
                "Space API",
                "Space API",
                "add_users",
                "space_api_settings",
                array($this, "renderSubmenuSettings")
            );
        }

        public function load_styles()
        {
        }

        public static function activate()
        {
        }

        public static function deactivate($network_deactivating)
        {
        }
    }
}
