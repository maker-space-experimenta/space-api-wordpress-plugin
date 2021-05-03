<?php

$space_api_toggle_endpoint_token = get_option("space_api_toggle_endpoint_token");
$endpoint_url = get_bloginfo("url") . "/wp-json/spaceapi/v14/toggle/" . $space_api_toggle_endpoint_token;
$spaceApiConfig = get_option("space_api_config");

$button_text = $spaceApiConfig->state->open ? "close space" : "open space";

if ($space_api_toggle_endpoint_token == false) : ?>

    Space API is not configured. Please go to admin interface, switch to settings and Space API Settings to set the required fields.

<?php else : ?>




    <script>
        function toggle_space_api() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", '<?php echo $endpoint_url ?>', true);

            //Send the proper header information along with the request
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function() { // Call a function when the state changes.
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    let data = JSON.parse(this.response);
                    console.log(data);

                    document.getElementById("space_api_button").textContent = data.new_state.open ? "close space": "open space";
                }
            }
            xhr.send();
        }
    </script>
    <button type="button" id="space_api_button" onclick="toggle_space_api()" class="btn btn-primary btn-sm" style="background: #0071a1;"><?php echo __($button_text) ?></button>

<?php endif; ?>