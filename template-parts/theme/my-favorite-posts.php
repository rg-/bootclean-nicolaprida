<div class="featured_videos">
<?php 
$posts = get_favorites('all'); 
 
if ( $posts ) { 

    ?>
    <p>Hay <u><?php  echo (count($posts)); ?></u> publicaciones guardadas.
    <?php

    $remove_title = __( 'Remover de favoritos', 'nicolaprida' );
    $remove_link = ' <a href="#" data-id="%s" title="%s" class="wpf-remove-favorite">x</a>';
    $count = 0;
    foreach ($posts as $item) {
        $extra = $show_remove ? sprintf( $remove_link, $item->post_id, $remove_title ) : ''; 

    		$featured_img_low = get_the_post_thumbnail_url($item->post_id,'medium');  

    		if( 'video' === get_post_type($item->post_id) ){
    			$taxonomy = 'categoria-video';
    		}else{
    			$taxonomy = 'category';
    		}

    		$cats = WPBC_get_the_terms(array(
					'taxonomy' => $taxonomy,
					'post_id'=> $item->post_id,
					'before' => '',
					'sep' => '',
					'before_name' => '<u class="btn-xs">',
					'after_name' => '</u>',
					'use_links' => false,
				));
    		?>
<article id="favorite-post-<?php the_ID(); ?>" <?php post_class('search-post'); ?>>
    
    <div class="entry-content gmy-1">

        <div class="row row-half-gutters">

            <div class="col-md-3 col-lg-3 position-relative pt-md-2 gmb-1 mb-md-0">
                <?php $count++; ?>
                <div class="post-favorite-absolute d-md-none">[favorite-post-btn post_id="<?php echo $item->post_id; ?>"]</div>
                <a href="<?php echo esc_url( get_permalink($item->post_id) ); ?>" class="d-block">
                    <div class="hover_effect">
                        <div class="embed-responsive embed-responsive-4by3">
                            <div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $featured_img_low; ?>); ">
                            </div>
                        </div> 
                    <?php 
                    if( 'video' === get_post_type($item->post_id) ){
                        ?>
                        <span class="btn btn-more"><img src="[WPBC_get_stylesheet_directory_uri]/images/theme/icon-play.png" width="60" alt=" "/></span><?php
                    } 
                    ?>
                    </div>
                </a>
            </div>
            <div class="col-md-9 col-lg-9 gpr-lg-4">
                <div class="post-favorite-small d-none d-md-block">[favorite-post-btn post_id="<?php echo $item->post_id; ?>"]</div>
                <h6 class="section-title sm"><a href="<?php echo esc_url( get_permalink($item->post_id) ); ?>" class="d-block"><?php 
                if( 'post' === get_post_type($item->post_id) ){
                    echo "<small class='t'>RUTINAS</small><br>";
                }
                if( 'video' === get_post_type($item->post_id) ){
                    echo "<small class='t'>VIDEOS</small><br>";
                } 
                ?><?php echo get_the_title($item->post_id); ?></a></h6>
                <?php WPBC_excerpt(array(
                    'post' => $item->post_id,
                    'class' => 'small gmb-1',
                    'readmore' => false,
                ));  ?> 
                <a href="<?php echo esc_url( get_permalink($item->post_id) ); ?>" class="btn btn-outline-light btn-xs">VER MÁS</a>
                <div class="mt-1 d-none">
                    <?php echo $cats;?>
                </div>
            </div>
        </div>
    </div>

</article><!-- article#post-## -->
<hr class="bg-gray gmb-1">
<?php
    }
} else {
	?>
	<div class="featured_video gpb-2">
        <p class="lead">Agrega rutinas y videos favoritos a tu cuenta.</p>
	</div>
	<?php 
} 
?>
</div>