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

            add_action( 'wp_dashboard_setup', array($this, 'add_dashboard_widgets') );

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
            register_rest_route('spaceapi/v14', '/toggle/(?P<token>.+)', array(
                'methods' => 'GET',
                'callback' => array("SpaceApiJson", "Toggle"),
                // 'permission_callback' => function () {
                //     return true;
                // }
            ));
        }

        public function render_dashboard_widget_space_api () {
            include dirname(__FILE__) . '/partials/widget.partial.php';
        }
        public function add_dashboard_widgets()
        {
            wp_add_dashboard_widget(
                'space-api-toggle',         // Widget slug.
                'Space API',         // Title.
                array($this, 'render_dashboard_widget_space_api') // Display function.
            );
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
            wp_enqueue_style('css-bootstrap', plugins_url('/../vendor/bootstrap.min.css', __FILE__));
			wp_enqueue_style('css-clr-icons', plugins_url('/../vendor/clr-icons.min.css', __FILE__));

			wp_enqueue_script('js-custom-elements', plugins_url('/../vendor/custom-elements.min.js', __FILE__));
			wp_enqueue_script('js-clr-icons', plugins_url('/../vendor/clr-icons.min.js', __FILE__));
			wp_enqueue_script('js-bootstrap-util', plugins_url('/../vendor/util.js', __FILE__));
			wp_enqueue_script('js-bootstrap-collapse', plugins_url('/../vendor/collapse.js', __FILE__));

			// wp_enqueue_style('css-custom-styles', plugins_url('styles/styles.css', __FILE__));
        }

        public static function activate()
        {
        }

        public static function deactivate($network_deactivating)
        {
        }
    }
}
