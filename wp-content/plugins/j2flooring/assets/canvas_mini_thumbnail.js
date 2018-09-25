! function($) {
    "use strict";
    $.fn.rugbuilder = function() {
        var _canvas,_this, arrow_canvas, m_to_pix, canvas_width, _scale,
        canvas_height,_max_height, _max_width, default_square_rate, _size_boder,zoom_step ,square_rate, _multi, _max_zoom_step, _min_scale;
        function init() {
            _multi = 4;
            m_to_pix = 100;
            _size_boder = 20;
            canvas_width = 200;
            _canvas = document.createElement('canvas'),
            _canvas.id = "canvas";
            _canvas.style.maxWidth = "100%";
            _canvas.width  = Math.round(parseFloat(_this.attr('data-width'))*m_to_pix +  ft_m_to_pix(80) )*_multi;
			_canvas.height = Math.round(parseFloat(_this.attr('data-height'))*m_to_pix +  ft_m_to_pix(80) )*_multi;
            _canvas.background = _this.attr('data-bg');
            _canvas.border = _this.attr('data-border');
            set_background(_canvas.background);
            set_border(_canvas.border);
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
				var _moveto = 40*_multi;
				_draw.fillRect(_moveto, _moveto, _canvas.width - 80*_multi, _canvas.height - 80*_multi);
                _canvas.background = src ;
			}
            $(_this).html(_canvas);
        }
        
		function set_border(src){
			var _image = new Image();
			_image.src = src;
			var _draw = _canvas.getContext('2d');
			_image.onload = function() {
				var _pattern = _draw.createPattern(_image, 'repeat');
				_draw.fillStyle = _pattern;
				var temp_size_boder = _size_boder*_multi;
				var _moveto = 40*_multi;
				//top
				_draw.beginPath();
				_draw.moveTo(_moveto, _moveto);
				_draw.lineTo( _moveto + temp_size_boder, _moveto + temp_size_boder);
				_draw.lineTo(_canvas.width - temp_size_boder - _moveto, temp_size_boder + _moveto);
				_draw.lineTo(_canvas.width - _moveto, _moveto);
				_draw.fill();
				//left
				_draw.rotate(90 * Math.PI / 180);
				_draw.translate(0, -_canvas.width);
				_draw.beginPath();
				_draw.moveTo(_moveto, _moveto);
				_draw.lineTo( _moveto + temp_size_boder, _moveto + temp_size_boder);
				_draw.lineTo(_canvas.height-temp_size_boder - _moveto, temp_size_boder + _moveto);
				_draw.lineTo(_canvas.height - _moveto, _moveto);
				_draw.fill();
				//bottom
				_draw.rotate(90 * Math.PI / 180);
				_draw.translate(0, -_canvas.height);
				_draw.beginPath();
				_draw.moveTo(_moveto, _moveto);
				_draw.lineTo( _moveto + temp_size_boder, _moveto + temp_size_boder);
				_draw.lineTo(_canvas.width-temp_size_boder - _moveto, temp_size_boder + _moveto);
				_draw.lineTo(_canvas.width - _moveto, _moveto);
				_draw.fill();
				//right
				_draw.rotate(90 * Math.PI / 180);
				_draw.translate(0, -_canvas.width);
				_draw.beginPath();
				_draw.moveTo(_moveto, _moveto);
				_draw.lineTo( _moveto + temp_size_boder, _moveto + temp_size_boder);
				_draw.lineTo(_canvas.height-temp_size_boder - _moveto, temp_size_boder + _moveto);
				_draw.lineTo(_canvas.height - _moveto, _moveto);
				_draw.fill();
				//reset _draw
				_draw.rotate(90 * Math.PI / 180);
				_draw.translate(0, -(_canvas.width + (_canvas.height - _canvas.width)));
				_canvas.border = src ;
			}
			$(_this).html(_canvas);
        }
        return _this = this ,init();
    }
}(jQuery);
jQuery(function($){
    if($( '.canvas' ).length > 0){
        $( '.canvas' ).rugbuilder();
    }
    if($('.canvas-data').length > 0){
        $( '.canvas-data' ).each(function(){
            var thumbtarget = $(this).closest('tr').find('.wc-order-item-thumbnail');
            thumbtarget.empty();
            thumbtarget.attr('data-bg', $(this).attr('data-bg'));
            thumbtarget.attr('data-border', $(this).attr('data-border'));
            thumbtarget.attr('data-height', $(this).attr('data-height'));
            thumbtarget.attr('data-width', $(this).attr('data-width'));
            thumbtarget.addClass('canvas');
            thumbtarget.rugbuilder();
        });
    }
});
