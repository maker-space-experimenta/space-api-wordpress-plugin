<?php

$saved = false;

if (isset($_POST['space_api_settings_form'])) {
    
    $space = (object) array(
        "api" => "0.13",
        "api_compatibility" => ["14"],
        "space" => sanitize_text_field($_POST["space"]),
        "logo" => sanitize_text_field($_POST["url"]),
        "url" => sanitize_text_field($_POST["url"]),
        "location" => (object) array(
            "address" => sanitize_text_field($_POST["location_address"]),
            "lon" => floatval(sanitize_text_field($_POST["location_lon"])),
            "lat" => floatval(sanitize_text_field($_POST["location_lat"])),
        ),
        "contact" => (object) array(
            "email" => sanitize_text_field($_POST["contact_email"]),
            "irc" => sanitize_text_field($_POST["contact_irc"]),
            "ml" => sanitize_text_field($_POST["contact_ml"]),
            "twitter" => sanitize_text_field($_POST["contact_twitter"]),
        ),
        "issue_report_channels" => ["email"],
        "state" => (object) array(
            // "icon" => (object) array(
            //     "open" => null, // "http://shackspace.de/sopen.gif",
            //     "closed" => null // "http://shackspace.de/sopen.gif"
            // ),
            "open" => true
        ),
        // "projects" => array(
        // "http://github.com/shackspace",
        // "http://shackspace.de/wiki/doku.php?id=projekte"
        // )
    );

    update_option("space_api_config", $space);

    
    $saved = true;

}



$space = get_option("space_api_config");

if ($space == false) {

    $space = (object) array(
        "api" => "0.13",
        "api_compatibility" => ["14"],
        "space" => get_bloginfo("name"),
        "logo" => null, // "http://rescue.shackspace.de/images/logo_shack_brightbg_highres.png",
        "url" => get_bloginfo("url"),
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
            // "icon" => (object) array(
            //     "open" => null, // "http://shackspace.de/sopen.gif",
            //     "closed" => null // "http://shackspace.de/sopen.gif"
            // ),
            "open" => true
        ),
        // "projects" => array(
        // "http://github.com/shackspace",
        // "http://shackspace.de/wiki/doku.php?id=projekte"
        // )
    );
}

?>

<?php if ($saved) : ?>
    <div class="row mt-3" style="max-width: 100%;">
        <div class="col">
            <div class="alert alert-success" role="alert" style="padding: 8px 12px; width: 100%;">
                <?php echo __('Einstellungen gespeichert') ?>
            </div>
        </div>
    </div>
<?php endif; ?>



<form method="POST" action="?page=space_api_settings">

    <?php wp_nonce_field(basename(__FILE__), 'space_api_settings_form'); ?>

    <div class="row mt-3" style="max-width: 100%;">
        <div class="col">
            <h1 class="wp-heading-inline" style="font-size: 23px;"><?php echo __('Space API Settings') ?></h1>
        </div>
    </div>

    <div class="row mt-3" style="max-width: 100%; margin-top: 0 !important;">
        <div class="col">

            <div class="card wp-settings" style="border-radius: 0; padding: 8px 12px; max-width: 100%;">
                <div class="card-body">

                    <div style="display: flex;">
                        <h5 class="card-title"><?php echo __('Stammdaten') ?></h5>
                    </div>


                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('Space Name') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="space" id="space" class="form-control-plaintext" value="<?php echo $space->space ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('URL') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="url" id="url" class="form-control-plaintext" value="<?php echo $space->url ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('Logo-URL') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="logo" id="logo" class="form-control-plaintext" value="<?php echo $space->logo ?>">
                        </div>
                    </div>
                </div>
            </div>


            <div class="card wp-settings" style="border-radius: 0; padding: 8px 12px; max-width: 100%;">
                <div class="card-body">

                    <div style="display: flex;">
                        <h5 class="card-title"><?php echo __('Location') ?></h5>
                    </div>


                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('Address') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="location_address" id="location_address" class="form-control-plaintext" value="<?php echo $space->location->address ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('Latitute') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="location_lat" id="location_lat" class="form-control-plaintext" value="<?php echo $space->location->lat ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('Longitute') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="location_lon" id="location_lon" class="form-control-plaintext" value="<?php echo $space->location->lon ?>">
                        </div>
                    </div>

                </div>
            </div>


            <div class="card wp-settings" style="border-radius: 0; padding: 8px 12px; max-width: 100%;">
                <div class="card-body">

                    <div style="display: flex;">
                        <h5 class="card-title"><?php echo __('Contact') ?></h5>
                    </div>


                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('E-Mail') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="contact_email" id="contact_email" class="form-control-plaintext" value="<?php echo $space->contact->email ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('IRC') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="contact_irc" id="contact_irc" class="form-control-plaintext" value="<?php echo $space->contact->irc ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('Mailinglist') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="contact_ml" id="contact_ml" class="form-control-plaintext" value="<?php echo $space->contact->ml ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label"><?php echo __('Twitter') ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="contact_twitter" id="contact_twitter" class="form-control-plaintext" value="<?php echo $space->contact->twitter ?>">
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-12 col-md-3">
            <div class="card" style="padding: 0; border-radius: 0; font-size: 14px; ">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="font-size: 14px; padding: 8px 12px;"><?php echo __("Actions") ?></li>
                    <li class="list-group-item" style="font-size: 14px; padding: 8px 12px;">
                        <button type=" submit" class="btn btn-secondary btn-sm"><?php echo __("validate") ?></button>
                    </li>
                    <li class="list-group-item d-flex justify-content-end" style="background: #f5f5f5; font-size: 14px; padding: 8px 12px;"">
                        <button type=" submit" class="btn btn-primary btn-sm" style="background: #0071a1;"><?php echo __("save") ?></button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</form>