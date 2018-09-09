jQuery(function($){
	var _this ;
	$(".subsub_menu_rug_wapper").after('<div style = "display:none" id = "loading_img"><img  src = "'+global_var.loading_img+'" /></div>');
	$(document).on('click','.select_image_wapper .close',function(e){
		$(_this).removeClass("active");
		$(".select_image_wapper").html("");
	});
	$(document).on('click','.subsub_menu_rug ul li a',function(e){
		$(".subsub_menu_rug ul li a").removeClass("active");
		$(this).addClass("active");
		_this = this ,cat_id = $(this).data("cat_id"),
		data = {
			"action" : "load_product",
			"cat_id" : cat_id
		} ;
		$("#loading_img").show();
		$.post(global_var.ajax_url,data,function(response){
			$(".select_image_wapper").html(response).addClass("open");
			$("#loading_img").hide();
		});
		
	});
	$(document).on('click','.sub_menu_rug ul li a',function(e){
		$(".menu_rug_style ul li a").removeClass("active");
		$(this).addClass("active");
		_this = this ,cat_id = $(this).data("cat_id"),
		data = {
			"action" : "load_subcat",
			"cat_id" : cat_id
		} ;
		$("#loading_img").show();
		$.post(global_var.ajax_url,data,function(response){
			$(".subsub_menu_rug_wapper").html(response);
			$("#loading_img").hide();
		});
	});
	$(document).on('click','.main_menu_rug ul li a',function(e){
		$(".main_menu_rug ul li a").removeClass("active");
		$(".menu_rug_style ul li a").removeClass("active");
		$(".select_image_wapper").html("").attr('id','select_' + $(this).data("cat_slug"));
		$(this).addClass("active");
		var cat_id = $(this).data("cat_id");
		$(".menu_rug_style").hide();
		$(".sub_menu_rug#parent_" + cat_id).slideDown(100);
	});
	$(".main_menu_rug ul li:first-child a").trigger("click");
	$(document).on('click','#rugbuilder a',function(e){
		e.preventDefault();
	});
	$(document).on("click",".select_image_wapper ul li a",function(e){
		$(".select_image_wapper ul li a").removeClass("active");
		$(this).addClass("active");
	});
	
});
