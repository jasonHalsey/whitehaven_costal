(function ($) {
   $(document);

//Init jQuery on page load to support menu link updates
$(function() {

	$( "#coveshortcode_button" ).attr("aria-haspopup", "true");
	
   
	
	var coll_header_title = $("tr.coll-section-header-title .acf-input div input:text");
	
	
	
	coll_header_title.blur(function(){
        
		var coll_section_menu_link = $(this).closest(".acf-table").find('tr.coll_menu_link .acf-input input:text');
		
		
		if ($(this).val() != ""){
			
			var header_title = $(this).val();
				
			header_title = header_title.replace(/\s/g,"-");
			
			header_title = header_title.toLowerCase();
			
							$(coll_section_menu_link).val('/#' + header_title);
					
		}
		
		
    });
	
	
	
	var txt_header_title = $("tr.txt-section-header-title .acf-input div input:text");
		
	txt_header_title.blur(function(){
        
		var txt_section_menu_link = $(this).closest(".acf-table").find('tr.txt_menu_link .acf-input input:text');
		
		if ($(this).val() != ""){
			var header_title = $(this).val();
				
			header_title = header_title.replace(/\s/g,"-");
			header_title = header_title.toLowerCase();
			
			
				txt_section_menu_link.val('/#' + header_title);
				
		}
		
    });
	
	
	var tl_header_title = $("tr.tl-section-header-title input:text");
	
	
	$(tl_header_title).blur(function(){
        
		var tl_section_menu_link = $(this).closest(".acf-table").find('tr.tl_menu_link .acf-input input:text');
		
		if ($(this).val() != ""){
			var header_title = $(this).val();
				
			header_title = header_title.replace(/\s/g,"-");
			header_title = header_title.toLowerCase();
					
				tl_section_menu_link.val('/#' + header_title);
				
		}
		
    });
	
	var contact_header_title = $("tr.contact-section-header-title input:text");
		
	contact_header_title.blur(function(){
        if ($(this).val() != ""){
			
			var contact_section_menu_link = $(this).closest(".acf-table").find('tr.contact_menu_link .acf-input input:text');
			
			var header_title = $(this).val();
				
			header_title = header_title.replace(/\s/g,"-");
			header_title = header_title.toLowerCase();
			
				
				contact_section_menu_link.val('/#' + header_title);
				
			
		}
		
    });
	
	
});
  

		//Init jQuery function again on acf append
			acf.add_action('append', function(){
			
			
			$( "#coveshortcode_button" ).attr("aria-haspopup", "true");
			
		   
			
			var coll_header_title = $("tr.coll-section-header-title .acf-input div input:text");
			
			
			
			coll_header_title.blur(function(){
		        
				var coll_section_menu_link = $(this).closest(".acf-table").find('tr.coll_menu_link .acf-input input:text');
				
				
				if ($(this).val() != ""){
					
					var header_title = $(this).val();
						
					header_title = header_title.replace(/\s/g,"-");
					
					header_title = header_title.toLowerCase();
					
									$(coll_section_menu_link).val('/#' + header_title);
							
				}
				
				
		    });
			
			
			
			var txt_header_title = $("tr.txt-section-header-title .acf-input div input:text");
				
			txt_header_title.blur(function(){
		        
				var txt_section_menu_link = $(this).closest(".acf-table").find('tr.txt_menu_link .acf-input input:text');
				
				if ($(this).val() != ""){
					var header_title = $(this).val();
						
					header_title = header_title.replace(/\s/g,"-");
					header_title = header_title.toLowerCase();
					
					
						txt_section_menu_link.val('/#' + header_title);
						
				}
				
		    });
			
			
			var tl_header_title = $("tr.tl-section-header-title input:text");
			
			
			$(tl_header_title).blur(function(){
		        
				var tl_section_menu_link = $(this).closest(".acf-table").find('tr.tl_menu_link .acf-input input:text');
				
				if ($(this).val() != ""){
					var header_title = $(this).val();
						
					header_title = header_title.replace(/\s/g,"-");
					header_title = header_title.toLowerCase();
							
						tl_section_menu_link.val('/#' + header_title);
						
				}
				
		    });
			
			var contact_header_title = $("tr.contact-section-header-title input:text");
				
			contact_header_title.blur(function(){
		        if ($(this).val() != ""){
					
					var contact_section_menu_link = $(this).closest(".acf-table").find('tr.contact_menu_link .acf-input input:text');
					
					var header_title = $(this).val();
						
					header_title = header_title.replace(/\s/g,"-");
					header_title = header_title.toLowerCase();
					
						
						contact_section_menu_link.val('/#' + header_title);
						
					
				}
				
		    });
			
			
			}); //End second init

}(jQuery));