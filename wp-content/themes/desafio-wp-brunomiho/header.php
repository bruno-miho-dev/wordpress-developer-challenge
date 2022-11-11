<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <!-- Inc Google Tags and Facebook Pixel -->
        <?php // include("inc/tags.php"); ?>
        
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="header">
      <div class="container-fluid d-flex flex-row align-items-center justify-content-start">
        <div class="col-12 col-md-6 col-lg-3 text-center text-md-start">
          <a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri().'/assets/img/logo-play.svg'; ?>" alt="" /></a>
        </div>
        <div class="col-md-6 col-lg-9 d-none d-md-block">
          <?php echo do_shortcode('[custom_menu dispositivo="desktop"]');?>
        </div>
      </div>
    </header>

    <div class="menuFlutuante">
      <div class="container-fluid d-flex flex-row align-items-center justify-content-center">
        <div class="col-12">
          <?php echo do_shortcode('[custom_menu dispositivo="mobile"]');?>
        </div>
      </div>
    </div>