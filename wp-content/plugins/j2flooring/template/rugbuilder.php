<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> style = 'margin:0!important;' class="<?php  ?>"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>

<link href="<?php echo plugin_dir_url(__FILE__);?>/rugbuilder.css" rel="stylesheet" type="text/css">

</head>
<body id = "rugbuilder">
<?php
		$img = wp_get_attachment_image_src( 84, 'full' ) ;
		$logo_url =$img[0];
?>
	<div class="container">
		<div id = 'header_rugbuilder'>
			<div class = 'control' id = 'back_page'><a href = "">&#8592; Back</a></div>
			<div id = 'logo'><img src = "<?php echo $logo_url; ?>" /></div>
			<div class = 'control' id = 'close_page'><a href = "">&#x2715; Exit</a></div>
		</div>
	</div>
	<?php
	$parents = array(22,21);
	global $img_taxes;
	?>
	<div class="container">
		<div class="main_menu">
			<div class = 'main_menu_rug'>
				<ul class = ''>
				<?php
				
				foreach($parents as $parent_id){
					$parent = get_term ($parent_id); 
					?>
					<li><a data-cat_slug = '<?php echo $parent->slug ; ?>' data-cat_id = '<?php echo $parent_id ; ?>' href = ''><?php echo $parent->name ; ?></a></li>
					<?php
				}
				
				?>
					<li id = 'menu_size'><a data-cat_slug = 'size'href = '' data-cat_id = 'menu_size'>Size</a></li>
				</ul>
			</div>
			<div class = 'select_image_wapper'>
			</div>
			<div class = 'sub_menu_rug_wapper'>
				<?php
				
				foreach($parents as $parent_id){
						$children = get_terms( array(
							'taxonomy' => 'rugcat-tax',
							'hide_empty' => false,
							'parent' => $parent_id,
						) );
					
					?>
				<div class = 'sub_menu_rug menu_rug_style cat_<?php echo get_term($parent_id)->slug ; ?>' id = 'parent_<?php echo $parent_id ; ?>'>
					<ul class = ''>
						<?php foreach($children as $child){ 
							$term_id = $child->term_id ;
						?>
							<li>
							<a data-cat_id = '<?php echo $term_id ; ?>' href = ''>
								<img src = "<?php echo $img_taxes[$term_id]; ?>" />
								<span><?php echo $child->name ; ?></span>
							</a>
							</li>
						<?php } ?>
					</ul>
				</div>
					<?php } ?>
				<div class = 'sub_menu_rug menu_rug_style' id = 'parent_menu_size'>
					<div class = 'calculate_form'>
							<p><b>Height (m): </b><input type="number" class="form-control size-height" max="1000" min="0" step="0.1" name="height" value=""  /></p>
							<p><b>Witdh (m): </b><input type="number" class="form-control size-width" max="1000" min="0" step="0.1" name="width" value="" /></p>
							<p><a href="javascript:void(0);" class="apply-size">Calculate price</a>
					</div>
				</div>
			</div>
			<div class="subsub_menu_rug_wapper">
			</div>
		</div>
		<div class="review_main">
			<div id="calculation_result">
			</div>
			<div class="arrow_canvas">
				<canvas id = 'arrow_canvas'></canvas>
			</div>
			<div id="images_canvas" class="dragscroll"></div>
			<div id = 'canvas_control' >
				<a id = "zoom_in">+</a>
				<a id = "zoom_out">-</a>
			</div>
		</div>
	</div>
</body>
</html>