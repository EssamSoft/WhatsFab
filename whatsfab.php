<?php

/**
 * Plugin Name: WhatsFab
 * Description: Whatsapp floating action button.
 * Version: 1.0
 * Author: EssamSoft
 * Author URI: http://essamsoft.com/
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}




add_action('wp_head','load_assets');
function load_assets() {
?>
<script type="text/javascript"> var whatsappNumber = <?php echo stripslashes_deep(esc_attr(get_option('whatsfab-phone'))); ?>; </script>
<link rel="stylesheet" href="<?php echo plugins_url("whatsfab"); ?>/style.css">
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="<?php echo plugins_url("whatsfab"); ?>/script.js" ></script>
<?php
}


function whats_admin_menu() {

    $logoIcon = plugins_url("whatsfab") . "/logo.png";
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

	register_setting("whatsfab_config", "whatsfab-avatar");
    register_setting("whatsfab_config", "whatsfab-phone");
	register_setting("whatsfab_config", "whatsfab-support-name");
	register_setting("whatsfab_config", "whatsfab-support-status");
	register_setting("whatsfab_config", "whatsfab-message");
}
add_action("admin_init", "whatsfab_settings");

function whatsfab_option_phone() {
?>
   <tr>
        <th scope="row"><label for="whatsfab-phone">Phone number</label></th>
        <td>
            <input type="text" name="whatsfab-phone" value="<?php echo stripslashes_deep(esc_attr(get_option('whatsfab-phone'))); ?>" />
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
            <input type="text" name="whatsfab-avatar" value="<?php echo stripslashes_deep(esc_attr(get_option('whatsfab-avatar'))); ?>" />
        </td>
    </tr>

<?php
}

function whatsfab_option_support_name() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-support-name">Support name</label></th>
        <td>
            <input type="text" name="whatsfab-support-name" value="<?php echo stripslashes_deep(esc_attr(get_option('whatsfab-support-name'))); ?>" />
        </td>
    </tr>

<?php
}

function whatsfab_option_support_status() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-support-status">Support status</label></th>
        <td>
            <input type="text" name="whatsfab-support-status" value="<?php echo stripslashes_deep(esc_attr(get_option('whatsfab-support-status'))); ?>" />
        </td>
    </tr>

<?php
}

function whatsfab_option_message() {
?>

    <tr>
        <th scope="row"><label for="whatsfab-message">Welcome message</label></th>
        <td>
            <textarea name="whatsfab-message" >
            <?php echo stripslashes_deep(get_option('whatsfab-message')); ?>
            </textarea>
        </td>
    </tr>

<?php
}























add_action( 'wp_footer', 'whatsfab' );

function whatsfab() {

 ?>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700,300">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <button class="whatsapp-button">
        <i class="fa fa-whatsapp"></i>
    </button>

    <div class="whatsapp" style="display:none;">
        <div class="screen">
        <div class="screen-container">
            <div class="screen-container">
            <div class="chat">
            <div class="chat-container">
                <div class="user-bar">

                <div class="avatar">
                    <img src="<?php echo stripslashes_deep(esc_attr(get_option('whatsfab-avatar'))); ?>" alt="Avatar">
                </div>
                <div class="name">
                    <span><?php echo stripslashes_deep(esc_attr(get_option('whatsfab-support-name'))); ?></span>
                    <span class="status"><?php echo stripslashes_deep(esc_attr(get_option('whatsfab-support-status'))); ?></span>
                </div>
                        <div class="actions close">
                    <i class="zmdi zmdi-close"></i>
                    </div>
                </div>
                <div class="conversation">
                <div class="conversation-container">

                    <div class="message received" style="direction:rtl;text-align: right;">
                    <?php echo stripslashes_deep(get_option('whatsfab-message')); ?>
                    <span class="metadata"><span class="time"></span></span>
                    </div>


                </div>
                <div class="conversation-compose">
                    <div class="emoji">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"></path></svg>
                    </div>
                    <input class="input-msg" name="input" placeholder="Type a message" autocomplete="off" autofocus="">

                    <button class="send">
                        <div class="circle">
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



<?php

}
