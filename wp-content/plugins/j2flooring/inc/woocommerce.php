<?php 
function display_rug_info($rugbuilder){
	$background_id 		= $rugbuilder['background_id'] ;
	$border_id 			= $rugbuilder['border_id'] ;
	$border_price 		= wc_price(get_post_meta( $border_id, '_price', true )) ;
	$background_price 	= wc_price(get_post_meta( $background_id, '_price', true )) ;
	
	
?>
	<div class = 'info_rugbuilder'>
		<p>Background: <span><?php echo get_the_title($background_id); ?></span><br/>
			SQ: <?php echo $rugbuilder['bg_area']; ?> &#13217;
			x <?php echo $background_price; ?></p>
		<p>Border: <span><?php echo get_the_title($border_id); ?></span><br/>
			Cirle: <?php echo $rugbuilder['cir']; ?>m x <?php echo $border_price; ?></p>
	</div>
<?php	
}
/*
add_filter( 'woocommerce_display_item_meta','display_item_data_rugbuilder', 10, 3);
function display_item_data_rugbuilder($html, $item, $args){
	print_r ($html) ;
	return $html;
}*/
add_filter( 'woocommerce_get_item_data','item_data_rugbuilder', 10, 2);
function item_data_rugbuilder($item_data, $cart_item){
	//print_r ($cart_item) ;
	if(isset($cart_item['rugbuilder'])){
		$rugbuilder = $cart_item['rugbuilder'] ;
		
		$background_id 		= $rugbuilder['background_id'] ;
		$background_price 	= wc_price(get_post_meta( $background_id, '_price', true )) ;
		$background_title 	= get_the_title($background_id) ;
		
		$border_id 			= $rugbuilder['border_id'] ;
		$border_price 		= wc_price(get_post_meta( $border_id, '_price', true )) ;
		$border_title 		= get_the_title($border_id) ;
		
		$item_data['background']['name']	= $background_title;
		$item_data['background']['display'] = $rugbuilder['bg_area'].'&#13217; x ' .$background_price;
		
		$item_data['border']['name'] 		= $border_title;
		$item_data['border']['display'] 	= $rugbuilder['cir'].'m x ' .$border_price;
		
	}
	return $item_data;
}
/*
add_action('woocommerce_order_item_meta_end', function( $item_id, $item, $order){
	print_r ($item) ;
}, 10, 3);
add_action('woocommerce_after_cart_item_name', function($cart_item, $cart_item_key){
	if(isset($cart_item['rugbuilder'])){
		$rugbuilder = $cart_item['rugbuilder'] ;
		display_rug_info($rugbuilder);
	}
}, 10, 3);
*/
add_filter('woocommerce_cart_item_thumbnail','create_thumbnail_rugbuilder', 10, 3);
function create_thumbnail_rugbuilder($_product_image, $cart_item, $cart_item_key){
    if(isset($cart_item['rugbuilder'])){
        echo '<div class="canvas" data-bg="'.$cart_item['rugbuilder']['bg_url'][0].'" data-border="'.$cart_item['rugbuilder']['border_url'][0].'" data-height="'.$cart_item['rugbuilder']['height'].'" data-width="'.$cart_item['rugbuilder']['width'].'"></div>';
        $product_get_image = '';
    }
    return $product_get_image; 
}
//add_action('woocommerce_before_order_itemmeta', 'create_thumbnail_rugbuilder_admin', 10, 3);
function create_thumbnail_rugbuilder_admin($item_id, $item, $product){
    if($bg_url = $item->get_meta('rugbuilder_background', true)){
        $border_url = $item->get_meta('rugbuilder_border', true);
        $height = $item->get_meta('rugbuilder_height', true);
        $width = $item->get_meta('rugbuilder_width', true);
        echo '<div class="canvas-data" data-bg="'.$bg_url.'" data-border="'.$border_url.'" data-height="'.$height.'" data-width="'.$width.'"></div>';
    }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'rugbuilder_checkout_create_order_line_item', 20, 4 );
function rugbuilder_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
    if(isset($values['rugbuilder'])){
  		$rugbuilder = $values['rugbuilder'] ;
		
		$background_id 		= $rugbuilder['background_id'] ;
		$background_price 	= wc_price(get_post_meta( $background_id, '_price', true )) ;
		$background_title 	= get_the_title($background_id) ;
		
		$border_id 			= $rugbuilder['border_id'] ;
		$border_price 		= wc_price(get_post_meta( $border_id, '_price', true )) ;
		$border_title 		= get_the_title($border_id) ;
		
		$item->update_meta_data( $background_title, $rugbuilder['bg_area'].'&#13217; x ' .$background_price );
        $item->update_meta_data( $border_title, $rugbuilder['cir'].'m x ' .$border_price);
		
        //$item->update_meta_data( 'Rugbuilder', $values['rugbuilder']);
        /*$item->update_meta_data( 'rugbuilder_background', $values['rugbuilder']['bg_url'][0] );
        $item->update_meta_data( 'rugbuilder_border', $values['rugbuilder']['border_url'][0] );
        $item->update_meta_data( 'rugbuilder_height', $values['rugbuilder']['height'] );
        $item->update_meta_data( 'rugbuilder_width', $values['rugbuilder']['width'] );*/
    }
}
function myplugin_plugin_path() {

  // gets the absolute path to this plugin directory

  return untrailingslashit( plugin_dir_path( __FILE__ ) );
}
add_filter( 'woocommerce_locate_template', 'myplugin_woocommerce_locate_template', 10, 3 );

function myplugin_woocommerce_locate_template( $template, $template_name, $template_path ) {
  global $woocommerce;

  $_template = $template;

  if ( ! $template_path ) $template_path = $woocommerce->template_url;

  $plugin_path  = SD_PLUGIN_PATH . '/woocommerce/';

  // Look within passed path within the theme - this is priority
  $template = locate_template(

    array(
      $template_path . $template_name,
      $template_name
    )
  );

  // Modification: Get the template from this plugin, if it exists
  if ( ! $template && file_exists( $plugin_path . $template_name ) )
    $template = $plugin_path . $template_name;

  // Use default template
  if ( ! $template )
    $template = $_template;

  // Return what we found
  return $template;
}
?>