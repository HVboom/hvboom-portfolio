<?php
/**
Plugin Name: HVboom Portfolio
Plugin URI: http://hvboom.ch
Description: Tutorial custom post type (see http://bootstrapwp.com/portfolio-custom-post-type-tutorial/)
Author: Mario Lotz
Version: 1.0
Author URI: http://hvboom.ch
*/

/** Constants */
define('CURRENT_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/');
define('CURRENT_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CURRENT_PLUGIN_STYLESHEET_URL', CURRENT_PLUGIN_URL . 'assets/stylesheets/');
define('CURRENT_PLUGIN_NAME', "HVboom Portfolio");


/** Require CPT */
require_once(CURRENT_PLUGIN_PATH . 'hvboom-portfolio-cpt.php');

?>
