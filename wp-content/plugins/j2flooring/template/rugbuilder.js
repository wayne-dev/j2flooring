jQuery(function($){
	var _this ,product = {
		'background' : '',
		'border' : '',
		'width' : '',
		'height' : ''
	};
	$(".subsub_menu_rug_wapper").after('<div style = "display:none" id = "loading_img"><img  src = "'+global_var.loading_img+'" /></div>');
	$(document).on('click','.select_image_wapper .close',function(e){
		$(_this).removeClass("active");
		$(".select_image_wapper").removeClass("open").html("");
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
		$(".select_image_wapper").removeClass("open");
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
		$('#calculation_result').hide();
	});
	$(document).on("click","a.apply-size",function(e){
		e.preventDefault();
		global_var.rugbuilder.width = $(".size-width").val();
		global_var.rugbuilder.height = $(".size-height").val();
		var rugbuilder = global_var.rugbuilder ,
		data = {
			"action" : "calculation_price",
			"rugbuilder" : rugbuilder
		} ;
		if(rugbuilder.border && rugbuilder.background){
		$("#loading_img").show();
			$.post(global_var.ajax_url,data,function(response){
				console.log(response);
				$('#calculation_result').html(response).show();
				$("#loading_img").hide();
			});
		}
		if(!rugbuilder.border) {
			$('a[data-cat_slug=border]').click();
		}
		if(!rugbuilder.background) {
			$('a[data-cat_slug=center]').click();
		}
	});
	$(document).on("click","a#rugbuilder_add_to_cart",function(e){
		var rugbuilder = global_var.rugbuilder ,
		data = {
			"action" : "rugbuilder_add_to_cart",
			"rugbuilder" : rugbuilder
		} ;
		if(rugbuilder.border && rugbuilder.background){
		$("#loading_img").show();
			$.post(global_var.ajax_url,data,function(response){
				console.log(response);
				location.href = response;
				$("#loading_img").hide();
			});
		}
	});
	$(document).on("click",".select_image_wapper ul li a",function(e){
		$(".select_image_wapper ul li a").removeClass("active");
		$(this).addClass("active");
	});
	
});
