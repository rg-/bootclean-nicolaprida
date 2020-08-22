<?php
  $field_settings_footer = WPBC_get_field('field_settings_footer', 'options'); 
?>

<footer id="main-footer" data-inview="detect" data-inview-apply="body" data-inview-replaceclass="uielements-" data-inview-replaceto="uielements-white"> 

  <div class="container">
    
    <div class="row gpt-3 gpb-1">
      <div class="col-12">
        <?php
        $settings_footer_logos = $field_settings_footer['settings_footer_logos'];
        $img_0 = wp_get_attachment_image_src($settings_footer_logos[0]['image'],'large');
         echo '<img class=" d-block d-lg-none mx-auto gmb-1" src="'.$img_0[0].'" height="98" style="width:auto;" alt="'.$settings_footer_logos[0]['label'].'"/>';
        ?>
        <div class="text-center justify-content-center justify-content-lg-between d-flex flex-wrap ">
          <?php 
          $count = 0;
          foreach ($settings_footer_logos as $key => $value) {
            # code...
            /*
              $value['label']
              $value['url']
              $value['image']
            */
              $img = wp_get_attachment_image_src($value['image'],'large');
              if($count==0){
                $class = 'd-none d-lg-inline-block';
              }else{
                $class = 'd-inline-block';
              }
            echo '<img class="'.$class.'" src="'.$img[0].'" height="98" style="width:auto;" alt="'.$value['label'].'"/>';
            $count++;
          }
          ?>
        </div>
      </div>
    </div>

    <div class="row gpt-1 gpb-2"> 

      <div class="col-12 text-center order-3 order-md-2">
        <div class="d-sm-flex align-items-center">
          <p class="mr-md-auto"><?php echo $field_settings_footer['copyright'];?></p>
          <p class="mx-auto mr-md-0 ml-md-auto d-sm-flex align-items-center">Design & development <a href="http://nomadeweb.com" target="_blank"><img src="<?php echo CHILD_THEME_URI; ?>/images/theme/nomade.png" width="36" alt=" "></a></p>
        </div>
      </div>

    </div>

  </div>

</footer>