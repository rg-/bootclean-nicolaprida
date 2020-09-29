<?php

if(isset($_GET['u'])){
	if( is_user_logged_in() ){
		$current_user_id = get_current_user_id();
		if($_GET['u'] == $current_user_id){
			echo 1;
		}else{ 
			echo 0;
		} 
	}else{ 
		echo 0;
	}
}else{ 
		echo 0;
	}
