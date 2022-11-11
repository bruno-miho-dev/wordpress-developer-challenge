<?php

    //Define o caminho do tema.
    define('path_theme', get_template_directory_uri());
    
    //Funcão para inserir css e js.
    function mytheme_enqueue_script(){
      wp_enqueue_script( 'slick-js', path_theme.'/assets/js/slick.min.js', array('jquery'), '1.0', true );
      wp_enqueue_script( 'my-custom-js', path_theme.'/assets/js/general.js', array('jquery'), '1.0', true );
      wp_enqueue_style( 'bootstrap-js', path_theme.'/assets/bootstrap-5.1.3/js/bootstrap.min.js', array('jquery'), '5.1.3', true);
      wp_enqueue_style( 'bootstrap-css', path_theme.'/assets/bootstrap-5.1.3/css/bootstrap.min.css');
      wp_enqueue_style( 'slick-theme-css', path_theme.'/assets/css/slick-theme.css');
      wp_enqueue_style( 'slick-css', path_theme.'/assets/css/slick.css');
      wp_enqueue_style( 'style-default', path_theme.'/style.css');	
      //wp_enqueue_style('fontawesome', path_theme.'/assets/fontawesome-free-6.0.0/css/all.min.css');
    }
    
    add_action('wp_enqueue_scripts', 'mytheme_enqueue_script', 20 );

    //Suports
    add_theme_support('post-thumbnails');

    //Taxonomia
    function custom_taxonomies_config(){
      $args_catVideos = array(
        "label" => "Categoria de Videos",
        "public" => true,
        "rewrite" => true,
        "hierarchical" => true,
        "show_admin_column" => true,
        "show_in_rest" => true,
      );

      register_taxonomy("cat_videos", "Categoria de Videos", $args_catVideos);

    }
    
    add_action("init", "custom_taxonomies_config");

    //Post-Type
    function custom_post_type_config(){

      $args_videos = array(
        "label" => "Videos",
        "labels" => array(
          "name" => "Videos",
          "singular_name" => "Video"
        ),
        "description" => "Cadastro de video.",
        "public" => true,
        "public_queryable" => true,
        'show_in_rest' => true,
        "show_ui" => true, /* exibe na inteface */
        "show_in_menu" => true, /* menu lateral */
        "show_in_nav_menus" => true, /* criação de menus */
        "menu_icon" => 'dashicons-video-alt2',
        "rewrite" => array("slug" => "video", "with_front" => true),
        "supports" => array("title", "editor", "thumbnail"),
        "taxonomies" => array("cat_videos", "Categoria de Videos"),
      );
  
      register_post_type("videos", $args_videos);

    }
  
    add_action("init", "custom_post_type_config");

	//CAMPOS PERSONALIZADOS
				if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_636d15b35296b',
	'title' => 'Campos Personalizados',
	'fields' => array(
		array(
			'key' => 'field_636d15b3e01d5',
			'label' => 'Tempo de Duração',
			'name' => 'tempo_de_duracao',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_636d15fbe01d6',
			'label' => 'Sinopse',
			'name' => 'sinopse',
			'aria-label' => '',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'rows' => '',
			'placeholder' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_636d160fe01d7',
			'label' => 'Embed do Video',
			'name' => 'embed_do_video',
			'aria-label' => '',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'videos',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

endif;		

    //SHORTCODES
    function func_menu_shortcode($params = ''){

      $args_menu = array(
        'taxonomy' => 'cat_videos',
        'order' => 'ASC',
        'hide_empty'=> false,
      );
      
      $categories = get_categories($args_menu);
      
      $html = '<ul class="menu d-flex align-items-center justify-content-center justify-content-lg-end gap-4">';

      $ExtraClass = "";
      $slugSeparada = "";
      $term = "";
      $addIcon = "";
    
      foreach($categories as $category){
    
        if(is_front_page()) {

        } else {
          $obj_id = get_queried_object_id();
          $current_url = get_term_link( $obj_id );
          $separarURL = explode("/", $current_url);
          
          if(isset($separarURL[5]) == null) {

          } else {
            $slugSeparada = $separarURL[5];
          }

          if($slugSeparada == $category->slug) {
            $ExtraClass = 'ativo';
          } else {
            $ExtraClass = '';
          }

        }
        
        $html .= '<li><a href="'. get_site_url() .'/cat_videos/'.$category->slug.'" class="'. $ExtraClass .'">'.$category->name.'</a></li>';

      }

      $html .= '</ul>';

      return $html;
        
    }
  
    add_shortcode("custom_menu", "func_menu_shortcode");

    // SHORTCODE - BANNER
    function func_banner_destaque(){

      $args_destaque = array (
        'post_type' => 'videos',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'order' => 'ASC',
      );

      $dados_cpt = new WP_Query($args_destaque);

      if($dados_cpt->have_posts()){

        $html = '<div class="row banner">';

        while($dados_cpt->have_posts()){
              $dados_cpt->the_post();
              $embed = get_field('embed_do_video');
              $embedtomovie = explode("/", $embed);

              // Pegar Categoria Atual
              $cat = wp_get_post_terms(get_the_ID(), 'cat_videos');
              foreach ($cat as $categoria) {
                $catVideo = $categoria->name;
              }


              $html .= '

                      <div class="col-12 position-relative px-0">
                        <iframe style="filter: brightness(0.6);" width="100%" height="800" src="https://www.youtube.com/embed/'. $embedtomovie[3] .'?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <div class="content">
                          <div class="d-flex flex-row mb-4 gap-3">
                            <span class="titulo_categoria">'. $catVideo .'</span>
                            <span class="duracao">'. get_field('tempo_de_duracao').'</span>
                          </div>
                          <h2 class="titulo_video mb-4">'. get_the_title() .'</h2>
                          <a class="btnInfo" href="'. get_the_permalink() .'">Mais informações</a>
                        </div>
                      </div>
              
                          
              ';
        }

        $html .= '</div>';
        wp_reset_query();
      } else {
        return 'Nenhum post encontrado!';
      }

      return $html;
      
    }
  
    add_shortcode("banner_destaque", "func_banner_destaque");

    // SHORTCODE - VIDEOS
    function func_exibir_videos($params = '') {

      //Validação Classe
      $extraClass = "";
      $columnClass = "";

      if($params['classe']) {
        $columnClass = 'px-3';
      } else {
        $extraClass = 'row-cols-1 row-cols-md-3';
      }

      //Validação na Home
      $addTitle = "";
      if(is_front_page()) {
        $addTitle = '<h2 class="text-capitalize">'. $params['categoria'] .'</h2>';
      }
      
      // Filtro de Categoria
      $arrayFilter = array();
		
      if(isset($params['categoria']) && strlen($params['categoria']) > 0){
        array_push($arrayFilter, array(
          'taxonomy' => 'cat_videos',
          'field' => 'slug',
          'terms' => $params['categoria'],
        ));	
      }
      
      $args_videos = array (
        'post_type' => 'videos',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'order' => 'ASC',
        'tax_query' => $arrayFilter
      );

      $dados_cpt = new WP_Query($args_videos);

      if($dados_cpt->have_posts()){

        //Ternario
        $comRow = is_front_page() ? 'row' : '';

        $html = '<div class="videos '. $comRow .' text-white">';

        $html .= '
        
            '. $addTitle .'
            
            <div class="row '. $extraClass .' '. $params['classe'] .'">
            ';

        while($dados_cpt->have_posts()){
              $dados_cpt->the_post();

              // Pegar Categoria Atual
              $cat = wp_get_post_terms(get_the_ID(), 'cat_videos');
              foreach ($cat as $categoria) {
                $catVideo = $categoria->name;
              }


              $html .= '

                      <a href="'. get_the_permalink() .'" class="col '.$columnClass.' mb-5">
                        <div class="imgCapa" style="background-image: url('. get_the_post_thumbnail_url() .');"></div>
                        <span class="mb-3">'. get_field('tempo_de_duracao') .'</span>
                        <h3>'. get_the_title() .'</h3>
                      </a>
              
                          
              ';
        }

        $html .= '</div></div>';
        wp_reset_query();
      } else {
        return 'Nenhum post encontrado!';
      }

      return $html;
    }
    add_shortcode("exibir_videos", "func_exibir_videos");