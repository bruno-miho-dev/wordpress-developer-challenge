<?php get_header(); ?>
    <main class="main">
      <!-- BANNER TOPO -->
      <?php echo do_shortcode('[banner_destaque]');?>
      <!-- SECTION FILMES -->
      <?php echo do_shortcode('[exibir_videos categoria="filmes" classe="slider-videos"]');?>
      <!-- SECTION DOCUMENTARIOS -->
      <?php echo do_shortcode('[exibir_videos categoria="documentarios" classe="slider-videos"]');?>
      <!-- SECTION SÉRIES -->
      <?php echo do_shortcode('[exibir_videos categoria="series" classe="slider-videos"]');?>
    </main>
<?php get_footer(); ?>    