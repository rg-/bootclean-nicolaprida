+function ($) { 

	$('[data-is-inview]').is_inview();
 	
 	$(window).on('bc_inited', function(e){ 
    
  });  

  $('[data-slick]').on('init', function(slick){  
 		var me = $(this);
		me.find('[data-is-inview]').is_inview();  
	}); 

	$('[data-toggle="collapse-custom"]').on('click',function(){

		var target = $(this).attr('href');
		var expanded = $(this).attr('aria-expanded');
		var parent = $(this).attr('data-parent');
		if(expanded == 'false'){
			//alert("ops");
			//$(parent).find('.collapse').collapse('hide');

			$(parent).find('[aria-expanded=true]').attr('aria-expanded','false').addClass('collapsed');

			$(this).removeClass('collapsed');
			$(this).attr('aria-expanded','true');
			$(target).collapse('show');
		}
		return false;

	});

	function _respond_CollapseHover(el){

		var respond = el.data('hover-respond') ? el.data('hover-respond') : 'lg';
		var respond_min = bc_config.breakpoints.md;
		if(respond=='xs'){
			respond_min = bc_config.breakpoints.xs;
		}
		if(respond=='sm'){
			respond_min = bc_config.breakpoints.sm;
		}
		if(respond=='md'){
			respond_min = bc_config.breakpoints.md;
		}
		if(respond=='lg'){
			respond_min = bc_config.breakpoints.lg;
		}
		if(respond=='xl'){
			respond_min = bc_config.breakpoints.xl;
		} 

		return respond_min;
	} 


	$(window).on('resize', function () {
		if($('#collapse-lol').hasClass('show')){
			$('#collapse-lol').collapse('hide');
		} 
	});

	$(document).on('click', '.dropdown [data-trigger="onclick"]',function(event){
		
		event.preventDefault();
		var selText = $(this).html();
    var valueText = $(this).data('value'); 
    var me = $(this).closest('.dropdown-select'); 
    me.find('.dropdown-select-value').data('value',valueText);
    me.find('.dropdown-select-value').html(selText); 
    var this_rel = $(this).attr('href');
		$(this_rel).trigger('click');
	});
	 
	$(document).on('mouseover', '[data-hover="collapse"]',function(){
		var me = $(this);
		var target = $( me.data('target') );
		var respond_min = _respond_CollapseHover($(this)); 
			if( $(window).width() < respond_min || $('body').hasClass('side-menu-visible') ) {
				// target.collapse('hide');
			}else{
				target.collapse('show');
				$(document).on('mouseleave', '#main-navbar',function(){
					var respond_min = _respond_CollapseHover(me); 
					if( $(window).width() < respond_min || $('body').hasClass('side-menu-visible') ) {
						// target.collapse('hide');
					}else{
						target.collapse('hide');
					}
				});
			}
	});
	$(document).on('click', '[data-hover="collapse"]',function(){
		var me = $(this);
		var target = $( me.data('target') );
		e.preventDefault();
			// data-hover-respond
			var respond_min = _respond_CollapseHover($(this));
			if( $(window).width() < respond_min || $('body').hasClass('side-menu-visible') ) {
				// target.collapse('hide');
			}else{
				//return false;
			}
	}); 

	 

	$('#main-navbar .navbar-collapse').on('show.bs.collapse', function (e) { 
		var target = $(this); 
		$('body').addClass('nav-open');
		$('.side-menu .nav-link').on('click',function(){ 
				if( $('body').hasClass('side-menu-visible') ) { 
					target.collapse('hide');
					$('body').removeClass('side-menu-visible'); 
				}else{
					//return false;
				}
		});
	}); 
	$('#main-navbar .navbar-collapse').on('hide.bs.collapse', function (e) {  
		$('body').removeClass('nav-open');
	});
	////////////////////////////////////

	$('.page-header .theme-slick-slider').on('init', function(slick){
	  
	  $('.page-header .custom-dots button').each(function(e){

	  	var c = $(this).html();
	  	var index = parseInt( c );

	  	if(index<10){
	  		$(this).html( '0' + c );
	  	}

	  	var cc = $(this).html();

	  	$(this).html('<span class="custom-arrow-n">'+cc+'</span>');

	  	$(this).append('<span class="custom-arrow-active"/>');

	  }); 

	});
	

	$('.modal').on('show.bs.modal', function (e) { 
		var modal = $( this );  

		if($(e.relatedTarget).attr('data-modal-content')){
			var result = $(e.relatedTarget).attr('data-modal-content');  
			
			modal.find('.modal-body').html(result);
		}

	});

}(jQuery);

// window scroll ease effect