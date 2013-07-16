<?php
/*
 WARNING: This file is part of the core Genesis framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the header structure.
 *
 * This file is a core Genesis file and should not be edited.
 *
 * @category Genesis
 * @package  Templates
 * @author   StudioPress
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.studiopress.com/themes/genesis
 */

do_action( 'genesis_doctype' );
do_action( 'genesis_title' );
do_action( 'genesis_meta' );

wp_head(); /** we need this for plugins **/
?>

  <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700,700italic' rel='stylesheet' type='text/css'>

  <style type="text/css">
    html { margin-top: 0px !important; }
    * html body { margin-top: 0px !important; }
  </style>
</head>
<body <?php body_class(); ?>>
  <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <div class="page">

      <header class="header">
        <div class="wrap">
          <a class="open" href="#navigation">
            <span></span>
            <span></span>
            <span></span>
          </a>
          <div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo CHILD_URL ?>/images/img_trans.gif" class="img-logo" alt="Mums at Work Singapore" /></a></div>
          <navigation class="navigation" id="navigation" />
            <a class="close" href="javascript:$.pageslide.close()">&times;</a>
            <h2>Navigation</h2>
              <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
          </navigation>
        </div>
      </header><!--.header-->