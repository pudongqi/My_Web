<?php 
// 定义几个常量
define("T_P",get_bloginfo("template_url")."/");
define("FILE_PATH",dirname(__FILE__));
define("TU_TAG",true);
include "inc/wbox_fun.php";
if( !function_exists( 'get_simple_local_avatar' )) include "inc/localavatars.php";
include "inc/wbox_meta_box.php";
add_theme_support('post-thumbnails');

//设置页面配置
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );
function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

  jQuery('#example_showhidden').click(function() {
      jQuery('#section-example_text_hidden').fadeToggle(400);
  });

  if (jQuery('#example_showhidden:checked').val() !== undefined) {
    jQuery('#section-example_text_hidden').show();
  }

});
</script>

<?php
}
add_action('admin_init','optionscheck_change_santiziation', 100);
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
        "src" => array(),
        "type" => array(),
        "allowfullscreen" => array(),
        "allowscriptaccess" => array(),
        "height" => array(),
        "width" => array()
      );
    $custom_allowedtags["script"] = array( "type" => array(),"src" => array() );
    $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
    $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}