jQuery(document).ready(function($){
	var _canvas = document.createElement('canvas');
	_canvas.id     = "canvas";
	var _width = _canvas.width = 1200; //$("html").width() * 0.6;
	var _height = _canvas.height = _width * 0.6;
	var _temp_border, _temp_background = '';
	var _scale = 1 , zoom_step = 0.05;
	var _size_boder = 20;
	
	function change_background(src, size, canvas){
		var _image = new Image();
		_image.src = src;
		var _draw = canvas.getContext('2d');
		_image.onload = function() {
			var _pattern = _draw.createPattern(_image, 'repeat');
			_draw.fillStyle = _pattern;
			_draw.fillRect(size, size, _width-(size*2), _height-(size*2));
		}
		_temp_background = src;
	}
	function change_border(src, size, canvas){
		var _image = new Image();
		_image.src = src;
		var _draw = canvas.getContext('2d');
		_image.onload = function() {
			var _pattern = _draw.createPattern(_image, 'repeat');
			_draw.fillStyle = _pattern;
			//top
			_draw.beginPath();
			_draw.moveTo(0, 0);
			_draw.lineTo( size, size);
			_draw.lineTo(_width-size, size);
			_draw.lineTo(_width, 0);
			_draw.fill();
			//_draw.fillRect(0, 0, _width, size);
			//bottom
			_draw.beginPath();
			_draw.moveTo(0, _height);
			_draw.lineTo(size, _height-size);
			_draw.lineTo(_width-size, _height-size);
			_draw.lineTo(_width, _height);
			_draw.fill();
			//_draw.fillRect(0, _height-size, _width, size);
			//left
			_draw.beginPath();
			_draw.moveTo(0, 0);
			_draw.lineTo( size, size);
			_draw.lineTo( size, _height-size);
			_draw.lineTo(0, _height);
			_draw.fill();
			//_draw.fillRect(0, 0, size, _height);
			//right
			_draw.beginPath();
			_draw.moveTo(_width, 0);
			_draw.lineTo( _width-size, size);
			_draw.lineTo( _width-size, _height-size);
			_draw.lineTo(_width, _height);
			_draw.fill();
			//_draw.fillRect(_width-size, 0, size, _height);
		}
		_temp_border = src;
	}
	function add_canvas(){
		$('#images_canvas').empty();
		document.getElementById('images_canvas').appendChild(_canvas);
		scale_img();
	}
	function scale_img(){
		if(_scale == 1){
			var _width_canvas = $("html").width() * 0.6;
			$('#images_canvas canvas').css({'height': _width_canvas*0.6+'px' , 'width': _width_canvas+'px'});
		} else {
			$('#images_canvas canvas').css({'height': _height*_scale+'px' , 'width': _width*_scale+'px'});
		}
	}
	$('.canvas-background').click(function(){
		var $src = $(this).attr('data-pattern');
		change_background($src, _size_boder, _canvas);
		if(_temp_border){
			change_border(_temp_border, _size_boder, _canvas);
		}
		add_canvas();
	});
	$('.canvas-border').click(function(){
		var $src = $(this).attr('data-pattern');
		if(_temp_background){
			change_background(_temp_background, _size_boder, _canvas);
		}
		change_border($src, _size_boder, _canvas);
		add_canvas();
	});
	$('a#zoom_in').click(function(e){
		e.preventDefault();
		_scale = parseFloat(_scale) + zoom_step;
		scale_img();
	});
	$('a#zoom_out').click(function(e){
		e.preventDefault();
		_scale = parseFloat(_scale) - zoom_step;
		scale_img();
	});
	$(document).on("click",".select_image_wapper ul li a",function(e){
		$(".select_image_wapper ul li a").removeClass("active");
		$(this).addClass("active");
	});
	$(document).on("click",".select_image_wapper#select_center .menu_rug_style ul li a",function(e){
		var $src = $(this).find('img').attr("src");
		change_background($src, _size_boder, _canvas);
		if(_temp_border){
			change_border(_temp_border, _size_boder, _canvas);
		}
		add_canvas();
	});
	$(document).on("click",".select_image_wapper#select_border .menu_rug_style ul li a",function(e){
		var $src = $(this).find('img').attr("src");
		if(_temp_background){
			change_background(_temp_background, _size_boder, _canvas);
		}
		change_border($src, _size_boder, _canvas);
		add_canvas();
	});
});