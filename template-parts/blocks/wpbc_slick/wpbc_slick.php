<?php


// Create id attribute allowing for custom "anchor" value.
$id = 'wpbc_slick-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wpbc_slick';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


$wpbc_block_slick_gallery = get_field('wpbc_block_slick_gallery');
$wpbc_block_slick_settings = !empty( get_field('wpbc_block_slick_settings') ) ? get_field('wpbc_block_slick_settings') : '{ "adaptiveHeight":true, "dots":false, "arrows":true, "autoplay":true, "autoplaySpeed":10000, "speed":1000 }';
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php if(!empty($wpbc_block_slick_gallery)){ 
			?><div class="theme-slick-slider gmb-2" data-slick='<?php echo esc_attr($wpbc_block_slick_settings); ?>' ><?php
			foreach($wpbc_block_slick_gallery as $k=>$v){ 
				$large = $v['sizes']['large'];
				$thumbnail = $v['sizes']['thumbnail'];
				$img = $v['sizes']['large']; 
				$attr = '';
				$img_attr = '';
				if(is_admin()){
					$img = $v['sizes']['thumbnail'];
					$attr = 'style="display:inline-block; margin-right:5px; "';
					$img_attr = 'style="width: 97px;"';
				}
				?><div class="item" <?php echo $attr; ?>> 
				    <div class="item-container"> 
				    	<img src="<?php echo $img; ?>" class="item-image full-w" alt=" " <?php echo $img_attr; ?>/>
				    </div>
				  </div><?php
			}
			?></div><?php 
	} else { ?>
		<p>Insert some images</p>
	<?php } ?>
</div>