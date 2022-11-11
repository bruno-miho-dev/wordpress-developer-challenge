<?php get_header(); ?>

<?php 

// Pegar Categoria Atual
$cat = wp_get_post_terms(get_the_ID(), 'cat_videos');
foreach ($cat as $categoria) {
	$catVideo = $categoria->name;
}

$embed = get_field('embed_do_video');
$embedtomovie = explode("/", $embed);

?>

<div class="content">
	<div class="container-fluid">
		<div class="col-12 col-lg-10 offset-lg-2">
			<div class="banner">
				<div class="d-flex flex-row mb-4 gap-3">
					<span class="titulo_categoria"><?php echo $catVideo; ?></span>
					<span class="duracao"><?php echo get_field('tempo_de_duracao'); ?></span>
				</div>
				<h2 class="titulo_video mb-4"><?php echo get_the_title(); ?></h2>
			</div>
		</div>
		<div class="col-12">
			<div>
				<iframe class="videoEmbed" src="https://www.youtube.com/embed/<?php echo $embedtomovie[3]; ?>?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
		<div class="col-12 col-lg-10 mx-auto py-5">
			<div class="texto-single">
				<?php echo get_the_content(); ?>
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>