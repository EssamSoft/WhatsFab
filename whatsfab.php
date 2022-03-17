<?php

/**
 * Plugin Name: WhatsFab
 * Pligin URL: https://github.com/EssamSoft/WhatsFab
 * Description: Whatsapp floating action button.
 * Version: 1.2
 * Author: EssamSoft
 * Author URI: http://essamsoft.com/
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}


define( 'WHATSFAB_VERSION', '1.2' );
define( 'WHATSFAB_REQUIRED_WP_VERSION', '5.4' );
define( 'WHATSFAB_PLUGIN', __FILE__ );

add_action( 'wp_enqueue_scripts', 'whatsfab_enqueue_scripts', 10, 0 );

function whatsfab_plugin_url( $path = '' ) {
	$url = plugins_url( $path, WHATSFAB_PLUGIN );

	return $url;
}

function whatsfab_enqueue_scripts() {



    $plugins_dir = whatsfab_plugin_url();
    $showWhatsfabAlert = (hard_trim(get_option('whatsfab-popup')) != "") ? 'true' : 'false';
    $whatsappNumber = hard_trim(get_option('whatsfab-phone'));

    wp_enqueue_script( 'whatsfab', whatsfab_plugin_url( 'js/script.js' ),array( 'jquery' ), WHATSFAB_VERSION, true );
    wp_add_inline_script( 'whatsfab', "var whatsfabDir = '$plugins_dir';var showWhatsfabAlert = $showWhatsfabAlert; var whatsappNumber = '$whatsappNumber';",'before' );

    whatsfab_enqueue_styles();

	do_action( 'whatsfab_enqueue_scripts' );
}

function whatsfab_enqueue_styles() {
	wp_enqueue_style( 'whatsfab', whatsfab_plugin_url( 'css/style.css' ), array(), WHATSFAB_VERSION, 'all' );

    wp_register_style( 'material-design-iconic-font', '//cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css', array(), '2.2.0' );
    wp_enqueue_style( 'material-design-iconic-font' );
    wp_register_style( 'Almarai-font', '//fonts.googleapis.com/css2?family=Almarai&display=swap', array(), '2.2.0' );
    wp_enqueue_style( 'Almarai-font' );

	do_action( 'whatsfab_enqueue_styles' );
}



 



function whats_admin_menu() {

    $logoIcon = plugins_url("whatsfab") . "/assets/logo.png";
	add_menu_page("Whatsfab", "Whatsfab", "manage_options", "whatsfab", "page_setting" , $logoIcon);
}
add_action("admin_menu", "whats_admin_menu");



function page_setting()
{
?>




<div class="wrap">


    <h1>Whatsapp FAB setting</h1>

    <hr>

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="text-align: right;float: right;">
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="6R7F7B3RL2M9Y" />
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    </form>

	<form method="post" action="options.php">
        <table class="form-table" role="presentation">

                <?php
                    settings_fields("whatsfab_config");
                    do_settings_sections("whatsfab");
                    submit_button();
                ?>


        </table>

    </form>

</div>

<?php
}

function whatsfab_settings() {
    add_settings_section("whatsfab_config", "", null, "whatsfab");

	add_settings_field("whatsfab-phone", "", "whatsfab_option_phone", "whatsfab", "whatsfab_config");
    add_settings_field("whatsfab-avatar", "", "whatsfab_option_avatar", "whatsfab", "whatsfab_config");
    add_settings_field("whatsfab-support-name", "", "whatsfab_option_support_name", "whatsfab", "whatsfab_config");
    add_settings_field("whatsfab-support-status", "", "whatsfab_option_support_status", "whatsfab", "whatsfab_config");
    add_settings_field("whatsfab-message", "", "whatsfab_option_message", "whatsfab", "whatsfab_config");
    add_settings_field("whatsfab-popup", "", "whatsfab_option_popup", "whatsfab", "whatsfab_config");
    add_settings_field("whatsfab-call", "", "whatsfab_option_call", "whatsfab", "whatsfab_config");
    add_settings_field("whatsfab-position", "", "whatsfab_option_position", "whatsfab", "whatsfab_config");
    add_settings_field("whatsfab-animation-btn", "", "whatsfab_option_animation_btn", "whatsfab", "whatsfab_config");

	register_setting("whatsfab_config", "whatsfab-avatar");
    register_setting("whatsfab_config", "whatsfab-phone");
	register_setting("whatsfab_config", "whatsfab-support-name");
	register_setting("whatsfab_config", "whatsfab-support-status");
	register_setting("whatsfab_config", "whatsfab-message");
	register_setting("whatsfab_config", "whatsfab-popup");
	register_setting("whatsfab_config", "whatsfab-call");
	register_setting("whatsfab_config", "whatsfab-position");
	register_setting("whatsfab_config", "whatsfab-animation-btn");
}
add_action("admin_init", "whatsfab_settings");

function whatsfab_option_phone() {
?>
   <tr>
        <th scope="row"><label for="whatsfab-phone">Phone number</label></th>
        <td>
            <input type="text" name="whatsfab-phone" value="<?php echo hard_trim(get_option('whatsfab-phone')); ?>" />
            <br>
             <a href="https://faq.whatsapp.com/en/general/26000030" target="_blank">See whatsapp number format</a>
        </td>
    </tr>

<?php
}

function whatsfab_option_avatar() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-avatar">Avatar URL</label></th>
        <td>
            <input type="text" name="whatsfab-avatar" value="<?php echo hard_trim(get_option('whatsfab-avatar')); ?>" />
        </td>
    </tr>

<?php
}

function whatsfab_option_support_name() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-support-name">Support name</label></th>
        <td>
            <input type="text" name="whatsfab-support-name" value="<?php echo hard_trim(get_option('whatsfab-support-name')); ?>" />
        </td>
    </tr>

<?php
}

function whatsfab_option_support_status() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-support-status">Support status</label></th>
        <td>
            <input type="text" name="whatsfab-support-status" value="<?php echo hard_trim(get_option('whatsfab-support-status')); ?>" />
        </td>
    </tr>

<?php
}

function whatsfab_option_message() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-message">Welcome message</label></th>
        <td>
            <textarea name="whatsfab-message" ><?php echo (get_option('whatsfab-message')); ?></textarea>
        </td>
    </tr>

<?php
}


function whatsfab_option_popup() {
    ?>
    
        <tr>
            <th scope="row"><label for="whatsfab-popup">Popup alert message</label></th>
            <td>
                <textarea name="whatsfab-popup" > <?php echo hard_trim(get_option('whatsfab-popup')); ?> </textarea>
                <p for="whatsfab-popup">leave blank if you don't want to show the alert</p>
            </td>
        </tr>
    
    <?php
}


function whatsfab_option_position() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-position">is RTL?</label></th>
        <td>

            <input type="checkbox" name="whatsfab-position" value="1" <?php checked(1, get_option('whatsfab-position'), true); ?> />

        </td>
    </tr>

<?php
}
function whatsfab_option_call() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-call">Enable call</label></th>
        <td>

            <input type="checkbox" name="whatsfab-call" value="1" <?php checked(1, get_option('whatsfab-call'), true); ?> />

        </td>
    </tr>

<?php
}

function whatsfab_option_animation_btn() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-animation-btn">Enable Animation button</label></th>
        <td>

            <input type="checkbox" name="whatsfab-animation-btn" value="1" <?php checked(1, get_option('whatsfab-animation-btn'), true); ?> />

        </td>
    </tr>

<?php
}



function hard_trim($str) {

    return stripslashes_deep(esc_attr(trim($str)));
}

add_action( 'wp_footer', 'whatsfab' );

function whatsfab() { ?>

 

    <div class="wf <?php echo (get_option('whatsfab-position')) ? "right_wf" : "left_wf" ; ?>">

    <div class="wf_welcome_alert_container">
        <i class="close_wf_welcome_alert zmdi zmdi-close"></i>
        <p class="wf_welcome_alert"><?php echo hard_trim(get_option('whatsfab-popup')); ?></p>

    </div>

    <?php if(get_option('whatsfab-animation-btn')) : ?>
        <div class="wf_animate_button zoomIn-flicker"></div>
    <?php endif; ?>

    <button class="wf_whatsapp-button">
        <i class="zmdi zmdi-whatsapp"></i>
    </button>

    <div class="wf_whatsapp" style="display:none;">
        <div class="wf_screen">
        <div class="wf_screen-container">
            <div class="wf_screen-container">
            <div class="wf_chat">
            <div class="wf_chat-container">
                <div class="wf_user-bar">

                    <div class="wf_avatar">
                        <img src="<?php echo hard_trim(get_option('whatsfab-avatar')); ?>" alt="Avatar">
                    </div>
                    <div class="wf_name">
                        <span><?php echo hard_trim(get_option('whatsfab-support-name')); ?></span>
                        <span class="wf_status"><?php echo hard_trim(get_option('whatsfab-support-status')); ?></span>
                    </div>
                    <div class="wf_actions wf_close">
                         <i class="zmdi zmdi-close"></i>
                    </div>

                    <?php if(get_option('whatsfab-call')) : ?>
                        <div class="wf_actions wf_call">
                            <a href="tel:00<?php echo hard_trim(get_option('whatsfab-phone')); ?>">
                                <i class="zmdi zmdi-phone"></i>
                            </a>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="wf_conversation">
                <div class="wf_conversation-container">

                    <div class="wf_message wf_received" style="direction:rtl;text-align: right;">
                        <?php echo (get_option('whatsfab-message')); ?>
                        <span class="wf_metadata"><span class="wf_time"></span></span>
                    </div>


                </div>
                <div class="wf_conversation-compose">
                    <div class="wf_emoji">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"></path></svg>
                    </div>
                    <input class="wf_input-msg" name="input" placeholder="Type a message" autocomplete="off" autofocus="">

                    <button class="wf_send">
                        <div class="wf_circle">
                        <i class="zmdi zmdi-mail-send"></i>
                        </div>
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

    </div>


<?php

}
