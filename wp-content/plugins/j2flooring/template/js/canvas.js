! function($) {
    "use strict";
	$.fn.rugbuilder = function() {
		var _canvas,_this, arrow_canvas, m_to_pix, canvas_width, _scale,
		canvas_height,_max_height, _max_width, default_square_rate, _size_boder,zoom_step ,square_rate;
		var _canvas_border,ct_arrow_canvas ;
		function init() {
			
			m_to_pix = 100; // 1m - 100px
			square_rate = default_square_rate = 1;//square rate  = h / w
			_max_width = $("html").width()*0.8 + 40 ;
			_max_height = $("html").width() * square_rate*0.8 + 40;
			_size_boder = 20;//_size_boder 20 px
			zoom_step	= 0.02;
			_scale = 1;
			_canvas = document.createElement('canvas'),_canvas.id     = "canvas";
			//canvas_width 	= _canvas.width		=  _max_width * 0.6; // max canvas width = 0.6 screen (px)
			canvas_width 	= _canvas.width		=  500 + 80; // max canvas width = 0.6 screen (px)
			canvas_height 	= _canvas.height	=  500 * square_rate + 80;
			_canvas.background = '';
			_canvas.border = '';
			arrow_canvas = document.getElementById('arrow_canvas');
			ct_arrow_canvas = arrow_canvas.getContext("2d");
			arrow_canvas.width		= _canvas.width  ;
			arrow_canvas.height		= _canvas.height;
			//----------
			
			//_canvas.border= 'http://localhost/j2flooring.com/wp-content/uploads/2018/09/Wool1-150x150.jpg';
			//set_background("https://findicons.com/files/icons/102/openphone/128/settings.png");
			
			$('#parent_menu_size input[name="width"]').val((_canvas.width  - ft_m_to_pix(80))/m_to_pix);
			$('#parent_menu_size input[name="height"]').val((_canvas.height - ft_m_to_pix(80))/m_to_pix);
			//draw_distance_info();
			
		}
		function ft_m_to_pix (x){
				return x * (m_to_pix/100) ;
		}
		function set_background(src){
			var _image = new Image();
			_image.src = src;
			var _draw = _canvas.getContext('2d');
			_image.onload = function() {
				var _pattern = _draw.createPattern(_image, 'repeat');
				_draw.fillStyle = _pattern;
				//_draw.translate(40, 40);
				_draw.fillRect(40, 40, _canvas.width-80, _canvas.height-80);
				_canvas.background = src ;
				if(_canvas.border)
					set_border(_canvas.border);
				draw_distance_info();
			}
			//_temp_background = src;
			$(_this).html(_canvas);
		}
		function set_border(src){
			var _image = new Image();
			_image.src = src;
			var _draw = _canvas.getContext('2d');
			_image.onload = function() {
				var _pattern = _draw.createPattern(_image, 'repeat');
				//_draw.translate(-40, -40);
				_draw.fillStyle = _pattern;
				//top
				_draw.beginPath();
				_draw.moveTo(40, 40);
				_draw.lineTo( 40 + _size_boder, 40 + _size_boder);
				_draw.lineTo(_canvas.width-_size_boder - 40, _size_boder + 40);
				_draw.lineTo(_canvas.width - 40, 40);
				_draw.fill();
				//_draw.fillRect(0, 0, _canvas.width, _size_boder);
				//bottom
				_draw.beginPath();
				_draw.moveTo(40,  _canvas.height -40);
				_draw.lineTo(_size_boder + 40, _canvas.height-_size_boder - 40);
				_draw.lineTo(_canvas.width-_size_boder - 40, _canvas.height-_size_boder - 40);
				_draw.lineTo(_canvas.width -40, _canvas.height -40);
				_draw.fill();
				//_draw.fillRect(0, _canvas.height-_size_boder, _canvas.width, _size_boder);
				//left
				_draw.beginPath();
				_draw.moveTo(40, 40);
				_draw.lineTo( 40 + _size_boder, 40+ _size_boder);
				_draw.lineTo( _size_boder + 40, _canvas.height-_size_boder - 40);
				_draw.lineTo(40, _canvas.height - 40);
				_draw.fill();
				//_draw.fillRect(0, 0, _size_boder, _canvas.height);
				//right
				_draw.beginPath();
				_draw.moveTo( _canvas.width - 40, 40);
				_draw.lineTo( _canvas.width-_size_boder - 40, _size_boder + 40);
				_draw.lineTo( _canvas.width-_size_boder - 40, _canvas.height-_size_boder -40);
				_draw.lineTo(_canvas.width - 40, _canvas.height -40);
				_draw.fill();
				//_draw.fillRect(_width-_size_boder, 0, _size_boder, _canvas.height);
				_canvas.border = src ;
			}
			$(_this).html(_canvas);
			//_temp_border = src;
		}
		function update_canvas(){
			set_background(_canvas.background);
			//set_border(_canvas.border);
			
			//$(_this).html(_canvas);
		}
		$(document).on("click",".select_image_wapper#select_center .menu_rug_style ul li a",function(e){
			var $src = $(this).find('img').attr("src");
			set_background($src);
		});
		$(document).on("click",".select_image_wapper#select_border .menu_rug_style ul li a",function(e){
			var $src = $(this).find('img').attr("src");
			set_border($src);
		});
		function fix_rate(){
			//console.log(_canvas.height + '-' + _max_height);
			//square_rate = h / w ;
			var scale = 1;
			if(_canvas.width > _max_width){
				//scale = _max_width / _canvas.width  ;
				scale = _max_width / _canvas.width  ;
			}
			if(_canvas.height > _max_height){
				//scale = _max_height / _canvas.height ;
				scale = _max_height / _canvas.height ;
			}
			update_distance_info();
			scale_img(scale);
		}
		$(document).on('change', '#parent_menu_size input', function(e){
			var $_parent = $(this).closest('#parent_menu_size');
			_canvas.height 	= (parseFloat($_parent.find('[name="height"]').val())*m_to_pix +  ft_m_to_pix(80)) ;
			_canvas.width 	= (parseFloat($_parent.find('[name="width"]').val())*m_to_pix +  ft_m_to_pix(80)) ;
			console.log(ft_m_to_pix(80));
			console.log($_parent.find('[name="height"]').val());
			square_rate = _canvas.height / _canvas.width ;
			update_canvas();
			fix_rate() ;
			//draw_distance_info();
		});
		function update_distance_info(){
			reset_canvas('.arrow_canvas');
			//draw_distance_info();
		}
		function reset_canvas(wapper){
			$(wapper).find('canvas').remove();
			$(wapper).append('<canvas id="arrow_canvas"></canvas>');
			arrow_canvas = document.getElementById('arrow_canvas');
			ct_arrow_canvas = arrow_canvas.getContext("2d");
			arrow_canvas.width		= _canvas.width  ;
			arrow_canvas.height		= _canvas.height;
		}
		function draw_distance_info(){
			//console.log(_canvas);
			draw_distance({x:45,y:25},{x:arrow_canvas.width-45,y:25});
			draw_distance({x:25,y:45},{x:25,y:arrow_canvas.height-45});
			draw_width_value(_canvas.width);
			draw_height_value(_canvas.height);			
		}
		$('a#zoom_in').click(function(e){
			e.preventDefault();
			if($('#images_canvas canvas').width() <= (_max_width * 0.8)){
				_scale = parseFloat(_scale) + zoom_step;
				 scale_img(_scale);
			}
		});
		$('a#zoom_out').click(function(e){
			e.preventDefault();
			if($('#images_canvas canvas').width() >= (_max_width * 0.4)){
				_scale = parseFloat(_scale) - zoom_step;
				 scale_img(_scale);
			}
		});
		function scale_img(scale){
			$('#images_canvas canvas').css({'height':  _canvas.height*scale+'px' , 'width': _canvas.width*scale+'px'});
			$('.arrow_canvas canvas').css({'height':  arrow_canvas.height*scale+'px' , 'width': arrow_canvas.width*scale+'px'});
		}
		
		function draw_width_value(text){
			text -= ft_m_to_pix(80);
			text += " cm";
			//var ctx = arrow_canvas.getContext("2d");
			ct_arrow_canvas.font = "10px Open Sans";
			ct_arrow_canvas.fillText(text,(arrow_canvas.width / 2)-20,20);
		}
		function draw_height_value(text){
			text -= ft_m_to_pix(80);
			text += " cm";
			//var ctx = arrow_canvas.getContext('2d');
			ct_arrow_canvas.save();
			ct_arrow_canvas.translate( 20, 20);
			ct_arrow_canvas.rotate(-Math.PI/2);
			ct_arrow_canvas.font = "10px Open Sans";
			ct_arrow_canvas.textAlign = "center";
			ct_arrow_canvas.fillText(text, (-0.5 * arrow_canvas.height ) +20, -5);
			ct_arrow_canvas.restore();
		}

		function draw_distance(from,to){
			var arrow_size = 5;
			//var ctx = arrow_canvas.getContext('2d');
			ct_arrow_canvas.lineWidth = 1;
			ct_arrow_canvas.beginPath();
			ct_arrow_canvas.fillStyle = 'steelbllue'; // for the triangle fill
			ct_arrow_canvas.lineJoin = 'butt';

			ct_arrow_canvas.moveTo(from.x, from.y);
			ct_arrow_canvas.lineTo(to.x, to.y);
			ct_arrow_canvas.strokeStyle = '#000';
			ct_arrow_canvas.stroke();

			canvas_arrow(ct_arrow_canvas, from.x, from.y, to.x, to.y, arrow_size);
			canvas_arrow(ct_arrow_canvas, to.x, to.y, from.x, from.y, arrow_size);
			$(_this).html(_canvas);
		}
		function canvas_arrow(context, fromx, fromy, tox, toy, r){
			var x_center = tox;
			var y_center = toy;
			
			var angle;
			var x;
			var y;
			
			context.beginPath();
			
			angle = Math.atan2(toy-fromy,tox-fromx)
			x = r*Math.cos(angle) + x_center;
			y = r*Math.sin(angle) + y_center;

			context.moveTo(x, y);
			
			angle += (1/3)*(2*Math.PI)
			x = r*Math.cos(angle) + x_center;
			y = r*Math.sin(angle) + y_center;
			
			context.lineTo(x, y);
			
			angle += (1/3)*(2*Math.PI)
			x = r*Math.cos(angle) + x_center;
			y = r*Math.sin(angle) + y_center;
			
			context.lineTo(x, y);
			
			context.closePath();
			context.fill();
		}
		return _this = this ,init();
	}
}(jQuery);
jQuery(function($){
	$( '#images_canvas' ).rugbuilder();
});
