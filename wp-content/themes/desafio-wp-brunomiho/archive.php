<?php get_header(); ?>

<?php
    //Criar o objeto termo.
    $term = get_queried_object();
?>

<div class="content interna_videos">
    <div class="container-fluid d-flex flex-column flex-lg-row">
        <div class="col-12 col-lg-5 mb-5">
            <h3 class="titulo_categoria mb-4"><?php echo $term->name; ?></h3>
            <p class="descricao_categoria"><?php echo $term->description; ?></p>
        </div>
        <div class="col-12 col-lg-6 offset-lg-1">
            <?php echo do_shortcode('[exibir_videos categoria="'. $term->slug .'" classe=""]');?>
        </div>
    </div>
</div>

<?php get_footer(); ?>