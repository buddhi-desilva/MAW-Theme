<?php /*
Template Name: Homepage
*/ ?>
<?php
remove_action('maw_genesis_post_title', 'maw_genesis_do_post_title' );
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
add_action( 'genesis_post_content', 'maw_home_page_content' );

remove_action( 'maw_genesis_loop', 'maw_genesis_do_loop' );
add_action( 'maw_genesis_loop', 'maw_home_genesis_do_loop' );

function maw_home_genesis_do_loop() {
  maw_genesis_homepage_loop();
}


function maw_home_page_content () { ?>
  <div class="banner">
    <div class="wrap">

      <?php
        global $post;

        if ( is_singular() ) {
          the_content();

          if ( is_single() && 'open' == get_option( 'default_ping_status' ) && post_type_supports( $post->post_type, 'trackbacks' ) ) {
            echo '<!--';
            trackback_rdf();
            echo '-->' . "\n";
          }

          if ( is_page() && apply_filters( 'genesis_edit_post_link', true ) )
            edit_post_link( __( '(Edit)', 'genesis' ), '', '' );
        }
        elseif ( 'excerpts' == genesis_get_option( 'content_archive' ) ) {
          the_excerpt();
        }
        else {
          if ( genesis_get_option( 'content_archive_limit' ) )
            the_content_limit( (int) genesis_get_option( 'content_archive_limit' ), __( '[Read more...]', 'genesis' ) );
          else
            the_content( __( '[Read more...]', 'genesis' ) );
        }
       ?>

    </div>
  </div>
  <div class="menu">
    <div class="wrap">
      <ul>
        <li><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Flexiwork Mums' ) ) ); ?>" class="btn-flexiwork-mums"><img src="<?php echo CHILD_URL ?>/images/flexiwork-mums-img.png" alt="Flexiwork Mums" /> Flexiwork Mums</a></li>
        <li><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Employers' ) ) ); ?>"  class="btn-employers"><img src="<?php echo CHILD_URL ?>/images/employers-img.png" alt="Employers" /> Employers</a></li>
        <li><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Mumpreneurs' ) ) ); ?>"  class="btn-mumpreneurs"><img src="<?php echo CHILD_URL ?>/images/mumpreneurs-img.png" alt="Mumpreneurs" /> Mumpreneurs</a></li>
      </ul>
      <a href="#" class="btn-circle-arrow-down"><img class="img-circle-arrow-down" src="<?php echo CHILD_URL ?>/images/img_trans.gif" alt="Next" /></a>
    </div>
  </div><!--.menu-->


<?php } ?>

<?php maw_genesis(); ?>