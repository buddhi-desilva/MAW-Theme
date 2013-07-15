<?php
// Start the engine
require_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Mums at Work' );
define( 'CHILD_THEME_URL', 'http://zpixel.com/' );

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'sample_viewport_meta_tag' );
function sample_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for custom header
add_theme_support( 'genesis-custom-header', array(
	'width' => 1152,
	'height' => 120
) );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

register_nav_menu( 'footer-misc-links', __( 'Footer misc links', 'twentytwelve' ) );


function maw_genesis() {
  get_header();
  // do_action( 'genesis_before_content_sidebar_wrap' );
  ?>
      <?php
        do_action( 'genesis_before_loop' );
        do_action( 'maw_genesis_loop' );
        do_action( 'genesis_after_loop' );
      ?>
  <?php

  get_footer();

}

add_action( 'maw_genesis_loop', 'maw_genesis_do_loop' );
/**
 * Attach a loop to the genesis_loop output hook so we can get
 * some front-end output. Pretty basic stuff.
 *
 * @since 1.1.0
 *
 * @uses genesis_get_option() Get theme setting value
 * @uses genesis_get_custom_field() Get custom field value
 * @uses genesis_custom_loop() Do custom loop
 * @uses genesis_standard_loop() Do standard loop
 */
function maw_genesis_do_loop() {

  if ( is_page_template( 'page_blog.php' ) ) {
    $include = genesis_get_option( 'blog_cat' );
    $exclude = genesis_get_option( 'blog_cat_exclude' ) ? explode( ',', str_replace( ' ', '', genesis_get_option( 'blog_cat_exclude' ) ) ) : '';
    $paged   = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

    /** Easter Egg */
    $query_args = wp_parse_args(
      genesis_get_custom_field( 'query_args' ),
      array(
        'cat'              => $include,
        'category__not_in' => $exclude,
        'showposts'        => genesis_get_option( 'blog_cat_num' ),
        'paged'            => $paged,
      )
    );

    genesis_custom_loop( $query_args );
  } else {
    maw_genesis_standard_loop();
  }

}


function maw_genesis_standard_loop() {

  global $loop_counter;

  $loop_counter = 0;

  if ( have_posts() ) : while ( have_posts() ) : the_post();

  do_action( 'genesis_before_post' );
  ?>

    <div class="content">
      <div class="wrap">
        <?php do_action( 'genesis_before_post_title' ); ?>
        <?php do_action( 'maw_genesis_post_title' ); ?>
        <?php do_action( 'genesis_after_post_title' ); ?>
        <?php do_action( 'genesis_before_post_content' ); ?>
        <?php do_action( 'genesis_post_content' ); ?>
        <?php do_action( 'genesis_after_post_content' ); ?>
      </div>
    </div>

  <?php

  do_action( 'genesis_after_post' );
  $loop_counter++;

  endwhile; /** end of one post **/
  do_action( 'genesis_after_endwhile' );

  else : /** if no posts exist **/
  do_action( 'genesis_loop_else' );
  endif; /** end loop **/

}


function maw_genesis_homepage_loop() {

  global $loop_counter;

  $loop_counter = 0;

  if ( have_posts() ) : while ( have_posts() ) : the_post();

  do_action( 'genesis_before_post' );
  ?>
        <?php do_action( 'genesis_before_post_title' ); ?>
        <?php do_action( 'maw_genesis_post_title' ); ?>
        <?php do_action( 'genesis_after_post_title' ); ?>
        <?php do_action( 'genesis_before_post_content' ); ?>
        <?php do_action( 'genesis_post_content' ); ?>
        <?php do_action( 'genesis_after_post_content' ); ?>
  <?php

  do_action( 'genesis_after_post' );
  $loop_counter++;

  endwhile; /** end of one post **/
  do_action( 'genesis_after_endwhile' );

  else : /** if no posts exist **/
  do_action( 'genesis_loop_else' );
  endif; /** end loop **/

}


add_action( 'maw_genesis_post_title', 'maw_genesis_do_post_title' );
/**
 * Echo the title of a post.
 *
 * The genesis_post_title_text filter is applied on the text of the title, while
 * the genesis_post_title_output filter is applied on the echoed markup.
 *
 * @since 1.1.0
 *
 * @return null Returns early if the length of the title string is zero
 */
function maw_genesis_do_post_title() {

  $title = apply_filters( 'genesis_post_title_text', get_the_title() );

  if ( 0 == strlen( $title ) )
    return;

  if ( is_singular() )
    $title = sprintf( '<h2><span>%s</span></h2>', $title );
  elseif ( apply_filters( 'genesis_link_post_title', true ) )
    $title = sprintf( '<h2><span><a href="%s" title="%s" rel="bookmark">%s</a></span></h2>', get_permalink(), the_title_attribute( 'echo=0' ), apply_filters( 'genesis_post_title_text', $title ) );
  else
    $title = sprintf( '<h2><span>%s</span></h2>', $title );

  echo apply_filters( 'genesis_post_title_output', "$title \n" );

}
