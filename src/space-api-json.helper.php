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
            $response->set_headers(['access-control-allow-origin' => '*']);

            return $response;
        }

        static public function Toggle($data)
        {

            $space_api_toggle_endpoint_token = get_option("space_api_toggle_endpoint_token");

            if ($space_api_toggle_endpoint_token == false) {
                $response = new WP_REST_Response((object)array(
                    "message" => "Space API is not configured. Please go to admin interface, switch to settings and Space API Settings to set the required fields."
                ), 500);
                $response->set_headers(['Content-Type' => 'application/json']);

                return $response;
            }

            if ($data["token"] != $space_api_toggle_endpoint_token) {
                $response = new WP_REST_Response((object)array(
                    "message" => "Invalid token."
                ), 403);
                $response->set_headers(['Content-Type' => 'application/json']);

                return $response;
            }

            $spaceApiConfig = get_option("space_api_config");
            $spaceApiConfig->state->open = !$spaceApiConfig->state->open;
            update_option("space_api_config", $spaceApiConfig);


            $response = new WP_REST_Response((object) array(
                "message" => "toggled",
                "new_state" => (object) array(
                    "open" => $spaceApiConfig->state->open
                )
            ), 200);
            $response->set_headers(['Content-Type' => 'application/json']);

            return $response;
        }
    }
}
