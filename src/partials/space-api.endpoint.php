<?php




$spaceApiConfig = get_option("space_api_config");

if ($spaceApiConfig == false) {
    $spaceApiConfig = (object) array(
        "space" => "",
        "logo" => null, // "http://rescue.shackspace.de/images/logo_shack_brightbg_highres.png",
        "url" => null, // "http://shackspace.de",
        "location" => (object) array(
            "address" => null, // "Ulmer Strasse 255, 70327 Stuttgart, Germany",
            "lon" => null, // 9.236,
            "lat" => null, // 48.777
        ),
        "contact" => (object) array(
            "email" => null, // "info@shackspace.de",
            "irc" => null, // "irc://irc.freenode.net/shackspace",
            "ml" => null, // "public@lists.shackspace.de",
            "twitter" => null, // "@shackspace"
        ),
        "issue_report_channels" => ["email"],
        "state" => (object) array(
            "icon" => (object) array(
                "open" => null, // "http://shackspace.de/sopen.gif",
                "closed" => null // "http://shackspace.de/sopen.gif"
            ),
            "open" => true
        ),
        "projects" => array(
            // "http://github.com/shackspace",
            // "http://shackspace.de/wiki/doku.php?id=projekte"
        )
    );
}


echo json_encode($spaceApiConfig);

$data = array(
    "test" => "success"
);


$response = new WP_REST_Response($data, 200);
$response->set_headers(['Cache-Control' => 'must-revalidate, no-cache, no-store, private']);

return $response;
