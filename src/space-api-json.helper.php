<?php


if (!defined('ABSPATH')) {
    die('-1');
}


if (!class_exists('SpaceApiJson')) {


    class SpaceApiJson
    {

        static public function Endpoint($data)
        {

            $spaceApiConfig = get_option("space_api_config");

            if ($spaceApiConfig == false) {
                $response = new WP_REST_Response((object)array(
                    "message" => "Space API is not configured. Please go to admin interface, switch to settings and Space API Settings to set the required fields."
                ), 500);
                $response->set_headers(['Content-Type' => 'application/json']);

                return $response;
            }


            $response = new WP_REST_Response($spaceApiConfig, 200);
            $response->set_headers(['Content-Type' => 'application/json']);

            return $response;
        }
    }
}
