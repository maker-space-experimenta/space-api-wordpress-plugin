<?php

$endpoint_url = get_bloginfo("url") . "/wp-json/spaceapi/v14/toggle/" . $space_api_toggle_endpoint_token;
$space_api_toggle_endpoint_token = get_option("space_api_toggle_endpoint_token");

if ($space_api_toggle_endpoint_token == false): ?>

Space API is not configured. Please go to admin interface, switch to settings and Space API Settings to set the required fields.

<?php else: ?>




<script>
    function toggle_space_api() {
        
    }
</script>
<button type="button" onclick="toggle_space_api()" class="btn btn-primary btn-sm" style="background: #0071a1;"><?php echo __("open space") ?></button>
<button type="button" onclick="toggle_space_api()" class="btn btn-primary btn-sm" style="background: #0071a1;"><?php echo __("close space") ?></button>

<?php endif; ?>