<?php

add_filter('wpbc/filter/pjax/installed',function(){
	return true;
},10,1);


add_action('wpbc/action/pjax/js/send', 'custom_pjax_send',10);
function custom_pjax_send(){
	?>
	// $('#main-navbar').animate({top:'-300px'},300); 
	<?php
};

add_action('wpbc/action/pjax/js/success/loader', 'custom_pjax_success_loader',10);
function custom_pjax_success_loader(){
	?>  
	<?php
};
add_action('wpbc/action/pjax/js/success', 'custom_pjax_success',10);
function custom_pjax_success(){
	?>
	  
	<?php
};