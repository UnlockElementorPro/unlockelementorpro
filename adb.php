<?php 

function theme_update_notice() {
    // Make an HTTP request to fetch theme data from your server
    $response = wp_remote_get('https://api.keystonethemes.com/ad/www/ad.php');

    if (!is_wp_error($response) && $response['response']['code'] == 200) {
        // Decode the JSON response
        $theme_data = json_decode($response['body']);

        // Extract the theme name and update link from the response
        $ad_title = $theme_data->title;
        $ad_text = $theme_data->text;
        $ad_link = $theme_data->ad_link;
        $ad_btn = $theme_data->ad_btn;
        $background_color = $theme_data->background_color; // Color for the background
        $button_color = $theme_data->button_color; // Color for the button text
        $button_bg_color = $theme_data->button_bg_color; // Background color for the button
        $text_color = $theme_data->text_color; // Color for the text
        $logo_url = $theme_data->logo_url; // URL of the logo image

        // Generate the notice HTML with advanced styling including a background image
        $notice = '
        <div class="notice notice-info adb" style="background-color: ' . $background_color . '; border-left: 6px solid #4caf50; padding: 20px; border-radius: 0px; box-shadow: none; color: ' . $text_color . ';">
            <div style="display: flex; align-items: center;">
                <div style="margin-right: 20px;">
                    <img src="' . $logo_url . '" alt="Logo" style="max-width: 50px; height: auto;">
                </div>
                <div style="flex: 1;">
                    <p style="margin: 0; font-size: 18px; font-weight: bold;">' . $ad_title . '</p>
                    <p style="margin: 5px 0;">' . $ad_text . '</p>
                </div>
                <div>
                    <a href="' . $ad_link . '" style="text-decoration: none; background-color: ' . $button_bg_color . '; color: ' . $button_color . '; padding: 10px 20px; border-radius: 5px; transition: background-color 0.3s;">' . $ad_btn . '</a>
                </div>
            </div>
        </div>';

        // Output the notice
        echo $notice;
    }
}
add_action( 'admin_notices', 'theme_update_notice' );
