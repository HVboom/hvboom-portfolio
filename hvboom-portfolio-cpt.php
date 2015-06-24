<?php

/**
 * Require helper class
 */
require_once(CURRENT_PLUGIN_PATH . 'vendor/wp-custom-post-type-class/src/CPT.php');

/**
 * Register custom post type Portfolio
 */
$portfolio = new CPT(
  array(
    'post_type_name' => 'portfolio',
    'singular'       => 'Portfolio',
    'plural'         => 'Portfolio',
    'slug'           => 'portfolio'
  ),
	array(
    'supports'       => array('title', 'editor', 'thumbnail', 'comments'),
    'menu_icon'      => 'dashicons-portfolio',
    'set_textdomain' => 'hvboom'
  )
);

/**
 * Register taxonomy
 */
$portfolio->register_taxonomy(
  array(
    'taxonomy_name' => 'portfolio_tags',
    'singular'      => 'Portfolio Tag',
    'plural'        => 'Portfolio Tags',
    'slug'          => 'portfolio-tag'
  )
);



function hvboom_get_portfolio(){
  $portfolio = '<section class="hvboom-portfolio">' . PHP_EOL;

  $args = "post_type=portfolio";
  $catalog = new WP_Query($args);

  while($catalog->have_posts()) : $catalog->the_post();
    $img = hvboom_get_image();
    $portfolio .= '  <article>' . PHP_EOL;
    $portfolio .= '    <div class="styling-wrapper">' . PHP_EOL;
    $portfolio .= $img;
    $portfolio .= '      <header><h1>';
    $portfolio .= sprintf ('<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) . get_the_title() . '</a>';
    $portfolio .= '</h1></header>' . PHP_EOL;
    $portfolio .= '      <section>' . get_the_excerpt() . '</section>' . PHP_EOL;
    $portfolio .= '      <hr />' . PHP_EOL;
    $portfolio .= '      <footer>' . PHP_EOL;
    $portfolio .= sprintf ('      <a href="%s" class="" role="button">', esc_url( get_permalink() ) ) . __('View Project', 'hvboom') . '</a>' . PHP_EOL;
    $portfolio .= '      </footer>' . PHP_EOL;
    $portfolio .= '    </div> <!-- end of styling-wrapper -->' . PHP_EOL;
    $portfolio .= '  </article>' . PHP_EOL;
    $portfolio .= '  <smart-break></smart-break> <!-- styling element used only to break article in a responsive way -->' . PHP_EOL;
  endwhile;
  wp_reset_postdata();

  $portfolio .= '</section>' . PHP_EOL;

  return $portfolio;
}

/**
 * Shortcode
 */
function hvboom_portfolio_shortcode($atts, $content = null) {
  $portfolio = hvboom_get_portfolio();

  return $portfolio;
}
add_shortcode('hvboom_portfolio', 'hvboom_portfolio_shortcode');

/**
 * Template-Tag
 */
function hvboom_portfolio_tag() {
  print hvboom_get_portfolio();
}

/**
 * Include CSS
 */
function hvboom_plugin_scripts() {
  wp_enqueue_style('hvboom-portfolio', CURRENT_PLUGIN_STYLESHEET_URL . 'hvboom-portfolio.css', array('bootstrap-styles'));
}
add_action('wp_enqueue_scripts', 'hvboom_plugin_scripts');


/**
 * Helper functions
 */
function hvboom_get_image($pid = NULL, $size = 'thumbnail') {
  $url = wp_get_attachment_image_src(get_post_thumbnail_id($pid), $size);
  $content = '';
  if($url) {
    $content .= '    <img src="' . $url[0] . '" alt="' . esc_attr(get_the_title($pid)) . '" />' . PHP_EOL;
  }

  return $content;
}

?>
