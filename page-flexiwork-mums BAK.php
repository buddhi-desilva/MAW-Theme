<?php /*
Template Name: Flexiwork mums
*/ ?>
<?php
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
add_action( 'genesis_post_content', 'maw_page_content' );
add_action( 'genesis_before_post_title', 'maw_flexiwork_mum_form' );


function maw_flexiwork_mum_form () { ?>
  <div class="signup-form">
    <form class="newsletter-form">
      <h1>Flexiwork Mums</h1>
      <p>Subscribe to our FREE Newsletter</p>
      <div class="form-inputs">
        <input type="text" placeholder="Your Full Name" />
        <input type="text" placeholder="Your Email Address" />
      </div>
      <div class="btn-holder">
        <input type="submit" class="btn-signup" value="Sign Me Up!" />
      </div>
    </form><!--
    --><img class="img-flexiwork-mums-banner" src="images/img_trans.gif" alt="Next" />
  </div>
<?php }


function maw_page_content () { ?>
  <div class="content">
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


<?php } ?>

<?php maw_genesis(); ?>