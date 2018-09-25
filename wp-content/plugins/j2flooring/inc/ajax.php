<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'woocommerce_before_calculate_totals', 'update_custom_price', 10, 1 );
function update_custom_price( $cart_object ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}
    foreach ( $cart_object->cart_contents as $cart_item_key => $value ) {
		if(isset($value["rugbuilder"]) ){
			$rugbuilder_price = $value["rugbuilder"]['price'];
			$value['data']->set_price( $rugbuilder_price);
		}
    }
	return $cart_object ;
}
/*
add_action('woocommerce_add_order_item_meta','update_add_values_to_order_item_meta',1,2);
if(!function_exists('update_add_values_to_order_item_meta'))
{
  function update_add_values_to_order_item_meta($item_id, $values)
  {
        global $woocommerce,$wpdb;
 		$addon_name = $values["lense_addon"]["value"];
		$addon_price = $values["lense_addon"]["price"];
        if(!empty($addon_name))
        {
            wc_update_order_item_meta($item_id,$addon_name,$addon_price);  
        }
  }
}
*/
add_action( 'wp_ajax_rugbuilder_add_to_cart', 'rugbuilder_add_to_cart' );
add_action( 'wp_ajax_nopriv_rugbuilder_add_to_cart', 'rugbuilder_add_to_cart' );
function rugbuilder_add_to_cart() {
	global $img_taxes;
	$product_obj = get_page_by_path( "rug-builder", OBJECT, 'product' );

	$rugbuilder = $_POST['rugbuilder'] ;
	//$item_key 	= $_POST['item_key'] ;
	$bg_area 	= $rugbuilder['height'] * $rugbuilder['width'] ;
	$cir 		= ($rugbuilder['height'] + $rugbuilder['width']) * 2 ;
	
	$border_id 		= $rugbuilder['border'];
	$background_id 	= $rugbuilder['background'];
	$border_price 		= get_post_meta( $border_id, '_price', true ) * $cir;
	$background_price 	= get_post_meta( $background_id, '_price', true ) * $bg_area;
	$rugbuilder_price =  $border_price + $background_price ;
	$cart_item_meta["rugbuilder"]["bg_area"] =  $bg_area;
	$cart_item_meta["rugbuilder"]["cir"] =  $cir;
	$cart_item_meta["rugbuilder"]["price"] =  $rugbuilder_price;
	$cart_item_meta["rugbuilder"]["bg_url"] =  wp_get_attachment_image_src( get_post_meta( $rugbuilder['background'],"_pattern_id", true ), 'full' );
	$cart_item_meta["rugbuilder"]["border_url"] = wp_get_attachment_image_src( get_post_meta( $rugbuilder['border'],"_pattern_id", true ), 'full' );
	$cart_item_meta["rugbuilder"]["height"] =  $rugbuilder['height'];
	$cart_item_meta["rugbuilder"]["width"] =  $rugbuilder['width'];

	//WC()->cart->remove_cart_item($item_key);	
	wc_empty_cart();
	$error = WC()->cart->add_to_cart($product_obj->ID,1, $product_obj->ID , array(), $cart_item_meta );
	/*
	*/
	echo wc_get_cart_url();
	wp_die();
}
add_action( 'wp_ajax_calculation_price', 'calculation_price' );
add_action( 'wp_ajax_nopriv_calculation_price', 'calculation_price' );
function calculation_price() {
	$rugbuilder = $_POST['rugbuilder'] ;
	$price = wc_price(get_price_rugbuilder($rugbuilder));
	ob_start();
	?>
	<div id = 'calculation_result_wapper'>
		<?php echo $price?>
		<a id = 'rugbuilder_add_to_cart' href = '' >Add to cart</a>
	</div>
	<?php
	$page = ob_get_contents();
	ob_clean();
	wp_send_json($page);
	//$price = $bg_area * 
	wp_die();
}
function get_price_rugbuilder($rugbuilder){
	$bg_area 	= $rugbuilder['height'] * $rugbuilder['width'] ;
	$cir 		= ($rugbuilder['height'] + $rugbuilder['width']) * 2 ;
	
	$border_id 		= $rugbuilder['border'];
	$background_id 	= $rugbuilder['background'];
	$border_price 		= get_post_meta( $border_id, '_price', true ) * $cir;
	$background_price 	= get_post_meta( $background_id, '_price', true ) * $bg_area;
	return $border_price + $background_price ;
}
add_action( 'wp_ajax_load_product', 'load_product' );
add_action( 'wp_ajax_nopriv_load_product', 'load_product' );
function load_product() {
	$cat_id = $_POST['cat_id'];
	$patterns = get_posts(array(
		'post_type' => 'rug-builder',
		'tax_query' => array(
			array(
			'taxonomy' => 'rugcat-tax',
			'field' => 'term_id',
			'terms' => $cat_id)
		))
	);
	ob_start();
	?>
	<?php
		
		?>
	<div class = 'menu_rug_style' id = 'parent_product_<?php echo $cat_id ; ?>'>
		<ul class = ''>
			<?php foreach($patterns as $pattern){ 
				$id = $pattern->ID ;
				$img_id = get_post_meta( $id,"_pattern_id", true );
				$src = wp_get_attachment_image_src( $img_id, 'full' );
			?>
				<li>
				<a  data-pattern_id = '<?php echo $id ; ?>' href = ''>
					<img src = "<?php echo $src[0]; ?>" />
					<span><?php echo $pattern->post_title ; ?></span>
				</a>
				</li>
			<?php }  ?>
		</ul>
	</div>
	<span class = 'close'>✕</span>
	<?php
	$page = ob_get_contents();
	ob_clean();
	wp_send_json($page);
	wp_die();
}
add_action( 'wp_ajax_load_subcat', 'load_subcat' );
add_action( 'wp_ajax_nopriv_load_subcat', 'load_subcat' );
function load_subcat() {
	$parent_id = $_POST['cat_id'];
	global $img_taxes;
	ob_start();
	?>
	<?php
			$children = get_terms( array(
				'taxonomy' => 'rugcat-tax',
				'hide_empty' => false,
				'parent' => $parent_id,
			) );
		
		?>
	<div class = 'subsub_menu_rug menu_rug_style' id = 'parent_<?php echo $parent_id ; ?>'>
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
	<?php
	$page = ob_get_contents();
	ob_clean();
	wp_send_json($page);
	wp_die();
}
?>